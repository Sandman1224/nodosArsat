<?php

namespace frontend\models;

use yii\base\Model;
use common\models\User;

class UpdateuserForm extends User {

    public $id;
    public $username;
    public $email;
    public $password;
    public $type;
    //protected $oldAttributes;

    public function rules() {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            [
                'email',
                'unique',
                'targetClass' => '\common\models\User',
                'message' => 'This email address has already been taken.',
                'when' => function($model, $attribute) {
                    $val1 = $model->{$attribute};
                    $val2 = $model->oldAttributes['email'];
                    return $model->{$attribute} !== $model->oldAttributes['email'];
                }
            ],
            ['password', 'safe'],
            ['password', 'string', 'min' => 6],
            ['type', 'required'],
            ['type', 'integer']
        ];
    }

    //Ver de crear todo en un modelo
    public function updateUser($id) {
        if (!$this->validate()) {
            return null;
        }

        $user = User::findOne([$id]);
        $user->username = $this->username;
        $user->email = $this->email;
        if ($this->password != '') {
            $user->setPassword($this->password);
        }
        // $user->generateAuthKey();
        $user->type = $this->type;

        $pass = $this->password;

        return $user->save() ? $user : null;
    }

    public function getOldAttributes() {
        parent::getOldAttributes();
    }

    public function afterFind() {
        $this->oldAttributes = $this->attributes;
        return parent::afterFind();
    }

}
