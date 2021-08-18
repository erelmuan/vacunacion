<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "noinsertado".
 *
 * @property int $id
 * @property string $id_tabla
 * @property string $tabla
 */
class Noinsertado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'noinsertado';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tabla', 'tabla'], 'required'],
            [['id_tabla'], 'string', 'max' => 40],
            [['tabla'], 'string', 'max' => 35],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_tabla' => 'Id Tabla',
            'tabla' => 'Tabla',
        ];
    }
}
