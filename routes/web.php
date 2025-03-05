<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerOrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierOrderController;
use App\Http\Controllers\PaOrderController;
use App\Http\Controllers\FinancialController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PolymerAdditivesController;
use App\Http\Controllers\MettingController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\ProductFileController;
use App\Http\Controllers\HelperTableController;
use App\Http\Controllers\StockMovementController;

// Login 
Route::get('/', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');
Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');
Route::get('/create-user-login', [LoginController::class, 'create'])->name('login.create-user');
Route::post('/store-user-login', [LoginController::class, 'store'])->name('login.store-user');

// Recuperar senha
Route::get('/forgot-password', [ForgotPasswordController::class, 'showForgotPassword'])->name('forgot-password.show');
Route::post('/forgot-password', [ForgotPasswordController::class, 'submitForgotPassword'])->name('forgot-password.submit');

Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPassword'])->name('reset-password.submit');


Route::group(['middleware' => 'auth'], function () {

    // Dashboard
    Route::get('/index-dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/legal-notice', [DashboardController::class, 'legalNotice'])->name('dashboard.legalNotice');
    Route::get('/privacy-policy', [DashboardController::class, 'privacyPolicy'])->name('dashboard.privacyPolicy');
    Route::get('/cookies', [DashboardController::class, 'cookies'])->name('dashboard.cookies');

    // Profile
    Route::get('/show-profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/update-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/edit-profile-password', [ProfileController::class, 'editPassword'])->name('profile.edit-password');
    Route::put('/update-profile-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Users
    Route::get('/index-user', [UserController::class, 'index'])->name('user.index')->middleware('permission:index-user'); 
    Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show')->middleware('permission:show-user'); 
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create')->middleware('permission:create-user'); 
    Route::post('/store-user', [UserController::class, 'store'])->name('user.store')->middleware('permission:create-user'); 
    Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit')->middleware('permission:edit-user'); 
    Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update')->middleware('permission:edit-user'); 
    Route::get('/edit-user-password/{user}', [UserController::class, 'editPassword'])->name('user.edit-password')->middleware('permission:edit-user-password'); 
    Route::put('/update-user-password/{user}', [UserController::class, 'updatePassword'])->name('user.update-password')->middleware('permission:edit-user-password'); 
    Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('permission:destroy-user'); 
    Route::get('/generate-pdf-user', action: [UserController::class, 'generatePdf'])->name('user.generate-pdf')->middleware('permission:generate-pdf-user');

    // Role
    Route::get('/index-role', [RoleController::class, 'index'])->name('role.index')->middleware('permission:index-role'); 
    Route::get('/create-role', [RoleController::class, 'create'])->name('role.create')->middleware('permission:create-role'); 
    Route::post('/store-role', [RoleController::class, 'store'])->name('role.store')->middleware('permission:create-role'); 
    Route::get('/edit-role/{role}', [RoleController::class, 'edit'])->name('role.edit')->middleware('permission:edit-role'); 
    Route::put('/update-role/{role}', [RoleController::class, 'update'])->name('role.update')->middleware('permission:edit-role'); 
    Route::delete('/destroy-role/{role}', [RoleController::class, 'destroy'])->name('role.destroy')->middleware('permission:destroy-role'); 

    // Role permission 
    Route::get('/index-role-permission/{role}', [RolePermissionController::class, 'index'])->name('role-permission.index')->middleware('permission:index-role-permission'); 
    Route::get('/update-role-permission/{role}/{permission}', [RolePermissionController::class, 'update'])->name('role-permission.update')->middleware('permission:update-role-permission');

    // Permission
    Route::get('/index-permission', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/show-permission/{permission}', [PermissionController::class, 'show'])->name('permission.show');
    Route::get('/create-permission', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/store-permission', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/edit-permission/{permission}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('/update-permission/{permission}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/destroy-permission/{permission}', [PermissionController::class, 'destroy'])->name('permission.destroy');

    // Products
    Route::get('/index-product', [ProductController::class, 'index'])->name('product.index')->middleware('permission:index-product');
    Route::get('/create-product', [ProductController::class, 'create'])->name('product.create')->middleware('permission:create-product');
    Route::post('/store-product', [ProductController::class, 'store'])->name('product.store')->middleware('permission:create-product');
    Route::get('/edit-product/{product}', [ProductController::class, 'edit'])->name('product.edit')->middleware('permission:edit-product');
    Route::put('/update-product/{product}', [ProductController::class, 'update'])->name('product.update')->middleware('permission:edit-product');
    Route::delete('/destroy-product/{product}', [ProductController::class, 'destroy'])->name('product.destroy')->middleware('permission:destroy-product');
    
    Route::get('/document-product/{product}', [ProductController::class, 'document'])->name('product.document');
    Route::get('/technical_product/{product}', [ProductController::class, 'technical'])->name('product.technical');
    Route::get('/metting-product/{product}', [ProductController::class, 'metting'])->name('product.metting');
    Route::get('/presentation-product/{product}', [ProductController::class, 'presentation'])->name('product.presentation');

    // Customer
    Route::get('/index-customer', [CustomerController::class, 'index'])->name('customer.index')->middleware('permission:index-customer');
    Route::get('/create-customer', [CustomerController::class, 'create'])->name('customer.create')->middleware('permission:create-customer');
    Route::post('/store-customer', [CustomerController::class, 'store'])->name('customer.store')->middleware('permission:create-customer');
    Route::get('/edit-customer/{customer}', [CustomerController::class, 'edit'])->name('customer.edit')->middleware('permission:edit-customer');
    Route::put('/update-customer/{customer}', [CustomerController::class, 'update'])->name('customer.update')->middleware('permission:edit-customer');
    Route::delete('/destroy-customer/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy')->middleware('permission:destroy-customer');
    Route::get('/order-customer/{customer}', [CustomerController::class, 'order'])->name('customer.order');
    Route::get('/contact-customer/{customer}', [CustomerController::class, 'contact'])->name('customer.contact');
    Route::get('/metting-customer/{customer}', [CustomerController::class, 'metting'])->name('customer.metting');
    Route::get('/presentation-customer/{customer}', [CustomerController::class, 'presentation'])->name('customer.presentation');
    Route::get('find-data-customer', [CustomerController::class, 'findCustomer'])->name('customer.findCustomer');
    
    // Supplier
    Route::get('/index-supplier', [SupplierController::class, 'index'])->name('supplier.index')->middleware('permission:index-supplier');
    Route::get('/create-supplier', [SupplierController::class, 'create'])->name('supplier.create')->middleware('permission:create-supplier');
    Route::post('/store-supplier', [SupplierController::class, 'store'])->name('supplier.store')->middleware('permission:create-supplier');
    Route::get('/edit-supplier/{supplier}', [SupplierController::class, 'edit'])->name('supplier.edit')->middleware('permission:edit-supplier');
    Route::put('/update-supplier/{supplier}', [SupplierController::class, 'update'])->name('supplier.update')->middleware('permission:edit-supplier');
    Route::delete('/destroy-supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy')->middleware('permission:destroy-supplier');
    Route::get('/order-supplier/{supplier}', [SupplierController::class, 'order'])->name('supplier.order');
    Route::get('/contact-supplier/{supplier}', [SupplierController::class, 'contact'])->name('supplier.contact');
    Route::get('/metting-supplier/{supplier}', [SupplierController::class, 'metting'])->name('supplier.metting');
    Route::get('/presentation-supplier/{supplier}', [SupplierController::class, 'presentation'])->name('supplier.presentation');

    // Contact
    Route::get('/customer-contact/{customer}', [ContactController::class, 'customer'])->name('contact.customer')->middleware('permission:customer-contact');
    Route::get('/supplier-contact/{supplier}', [ContactController::class, 'supplier'])->name('contact.supplier')->middleware('permission:supplier-contact');
    Route::post('/customer-contact/{customer}', [ContactController::class, 'contactCustomer'])->name('contactCustomer.store')->middleware('permission:customer-contact');
    Route::post('/supplier-contact/{supplier}', [ContactController::class, 'contactSupplier'])->name('contactSupplier.store')->middleware('permission:supplier-contact');
    Route::get('/edit-contact/{contact}', [ContactController::class, 'edit'])->name('contact.edit')->middleware('permission:edit-contact');
    Route::put('/update-contact/{contact}', [ContactController::class, 'update'])->name('contact.update')->middleware('permission:edit-contact');
    Route::delete('/destroy-contact/{contact}', [ContactController::class, 'destroy'])->name('contact.destroy')->middleware('permission:destroy-contact');

    // Customer Order
    Route::get('/index-customer-order', [CustomerOrderController::class, 'index'])->name('ordersCustomer.index')->middleware('permission:orders-customer');
    Route::get('/create-customer-orders/{customer}', [CustomerOrderController::class, 'create'])->name('ordersCustomer.create')->middleware('permission:order-customer');
    Route::post('/store-customer-order', [CustomerOrderController::class, 'store'])->name('ordersCustomer.store')->middleware('permission:orders-customer');
    Route::get('/edit-customer-orders/{order}', [CustomerOrderController::class, 'edit'])->name('ordersCustomer.edit')->middleware('permission:order-customer');
    Route::put('/update-customer-order/{order}', [CustomerOrderController::class, 'update'])->name('ordersCustomer.update')->middleware('permission:edit-order-customer');
    Route::delete('/destroy-customer-order/{order}', [CustomerOrderController::class, 'destroy'])->name('ordersCustomer.destroy')->middleware('permission:destroy-customer-order');
    Route::get('/show-customer-order', [CustomerOrderController::class, 'show'])->name('ordersCustomer.show')->middleware('permission:orders-customer'); 

    // Supplier Order
    Route::get('/index-supplier-order', [SupplierOrderController::class, 'index'])->name('ordersSupplier.index')->middleware('permission:orders-supplier');
    Route::get('/create-supplier-order/{supplier?}', [SupplierOrderController::class, 'create'])->name('ordersSupplier.create')->middleware('permission:order-supplier');
    Route::post('/store-supplier-order', [SupplierOrderController::class, 'store'])->name('ordersSupplier.store')->middleware('permission:orders-supplier');
    Route::get('/show-supplier-order/{order}', [SupplierOrderController::class, 'show'])->name('ordersSupplier.show')->middleware('permission:orders-supplier');
    Route::get('/edit-supplier-order/{order}', [SupplierOrderController::class, 'edit'])->name('ordersSupplier.edit')->middleware('permission:edit-supplier-order');
    Route::put('/update-supplier-order/{order}', [SupplierOrderController::class, 'update'])->name('ordersSupplier.update')->middleware('permission:edit-supplier-order');
    Route::delete('/destroy-supplier-order/{order}', [SupplierOrderController::class, 'destroy'])->name('ordersSupplier.destroy')->middleware('permission:destroy-supplier-order');
    Route::get('/generate-pdf-supplier-order/{order}', action: [SupplierOrderController::class, 'generatePdf'])->name('ordersSupplier.generate-pdf')->middleware('permission:generate-pdf-supplier-order');

    Route::get('/index-supplier-batch/{order}', [SupplierOrderController::class, 'batch'])->name('ordersSupplier.batch')->middleware('permission:orders-supplier-batch');

    // Metting
    Route::get('/create-metting/{entity}/{id}', [MettingController::class, 'create'])->name('metting.create');
    Route::post('/store-metting/{entity}/{id}', [MettingController::class, 'store'])->name('metting.store');
    Route::get('/edit-metting/{entity}/{metting}', [MettingController::class, 'edit'])->name('metting.edit');
    Route::put('/update-metting/{metting}', [MettingController::class, 'update'])->name('metting.update');
    Route::delete('/destroy-metting/{metting}', [MettingController::class, 'destroy'])->name('metting.destroy');
    
    // Presentaciones
    Route::get('/create-presentation/{entity}/{id}', [PresentationController::class, 'create'])->name('presentation.create');
    Route::post('/store-presentation/{entity}/{id}', [PresentationController::class, 'store'])->name('presentation.store');
    Route::get('/edit-presentation/{entity}/{presentation}', [PresentationController::class, 'edit'])->name('presentation.edit');
    Route::put('/update-presentation/{presentation}', [PresentationController::class, 'update'])->name('presentation.update');
    Route::delete('/destroy-presentation/{presentation}', [PresentationController::class, 'destroy'])->name('presentation.destroy');

     // Financial
     Route::get('/index-financial', [FinancialController::class, 'index'])->name('financial.index')->middleware('permission:index-financial');

     // Invoices
     Route::get('/index-invoice', [InvoiceController::class, 'index'])->name('invoice.index')->middleware('permission:index-invoice');
 
    //Polymer Additives
    Route::get('/index-polymerAdditives', [PolymerAdditivesController::class, 'index'])->name('polymerAdditives.index')->middleware('permission:index-polymerAdditives');

    //Files (Products - TDS/SDS - Tech)
    Route::get('/create-product-file/{product}', [ProductFileController::class, 'create'])->name(name: 'productFile.create')->middleware('permission:create-product-file');
    Route::post('/store-product-file', [ProductFileController::class, 'store'])->name(name: 'productFile.store')->middleware('permission:store-product-file');
    Route::get('/edit-product-file/{file}', [ProductFileController::class, 'edit'])->name('productFile.edit');
    Route::put('/update-product-file/{file}',[ProductFileController::class, 'update'])->name('productFile.update');
    Route::delete('/destroy-product-file/{file}', [ProductFileController::class, 'destroy'])->name('productFile.destroy');

    //Helper Tables
    Route::get('/index-helperTables', [HelperTableController::class, 'index'])->name('helperTables.index')->middleware('permission:index-helperTables');
    Route::get('/uri: update-helperTables/{country}', [HelperTableController::class, 'update'])->name('helperTables.update')->middleware('permission:edit-helperTables'); 

    //Stock Movements
    Route::get('/index-stockMovements', [StockMovementController::class, 'index'])->name('stockMovement.index')->middleware('permission:index-stockMovements');
    Route::get('/uri: update-stockMovements/{stock}', [StockMovementController::class, 'update'])->name('stockMovement.update')->middleware('permission:edit-stockMovements'); 

    // PA Order
    Route::get('/index-pa-order', [PaOrderController::class, 'index'])->name('ordersPa.index')->middleware('permission:orders-pa');
    Route::get('/create-pa-order', [PaOrderController::class, 'create'])->name('ordersPa.create')->middleware('permission:order-pa');
    Route::post('/store-pa-order', [PaOrderController::class, 'store'])->name('ordersPa.store')->middleware('permission:orders-pa');


});
