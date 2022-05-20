<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $fruit = Category::updateOrCreate(
                ['name' => 'Fruits'],
                [
                    'description' => 'Lorem ipsum dolor sit amet'
                ]
            );

            $fruit->addMediaFromUrl(asset('images/categories/fruits.png'))->toMediaCollection('primary');
        });

        DB::transaction(function () {
            $vegetable = Category::updateOrCreate(
                ['name' => 'Vegetables'],
                [
                    'description' => 'Lorem ipsum dolor sit amet'
                ]
            );

            $vegetable->addMediaFromUrl(asset('images/categories/vegetables.png'))->toMediaCollection('primary');
        });

        DB::transaction(function () {
            $grocery = Category::updateOrCreate(
                ['name' => 'Groceries'],
                [
                    'description' => 'Lorem ipsum dolor sit amet'
                ]
            );

            $grocery->addMediaFromUrl(asset('images/categories/groceries.png'))->toMediaCollection('primary');
        });

        DB::transaction(function () {
            $dairy = Category::updateOrCreate(
                ['name' => 'Dairy'],
                [
                    'description' => 'Lorem ipsum dolor sit amet'
                ]
            );

            $dairy->addMediaFromUrl(asset('images/categories/dairy.png'))->toMediaCollection('primary');
        });

        DB::transaction(function () {
            $bakery = Category::updateOrCreate(
                ['name' => 'Bakery'],
                [
                    'description' => 'Lorem ipsum dolor sit amet'
                ]
            );

            $bakery->addMediaFromUrl(asset('images/categories/bakery.png'))->toMediaCollection('primary');
        });

        DB::transaction(function () {
            $fish = Category::updateOrCreate(
                ['name' => 'Fish'],
                [
                    'description' => 'Lorem ipsum dolor sit amet'
                ]
            );

            $fish->addMediaFromUrl(asset('images/categories/fish.png'))->toMediaCollection('primary');
        });

        DB::transaction(function () {
            $meat = Category::updateOrCreate(
                ['name' => 'Meat'],
                [
                    'description' => 'Lorem ipsum dolor sit amet'
                ]
            );

            $meat->addMediaFromUrl(asset('images/categories/meat.png'))->toMediaCollection('primary');
        });

        DB::transaction(function () {
            $beverage = Category::updateOrCreate(
                ['name' => 'Beverage'],
                [
                    'description' => 'Lorem ipsum dolor sit amet'
                ]
            );

            $beverage->addMediaFromUrl(asset('images/categories/beverage.png'))->toMediaCollection('primary');
        });
    }
}