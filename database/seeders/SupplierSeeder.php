<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = [
            ['name' => 'Supplier A', 'address' => 'Jl. Kenangan No. 1', 'phone' => '08111111111', 'city' => 'Surabaya', 'email' => 'suppliera@example.com', 'supplier_role' => 'Distributor'],
            ['name' => 'Supplier B', 'address' => 'Jl. Mawar No. 5', 'phone' => '08122222222', 'city' => 'Medan', 'email' => 'supplierb@example.com', 'supplier_role' => 'Retailer'],
            ['name' => 'Supplier C', 'address' => 'Jl. Melati No. 10', 'phone' => '08133333333', 'city' => 'Yogyakarta', 'email' => 'supplierc@example.com', 'supplier_role' => 'Distributor'],
            ['name' => 'Supplier D', 'address' => 'Jl. Anggrek No. 15', 'phone' => '08144444444', 'city' => 'Semarang', 'email' => 'supplierd@example.com', 'supplier_role' => 'Retailer'],
            ['name' => 'Supplier E', 'address' => 'Jl. Kamboja No. 20', 'phone' => '08155555555', 'city' => 'Jakarta', 'email' => 'suppliere@example.com', 'supplier_role' => 'Distributor'],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
