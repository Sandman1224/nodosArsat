<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "municipios".
 *
 * @property int $id
 * @property string $nombre
 * @property int $departamento
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Localidades[] $localidades
 * @property Departamentos $departamento0
 */
class Municipios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'municipios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'departamento', 'created_at', 'updated_at'], 'required'],
            [['departamento', 'created_at', 'updated_at'], 'integer'],
            [['nombre'], 'string', 'max' => 255],
            [['departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['departamento' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'departamento' => 'Departamento',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidades()
    {
        return $this->hasMany(Localidades::className(), ['municipio' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento0()
    {
        return $this->hasOne(Departamentos::className(), ['id' => 'departamento']);
    }
}
