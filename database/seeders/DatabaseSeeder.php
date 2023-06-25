<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 1; $i <= 4; $i++) {
            $name = $faker->firstName;
            $last_name = $faker->lastName;
            $jenis = ['kuis', 'tugas', 'absensi', 'praktek', 'uas'];
            foreach($jenis as $item){
                $nilai = $faker->numberBetween(0, 100);
                \DB::table('students')->insert([
                    'name' => $name,
                    'last_name' => $last_name,
                    'jenis' =>$item,
                    'nilai' => $nilai,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
