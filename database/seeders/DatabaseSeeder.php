<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use App\Models\KosPlace;
use App\Models\Room;
use App\Models\User;
use App\Models\Owner;
use App\Models\Photo;
use App\Models\Facility;
use App\Models\Bank;
use App\Models\UserBankAccount;
use App\Models\Review;
use App\Models\Booking;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $now = Carbon::now();

        // 1. DATA USER & ADMIN
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'username' => 'superadmin',
                'full_name' => 'Administrator Utama',
                'password' => Hash::make('SandiAdmin'),
                'role' => 'admin',
                'email_verified_at' => $now,
            ]
        );
        if (User::count() < 10) User::factory(19)->create();

        // 2. DATA MASTER: BANKS
        if (DB::table('banks')->count() == 0) {
            $banks = [
                ['bank_name' => 'Bank Rakyat Indonesia', 'bank_code' => 'BRI', 'num_code' => '002'],
                ['bank_name' => 'Bank Mandiri', 'bank_code' => 'MANDIRI', 'num_code' => '008'],
                ['bank_name' => 'Bank Negara Indonesia', 'bank_code' => 'BNI', 'num_code' => '009'],
                ['bank_name' => 'Bank Tabungan Negara', 'bank_code' => 'BTN', 'num_code' => '200'],
                ['bank_name' => 'Bank Central Asia', 'bank_code' => 'BCA', 'num_code' => '014'],
                ['bank_name' => 'Bank CIMB Niaga', 'bank_code' => 'CIMB', 'num_code' => '022'],
                ['bank_name' => 'Bank Permata', 'bank_code' => 'PERMATA', 'num_code' => '013'],
                ['bank_name' => 'Bank Danamon', 'bank_code' => 'DANAMON', 'num_code' => '011'],
                ['bank_name' => 'Bank Syariah Indonesia', 'bank_code' => 'BSI', 'num_code' => '451'],
                ['bank_name' => 'Bank Jawa Timur', 'bank_code' => 'JATIM', 'num_code' => '114'],
                ['bank_name' => 'Bank PAN Indonesia', 'bank_code' => 'PANIN', 'num_code' => '019'],
                ['bank_name' => 'Bank Mega', 'bank_code' => 'MEGA', 'num_code' => '426'],
                ['bank_name' => 'Bank ICBC Indonesia', 'bank_code' => 'ICBC', 'num_code' => '164'],
            ];
            foreach ($banks as $b) DB::table('banks')->insert(array_merge($b, ['created_at' => $now, 'updated_at' => $now]));
        }

        // 3. DATA MASTER PHOTO_TYPES
        if (DB::table('photo_types')->count() == 0) {
            $types = [
                'Tampak Depan', 'Kamar Tidur', 'Kamar Mandi', 'Dapur Bersama', 'Ruang Tamu', 
                'Tampak Samping', 'Gerbang Kos', 'Parkiran Motor', 'Parkiran Mobil', 'Ruang Jemur', 
                'Koridor', 'Taman', 'Balkon', 'Fasilitas Umum', 'Lainnya'
            ];
            foreach ($types as $index => $t) {
                DB::table('photo_types')->insert(['id' => $index + 1, 'type_name' => $t, 'created_at' => $now]);
            }
        }

        // 4. FACILITIES
        if (DB::table('facilities')->count() == 0) {
            $facs = [
                'WiFi', 'AC', 'Kamar Mandi Dalam', 'Kasur', 'Lemari Pakaian', 
                'Meja Belajar', 'Kursi', 'TV', 'Air Panas', 'Kulkas', 
                'Dispenser', 'Dapur Bersama', 'Parkir Motor', 'Parkir Mobil', 'CCTV', 
                'Keamanan 24 Jam', 'Laundry', 'Ruang Tamu', 'Balkon', 'Musholla',
                'Kamar Mandi Luar', 'Kipas Angin', 'Penjaga Kos', 'Akses Kunci 24 Jam', 'Ruang Jemur'
            ];
            foreach ($facs as $f) DB::table('facilities')->insert(['name' => $f, 'created_at' => $now, 'updated_at' => $now]);
        }

        // 5. DATA MASTER: CITIES
        if (DB::table('cities')->count() == 0) {
            $cities = [['id' => 1, 'name' => 'Madiun'], ['id' => 2, 'name' => 'Ponorogo'], ['id' => 3, 'name' => 'Bojonegoro'], ['id' => 4, 'name' => 'Tuban'], ['id' => 5, 'name' => 'Surabaya'], ['id' => 6, 'name' => 'Malang'], ['id' => 7, 'name' => 'Sidoarjo'], ['id' => 8, 'name' => 'Lamongan'], ['id' => 9, 'name' => 'Blora'], ['id' => 10, 'name' => 'Rembang'], ['id' => 11, 'name' => 'Wonogiri'], ['id' => 12, 'name' => 'Sragen'], ['id' => 13, 'name' => 'Magetan'], ['id' => 14, 'name' => 'Ngawi'], ['id' => 15, 'name' => 'Tulungagung'], ['id' => 16, 'name' => 'Batu'], ['id' => 17, 'name' => 'Kediri'], ['id' => 18, 'name' => 'Pare'], ['id' => 19, 'name' => 'Nganjuk'], ['id' => 20, 'name' => 'Mojokerto'], ['id' => 21, 'name' => 'Pacitan']];
            foreach ($cities as $c) DB::table('cities')->insert(array_merge($c, ['created_at' => $now]));
        }

        // 6. SYNC DATA OWNER
        $ownerUsers = User::where('role', 'owner')->get();
        foreach ($ownerUsers as $u) {
            Owner::updateOrCreate(['user_id' => $u->id], ['name' => $u->full_name ?? $u->username, 'phone_number' => $u->phone_number ?? '08123456789']);
        }

// 7. USER BANK ACCOUNTS
        $allBanks = Bank::all();
        $allUsers = User::all();
        foreach ($allUsers as $u) {
            $randomBank = $allBanks->random();
    
    // Format Account Number
            $accountNumber = $randomBank->num_code . fake()->randomNumber(8, true);
    
            DB::table('user_bank_accounts')->updateOrInsert(
                ['user_id' => $u->id],
                [
                    'bank_id' => $randomBank->id,
                    'account_number' => $accountNumber,
                    'account_holder_name' => $u->full_name ?? $u->username,
                    'created_at' => $now,
                    'updated_at' => $now
                ]
            );
        }

        // 8. GENERATE DATA UTAMA
        District::factory(30)->create();
        KosPlace::factory(25)->create();
        Room::factory(80)->create();

        $kosPlaces = KosPlace::all();
        $facilityIds = Facility::pluck('id')->toArray();
        $regularUsers = User::where('role', 'user')->get();

        // 9. RELASI KOMPLEKS (PIVOT, PHOTOS, REVIEWS)
        foreach ($kosPlaces as $kos) {
            // Fasilitas & Foto
            $kos->facilities()->syncWithoutDetaching(fake()->randomElements($facilityIds, 7));
            
            Photo::create([
                'kos_place_id' => $kos->id, 
                'photo_type_id' => 1, 
                'image_url' => "https://picsum.photos/seed/{$kos->id}/800/600", 
                'caption' => 'Tampak Depan ' . $kos->name,
                'is_primary' => true
            ]);

            $rev = Review::create(['kos_place_id' => $kos->id, 'user_id' => $regularUsers->random()->id, 'rating' => 5, 'comment' => 'Sangat nyaman!']);
            if (fake()->boolean()) {
                DB::table('review_replies')->insert(['review_id' => $rev->id, 'user_id' => $admin->id, 'reply_comment' => 'Senang mendengarnya!', 'created_at' => $now]);
            }
        }

        // 10. BOOKINGS & REPORTS 
        foreach ($regularUsers as $user) {
            $room = Room::inRandomOrder()->first();
            $months = fake()->numberBetween(1, 12);
            DB::table('bookings')->insert([
                'user_id' => $user->id, 'room_id' => $room->id, 'start_date' => $now, 
                'duration_months' => $months, 'total_price' => ($room->price_custom ?? 1000000) * $months, 
                'status' => 'confirmed', 'created_at' => $now
            ]);

            // Reports: 
            DB::table('reports')->insert([
                'user_id' => $user->id, 'kos_place_id' => $kosPlaces->random()->id,
                'category' => fake()->randomElement(['Fasilitas', 'Kebersihan', 'Keamanan']),
                'description' => fake()->randomElement([
                    'Kamar mandi bocor', 'AC mati total', 'WiFi tidak bisa konek', 
                    'Lampu koridor redup', 'Air keran berbau', 'Tetangga sangat berisik malam hari'
                ]),
                'status' => 'pending', 'created_at' => $now
            ]);
        }
    }
}