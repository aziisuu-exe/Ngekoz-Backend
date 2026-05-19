<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Table: cities
        DB::table('cities')->insert([
            ['id' => 1, 'name' => 'Jakarta Selatan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Sleman', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Depok', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'Bandung', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'Surabaya', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'name' => 'Malang', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'name' => 'Semarang', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'name' => 'Yogyakarta', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'name' => 'Bogor', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'name' => 'Tangerang', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 2. Table: districts
        DB::table('districts')->insert([
            ['id' => 1, 'city_id' => 1, 'name' => 'Tebet', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'city_id' => 1, 'name' => 'Kuningan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'city_id' => 2, 'name' => 'Depok', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'city_id' => 2, 'name' => 'Mlati', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'city_id' => 3, 'name' => 'Beji', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'city_id' => 4, 'name' => 'Coblong', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'city_id' => 5, 'name' => 'Gubeng', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'city_id' => 6, 'name' => 'Lowokwaru', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'city_id' => 7, 'name' => 'Tembalang', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'city_id' => 8, 'name' => 'Umbulharjo', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 3. Table: banks
        DB::table('banks')->insert([
            ['id' => 1, 'bank_name' => 'Bank Central Asia', 'bank_code' => 'BCA', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'bank_name' => 'Bank Mandiri', 'bank_code' => 'MANDIRI', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'bank_name' => 'Bank Negara Indonesia', 'bank_code' => 'BNI', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'bank_name' => 'Bank Rakyat Indonesia', 'bank_code' => 'BRI', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'bank_name' => 'Bank Syariah Indonesia', 'bank_code' => 'BSI', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'bank_name' => 'Bank CIMB Niaga', 'bank_code' => 'CIMB', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'bank_name' => 'Bank Permata', 'bank_code' => 'PERMATA', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'bank_name' => 'Bank Danamon', 'bank_code' => 'DANAMON', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'bank_name' => 'Bank Jago', 'bank_code' => 'JAGO', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'bank_name' => 'Bank Mega', 'bank_code' => 'MEGA', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 4. Table: photo_types
        DB::table('photo_types')->insert([
            ['id' => 1, 'type_name' => 'Tampak Depan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'type_name' => 'Kamar Tidur', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'type_name' => 'Kamar Mandi', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'type_name' => 'Dapur Umum', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'type_name' => 'Ruang Tamu', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'type_name' => 'Parkiran Motor', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'type_name' => 'Parkiran Mobil', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'type_name' => 'Koridor/Lorong', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'type_name' => 'Area Jemur', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'type_name' => 'Fasilitas Lain', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 5. Table: facilities
        DB::table('facilities')->insert([
            ['id' => 1, 'name' => 'AC', 'icon_name' => 'icon-ac', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'WiFi', 'icon_name' => 'icon-wifi', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Kamar Mandi Dalam', 'icon_name' => 'icon-bath', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'Kasur', 'icon_name' => 'icon-bed', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'Lemari Pakaian', 'icon_name' => 'icon-wardrobe', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'name' => 'Meja Belajar', 'icon_name' => 'icon-desk', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'name' => 'Dapur', 'icon_name' => 'icon-kitchen', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'name' => 'Parkir Motor', 'icon_name' => 'icon-parking-motor', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'name' => 'Parkir Mobil', 'icon_name' => 'icon-parking-car', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'name' => 'CCTV', 'icon_name' => 'icon-cctv', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 6. Table: users
        $users = [
            ['id' => 1, 'username' => 'budi_owner', 'full_name' => 'Budi Santoso', 'profile_picture' => 'pic1.jpg', 'bio' => 'Pemilik Kos Budi', 'email' => 'budi@mail.com', 'phone_number' => '081234567890', 'password' => Hash::make('password'), 'role' => 'owner', 'created_at' => '2026-04-01 10:00:00'],
            ['id' => 2, 'username' => 'siti_owner', 'full_name' => 'Siti Aminah', 'profile_picture' => 'pic2.jpg', 'bio' => 'Pemilik Kos Siti', 'email' => 'siti@mail.com', 'phone_number' => '081234567891', 'password' => Hash::make('password'), 'role' => 'owner', 'created_at' => '2026-04-01 10:30:00'],
            ['id' => 3, 'username' => 'andi_owner', 'full_name' => 'Andi Wijaya', 'profile_picture' => 'pic3.jpg', 'bio' => 'Pemilik Kos Andi', 'email' => 'andi@mail.com', 'phone_number' => '081234567892', 'password' => Hash::make('password'), 'role' => 'owner', 'created_at' => '2026-04-02 09:15:00'],
            ['id' => 4, 'username' => 'rudi_seeker', 'full_name' => 'Rudi Hartono', 'profile_picture' => 'pic4.jpg', 'bio' => 'Mahasiswa UI', 'email' => 'rudi@mail.com', 'phone_number' => '081234567893', 'password' => Hash::make('password'), 'role' => 'user', 'created_at' => '2026-04-03 11:20:00'],
            ['id' => 5, 'username' => 'dina_seeker', 'full_name' => 'Dina Lestari', 'profile_picture' => 'pic5.jpg', 'bio' => 'Pekerja Kantoran', 'email' => 'dina@mail.com', 'phone_number' => '081234567894', 'password' => Hash::make('password'), 'role' => 'user', 'created_at' => '2026-04-03 14:10:00'],
            ['id' => 6, 'username' => 'eko_seeker', 'full_name' => 'Eko Prasetyo', 'profile_picture' => 'pic6.jpg', 'bio' => 'Cari kos murah', 'email' => 'eko@mail.com', 'phone_number' => '081234567895', 'password' => Hash::make('password'), 'role' => 'user', 'created_at' => '2026-04-04 08:00:00'],
            ['id' => 7, 'username' => 'fitri_seeker', 'full_name' => 'Fitriani', 'profile_picture' => 'pic7.jpg', 'bio' => 'Mahasiswi UGM', 'email' => 'fitri@mail.com', 'phone_number' => '081234567896', 'password' => Hash::make('password'), 'role' => 'user', 'created_at' => '2026-04-05 16:45:00'],
            ['id' => 8, 'username' => 'gilang_seeker', 'full_name' => 'Gilang Ramadhan', 'profile_picture' => 'pic8.jpg', 'bio' => 'IT Staff', 'email' => 'gilang@mail.com', 'phone_number' => '081234567897', 'password' => Hash::make('password'), 'role' => 'user', 'created_at' => '2026-04-06 09:30:00'],
            ['id' => 9, 'username' => 'hilda_seeker', 'full_name' => 'Hilda Sari', 'profile_picture' => 'pic9.jpg', 'bio' => 'Cari kos AC', 'email' => 'hilda@mail.com', 'phone_number' => '081234567898', 'password' => Hash::make('password'), 'role' => 'user', 'created_at' => '2026-04-07 13:20:00'],
            ['id' => 10, 'username' => 'admin_super', 'full_name' => 'Admin Sistem', 'profile_picture' => 'admin.jpg', 'bio' => 'Super Admin', 'email' => 'admin@mail.com', 'phone_number' => '081234567899', 'password' => Hash::make('password'), 'role' => 'admin', 'created_at' => '2026-04-01 08:00:00'],
        ];

        foreach ($users as &$user) {
            $user['updated_at'] = $now;
        }
        DB::table('users')->insert($users);

        // 7. Table: owners
        DB::table('owners')->insert([
            ['id' => 1, 'user_id' => 1, 'name' => 'Budi Santoso', 'phone_number' => '081234567890', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'user_id' => 2, 'name' => 'Siti Aminah', 'phone_number' => '081234567891', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'user_id' => 3, 'name' => 'Andi Wijaya', 'phone_number' => '081234567892', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'user_id' => 1, 'name' => 'Budi Management', 'phone_number' => '081234567800', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'user_id' => 2, 'name' => 'Siti Group', 'phone_number' => '081234567811', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'user_id' => 3, 'name' => 'Andi Jaya Kos', 'phone_number' => '081234567822', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'user_id' => 1, 'name' => 'Budi Properti', 'phone_number' => '081234567833', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'user_id' => 2, 'name' => 'Siti Makmur', 'phone_number' => '081234567844', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'user_id' => 3, 'name' => 'Andi Sejahtera', 'phone_number' => '081234567855', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'user_id' => 1, 'name' => 'Budi Investama', 'phone_number' => '081234567866', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 8. Table: user_bank_accounts
        DB::table('user_bank_accounts')->insert([
            ['id' => 1, 'user_id' => 1, 'bank_id' => 1, 'account_number' => '1234567890', 'account_holder_name' => 'Budi Santoso', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'user_id' => 2, 'bank_id' => 2, 'account_number' => '0987654321', 'account_holder_name' => 'Siti Aminah', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'user_id' => 3, 'bank_id' => 3, 'account_number' => '1122334455', 'account_holder_name' => 'Andi Wijaya', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'user_id' => 4, 'bank_id' => 1, 'account_number' => '5544332211', 'account_holder_name' => 'Rudi Hartono', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'user_id' => 5, 'bank_id' => 4, 'account_number' => '9988776655', 'account_holder_name' => 'Dina Lestari', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'user_id' => 6, 'bank_id' => 5, 'account_number' => '4455667788', 'account_holder_name' => 'Eko Prasetyo', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'user_id' => 7, 'bank_id' => 2, 'account_number' => '3322110099', 'account_holder_name' => 'Fitriani', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'user_id' => 8, 'bank_id' => 1, 'account_number' => '6677889900', 'account_holder_name' => 'Gilang Ramadhan', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'user_id' => 9, 'bank_id' => 6, 'account_number' => '2233445566', 'account_holder_name' => 'Hilda Sari', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'user_id' => 1, 'bank_id' => 9, 'account_number' => '7788990011', 'account_holder_name' => 'Budi Santoso', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 9. Table: kos_places
        $kosPlaces = [
            ['id' => 1, 'owner_id' => 1, 'district_id' => 1, 'name' => 'Kos Budi Tebet', 'address' => 'Jl. Tebet Raya No 1', 'type' => 'Campur', 'price_start_from' => 1500000, 'description' => 'Kos nyaman', 'rules' => 'Dilarang bawa hewan', 'latitude' => -6.2255, 'longitude' => 106.8488, 'rating_avg' => 4.5, 'is_verified' => true, 'created_at' => '2026-04-10 10:00:00'],
            ['id' => 2, 'owner_id' => 2, 'district_id' => 3, 'name' => 'Kos Siti Depok', 'address' => 'Jl. Margonda No 2', 'type' => 'Putri', 'price_start_from' => 1200000, 'description' => 'Dekat UI', 'rules' => 'Jam malam 22.00', 'latitude' => -6.3731, 'longitude' => 106.8345, 'rating_avg' => 4.8, 'is_verified' => true, 'created_at' => '2026-04-10 11:00:00'],
            ['id' => 3, 'owner_id' => 3, 'district_id' => 6, 'name' => 'Kos Andi Dago', 'address' => 'Jl. Dago No 3', 'type' => 'Putra', 'price_start_from' => 1800000, 'description' => 'Strategis', 'rules' => 'Bebas sopan', 'latitude' => -5.8893, 'longitude' => 107.6105, 'rating_avg' => 4.2, 'is_verified' => false, 'created_at' => '2026-04-10 12:00:00'],
            ['id' => 4, 'owner_id' => 4, 'district_id' => 8, 'name' => 'Kos UB Malang', 'address' => 'Jl. MT Haryono No 4', 'type' => 'Putri', 'price_start_from' => 1000000, 'description' => 'Dekat kampus UB', 'rules' => 'Dilarang merokok', 'latitude' => -7.9535, 'longitude' => 112.6133, 'rating_avg' => 4.9, 'is_verified' => true, 'created_at' => '2026-04-11 08:30:00'],
            ['id' => 5, 'owner_id' => 5, 'district_id' => 10, 'name' => 'Kos UGM Indah', 'address' => 'Jl. Kaliurang KM 5', 'type' => 'Campur', 'price_start_from' => 1300000, 'description' => 'Fasilitas lengkap', 'rules' => 'KTP Wajib', 'latitude' => -7.7667, 'longitude' => 110.3789, 'rating_avg' => 4.7, 'is_verified' => true, 'created_at' => '2026-04-11 09:45:00'],
            ['id' => 6, 'owner_id' => 6, 'district_id' => 2, 'name' => 'Kos Kuningan Elite', 'address' => 'Jl. HR Rasuna Said', 'type' => 'Campur', 'price_start_from' => 3000000, 'description' => 'Kos Eksklusif', 'rules' => 'No Pets', 'latitude' => -6.2146, 'longitude' => 106.8300, 'rating_avg' => 4.6, 'is_verified' => true, 'created_at' => '2026-04-12 10:15:00'],
            ['id' => 7, 'owner_id' => 7, 'district_id' => 5, 'name' => 'Kos Pocin Beji', 'address' => 'Jl. Pondok Cina', 'type' => 'Putra', 'price_start_from' => 900000, 'description' => 'Kos budget', 'rules' => 'Jam malam 23.00', 'latitude' => -6.3688, 'longitude' => 106.8322, 'rating_avg' => 3.8, 'is_verified' => false, 'created_at' => '2026-04-12 13:20:00'],
            ['id' => 8, 'owner_id' => 8, 'district_id' => 7, 'name' => 'Kos Gubeng Sby', 'address' => 'Jl. Gubeng Kertajaya', 'type' => 'Putri', 'price_start_from' => 1400000, 'description' => 'Aman dan bersih', 'rules' => 'Kunci bawa sendiri', 'latitude' => -7.2756, 'longitude' => 112.7565, 'rating_avg' => 4.3, 'is_verified' => true, 'created_at' => '2026-04-13 14:00:00'],
            ['id' => 9, 'owner_id' => 9, 'district_id' => 9, 'name' => 'Kos Undip Asri', 'address' => 'Jl. Tirto Agung', 'type' => 'Campur', 'price_start_from' => 1100000, 'description' => 'Nyaman sejuk', 'rules' => 'Bayar tepat waktu', 'latitude' => -7.0504, 'longitude' => 110.4370, 'rating_avg' => 4.5, 'is_verified' => true, 'created_at' => '2026-04-13 16:30:00'],
            ['id' => 10, 'owner_id' => 10, 'district_id' => 4, 'name' => 'Kos Sleman Raya', 'address' => 'Jl. Magelang KM 6', 'type' => 'Putra', 'price_start_from' => 800000, 'description' => 'Kos sederhana', 'rules' => 'Kerja bakti sebulan sekali', 'latitude' => -7.7314, 'longitude' => 110.3626, 'rating_avg' => 4.0, 'is_verified' => false, 'created_at' => '2026-04-14 09:00:00'],
        ];

        foreach ($kosPlaces as &$kos) {
            $kos['updated_at'] = $now;
        }
        DB::table('kos_places')->insert($kosPlaces);

        // 10. Table: rooms
        DB::table('rooms')->insert([
            ['id' => 1, 'kos_place_id' => 1, 'room_number' => 'A1', 'is_available' => true, 'price_custom' => null, 'description' => 'Kamar standar lantai 1', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'kos_place_id' => 1, 'room_number' => 'A2', 'is_available' => false, 'price_custom' => 1600000, 'description' => 'Kamar dengan jendela besar', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'kos_place_id' => 2, 'room_number' => '101', 'is_available' => true, 'price_custom' => null, 'description' => 'Dekat pintu masuk', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'kos_place_id' => 2, 'room_number' => '102', 'is_available' => true, 'price_custom' => 1300000, 'description' => 'Kamar luas pojok', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'kos_place_id' => 3, 'room_number' => 'B1', 'is_available' => false, 'price_custom' => null, 'description' => 'Kamar standar', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'kos_place_id' => 4, 'room_number' => 'VVIP', 'is_available' => true, 'price_custom' => 1500000, 'description' => 'Kamar mandi air panas', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'kos_place_id' => 5, 'room_number' => 'Lt2-01', 'is_available' => true, 'price_custom' => null, 'description' => 'View gunung', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'kos_place_id' => 6, 'room_number' => 'Penthouse', 'is_available' => true, 'price_custom' => 3500000, 'description' => 'Fasilitas apartemen', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'kos_place_id' => 7, 'room_number' => 'C1', 'is_available' => true, 'price_custom' => null, 'description' => 'Kasur single', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'kos_place_id' => 8, 'room_number' => 'D2', 'is_available' => false, 'price_custom' => null, 'description' => 'Lemari besar', 'created_at' => $now, 'updated_at' => $now],
        ]);

        // 11. Table: kos_place_facility
        DB::table('kos_place_facility')->insert([
            ['id' => 1, 'kos_place_id' => 1, 'facility_id' => 1],
            ['id' => 2, 'kos_place_id' => 1, 'facility_id' => 2],
            ['id' => 3, 'kos_place_id' => 1, 'facility_id' => 3],
            ['id' => 4, 'kos_place_id' => 2, 'facility_id' => 2],
            ['id' => 5, 'kos_place_id' => 2, 'facility_id' => 4],
            ['id' => 6, 'kos_place_id' => 2, 'facility_id' => 5],
            ['id' => 7, 'kos_place_id' => 3, 'facility_id' => 1],
            ['id' => 8, 'kos_place_id' => 3, 'facility_id' => 8],
            ['id' => 9, 'kos_place_id' => 4, 'facility_id' => 2],
            ['id' => 10, 'kos_place_id' => 5, 'facility_id' => 9],
        ]);

        // 12. Table: photos
        $photos = [
            ['id' => 1, 'kos_place_id' => 1, 'photo_type_id' => 1, 'image_url' => 'depan1.jpg', 'caption' => 'Tampak depan kos Budi', 'is_primary' => true, 'created_at' => '2026-04-10 10:05:00'],
            ['id' => 2, 'kos_place_id' => 1, 'photo_type_id' => 2, 'image_url' => 'kamar1.jpg', 'caption' => 'Interior kamar', 'is_primary' => false, 'created_at' => '2026-04-10 10:06:00'],
            ['id' => 3, 'kos_place_id' => 2, 'photo_type_id' => 1, 'image_url' => 'depan2.jpg', 'caption' => 'Tampak depan kos Siti', 'is_primary' => true, 'created_at' => '2026-04-10 11:05:00'],
            ['id' => 4, 'kos_place_id' => 2, 'photo_type_id' => 3, 'image_url' => 'km_mandi.jpg', 'caption' => 'Kamar mandi bersih', 'is_primary' => false, 'created_at' => '2026-04-10 11:06:00'],
            ['id' => 5, 'kos_place_id' => 3, 'photo_type_id' => 1, 'image_url' => 'depan3.jpg', 'caption' => 'Depan Dago', 'is_primary' => true, 'created_at' => '2026-04-10 12:05:00'],
            ['id' => 6, 'kos_place_id' => 4, 'photo_type_id' => 1, 'image_url' => 'depan4.jpg', 'caption' => 'Depan Malang', 'is_primary' => true, 'created_at' => '2026-04-11 08:35:00'],
            ['id' => 7, 'kos_place_id' => 5, 'photo_type_id' => 4, 'image_url' => 'dapur.jpg', 'caption' => 'Dapur bersama', 'is_primary' => false, 'created_at' => '2026-04-11 09:50:00'],
            ['id' => 8, 'kos_place_id' => 6, 'photo_type_id' => 1, 'image_url' => 'depan_elite.jpg', 'caption' => 'Elite Residence', 'is_primary' => true, 'created_at' => '2026-04-12 10:20:00'],
            ['id' => 9, 'kos_place_id' => 7, 'photo_type_id' => 2, 'image_url' => 'kamar_pocin.jpg', 'caption' => 'Kamar minimalis', 'is_primary' => true, 'created_at' => '2026-04-12 13:25:00'],
            ['id' => 10, 'kos_place_id' => 8, 'photo_type_id' => 6, 'image_url' => 'parkir.jpg', 'caption' => 'Parkiran luas', 'is_primary' => false, 'created_at' => '2026-04-13 14:05:00'],
        ];

        foreach ($photos as &$photo) {
            $photo['updated_at'] = $now;
        }
        DB::table('photos')->insert($photos);
    }
}