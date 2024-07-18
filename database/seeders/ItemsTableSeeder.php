<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;


class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $items = [
            ['name' => 'Kipas angin', 'description' => 'Kipas angin panasonic', 'quantity' => 10, 'price' => 200000],
            ['name' => 'Smartwatch', 'description' => 'Smartwatch garmin 5 new Arrival', 'quantity' => 20, 'price' => 2500000],
            // Add more items as needed
        ];

        // Loop through the data and insert into database
        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
