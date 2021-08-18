<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paciente_sisa".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellido
 * @property string $dni
 * @property string $edad_actual
 * @property string $tipo_de_edad_actual
 * @property string $localidad_establecimiento
 * @property string $vacuna
 * @property string $esquema
 * @property string $Dosis1
 * @property string $Dosis2
 */
class PacienteSisa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paciente_sisa';
    }
    //Funcion agregada para poder crear los CRUDS (incovenientes por ser una vista)
    public static function primaryKey()
    {
    return ['id'];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nombre', 'apellido'], 'string', 'max' => 100],
            [['dni', 'edad_actual', 'Dosis1', 'Dosis2'], 'string', 'max' => 10],
            [['tipo_de_edad_actual', 'localidad_establecimiento'], 'string', 'max' => 20],
            [['vacuna'], 'string', 'max' => 37],
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
            'vacuna' => 'Vacuna',
            'esquema' => 'Esquema',
            'Dosis1' => 'Dosis1',
            'Dosis2' => 'Dosis2',
        ];
    }
}
