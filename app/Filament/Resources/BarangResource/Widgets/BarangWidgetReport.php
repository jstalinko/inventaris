<?php

namespace App\Filament\Resources\BarangResource\Widgets;

use App\Models\Barang;
use App\Models\HistoryBarang;
use App\Models\Variant;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class BarangWidgetReport extends BaseWidget
{
    protected function getStats(): array
    {
        $totalBarang = Barang::count();
        $totalStock = Variant::sum('stock');
        $currentStock = Variant::sum('sisa_stock');
        $barangMasuk = HistoryBarang::with('barang')->where('type','=',1)->get();
        $barangKeluar = HistoryBarang::with('barang')->where('type','=',0)->get();

        $totalOmzet = $barangKeluar->sum(function($item){
            return $item->barang->price_sell * $item->total;
        });
        $totalModal = $barangMasuk->sum(function($item){
            return $item->barang->price_modal * $item->total;
        });

        $totalModalSemua = Barang::with('variants')->get()->sum(function ($barang) {
            $totalStock = $barang->variants->sum('stock'); // Mengambil total stok dari semua varian
            return $barang->price_modal * $totalStock; // Menghitung modal untuk barang tersebut
        });
        $totalOmzetSemua = Barang::with('variants')->get()->sum(function ($barang) {
            $totalStock = $barang->variants->sum('stock'); // Mengambil total stok dari semua varian
            return $barang->price_sell * $totalStock; // Menghitung modal untuk barang tersebut
        });
        
        return [
            Stat::make('Total Jenis Barang',$totalBarang),
            Stat::make('Total Stock (Stock Awal/ Sisa Stock)',$totalStock."/".$currentStock),
            Stat::make('Barang Keluar',$barangKeluar->sum('total')),
            Stat::make('Barang Masuk',$barangMasuk->sum('total')),
            Stat::make('Total Omzet',"Rp. ". number_format($totalOmzet , 0,",",".")),
            Stat::make('Total Modal Keluar',"Rp. ".number_format($totalModal , 0,",",".")),
            Stat::make('Total Keseluruhan Modal' , "Rp. ". number_format($totalModalSemua,0,",",".")),
            Stat::make('Total Estimasi Omzet' , "Rp. ". number_format($totalOmzetSemua,0,",","."))
        ];
    }
}
