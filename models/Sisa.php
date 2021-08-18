<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sisa".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $dni
 * @property string $edad_actual
 * @property string $tipo_de_edad_actual
 * @property string $localidad_establecimiento
 * @property string $fecha
 * @property string $vacuna
 * @property string $dosis
 * @property string $esquema
 */
class Sisa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sisa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido'], 'string', 'max' => 100],
            [['dni', 'edad_actual', 'fecha'], 'string', 'max' => 25],
            [['tipo_de_edad_actual', 'localidad_establecimiento'], 'string', 'max' => 20],
            [['vacuna'], 'string', 'max' => 37],
            [['dosis'], 'string', 'max' => 19],
            [['esquema'], 'string', 'max' => 35],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'dni' => 'Dni',
            'edad_actual' => 'Edad Actual',
            'tipo_de_edad_actual' => 'Tipo De Edad Actual',
            'localidad_establecimiento' => 'Localidad Establecimiento',
            'fecha' => 'Fecha',
            'vacuna' => 'Vacuna',
            'dosis' => 'Dosis',
            'esquema' => 'Esquema',
        ];
    }
}
