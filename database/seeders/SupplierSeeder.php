<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Faker\Provider\Lorem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!Supplier::where('supplier', 'RIANLON TECHNOLOGY')->first()){
            Supplier::create([
                'supplier' => 'RIANLON TECHNOLOGY',
                'country' => 'DE',
                'province'=> 'DUESSELDORF',
                'zip'=> '40210',
                'city'=> 'Duesseldorf',
                'street'=> 'Charlottenstr. 75',
                'street2'=> '',
                'email'=> 'rianlon@rialon.com',
                'tel'=> '',
                'vat'=> 'BE0720562619',
                'bank_id'=> 'Bank of China Frankfurt am Main',
                'bank_id_acc_number'=> '0406801221000',
                'bank_swift'=> 'BKCHDEFFXXX',
                'bank_iban'=> 'DE37514107004068012210',
            ]);
        }

        if(!Supplier::where('supplier', 'TONGCHENG SHINDE NEW MATERIALS')->first()){
            Supplier::create([
                'supplier' => 'TONGCHENG SHINDE NEW MATERIALS',
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
    }
}
