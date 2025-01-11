<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'John Doe',
                'phone' => '081234567890',
                'city' => 'Jakarta',
                'supplier_role' => 'Kain',
            ],
            [
                'name' => 'Jane Smith',
                'phone' => '081987654321',
                'city' => 'Bandung',
                'supplier_role' => 'Benang',
            ],
            [
                'name' => 'Ahmad Hasan',
                'phone' => '082123456789',
                'city' => 'Surabaya',
                'supplier_role' => 'Kain',
            ],
            [
                'name' => 'Siti Aminah',
                'phone' => '081556677889',
                'city' => 'Yogyakarta',
                'supplier_role' => 'Benang',
            ],
        ]);
    }
}
