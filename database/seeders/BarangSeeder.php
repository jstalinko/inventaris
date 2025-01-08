<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['supplier_id' => 1, 'code' => Str::random(8), 'nama_barang' => 'Barang A', 'satuan' => 'pcs', 'price_modal' => '20000', 'price_sell' => '25000', 'stock' => 20, 'note' => 'Contoh barang A'],
            ['supplier_id' => 2, 'code' => Str::random(8), 'nama_barang' => 'Barang B', 'satuan' => 'kg', 'price_modal' => '15000', 'price_sell' => '18000', 'stock' => 30, 'note' => 'Contoh barang B'],
            ['supplier_id' => 3, 'code' => Str::random(8), 'nama_barang' => 'Barang C', 'satuan' => 'ltr', 'price_modal' => '10000', 'price_sell' => '14000', 'stock' => 40, 'note' => 'Contoh barang C'],
            ['supplier_id' => 4, 'code' => Str::random(8), 'nama_barang' => 'Barang D', 'satuan' => 'box', 'price_modal' => '5000', 'price_sell' => '7000', 'stock' => 10, 'note' => 'Contoh barang D'],
            ['supplier_id' => 5, 'code' => Str::random(8), 'nama_barang' => 'Barang E', 'satuan' => 'pcs', 'price_modal' => '8000', 'price_sell' => '10000', 'stock' => 25, 'note' => 'Contoh barang E'],
            ['supplier_id' => 1, 'code' => Str::random(8), 'nama_barang' => 'Barang F', 'satuan' => 'pcs', 'price_modal' => '6000', 'price_sell' => '9000', 'stock' => 50, 'note' => 'Contoh barang F'],
            ['supplier_id' => 2, 'code' => Str::random(8), 'nama_barang' => 'Barang G', 'satuan' => 'kg', 'price_modal' => '4500', 'price_sell' => '7000', 'stock' => 15, 'note' => 'Contoh barang G'],
            ['supplier_id' => 3, 'code' => Str::random(8), 'nama_barang' => 'Barang H', 'satuan' => 'pcs', 'price_modal' => '12000', 'price_sell' => '15000', 'stock' => 5, 'note' => 'Contoh barang H'],
            ['supplier_id' => 4, 'code' => Str::random(8), 'nama_barang' => 'Barang I', 'satuan' => 'ltr', 'price_modal' => '2000', 'price_sell' => '5000', 'stock' => 35, 'note' => 'Contoh barang I'],
            ['supplier_id' => 5, 'code' => Str::random(8), 'nama_barang' => 'Barang J', 'satuan' => 'box', 'price_modal' => '3000', 'price_sell' => '4500', 'stock' => 8, 'note' => 'Contoh barang J'],
            ['supplier_id' => 1, 'code' => Str::random(8), 'nama_barang' => 'Barang K', 'satuan' => 'kg', 'price_modal' => '9000', 'price_sell' => '12000', 'stock' => 60, 'note' => 'Contoh barang K'],
            ['supplier_id' => 2, 'code' => Str::random(8), 'nama_barang' => 'Barang L', 'satuan' => 'pcs', 'price_modal' => '7500', 'price_sell' => '9500', 'stock' => 45, 'note' => 'Contoh barang L'],
            ['supplier_id' => 3, 'code' => Str::random(8), 'nama_barang' => 'Barang M', 'satuan' => 'ltr', 'price_modal' => '7000', 'price_sell' => '11000', 'stock' => 12, 'note' => 'Contoh barang M'],
            ['supplier_id' => 4, 'code' => Str::random(8), 'nama_barang' => 'Barang N', 'satuan' => 'pcs', 'price_modal' => '3000', 'price_sell' => '4000', 'stock' => 20, 'note' => 'Contoh barang N'],
            ['supplier_id' => 5, 'code' => Str::random(8), 'nama_barang' => 'Barang O', 'satuan' => 'box', 'price_modal' => '3500', 'price_sell' => '5000', 'stock' => 18, 'note' => 'Contoh barang O'],
            ['supplier_id' => 1, 'code' => Str::random(8), 'nama_barang' => 'Barang P', 'satuan' => 'kg', 'price_modal' => '8500', 'price_sell' => '13000', 'stock' => 55, 'note' => 'Contoh barang P'],
            ['supplier_id' => 2, 'code' => Str::random(8), 'nama_barang' => 'Barang Q', 'satuan' => 'ltr', 'price_modal' => '2200', 'price_sell' => '3000', 'stock' => 32, 'note' => 'Contoh barang Q'],
            ['supplier_id' => 3, 'code' => Str::random(8), 'nama_barang' => 'Barang R', 'satuan' => 'pcs', 'price_modal' => '6000', 'price_sell' => '10000', 'stock' => 25, 'note' => 'Contoh barang R'],
            ['supplier_id' => 4, 'code' => Str::random(8), 'nama_barang' => 'Barang S', 'satuan' => 'pcs', 'price_modal' => '9000', 'price_sell' => '12000', 'stock' => 40, 'note' => 'Contoh barang S'],
            ['supplier_id' => 5, 'code' => Str::random(8), 'nama_barang' => 'Barang T', 'satuan' => 'box', 'price_modal' => '1500', 'price_sell' => '2500', 'stock' => 70, 'note' => 'Contoh barang T'],
        ];

        foreach ($items as $item) {
            Barang::create($item);
        }
    }
}