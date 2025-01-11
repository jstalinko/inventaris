<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryBarangResource\Pages;
use App\Filament\Resources\HistoryBarangResource\RelationManagers;
use App\Models\HistoryBarang;
use App\Models\Variant;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Database\Eloquent\Model;

class HistoryBarangResource extends Resource
{
    protected static ?string $model = HistoryBarang::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?string $navigationLabel = 'Daftar Transaksi';

    public static $variants;

    

    public static function form(Form $form): Form
    {
        
        return $form
            ->schema([
                Forms\Components\Select::make('barang_id')
                    ->required()
                    ->relationship('barang','code')
                    ->searchable()
                    ->preload()
                    ->reactive()
                    ->label('SKU - BARANG')
                    ->getOptionLabelFromRecordUsing(fn(Model $record)=> "{$record->code} - {$record->nama_barang}" )
                    ->afterStateUpdated(function($set,$state)
                    {
                        $variant = Variant::where('barang_id',$state)->get();
                        self::$variants = $variant->pluck('warna' , 'id');
                        
                    })
                    ,
                Forms\Components\Select::make('variants')->options(fn() => self::$variants)->hidden(fn($state) => empty(self::$variants) && $state === null)->label('Pilih Variant Warna'),
                Forms\Components\Select::make('type')
                    ->label('Tipe Transaksi')
                    ->required()
                    ->options([0 => 'Keluar' , 1 => 'Masuk'])
                    ,

                Forms\Components\TextInput::make('total')->label('Jumlah')
                    ->required()
                    ->numeric(),
                Forms\Components\Textarea::make('note')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('karyawan.full_name')
                    ->label('Nama Admin')
                    ->sortable()
                    ->badge()->color('success'),
                Tables\Columns\TextColumn::make('barang.nama_barang')
                    ->label('Nama Barang')
                    ->sortable()
                    ->badge(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        '0' => 'danger',
                        '1' => 'success'
                    })->formatStateUsing(fn($record) => $record->type==1 ? 'MASUK' : 'KELUAR'),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->label('Jumlah')
                    ->sortable(),
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
            'index' => Pages\ListHistoryBarangs::route('/'),
            'create' => Pages\CreateHistoryBarang::route('/create'),
            'view' => Pages\ViewHistoryBarang::route('/{record}'),
            'edit' => Pages\EditHistoryBarang::route('/{record}/edit'),
        ];
    }
}
