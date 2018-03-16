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
        if($this->db->driverName === 'mysql'){
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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('departamentos');
        $this->dropTable('municipios');
        $this->dropTable('localidades');
    }

}
