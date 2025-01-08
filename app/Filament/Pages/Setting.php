<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;

class Setting extends Page implements HasForms
{
    use InteractsWithForms;
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $view = 'filament.pages.setting';

    protected static ?string $navigationGroup = 'Settings';

    public $data = [];
    
    public function mount(): void
    {
        $this->data = $this->loadSettings();
        
        $this->form->fill($this->loadSettings());
    }

    protected function loadSettings(): array
    {
        $settings = Storage::get('settings.json'); // storage/app/settings.json  
        return json_decode($settings, true) ?? [];
    }

    protected function saveSettings(array $data): void
    {
        $settings = json_encode($data, JSON_PRETTY_PRINT);
        Storage::put('settings.json', $settings);
    }

    public function form(Form $form):Form
    {
        return $form->schema([
            // Forms\Components\TextInput::make('site_url')->prefix('https://')->required(),
            // Forms\Components\TextInput::make('site_name')->required(),
            // Forms\Components\TextInput::make('site_description')->required(),
            // Forms\Components\FileUpload::make('icon')->avatar()->image(),
            // Forms\Components\FileUpload::make('logo')->image()->imageEditor(),

            Forms\Components\Section::make('Jam Kerja')->schema([
                Forms\Components\TimePicker::make('jamkerja.jam_masuk')->timezone('Asia/Jakarta')->native(false),
                Forms\Components\TimePicker::make('jamkerja.jam_pulang')->timezone('Asia/Jakarta')->native(false),
            ])->columns(2),

            Forms\Components\Section::make('GeoLocation Kantor')->schema([
                Forms\Components\TextInput::make('geo.latitude'),
                Forms\Components\TextInput::make('geo.longitude'),
                Forms\Components\TextInput::make('geo.gmaps_url'),
                Forms\Components\View::make('components.detect-location-button'),
            ])->columns(3)
        ])->statePath('data');
    }

    public function submit()
    {
        $data = $this->form->getState('data');
        $this->saveSettings($data);

        Notification::make('success')->icon('heroicon-o-check-circle')->body('Successfully save settings!')->success()->send();
    }
}
