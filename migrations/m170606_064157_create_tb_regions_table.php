<?php

use yii\db\Migration;

/**
 * Handles the creation of table `tb_regions`.
 */
class m170606_064157_create_tb_regions_table extends Migration
{
    public $tablename = 'tb_regions';

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
            'REGION_ID' => $this->primaryKey(),
            'REGION_NAME' => $this->string(30)->notNull(),
            'DATE_ADDED' => $this->dateTime()->notNull(),
            'TIMESTAMP' => $this->integer(20)->notNull()
        ], $tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable($this->tablename);
    }
}
