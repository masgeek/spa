<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tb_coordinates`.
 */
class m170607_063511_create_tb_clinics_table extends Migration
{
    public $tablename = 'tb_clinics';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable($this->tablename, [
            'CLINIC_ID' => $this->primaryKey(),
            'REGION_ID' => $this->integer()->notNull()->comment('clinic region nairobi, nakuru etc'),
            'CLINIC_NAME' => $this->string(50)->notNull()->comment('clinic name'),
            'LAT' => $this->float()->notNull()->comment('Map latitude'),
            'LONG' => $this->float()->notNull()->comment('Map longitude'),
            'DATE_ADDED' => $this->timestamp()->notNull(),
            'TIMESTAMP' => $this->integer(20)->notNull()
        ], $tableOptions);

        //create foreign keys
        $this->addForeignKey('FK_REGION_ID', $this->tablename, 'REGION_ID', 'tb_regions', 'REGION_ID', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->tablename);
    }
}
