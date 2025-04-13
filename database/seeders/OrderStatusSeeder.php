<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [ // always default values
            ['id' => 1, 'title' => 'New'],
            ['id' => 2, 'title' => 'Processing'],
            ['id' => 3, 'title' => 'Ready for Pickup'],
            ['id' => 4, 'title' => 'Completed'],
            ['id' => 5, 'title' => 'Cancelled'],
        ];
        foreach ($statuses as $status) {
            Status::query()->firstOrCreate($status);
        }
    }
}
