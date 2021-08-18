<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Reporte;

/**
 * ReporteSearch represents the model behind the search form about `app\models\Reporte`.
 */
class ReporteSearch extends Reporte
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['email', 'ceular', 'dni', 'nombres', 'apellidos', 'grupo', 'fecha_nacimiento', 'edad', 'grupo_de_riesgo', 'comorbilidades', 'localidad', 'estado', 'vacuna', 'primera_dosis', 'segunda_dosis', 'creado_el', 'modprimeradosis', 'modsegundadosis'], 'safe'],
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
        $query = Reporte::find();

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
        if ($this->primera_dosis=='DEF' or $this->primera_dosis=='def'){
          $query->andWhere(['!=', 'primera_dosis' , '']);
             }
        elseif ($this->primera_dosis=='NODEF' or $this->primera_dosis=='nodef') {
          $query->andWhere(['=', 'primera_dosis','']);
        }else {
            $query->andFilterWhere(['like', 'primera_dosis', $this->primera_dosis]);

        }
        if ($this->segunda_dosis =='DEF' or $this->segunda_dosis =='def'){
          $query->andWhere(['!=', 'segunda_dosis' , '']);
        }
        elseif ($this->segunda_dosis =='NODEF' or $this->segunda_dosis =='nodef') {
          $query->andWhere(['=', 'segunda_dosis' ,'']);
        }else {
            $query->andFilterWhere(['like', 'segunda_dosis', $this->segunda_dosis ]);

        }

        $query->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'ceular', $this->ceular])
            ->andFilterWhere(['like', 'dni', $this->dni])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'apellidos', $this->apellidos])
            ->andFilterWhere(['like', 'grupo', $this->grupo])
            ->andFilterWhere(['like', 'fecha_nacimiento', $this->fecha_nacimiento])
            ->andFilterWhere(['like', 'edad', $this->edad])
            ->andFilterWhere(['like', 'grupo_de_riesgo', $this->grupo_de_riesgo])
            ->andFilterWhere(['like', 'comorbilidades', $this->comorbilidades])
            ->andFilterWhere(['like', 'localidad', $this->localidad])
            ->andFilterWhere(['like', 'estado', $this->estado])
            ->andFilterWhere(['like', 'vacuna', $this->vacuna])
            // ->andFilterWhere(['like', 'primera_dosis', $this->primera_dosis])
            // ->andFilterWhere(['like', 'segunda_dosis', $this->segunda_dosis])
            ->andFilterWhere(['like', 'creado_el', $this->creado_el])
            ->andFilterWhere(['like', 'modprimeradosis', $this->modprimeradosis])
            ->andFilterWhere(['like', 'modsegundadosis', $this->modsegundadosis]);

        return $dataProvider;
    }
}
