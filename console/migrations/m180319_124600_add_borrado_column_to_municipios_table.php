<?php

use yii\db\Migration;

/**
 * Handles adding borrado to table `municipios`.
 */
class m180319_124600_add_borrado_column_to_municipios_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('municipios', 'borrado', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('municipios', 'borrado');
    }
}
