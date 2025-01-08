<template>
    <div class="flex flex-col items-center gap-4 p-4 max-w-96 w-full mx-auto">

        <h3 class="text-2xl font-bold">ABSEN KARYAWAN</h3>
        
    <div v-if="!locationConfirmed">
        <img src="/find_location.webp" class="w-96 mb-5">
        <p>
            Mohon ijinkan browser anda mengakses lokasi terkini,untuk melakukan absen secara otomatis di dalam radius kantor.
        </p>
      <button  
        @click="confirmLocation" 
        class="px-4 py-2 bg-blue-500 text-white m-3 rounded w-full hover:bg-blue-600">
        Ijinkan Akses Lokasi
      </button>

    </div>
      
    <div v-if="locationConfirmed && isWithinRange">
    <img src="/check.gif" class="w-96 mb-5">
    <p>Hallo , <b>{{ user.name }}</b> !</p>
    <p>Silahkan klik tombol Hadir di bawah untuk konfirmasi kehadiran.</p>
      <button 
         @click="checkIn" 
        class="px-4 py-2 bg-green-500 text-white m-3 w-full rounded hover:bg-green-600">
        Hadir
      </button>
    </div>
      
      <p v-if="errorMessage" class="text-red-500 text-sm">{{ errorMessage }}</p>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  const $props = defineProps({user:Object , karyawan : Object , signature: String , setting: Object});

  const targetLat = $props.setting.geo.latitude;
  const targetLon = $props.setting.geo.longitude;
  
  const locationConfirmed = ref(false);
  const isWithinRange = ref(false);
  const errorMessage = ref('');
  
  function confirmLocation() {
    if (!navigator.geolocation) {
      errorMessage.value = "Geolocation is not supported by your browser.";
      return;
    }
  
    navigator.geolocation.getCurrentPosition(
      (position) => {
        const userLat = position.coords.latitude;
        const userLon = position.coords.longitude;
        const distance = calculateDistance(userLat, userLon, targetLat, targetLon);
        locationConfirmed.value = true;
        isWithinRange.value = distance <= 20;
        if (!isWithinRange.value) {
          errorMessage.value = `Jarak kamu terlalu jauh untuk melakukan absen. Jarak kamu : ${distance.toFixed(2)} Meter.`;
        }
      },
      () => {
        errorMessage.value = "Gagal mengambil lokasi terkini anda, mohon di refresh";
      }
    );
  }
  
  function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 6371e3; // Earth radius in meters
    const toRad = (deg) => (deg * Math.PI) / 180;
    const φ1 = toRad(lat1);
    const φ2 = toRad(lat2);
    const Δφ = toRad(lat2 - lat1);
    const Δλ = toRad(lon2 - lon1);
  
    const a = Math.sin(Δφ / 2) ** 2 +
              Math.cos(φ1) * Math.cos(φ2) *
              Math.sin(Δλ / 2) ** 2;
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
  
    return R * c; // Distance in meters
  }
  
function checkIn() {
  try {
    // Extract CSRF-TOKEN from meta tag
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    
    // Example data to send
    const data = {
      user_id: $props.user.id, // Replace with dynamic user ID as needed
      signature: $props.signature,
      karyawan_id: $props.karyawan.id
    };
    
    // Fetch request with POST method
    fetch('/api/absen', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(res => {
      if(res.success)
    {
      window.location.href = '/dashboard';
    }else{
      alert(res.message);
    }

    })
    .catch(err => {
      console.error('Error:', err); // Handle errors
    });
    
  } catch (e) {
    console.error('Exception:', e); // Handle any other exceptions
  }
}

  </script>
  
  <style>
  /* TailwindCSS is used directly in class attributes, no custom styles needed */
  </style>
  