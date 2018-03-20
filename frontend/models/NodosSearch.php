<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Nodos;

/**
 * Description of LocalidadesSearch
 *
 * @author Tinch
 */
class NodosSearch extends Nodos {
    
    const NODO_ACTIVO = 0;
    CONST NODO_INACTIVO = 1;

    public function rules() {
        return [
            [['id', 'municipio'], 'integer'],
            [['nombre'], 'safe'],
        ];
    }
    
    public function search($params){
        $query = Nodos::find()
                ->where(['BORRADO' => self::NODO_ACTIVO]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);
        
        //Cargamos los parámetros de búsqueda
        $this->load($params);
        
        if (!$this->validate()) {
            return $dataProvider;
        }
        
        $query->andFilterWhere(['like', 'nombre', $this->nombre])
                ->andFilterWhere(['=', 'departamento', $this->departamento])
                ->andFilterWhere(['=', 'municipio', $this->municipio])
                ->andFilterWhere(['=', 'localidad', $this->localidad]);
        
        return $dataProvider;
    }
}
