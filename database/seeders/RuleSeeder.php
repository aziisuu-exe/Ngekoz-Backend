<?php

namespace Database\Seeders;

use App\Models\Rule;
use App\Models\KosPlace; // Pastikan nama Model Kos kamu sesuai
use Illuminate\Database\Seeder;

class RuleSeeder extends Seeder
{
    public function run()
    {
        // 1. Kumpulan 30 Data Rules
        $rules = [
            ['name' => 'Akses 24 Jam', 'icon_name' => 'clock'],
            ['name' => 'Dilarang membawa hewan peliharaan', 'icon_name' => 'ban'],
            ['name' => 'Dilarang merokok di dalam kamar', 'icon_name' => 'cigarette-off'],
            ['name' => 'Wajib lapor RT/RW 1x24 jam', 'icon_name' => 'file-text'],
            ['name' => 'Tamu menginap dikenakan biaya tambahan', 'icon_name' => 'users'],
            ['name' => 'Jam malam tamu maksimal pukul 22.00 WIB', 'icon_name' => 'clock-alert'],
            ['name' => 'Dilarang membawa senjata tajam/api', 'icon_name' => 'shield-alert'],
            ['name' => 'Dilarang meminum minuman keras', 'icon_name' => 'wine-off'],
            ['name' => 'Dilarang berbuat asusila', 'icon_name' => 'heart-crack'],
            ['name' => 'Wajib menjaga kebersihan fasilitas bersama', 'icon_name' => 'trash-2'],
            ['name' => 'Dilarang membawa anak kecil', 'icon_name' => 'baby'],
            ['name' => 'Dilarang membuat keributan', 'icon_name' => 'volume-x'],
            ['name' => 'Listrik token masing-masing', 'icon_name' => 'zap'],
            ['name' => 'Dilarang membawa kompor gas sendiri', 'icon_name' => 'flame'],
            ['name' => 'Parkir motor khusus penghuni (tamu di luar)', 'icon_name' => 'bike'],
            ['name' => 'Dilarang mengubah struktur atau mengecat kamar', 'icon_name' => 'paint-roller'],
            ['name' => 'Wajib mematikan air & listrik jika keluar', 'icon_name' => 'power-off'],
            ['name' => 'Dilarang memaku dinding', 'icon_name' => 'hammer'],
            ['name' => 'Tamu lawan jenis dilarang masuk kamar', 'icon_name' => 'user-x'],
            ['name' => 'Gerbang utama wajib dikunci kembali', 'icon_name' => 'lock'],
            ['name' => 'Dilarang berjudi di area kos', 'icon_name' => 'coins'],
            ['name' => 'Uang sewa dibayar maksimal tanggal 5', 'icon_name' => 'calendar-clock'],
            ['name' => 'Wajib membayar uang deposit di awal', 'icon_name' => 'wallet'],
            ['name' => 'Minimal masa sewa 3 bulan', 'icon_name' => 'calendar'],
            ['name' => 'Tidak tersedia parkir mobil', 'icon_name' => 'car-off'],
            ['name' => 'Hewan peliharaan kecil (dalam kandang) diizinkan', 'icon_name' => 'dog'],
            ['name' => 'Tamu harap lapor ke pemilik kos', 'icon_name' => 'message-circle-warning'],
            ['name' => 'Dilarang menjemur pakaian di depan kamar', 'icon_name' => 'shirt'],
            ['name' => 'Sepatu & Sandal wajib diletakkan di rak', 'icon_name' => 'footprints'],
            ['name' => 'Penghuni wajib menyerahkan Fotokopi KTP & KK', 'icon_name' => 'id-card'],
        ];

        // 2. Masukkan ke dalam tabel 'rules'
        foreach ($rules as $rule) {
            Rule::create($rule);
        }

        // 3. Logika untuk mengisi tabel pivot (kos_place_rule)
        // Ambil semua data rules yang baru saja dibuat
        $allRules = Rule::all();
        
        // Ambil semua data kos yang sudah kamu miliki di database
        $kosPlaces = KosPlace::all();

        // Looping setiap kos, lalu pasangkan dengan 6 aturan acak
        foreach ($kosPlaces as $kos) {
            // Mengambil 6 ID secara acak dari kumpulan rules
            $randomRuleIds = $allRules->random(6)->pluck('id')->toArray();
            
            // Perintah attach() otomatis memasukkan data ke tabel pivot kos_place_rule
            $kos->rules()->attach($randomRuleIds);
        }
    }
}