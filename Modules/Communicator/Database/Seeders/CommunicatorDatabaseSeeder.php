<?php

namespace Modules\Communicator\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Communicator\Database\Seeders\TemplateSeeder;

class CommunicatorDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            TemplateSeeder::class,
        ]);
    }
}
