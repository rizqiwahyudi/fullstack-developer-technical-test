<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posisi = ['Fullstack Developer','Human Resource Department','Mobile Developer'];
        foreach ($posisi as $nama) {
            Position::create(['name' => $nama]);
        }
    }
}
