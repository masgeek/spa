<?php

use yii\db\Migration;

class m170607_071837_create_dummy_data extends Migration
{
    public $regions_table = 'tb_regions';
    public $clinics_table = 'tb_clinics';

    public function safeUp()
    {
        $faker = Faker\Factory::create();

        $now = new DateTime('now');
        $current_date = $now->format('Y-m-d H:i:s');
        $current_timestamp = $now->getTimestamp();
        $timezone = $now->getTimezone();

        $records = 10;
        $seed_records = 0;
        do {
            $seed_records++;
            $this->insert($this->regions_table, [
                'REGION_ID' => $seed_records,
                'REGION_NAME' => strtoupper($faker->city),
                'DATE_ADDED' => $current_date,
                'TIMESTAMP' => $current_timestamp
            ]);

            $this->insert($this->clinics_table, [
                'REGION_ID' => $seed_records,
                'CLINIC_NAME' => $faker->company,
                'LAT' => $faker->latitude,
                'LONG' => $faker->longitude,
                'DATE_ADDED' => $current_date,
                'TIMESTAMP' => $current_timestamp
            ]);

        } while ($seed_records <= $records);
    }

    public function safeDown()
    {
        echo "m170607_071837_create_dummy_data cannot be reverted.\n";
        return true;
    }

}
