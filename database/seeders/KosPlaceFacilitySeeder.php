<?php

namespace Database\Seeders;

use App\Models\KosPlace;
use App\Models\Facility;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KosPlaceFacilitySeeder extends Seeder
{
    public function run(): void
    {
        $kosPlaces = KosPlace::all();
        $facilityIds = Facility::pluck('id')->toArray();

        foreach ($kosPlaces as $kos) {
            // Mengambil 3 sampai 6 ID fasilitas secara acak untuk setiap kos
            $randomFacilities = fake()->randomElements(
                $facilityIds, 
                fake()->numberBetween(3, 6)
            );

            foreach ($randomFacilities as $facilityId) {
                DB::table('kos_place_facility')->insertOrIgnore([
                    'kos_place_id' => $kos->id, //
                    'facility_id' => $facilityId, //
                ]);
            }
        }
    }
}