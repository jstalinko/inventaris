<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use App\Models\Barang;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Widgets\TableWidget as BaseWidget;

class BarangTable extends BaseWidget
{

    protected static ?int $sort=2;
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'Daftar Barang';
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Barang::query()
            )
            ->columns([
                Tables\Columns\TextColumn::make('code')
                    ->searchable()
                    ->label('SKU'),
                Tables\Columns\TextColumn::make('nama_barang')
                    ->searchable(),
                Tables\Columns\TextColumn::make('satuan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price_sell')->label('Harga')
                    ->searchable()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('variants')->formatStateUsing(function($record){
                        foreach($record->variants as $v)
                        {
                            echo $v['warna']." - ".$v['stock']."/".$v['sisa_stock']."<br>";
                        }
                    })->label('Warna - Stock Awal / Sisa Stock'),
               
            ]);
    }
}
