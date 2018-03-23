<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Nodos;

/**
 * NodosSearch represents the model behind the search form of `app\models\Nodos`.
 */
class NodosSearch extends Nodos
{
    const NODO_ACTIVO = 0;
    CONST NODO_INACTIVO = 1;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'departamento', 'localidad', 'estadoSitio', 'prioridad'], 'integer'],
            [['nombre'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Nodos::find()
                ->where(['BORRADO' => self::NODO_ACTIVO]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'departamento' => $this->departamento,
            'municipio' => $this->municipio,
            'localidad' => $this->localidad,
            'latitud' => $this->latitud,
            'longitud' => $this->longitud,
            'documentacion' => $this->documentacion,
            'fechaDocumentacion' => $this->fechaDocumentacion,
            'poblacion' => $this->poblacion,
            'estadoSitio' => $this->estadoSitio,
            'prioridad' => $this->prioridad,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'contratista', $this->contratista])
            ->andFilterWhere(['like', 'situacion', $this->situacion])
            ->andFilterWhere(['like', 'estadoSitioContratista', $this->estadoSitioContratista])
            ->andFilterWhere(['like', 'estadoSitioEjesa', $this->estadoSitioEjesa])
            ->andFilterWhere(['like', 'estadoSitioArsat', $this->estadoSitioArsat])
            ->andFilterWhere(['like', 'borrado', $this->borrado]);

        return $dataProvider;
    }
}
