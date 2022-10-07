<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('news')->insert($this->getData());
    }

    private function getData(): array
    {
       $faker = Factory::create('ru_RU');

       $data = [];
       for ($i = 0; $i < 10; $i++) {
           $data[] = [
               'category_id' => rand(1, 5),
               'title' => $faker->realText(rand(50, 100)),
               'text' => $faker->realText(rand(200, 400)),
               'isPrivate' => (boolean)rand(0, 1),
           ];
       }

       return $data;
    }
}
