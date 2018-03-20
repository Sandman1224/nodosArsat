<?php

use yii\db\Migration;

/**
 * Handles adding borrado to table `localidades`.
 */
class m180319_124647_add_borrado_column_to_localidades_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('localidades', 'borrado', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('localidades', 'borrado');
    }
}
