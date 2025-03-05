<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        if (!Customer::where('customer', 'ACI PERPLASTICS')->first()) {
            Customer::create([
                'customer' => 'ACI PERPLASTICS',
                'country' => 'CH',
                'province'=> '',
                'zip'=> '231400',
                'city'=> 'ANHUI',
                'street'=> 'TONGCHENG ECONOMIC DEVELOPMENTZONE',
                'street2'=> '',
                'email'=> 'tongcheng@tongcheng.com',
                'tel'=> '',
                'vat'=> 'BE0720562619',
                'bank_id'=> 'Bank of China Frankfurt am Main',
                'bank_id_acc_number'=> '1230406801221',
                'bank_swift'=> 'BKCHDEFFYYYY',
                'bank_iban'=> 'XX107004068012210',
            ]);
        }

        if (!Customer::where('customer', 'ACTEGA ARTÍSTICA')->first()) {
            Customer::create([
                'customer' => 'ACTEGA ARTÍSTICA',
                'country' => 'CH',
                'province'=> '',
                'zip'=> '231400',
                'city'=> 'ANHUI',
                'street'=> 'TONGCHENG ECONOMIC DEVELOPMENTZONE',
                'street2'=> '',
                'email'=> 'tongcheng@tongcheng.com',
                'tel'=> '',
                'vat'=> 'BE0720562619',
                'bank_id'=> 'Bank of China Frankfurt am Main',
                'bank_id_acc_number'=> '1230406801221',
                'bank_swift'=> 'BKCHDEFFYYYY',
                'bank_iban'=> 'XX107004068012210',
            ]);
        }

        // CourseTheme::firstOrCreate(
        //     ['name' => 'Data Science'], // Condição para verificar se já existe
        //     ['description' => 'Curso introdutório sobre Data Science.'] // Atributos adicionais se o registro não existir
        //     );

    }
}