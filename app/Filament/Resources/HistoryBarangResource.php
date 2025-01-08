<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HistoryBarangResource\Pages;
use App\Filament\Resources\HistoryBarangResource\RelationManagers;
use App\Models\HistoryBarang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HistoryBarangResource extends Resource
{
    protected static ?string $model = HistoryBarang::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    protected static ?string $navigationGroup = 'Transaksi';

    protected static ?string $navigationLabel = 'Daftar Transaksi';

    

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('barang_id')
                    ->required()
                    ->relationship('barang','nama_barang')
                    ->native(false)
                    ->searchable()
                    ->preload()
                    ->columnSpanFull(),
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('barang.nama_barang')
                    ->label('Nama Barang')
                    ->sortable(),
                Tables\Columns\TextColumn::make('type')
                    ->badge(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
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
