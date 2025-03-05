<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            ['title'=> 'Listar usuarios', 'name' => 'index-user'],
            ['title'=> 'Ver usuario', 'name' => 'show-user'],
            ['title'=> 'Registrar usuario', 'name' => 'create-user'],
            ['title'=> 'Editar usuario', 'name' => 'edit-user'],
            ['title'=> 'Editar contraseña de usuario', 'name' => 'edit-user-password'],
            ['title'=> 'Eliminar usuario', 'name' => 'destroy-user'],

            ['title'=> 'Listar clientes', 'name' => 'index-customer'],
            ['title'=> 'Ver cliente', 'name' => 'show-customer'],
            ['title'=> 'Registrar cliente', 'name' => 'create-customer'],
            ['title'=> 'Editar cliente', 'name' => 'edit-customer'],
            ['title'=> 'Eliminar cliente', 'name' => 'destroy-customer'],

            ['title'=> 'Listar productos', 'name' => 'index-product'],
            ['title'=> 'Ver productos', 'name' => 'show-product'],
            ['title'=> 'Registrar productos', 'name' => 'create-product'],
            ['title'=> 'Editar productos', 'name' => 'edit-product'],
            ['title'=> 'Eliminar productos', 'name' => 'destroy-product'],

            ['title'=> 'Listar proveedores', 'name' => 'index-supplier'],
            ['title'=> 'Ver proveedor', 'name' => 'show-supplier'],
            ['title'=> 'Registrar proveedor', 'name' => 'create-supplier'],
            ['title'=> 'Editar proveedor', 'name' => 'edit-supplier'],
            ['title'=> 'Eliminar proveedor', 'name' => 'destroy-supplier'],

            ['title' => 'Listar perfiles', 'name' => 'index-role'],
            ['title' => 'Registrar perfil', 'name' => 'create-role'],
            ['title' => 'Editar perfil', 'name' => 'edit-role'],
            ['title' => 'Eliminar perfil', 'name' => 'destroy-role'],

            ['title' => 'Listar permisos de perfil', 'name' => 'index-role-permission'],
            ['title' => 'Editar permiso de perfil', 'name' => 'update-role-permission'],

            ['title'=> 'Listar permisos ', 'name' => 'index-permission'],
            ['title'=> 'Ver permiso', 'name' => 'show-permission'],
            ['title'=> 'Registrar permiso', 'name' => 'create-permission'],
            ['title'=> 'Editar permiso', 'name' => 'edit-permission'],
            ['title'=> 'Eliminar permiso', 'name' => 'destroy-permission'],

            ['title'=> 'Subir PDF', 'name' => 'generate-pdf-user'],

            ['title' => 'Listar Facturas', 'name' => 'index-invoice'],

            ['title' => 'Listar Financiero', 'name' => 'index-financial'],
        ];

        foreach ($permissions as $permission) {
            $existingPermission = Permission::where('name', $permission['name'])->first();

            if (!$existingPermission) {
                Permission::create([
                    'title' => $permission['title'],
                    'name' => $permission['name'],
                    'guard_name' => 'web',
                ]);
            }
        }
    }
}
