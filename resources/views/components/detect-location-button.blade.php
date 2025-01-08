<div x-data>
    <x-filament::button type="button"
        @click="navigator.geolocation.getCurrentPosition(
            (position) => {
                let latitude = position.coords.latitude.toFixed(6);
                let longitude = position.coords.longitude.toFixed(6);
                let gmapsUrl = `https://www.google.com/maps?q=${latitude},${longitude}`;

                $wire.set('data.geo.latitude', latitude);
                $wire.set('data.geo.longitude', longitude);
                $wire.set('data.geo.gmaps_url', gmapsUrl);
                alert('Location detected successfully!');
            },
            (error) => {
                alert('Failed to detect location: ' + error.message);
            }
        )">
        Detect Live Location
    </x-filament::button>
</div>
