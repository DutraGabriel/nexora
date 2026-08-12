<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $electronics = Category::updateOrCreate(
            ['slug' => 'eletronicos'],
            ['name' => 'Eletrônicos']
        );

        Category::updateOrCreate(
            ['slug' => 'celulares'],
            [
                'name' => 'Celulares',
                'parent_id' => $electronics->id,
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'computadores'],
            [
                'name' => 'Computadores',
                'parent_id' => $electronics->id,
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'televisores'],
            [
                'name' => 'Televisores',
                'parent_id' => $electronics->id,
            ]
        );

        $home = Category::updateOrCreate(
            ['slug' => 'casa'],
            ['name' => 'Casa']
        );

        Category::updateOrCreate(
            ['slug' => 'moveis'],
            [
                'name' => 'Móveis',
                'parent_id' => $home->id,
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'eletrodomesticos'],
            [
                'name' => 'Eletrodomésticos',
                'parent_id' => $home->id,
            ]
        );

        $fashion = Category::updateOrCreate(
            ['slug' => 'moda'],
            ['name' => 'Moda']
        );

        Category::updateOrCreate(
            ['slug' => 'roupas'],
            [
                'name' => 'Roupas',
                'parent_id' => $fashion->id,
            ]
        );

        Category::updateOrCreate(
            ['slug' => 'calcados'],
            [
                'name' => 'Calçados',
                'parent_id' => $fashion->id,
            ]
        );
    }
}
