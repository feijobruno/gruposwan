<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (!Role::where('name', 'Super Admin')->first()) {
            Role::create([
                'name' => 'Super Admin',
            ]);
        }

        if (!Role::where('name', 'Admin')->first()) {
            $admin = Role::create([
                'name' => 'Admin',
            ]);
        } else {
            $admin = Role::where('name', 'Admin')->first();
        }

        // Register permission for the role
        $admin->givePermissionTo([

            'index-user',
            'show-user',
            'create-user',
            'edit-user',
            'edit-user-password',
            'destroy-user',

            'index-customer',
            'show-customer',
            'create-customer',
            'edit-customer',
            'destroy-customer',

            'index-supplier',
            'show-supplier',
            'create-supplier',
            'edit-supplier',
            'destroy-supplier',

            'index-product',
            'show-product',
            'create-product',
            'edit-product',
            'destroy-product',

            'index-role',
            'create-role',
            'edit-role',
            'destroy-role',

            'index-role-permission',
            'update-role-permission',

            'generate-pdf-user',
        ]);

        // Remove access permission
        // $admin->revokePermissionTo([
        //     'update-role-permission',
        // ]);

        if (!Role::where('name', 'Comercial')->first()) {
            $commercial = Role::create([
                'name' => 'Comercial',
            ]);
        } else {
            $commercial = Role::where('name', 'Comercial')->first();
        }

        // Register permission for the role
        $commercial->givePermissionTo([

            'index-user',
            'show-user',
            
            'index-customer',
            'show-customer',
            'create-customer',
            'edit-customer',
            'destroy-customer',

            'index-product',
            'show-product',
            'create-product',
            'edit-product',
            'destroy-product',
        ]);

        if (!Role::where('name', 'Facturas')->first()) {
            $invoices = Role::create([
                'name' => 'Facturas',
            ]);
        } else {
            $invoices = Role::where('name', 'Facturas')->first();
        }

        // Register permission for the role
        $invoices->givePermissionTo([
           
            'index-invoice',


        ]);

        if (!Role::where('name', 'Financiero')->first()) {
            $financial = Role::create([
                'name' => 'Financiero',
            ]);
        } else {
            $financial = Role::where('name', 'Financiero')->first();
        }

        // Register permission for the role
        $financial->givePermissionTo([
           
            'index-financial',

        ]);

        if (!Role::where('name', 'Comercial')->first()) {
            Role::create([
                'name' => 'Comercial',
            ]);
        } else {
            $admin = Role::where('name', 'Comercial')->first();
        }
    }
}
