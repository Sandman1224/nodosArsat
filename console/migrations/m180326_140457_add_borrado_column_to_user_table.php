<?php

use yii\db\Migration;

/**
 * Handles adding borrado to table `user`.
 */
class m180326_140457_add_borrado_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'borrado', $this->boolean()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'borrado');
    }
}
