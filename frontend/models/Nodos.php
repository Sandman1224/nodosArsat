<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "nodos".
 *
 * @property int $id
 * @property string $nombre
 * @property int $departamento
 * @property int $municipio
 * @property int $localidad
 * @property double $latitud
 * @property double $longitud
 * @property string $contratista
 * @property int $documentacion
 * @property string $fechaDocumentacion
 * @property int $poblacion
 * @property int $estadoSitio
 * @property string $situacion
 * @property int $prioridad
 * @property string $estadoSitioContratista
 * @property string $estadoSitioEjesa
 * @property string $estadoSitioArsat
 * @property int $borrado
 *
 * @property Departamentos $departamento0
 * @property Localidades $localidad0
 * @property Municipios $municipio0
 */
class Nodos extends \yii\db\ActiveRecord {

    const SCENARIO_ARSAT = 'arsat';
    const SCENARIO_EJESA = 'ejesa';

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'nodos';
    }

    public function scenarios() {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_ARSAT] = ['estadoSitioArsat'];
        $scenarios[self::SCENARIO_EJESA] = ['estadoSitioEjesa'];
        
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nombre', 'departamento', 'municipio', 'localidad', 'latitud', 'longitud', 'borrado'], 'required'],
            [['departamento', 'municipio', 'localidad', 'documentacion', 'poblacion', 'estadoSitio', 'prioridad'], 'integer'],
            [['latitud', 'longitud'], 'number'],
            [['fechaDocumentacion'], 'safe'],
            [['nombre', 'contratista', 'situacion', 'estadoSitioContratista', 'estadoSitioEjesa', 'estadoSitioArsat'], 'string', 'max' => 255],
            [['borrado'], 'string', 'max' => 1],
            [['departamento'], 'exist', 'skipOnError' => true, 'targetClass' => Departamentos::className(), 'targetAttribute' => ['departamento' => 'id']],
            [['localidad'], 'exist', 'skipOnError' => true, 'targetClass' => Localidades::className(), 'targetAttribute' => ['localidad' => 'id']],
            [['municipio'], 'exist', 'skipOnError' => true, 'targetClass' => Municipios::className(), 'targetAttribute' => ['municipio' => 'id']],
            [['estadoSitioArsat'], 'required', 'on' => self::SCENARIO_ARSAT]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'departamento' => 'Departamento',
            'municipio' => 'Municipio',
            'localidad' => 'Localidad',
            'latitud' => 'Latitud',
            'longitud' => 'Longitud',
            'contratista' => 'Contratista',
            'documentacion' => 'Documentacion',
            'fechaDocumentacion' => 'Fecha Documentacion',
            'poblacion' => 'Poblacion',
            'estadoSitio' => 'Estado Sitio',
            'situacion' => 'Situacion',
            'prioridad' => 'Prioridad',
            'estadoSitioContratista' => 'Estado Sitio Contratista',
            'estadoSitioEjesa' => 'Estado Sitio Ejesa',
            'estadoSitioArsat' => 'Estado Sitio Arsat',
            'borrado' => 'Borrado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepartamento0() {
        return $this->hasOne(Departamentos::className(), ['id' => 'departamento']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidad0() {
        return $this->hasOne(Localidades::className(), ['id' => 'localidad']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMunicipio0() {
        return $this->hasOne(Municipios::className(), ['id' => 'municipio']);
    }

}
