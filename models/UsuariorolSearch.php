<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuariorol;

/**
 * UsuariorolSearch represents the model behind the search form of `app\models\Usuariorol`.
 */
class UsuariorolSearch extends Usuariorol
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idusuariorol', 'idusuario', 'idrol'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Usuariorol::find();

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
            'idusuariorol' => $this->idusuariorol,
            'idusuario' => $this->idusuario,
            'idrol' => $this->idrol,
        ]);

        return $dataProvider;
    }
}
