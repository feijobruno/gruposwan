CREATE TABLE seq_supplier_order (
    supplier_order INT NOT NULL PRIMARY KEY,
    year_order INT
);

DELIMITER $
CREATE TRIGGER trg_supplier_order BEFORE INSERT ON supplier_orders
FOR each ROW
BEGIN
   SET NEW.order = get_order_supplier();
END$
DELIMITER ;


DELIMITER $

CREATE FUNCTION get_order_supplier() RETURNS VARCHAR(10)
BEGIN
    DECLARE last_value INT;
    SET last_value = (SELECT supplier_order FROM seq_supplier_order);
    SET last_value = last_value + 1;
    UPDATE seq_supplier_order SET supplier_order = last_value;
    SET @result = (SELECT concat(lpad(last_value, 5, '0'), '-', CAST((SELECT year_order FROM seq_supplier_order) AS CHAR(4))));
    RETURN @result;
END$

DELIMITER ;


CREATE TABLE stock_products (
    id INT AUTO_INCREMENT PRIMARY KEY,        -- Primary key with auto increment
    product VARCHAR(100) NOT NULL,       -- Product name
    quantity INT NOT NULL,                    -- Available stock quantity
    batch_number VARCHAR(50) NOT NULL,        -- Batch number
    expiration_date DATE,                     -- Expiration date of the batch (if applicable)
    received_date DATE NOT NULL,              -- Date the batch was received
    supplier VARCHAR(100),                    -- Supplier name
    unit_price DECIMAL(10, 2) NOT NULL,       -- Unit price of the product
    storage_location VARCHAR(50),             -- Storage location of the product
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Record creation timestamp
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  -- Record last update timestamp
);


CREATE TABLE supplier_order_item_batches (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- Primary key for each batch associated with an item
    item_id INT NOT NULL,                          -- Foreign key linking to purchase_order_items
    product_id INT NOT NULL,                       -- Foreign key linking to stock_products (specific product)
    batch_number VARCHAR(50) NOT NULL,             -- Batch number of the product being ordered
    quantity_ordered INT NOT NULL,                 -- Quantity ordered for this specific batch
    unit_price DECIMAL(10, 2) NOT NULL,            -- Unit price for this batch
    total_price DECIMAL(10, 2), -- Total price for this batch
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Record creation timestamp
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,  -- Record last update timestamp
    FOREIGN KEY (item_id) REFERENCES supplier_order_items(id) ON DELETE CASCADE, -- Linking to purchase_order_items
    FOREIGN KEY (product_id) REFERENCES stock_products(id) ON DELETE CASCADE  -- Linking to stock_products
    
);


CREATE TABLE stock_products (
    id INT AUTO_INCREMENT PRIMARY KEY,        -- Primary key with auto increment
    product VARCHAR(100) NOT NULL,       -- Product name
    quantity INT NOT NULL,                    -- Available stock quantity
    batch_number VARCHAR(50) NOT NULL,        -- Batch number
    expiration_date DATE,                     -- Expiration date of the batch (if applicable)
    received_date DATE NOT NULL,              -- Date the batch was received
    supplier VARCHAR(100),                    -- Supplier name
    unit_price DECIMAL(10, 2) NOT NULL,       -- Unit price of the product
    storage_location VARCHAR(50),             -- Storage location of the product
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,  -- Record creation timestamp
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP  -- Record last update timestamp
);

CREATE TABLE stock_movements (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each movement
    product_id INT NOT NULL,                       -- The ID of the item being moved
    movement_type ENUM('in', 'out') NOT NULL,   -- The type of movement: "in" for adding stock, "out" for removing stock
    quantity INT NOT NULL,                      -- The quantity of the item being moved
    movement_date DATETIME NOT NULL,            -- The date and time of the movement
    order_id INT NOT NULL,                       -- The ID of the item being moved
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Timestamp for when the record was created
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Record last update timestamp
);

CREATE VIEW stock_by_item_and_warehouse AS
SELECT
    soi.product_id,
    soi.product,
    w.order_id,
    w.warehouse_name,
    SUM(CASE WHEN sm.movement_type = 'in' THEN sm.quantity ELSE 0 END) -
    SUM(CASE WHEN sm.movement_type = 'out' THEN sm.quantity ELSE 0 END) AS current_stock
FROM
    stock_movements sm
JOIN
    supplier_order_item soi ON sm.item_id = so.item_id
JOIN
    supplier_order so ON sm.warehouse_id = w.warehouse_id
GROUP BY
    i.item_id, w.warehouse_id;