<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "localidades".
 *
 * @property int $id
 * @property string $nombre
 * @property int $municipio
 * @property int $created_at
 * @property int $updated_at
 * @property double $latitud
 * @property double $longitud
 *
 * @property Municipios $municipio0
 */
class Localidades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'localidades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'municipio', 'created_at', 'updated_at'], 'required'],
            [['municipio', 'created_at', 'updated_at'], 'integer'],
            [['latitud', 'longitud'], 'number'],
            [['nombre'], 'string', 'max' => 255],
            [['municipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipios::className(), 'targetAttribute' => ['municipio' => 'id']],
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
            'municipio' => 'Municipio',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'latitud' => 'Latitud',
            'longitud' => 'Longitud',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio0()
    {
        return $this->hasOne(Municipios::className(), ['id' => 'municipio']);
    }
}
