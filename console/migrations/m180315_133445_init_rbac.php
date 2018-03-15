<?php

use yii\db\Migration;

/**
 * Class m180315_133445_init_rbac
 */
class m180315_133445_init_rbac extends Migration
{
    public function up() {
        $auth = Yii::$app->authManager;
        
        //Agregamos el rol de EJESA
        $ejesa = $auth->createRole('ejesa');
        $auth->add($ejesa);
        
        //Agregamos el rol de ARSAT
        $arsat = $auth->createRole('arsat');
        $auth->add($arsat);
        
        //Agregamos el rol del administrador
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $ejesa);
        $auth->addChild($admin, $arsat);
        
        $auth->assign($admin, 1);
        $auth->assign($ejesa, 2);
        $auth->assign($arsat, 3);
    }
    
    public function down() {
        $auth = Yii::$app->authManager;
        
        $auth->removeAll();
    }
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180315_133445_init_rbac cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180315_133445_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
