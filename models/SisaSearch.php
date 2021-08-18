<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sisa;

/**
 * SisaSearch represents the model behind the search form about `app\models\Sisa`.
 */
class SisaSearch extends Sisa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'apellido', 'dni', 'edad_actual', 'tipo_de_edad_actual', 'localidad_establecimiento', 'fecha', 'vacuna', 'dosis', 'esquema'], 'safe'],
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
        $query = Sisa::find();

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

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'apellido', $this->apellido])
            ->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'edad_actual', $this->edad_actual])
            ->andFilterWhere(['like', 'tipo_de_edad_actual', $this->tipo_de_edad_actual])
            ->andFilterWhere(['like', 'localidad_establecimiento', $this->localidad_establecimiento])
            ->andFilterWhere(['like', 'fecha', $this->fecha])
            ->andFilterWhere(['like', 'vacuna', $this->vacuna])
            ->andFilterWhere(['like', 'dosis', $this->dosis])
            ->andFilterWhere(['like', 'esquema', $this->esquema]);

        return $dataProvider;
    }
}
