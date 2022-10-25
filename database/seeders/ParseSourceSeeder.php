<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ParseSourceSeeder extends Seeder
{
    private array $urls = [
        'https://www.vedomosti.ru/rss/library/characters',
        'https://www.vedomosti.ru/rss/rubric/business/energy',
        'https://www.vedomosti.ru/rss/rubric/business/industry',
        'https://www.vedomosti.ru/rss/rubric/business/transport',
        'https://www.vedomosti.ru/rss/rubric/business/agriculture',
        'https://www.vedomosti.ru/rss/rubric/business/retail',
        'https://www.vedomosti.ru/rss/rubric/business/sport',
        'https://www.vedomosti.ru/rss/rubric/economics/macro',
        'https://www.vedomosti.ru/rss/rubric/economics/state_investments',
        'https://www.vedomosti.ru/rss/rubric/economics/global',
        'https://www.vedomosti.ru/rss/rubric/economics/taxes',
        'https://www.vedomosti.ru/rss/rubric/economics/regulations',
//            'https://www.vedomosti.ru/rss/rubric/finance',
        'https://www.vedomosti.ru/rss/rubric/finance/banks',
        'https://www.vedomosti.ru/rss/rubric/finance/markets',
        'https://www.vedomosti.ru/rss/rubric/finance/players',
        'https://www.vedomosti.ru/rss/rubric/finance/insurance',
//            'https://www.vedomosti.ru/rss/rubric/finance/personal_finance',
        'https://www.vedomosti.ru/rss/rubric/opinion',
        'https://www.vedomosti.ru/rss/rubric/opinion/details',
        'https://www.vedomosti.ru/rss/rubric/opinion/analytics',
//            'https://www.vedomosti.ru/rss/rubric/politics',
        'https://www.vedomosti.ru/rss/rubric/politics/official',
        'https://www.vedomosti.ru/rss/rubric/politics/democracy',
        'https://www.vedomosti.ru/rss/rubric/politics/international',
        'https://www.vedomosti.ru/rss/rubric/politics/security_law',
//            'https://www.vedomosti.ru/rss/rubric/politics/social',
        'https://www.vedomosti.ru/rss/rubric/politics/foreign',
//            'https://www.vedomosti.ru/rss/rubric/technology',
        'https://www.vedomosti.ru/rss/rubric/technology/telecom',
        'https://www.vedomosti.ru/rss/rubric/technology/internet',
//         	'https://www.vedomosti.ru/rss/rubric/technology/media',
        'https://www.vedomosti.ru/rss/rubric/technology/it_business',
        'https://www.vedomosti.ru/rss/rubric/technology/personal_technologies',
        'https://www.vedomosti.ru/rss/rubric/technology/hi_tech',
        'https://www.vedomosti.ru/rss/rubric/realty',
//        	'https://www.vedomosti.ru/rss/rubric/realty/housing',
//        	'https://www.vedomosti.ru/rss/rubric/realty/commercial_property',
        'https://www.vedomosti.ru/rss/rubric/realty/infrastructure',
        'https://www.vedomosti.ru/rss/rubric/realty/architecture',
        'https://www.vedomosti.ru/rss/rubric/realty/districts',
//         	'https://www.vedomosti.ru/rss/rubric/auto',
//            'https://www.vedomosti.ru/rss/rubric/auto/auto_industry',
        'https://www.vedomosti.ru/rss/rubric/auto/cars',
        'https://www.vedomosti.ru/rss/rubric/auto/commercial_vehicles',
        'https://www.vedomosti.ru/rss/rubric/auto/car_design',
        'https://www.vedomosti.ru/rss/rubric/auto/test_drive',
//            'https://www.vedomosti.ru/rss/rubric/management',
//            'https://www.vedomosti.ru/rss/rubric/management/career',
//            'https://www.vedomosti.ru/rss/rubric/management/management',
        'https://www.vedomosti.ru/rss/rubric/management/compensation',
//            'https://www.vedomosti.ru/rss/rubric/management/entrepreneurship',
        'https://www.vedomosti.ru/rss/rubric/management/education',
        'https://www.vedomosti.ru/rss/rubric/lifestyle',
        'https://www.vedomosti.ru/rss/rubric/lifestyle/leisure',
//            'https://www.vedomosti.ru/rss/rubric/lifestyle/culture',
        'https://www.vedomosti.ru/rss/rubric/lifestyle/luxury',
        'https://www.vedomosti.ru/rss/rubric/lifestyle/interview',
        'https://www.vedomosti.ru/rss/rubric/lifestyle/lifeline',
        'https://www.lenta.ru/rss'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('sources')->insert($this->getData());
    }

    private function getData(): array
    {
        $data = [];
        foreach ($this->urls as $url) {
            $data[] = [
                'url' => $url,
            ];
        }
        return $data;
    }
}
