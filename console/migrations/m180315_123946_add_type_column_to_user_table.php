<?php

use yii\db\Migration;

/**
 * Handles adding type to table `user`.
 */
class m180315_123946_add_type_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'type', $this->integer()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'type');
    }
}
