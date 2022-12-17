<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class Building extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buildings')->insert(
            [
                [
                    'name'=> 'BuildingA'
                ],
                [
                    'name'=> 'BuildingB'
                ],
                [
                    'name'=> 'BuildingC'
                ],
                [
                    'name'=> 'BuildingD'
                ],
                [
                    'name'=> 'BuildingE'
                ],
                [
                    'name'=> 'BuildingF'
                ],
                [
                    'name'=> 'BuildingG'
                ],
                [
                    'name'=> 'BuildingH'
                ],
                [
                    'name'=> 'BuildingI'
                ],
                [
                    'name'=> 'BuildingJ'
                ],
            ]
        
    );
    }
}
