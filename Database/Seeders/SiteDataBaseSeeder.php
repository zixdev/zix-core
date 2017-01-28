<?php

namespace Zix\Core\Database\Seeders;
use Illuminate\Database\Seeder;
use Zix\Core\Entities\Site;

class SiteDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::create([
            'name'		                => env('API_DEFAULT_SITE_CLIENT', 'Zix Development'),
            'url'		                => env('API_DEFAULT_SITE_CLIENT_URL', 'https://zixdev.com'),
            'ui'		                => 'default',
        ]);

    }
}
