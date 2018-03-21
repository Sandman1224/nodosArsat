<?php

use yii\db\Migration;

/**
 * Handles adding borrado to table `departamentos`.
 */
class m180319_124424_add_borrado_column_to_departamentos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('departamentos', 'borrado', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('departamentos', 'borrado');
    }
}
