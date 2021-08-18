<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "firma".
 *
 * @property int $id
 * @property string $path
 * @property string $medico
 */
class Firma extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'firma';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['path', 'medico'], 'required'],
            [['path'], 'string', 'max' => 120],
            [['medico'], 'string', 'max' => 65],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'medico' => 'Medico',
        ];
    }
}
