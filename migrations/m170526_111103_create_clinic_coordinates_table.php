<?php

use yii\db\Migration;

/**
 * Handles the creation of table `clinic_coordinates`.
 */
class m170526_111103_create_clinic_coordinates_table extends Migration
{
    public $table_name ='clinic_coordinates';
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable($this->table_name, [
            'ID' => $this->primaryKey(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable($this->table_name);
    }
}
