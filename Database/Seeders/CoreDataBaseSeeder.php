<?php

namespace Zix\Core\Database\Seeders;

use Illuminate\Database\Seeder;

class CoreDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SiteDataBaseSeeder::class);
        $this->call(PermissionsDatabaseSeeder::class);
    }
}
