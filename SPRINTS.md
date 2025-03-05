# Sprint 26-10-24

# Customer
- Refatorar customer module - Bruno

# Customer Order
- Lista de produtos baseado na stock
- Refator Endereços

# Supplier Order and Stock
- Criar stock baseado na supplier order
- Lote do pedido

# Products
- TDS / SDS e Technical
- Editar e Excluir arquivos 


###  Sprint 15/11/24 ###
## TODO

# Customer Order
– Teste CRUD

# Supplier Order -- ANDAMENTO
- Create Order, autocomplete dos campos de endereço após selecionar o cliente / armazen -- CONCLUÍDO
- Create Order, possibilidade de adicionar vários arquivos **** (Verificar possibilidade de dados polimorficos, ex: OrderFiles  ) - ANDAMENTO
 

##  FYI
# Tabela Criada em Banco de Dados -- CONCLUÍDO

    OBS: Select Option customerOrders/create.blade.php, já está listando com informações vinda do banco. 
Status de um pedido:
 
Quando material está en armazem:
 
1- Pedido registrado
2- Pedido a proveedor 
3- Enviado albarán 
4- Enviado COA
5- Listo para factuar
6- Facturado a PA 
7- Facturado al cliente
8- Factura pagada
9- Pedido completado
 
Quando material nao está em armazem 
 
1- Pedido registrado
2- Pedido a proveedor
3- Pedido sin costes 
4- Llegada a almacén 
5- Enviado albarán 
6- Enviado COA
7- Listo para factuar
8- Facturado a PA 
9- Facturado al cliente
10- Factura pagada
11- Pedido completado

## Criar Tabela Incoterm -- CONCLUÍDO
    OBS: Select Option SuplierOrders/create.blade.php, SuplierOrders/edit.blade.php, PaOrders/create.blade.php , já está listando com informações vinda do Banco.

- Campos
id
incoterm
created_at
updated_at


## Questions
- Customer Order terá status? Será o mesmo do Supplier Order

---------------------------------------------------------------------------------------------------------------------------------------------
###  Sprint 19/11/24 ###
## TODO

# Customer Order
– Price ser o valor inserido na supplier order
-


# S
- Create Order, autocomplete dos campos de endereço após selecionar o cliente / armazen -- CONCLUÍDO
- Create Order, possibilidade de adicionar vários arquivos **** (Verificar possibilidade de dados polimorficos, ex: OrderFiles  ) - ANDAMENTO
 
##  FYI

Supplier Order (PO) --> PA Order (PS comprando da PA) --> Customer Order

Albarán --> Pedido de entrega ** 

###  Sprint 26/11/24 ###
## TODO

# Supplier Order
– Supplier Order salvar owner - Feijó
- Supplier Order Item salvar owner - Feijó
- Armazen para DAVI - Eric
- Vários arquivos para o Supplier Order para cadastrar e editar - Eric 

Products to Supplier Order
- Lógica para Supplier Order / Items salvar o preço unitário e qty (kg). Pallet dever ser calculado pelo sistema ***

##  FYI

Supplier Order --> PA Order (PS comprando da PA, se houver) --> Customer Order --> Albarán

