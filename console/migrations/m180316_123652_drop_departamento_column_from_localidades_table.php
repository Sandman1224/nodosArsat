<?php

use yii\db\Migration;

/**
 * Handles dropping departamento from table `localidades`.
 */
class m180316_123652_drop_departamento_column_from_localidades_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('FK-LOCALIDADES-DEPARTAMENTO', 'localidades');
        
        $this->dropColumn('localidades', 'departamento');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->addColumn('localidades', 'departamento', $this->integer());
        
        // Clave foránea para la localidades-departamentos
        $this->addForeignKey(
                'FK-LOCALIDADES-DEPARTAMENTO', 'localidades', 'departamento', 'departamentos', 'id', 'CASCADE', 'CASCADE');
    }
}
