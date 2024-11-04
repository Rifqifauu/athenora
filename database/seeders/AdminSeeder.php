<?php
namespace Database\Seeders;

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create 10 sample admins using the factory
        Admin::factory()->count(1)->create();
    }
}
