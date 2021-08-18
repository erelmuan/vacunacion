<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PacienteSisa;

/**
 * PacienteSisaSearch represents the model behind the search form about `app\models\PacienteSisa`.
 */
class PacienteSisaSearch extends PacienteSisa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'apellido', 'dni', 'edad_actual', 'tipo_de_edad_actual', 'localidad_establecimiento', 'vacuna', 'esquema', 'Dosis1', 'Dosis2'], 'safe'],
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
        $query = PacienteSisa::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);
        if ($this->Dosis1=='DEF' or $this->Dosis1=='def' ){
          $query->andWhere(['not', ['Dosis1' => null]]);
             }
        elseif ($this->Dosis1=='NODEF'or $this->Dosis1=='nodef') {
          $query->andWhere(['is', 'Dosis1', new \yii\db\Expression('null')]);
        }else {
            $query->andFilterWhere(['like', 'Dosis1', $this->Dosis1]);

        }
        if ($this->Dosis2=='DEF'or $this->Dosis2=='def' ){
          $query->andWhere(['not', ['Dosis2' => null]]);
        }
        elseif ($this->Dosis2=='NODEF'or $this->Dosis2=='nodef') {
          $query->andWhere(['is', 'Dosis2' , new \yii\db\Expression('null')]);
        }else {
            $query->andFilterWhere(['like', 'Dosis2', $this->Dosis2]);

        }
        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'edad_actual', $this->edad_actual])
            ->andFilterWhere(['like', 'tipo_de_edad_actual', $this->tipo_de_edad_actual])
            ->andFilterWhere(['like', 'localidad_establecimiento', $this->localidad_establecimiento])
            ->andFilterWhere(['like', 'vacuna', $this->vacuna])
            ->andFilterWhere(['like', 'esquema', $this->esquema]);
            // ->andFilterWhere(['like', 'Dosis1', $this->Dosis1])
            // ->andFilterWhere(['like', 'Dosis2', $this->Dosis2]);

        return $dataProvider;
    }
}
