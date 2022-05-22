<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::updateOrCreate(
            ['name' => "Kilogram"],
            ['code' => "kg"],
        );

        Unit::updateOrCreate(
            ['name' => "Pieces"],
            ['code' => "pcs"],
        );

        Unit::updateOrCreate(
            ['name' => "Litre"],
            ['code' => "ltr"],
        );

        Unit::updateOrCreate(
            ['name' => "Meter"],
            ['code' => "mt"],
        );
    }
}