<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Prefensi;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $nilai_prefensis = array(
            array(
                "id" => 1,
                "kode" => "1",
                "nama" => "sangat penting",
                "created_at" => "2022-11-23 21:41:13",
                "updated_at" => "2022-11-24 08:00:10",
            ),
            array(
                "id" => 2,
                "kode" => "2",
                "nama" => "Mendekati sedikit lebih penting",
                "created_at" => "2022-11-23 21:41:26",
                "updated_at" => "2022-11-24 07:59:54",
            ),
            array(
                "id" => 3,
                "kode" => "3",
                "nama" => "Sedikit lebih penting dari",
                "created_at" => "2022-11-23 21:41:38",
                "updated_at" => "2022-11-24 08:00:25",
            ),
            array(
                "id" => 4,
                "kode" => "4",
                "nama" => "Mendekati lebih lebih penting dari",
                "created_at" => "2022-11-23 21:41:44",
                "updated_at" => "2022-11-24 08:00:35",
            ),
            array(
                "id" => 5,
                "kode" => "5",
                "nama" => "Lebih penting dari",
                "created_at" => "2022-11-24 08:00:47",
                "updated_at" => "2022-11-24 08:00:47",
            ),
            array(
                "id" => 6,
                "kode" => "6",
                "nama" => "Mendekati sangat penting dari",
                "created_at" => "2022-11-24 08:00:58",
                "updated_at" => "2022-11-24 08:00:58",
            ),
            array(
                "id" => 7,
                "kode" => "7",
                "nama" => "sangat penting dari",
                "created_at" => "2022-11-24 08:01:12",
                "updated_at" => "2022-11-24 08:01:12",
            ),
            array(
                "id" => 8,
                "kode" => "8",
                "nama" => "Mendekati mutlak dari",
                "created_at" => "2022-11-24 08:01:23",
                "updated_at" => "2022-11-24 08:01:23",
            ),
            array(
                "id" => 9,
                "kode" => "9",
                "nama" => "Mutlak sangat penting dari",
                "created_at" => "2022-11-24 08:01:36",
                "updated_at" => "2022-11-24 08:01:36",
            ),
        );
        Prefensi::insert($nilai_prefensis);
    }
}
