<?php

use Illuminate\Database\Seeder;

class ApiListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $lists = [
            [
                'name' => "London",
                'feed_url' => 'https://content-api.hiltonapps.com/v1/places/top-places/uk-london-fsq?access_token=jobs383-UgWfVvxQXNhDQLw4v'
            ],
            [
                'name' => "London",
                'feed_url' => 'https://content-api.hiltonapps.com/v1/places/top-places/uk-london-via?access_token=jobs383-UgWfVvxQXNhDQLw4v'
            ],
            [
                'name' => "London",
                'feed_url' => 'https://content-api.hiltonapps.com/v1/places/top-places/london-uk-timeout?access_token=jobs383-UgWfVvxQXNhDQLw4v'
            ],
            [
                'name' => "USA NYCNY",
                'feed_url' => 'https://content-api.hiltonapps.com/v1/places/top-places/usa-nycny-fsq?access_token=jobs383-UgWfVvxQXNhDQLw4v'
            ],
            [
                'name' => "USA NYCNY",
                'feed_url' => 'https://content-api.hiltonapps.com/v1/places/top-places/usa-nycny-via?access_token=jobs383-UgWfVvxQXNhDQLw4v'
            ],
            [
                'name' => "USA NYCNY",
                'feed_url' => 'https://content-api.hiltonapps.com/v1/places/top-places/new-york-ny-usa-timeout?access_token=jobs383-UgWfVvxQXNhDQLw4v'
            ]

        ];

        //
        DB::table('api_lists')->insert($lists);

    }
}
