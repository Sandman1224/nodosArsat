<?php

use yii\db\Migration;

/**
 * Handles the creation of table `nodos`.
 */
class m180316_140347_create_nodos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('nodos', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),
            'departamento' => $this->integer()->notNull(),
            'municipio' => $this->integer()->notNull(),
            'localidad' => $this->integer()->notNull(),
            'latitud' => $this->double()->notNull(),
            'longitud' => $this->double()->notNull(),
            'contratista' => $this->string(),
            'documentacion' => $this->integer(),
            'fechaDocumentacion' => $this->date(),
            'poblacion' => $this->integer(),
            'estadoSitio' => $this->integer(),
            'situacion' => $this->string(),
            'prioridad' => $this->integer(),
            'estadoSitioContratista' => $this->string(),
            'estadoSitioEjesa' => $this->string(),
            'estadoSitioArsat' => $this->string(),
            'borrado' => $this->boolean()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('nodos');
    }
}
