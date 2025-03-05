<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (!User::where('email', 'administracion@polymersolutions.es')->first()) {
            $superAdmin = User::create([
                'name' => 'Daiane Rocha',
                'email' => 'administracion@polymersolutions.es',
                'password' => Hash::make('030201', ['rounds' => 12])
            ]);

            // Assign role to user
            $superAdmin->assignRole('Super Admin');
        }

        if (!User::where('email', 'bruno.feijo@live.com')->first()) {
            $superAdmin = User::create([
                'name' => 'Bruno',
                'email' => 'bruno.feijo@live.com',
                'password' => Hash::make('030201', ['rounds' => 12])
            ]);

            $superAdmin->assignRole('Super Admin');
        }
        
        if (!User::where('email', 'bruno.admin@live.com')->first()) {
            $admin = User::create([
                'name' => 'Bruno Admin',
                'email' => 'bruno.admin@live.com',
                'password' => Hash::make('030201', ['rounds' => 12])
            ]);

            $admin->assignRole('Admin');
        }
        
        if (!User::where('email', 'bruno.comercial@live.com')->first()) {
            $commercial = User::create([
                'name' => 'Bruno Comercial',
                'email' => 'bruno.comercial@live.com.br',
                'password' => Hash::make('030201', ['rounds' => 12])
            ]);

            $commercial->assignRole('Comercial');
        }
        
        if (!User::where('email', 'bruno.financiero@live.com')->first()) {
            $financial = User::create([
                'name' => 'Bruno Financiero',
                'email' => 'bruno.financiero@live.com',
                'password' => Hash::make('030201', ['rounds' => 12])
            ]);

            $financial->assignRole('Financiero');
        }
        
        if (!User::where('email', 'bruno.facturas@live.com')->first()) {
            $invoices= User::create([
                'name' => 'Bruno Facturas',
                'email' => 'bruno.facturas@live.com',
                'password' => Hash::make('030201', ['rounds' => 12])
            ]);

            // Atribuir papel para o usuário
            $invoices->assignRole('Facturas');
        }
    }
}
