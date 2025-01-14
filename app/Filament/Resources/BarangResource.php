<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BarangResource\Pages;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class BarangResource extends Resource
{
    protected static ?string $model = Barang::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';


    protected static ?string $navigationGroup = 'Master Data';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('supplier_id')
                    ->required()
                    ->relationship('supplier','name')->native(false),
                Forms\Components\TextInput::make('code')
                    ->label('SKU')
                    ->required(),
                Forms\Components\TextInput::make('nama_barang')
                    ->required(),
                Forms\Components\TextInput::make('satuan')
                    ->required(),
                Forms\Components\TextInput::make('price_modal')->label('Harga Modal')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
                Forms\Components\TextInput::make('price_sell')->label('Harga Jual')
                    ->required()
                    ->numeric()
                    ->prefix('Rp'),
              
                Forms\Components\TextInput::make('gudang')
                    ->required(),
                    Forms\Components\TextInput::make('nomor_rak')->label('Nomor / Nama Rak')->required(),
                Forms\Components\Repeater::make('variasi')->schema([
                    Forms\Components\TextInput::make('warna'),
                    Forms\Components\TextInput::make('stock'),
                ])->columns(2)->columnSpanFull(),
                
               
                Forms\Components\Textarea::make('note')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('supplier.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('code')
                    ->label('SKU')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_barang')
                    ->searchable(),
    
                Tables\Columns\TextColumn::make('satuan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price_modal')
                    ->searchable()
                    ->label('Harga Modal')
                    ->formatStateUsing(function($record){
                        $satuan = "@Rp ".number_format($record->price_modal , 0,",",".");
                        $stock = 0;
                        $sisa_stock = 0;
                        foreach($record->variants as $v){
                            $stock+=$v['stock'];
                            $sisa_stock+=$v['sisa_stock'];
                        }
                        $total = ($record->price_modal * $stock);
                        echo $satuan." <br>Total: Rp ".number_format($total , 0,",",".");
                    }),
                Tables\Columns\TextColumn::make('price_sell')
                    ->searchable()
                    ->label('Harga Jual')
                    ->formatStateUsing(function($record){
                        $satuan = "@Rp ".number_format($record->price_sell , 0,",",".");
                        $stock = 0;
                        $sisa_stock = 0;
                        foreach($record->variants as $v){
                            $stock+=$v['stock'];
                            $sisa_stock+=$v['sisa_stock'];
                        }
                        $total = ($record->price_sell * $stock);
                        $terjual = ($record->price_sell * ($stock-$sisa_stock));
                        $terjual = "<br>Terjual: Rp ".number_format($terjual,0,",",".");
                        echo $satuan." <br>Total: Rp ".number_format($total , 0,",",".").$terjual;
                    }),
                Tables\Columns\TextColumn::make('variants')->formatStateUsing(function($record){
                    foreach($record->variants as $v)
                    {
                        echo $v['warna']." - ".$v['stock']."/".$v['sisa_stock']."<br>";
                    }
                })->label('Warna - Stock Awal / Sisa Stock'),
                Tables\Columns\TextColumn::make('gudang')->formatStateUsing(fn($record) => 'Gudang: '. $record->gudang.' | Rak : '.$record->nomor_rak )->label('Gudang | Rak'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBarangs::route('/'),
            'create' => Pages\CreateBarang::route('/create'),
            'view' => Pages\ViewBarang::route('/{record}'),
            'edit' => Pages\EditBarang::route('/{record}/edit'),
        ];
    }
}
