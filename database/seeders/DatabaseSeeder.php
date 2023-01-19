<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            ['name' => 'sydney'],
            ['name' => 'honululu'],
        ];
        foreach ($rows as $row) {
            Room::create([
                ...$row,
                'posx' => 0,
                'posy' => 0,
                'width' => 0,
                'height' => 0
            ]);
        }
    }
}
