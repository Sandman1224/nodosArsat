<?php

use yii\db\Migration;

/**
 * Handles the creation of table `departamentos`.
 */
class m180315_160755_create_departamentos_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_spanish_ci ENGINE=InnoDB';
        }

        $this->createTable('departamentos', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull()
                ], $tableOptions);

        $this->createTable('municipios', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),
            'departamento' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

        // Clave foránea para la tabla municipios-departamentos
        $this->addForeignKey(
                'FK-DEPARTAMENTO-MUNICIPIO', 'municipios', 'departamento', 'departamentos', 'id', 'CASCADE', 'CASCADE');

        $this->createTable('localidades', [
            'id' => $this->primaryKey(),
            'nombre' => $this->string()->notNull(),
            'departamento' => $this->integer()->notNull(),
            'municipio' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
                ], $tableOptions);

        // Clave foránea para la localidades-departamentos
        $this->addForeignKey(
                'FK-LOCALIDADES-DEPARTAMENTO', 'localidades', 'departamento', 'departamentos', 'id', 'CASCADE', 'CASCADE');

        // Clave foránea para la tabla municipios
        $this->addForeignKey(
                'FK-LOCALIDADES-MUNICIPIOS', 'localidades', 'municipio', 'municipios', 'id', 'CASCADE', 'CASCADE');


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
        ], $tableOptions);

        // Clave foránea para la nodos-departamentos
        $this->addForeignKey(
                'FK-NODOS-DEPARTAMENTO', 'nodos', 'departamento', 'departamentos', 'id', 'CASCADE', 'CASCADE');

        // Clave foránea para la nodos-municipios
        $this->addForeignKey(
                'FK-NODOS-MUNICIPIO', 'nodos', 'municipio', 'municipios', 'id', 'CASCADE', 'CASCADE');

        // Clave foránea para la nodos-localidades
        $this->addForeignKey(
                'FK-NODOS-LOCALIDAD', 'nodos', 'localidad', 'localidades', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('localidades');
        $this->dropTable('municipios');
        $this->dropTable('departamentos');
        $this->dropTable('nodos');
    }

}
