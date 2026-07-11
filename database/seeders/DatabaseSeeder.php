<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ADMIN USER
        \App\Models\User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@hiddentasik.com',
            'password' => \Illuminate\Support\Facades\Hash::make('tasik2024'),
        ]);

        // DESTINATIONS
        $d1 = \App\Models\Destination::create([
            'name' => 'Curug Cimanintin',
            'category' => 'Wisata Alam / Air Terjun',
            'geographic_location' => 'Salopa, Tasikmalaya',
            'status' => 'TERBIT',
            'description' => 'Air terjun yang indah dan tersembunyi.',
            'image_url' => 'assets/images/dest_ciparay.png'
        ]);

        $d2 = \App\Models\Destination::create([
            'name' => 'Kawah Galunggung',
            'category' => 'Vulkanik / Pendakian',
            'geographic_location' => 'Sukaratu, Tasikmalaya',
            'status' => 'TERBIT',
            'description' => 'Kawah gunung berapi aktif dengan pemandangan menakjubkan.',
            'image_url' => 'assets/images/dest_galunggung.png'
        ]);

        $d3 = \App\Models\Destination::create([
            'name' => 'Pantai Karang Tawulan',
            'category' => 'Pantai / Tebing',
            'geographic_location' => 'Cikalong, Tasikmalaya',
            'status' => 'DRAFT',
            'description' => 'Pantai dengan tebing karang yang mempesona.',
            'image_url' => 'assets/images/dest_tawulan.png'
        ]);

        $d4 = \App\Models\Destination::create([
            'name' => 'Kampung Naga',
            'category' => 'Budaya / Sejarah',
            'geographic_location' => 'Salawu, Tasikmalaya',
            'status' => 'TERBIT',
            'description' => 'Desa adat yang mempertahankan budaya leluhur.',
            'image_url' => 'assets/images/dest_borobudur.png'
        ]);

        // ACTIVITIES
        \App\Models\Activity::create([
            'name' => 'Trekking Menuju Curug',
            'destination_id' => $d1->id,
            'duration' => '2 Jam',
            'price' => 25000,
            'description' => 'Perjalanan menembus hutan tropis.'
        ]);

        \App\Models\Activity::create([
            'name' => 'Berendam Air Panas',
            'destination_id' => $d2->id,
            'duration' => 'Sepuasnya',
            'price' => 15000,
            'description' => 'Relaksasi di kolam air panas alami.'
        ]);

        // FACILITIES
        \App\Models\Facility::create([
            'name' => 'Area Parkir Luas',
            'type' => 'Infrastruktur',
            'location' => 'Kawah Galunggung',
            'condition' => 'Baik',
            'description' => 'Tersedia untuk mobil dan motor.'
        ]);
        
        \App\Models\Facility::create([
            'name' => 'Toilet Umum',
            'type' => 'Fasilitas Dasar',
            'location' => 'Kampung Naga',
            'condition' => 'Cukup',
            'description' => 'Toilet bersih dengan air mengalir.'
        ]);
    }
}
