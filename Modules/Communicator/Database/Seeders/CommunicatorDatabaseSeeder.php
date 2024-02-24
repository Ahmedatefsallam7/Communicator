<?php

namespace Modules\Communicator\Database\Seeders;

use Illuminate\Database\Seeder;

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
