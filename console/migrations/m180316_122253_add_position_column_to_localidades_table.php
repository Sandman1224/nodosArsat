<?php

use yii\db\Migration;

/**
 * Handles adding position to table `localidades`.
 */
class m180316_122253_add_position_column_to_localidades_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('localidades', 'latitud', $this->double());
        $this->addColumn('localidades', 'longitud', $this->double());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('localidades', 'latitud');
        $this->dropColumn('localidades', 'longitud');
    }
}
