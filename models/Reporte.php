<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reporte".
 *
 * @property int $id
 * @property string $email
 * @property string $ceular
 * @property string $dni
 * @property string $nombres
 * @property string $apellidos
 * @property string $grupo
 * @property string $fecha_nacimiento
 * @property string $edad
 * @property string $grupo_de_riesgo
 * @property string $comorbilidades
 * @property string $localidad
 * @property string $estado
 * @property string $vacuna
 * @property string $primera_dosis
 * @property string $segunda_dosis
 * @property string $creado_el
 * @property string $modprimeradosis
 * @property string $modsegundadosis
 */
class Reporte extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reporte';
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
            // [['id'], 'required'],
            // [['id'], 'integer'],
            [['email'], 'string', 'max' => 45],
            [['ceular'], 'string', 'max' => 33],
            [['dni', 'primera_dosis'], 'string', 'max' => 16],
            [['nombres', 'apellidos', 'vacuna'], 'string', 'max' => 50],
            [['grupo'], 'string', 'max' => 164],
            [['fecha_nacimiento'], 'string', 'max' => 10],
            [['edad'], 'string', 'max' => 3],
            [['grupo_de_riesgo'], 'string', 'max' => 1],
            [['comorbilidades'], 'string', 'max' => 145],
            [['localidad', 'creado_el'], 'string', 'max' => 25],
            [['estado'], 'string', 'max' => 20],
            [['segunda_dosis'], 'string', 'max' => 17],
            [['modprimeradosis', 'modsegundadosis'], 'string', 'max' => 2],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'ceular' => 'Ceular',
            'dni' => 'Dni',
            'nombres' => 'Nombres',
            'apellidos' => 'Apellidos',
            'grupo' => 'Grupo',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'edad' => 'Edad',
            'grupo_de_riesgo' => 'Grupo De Riesgo',
            'comorbilidades' => 'Comorbilidades',
            'localidad' => 'Localidad',
            'estado' => 'Estado',
            'vacuna' => 'Vacuna',
            'primera_dosis' => 'Primera Dosis',
            'segunda_dosis' => 'Segunda Dosis',
            'creado_el' => 'Creado El',
            'modprimeradosis' => 'Modprimeradosis',
            'modsegundadosis' => 'Modsegundadosis',
        ];
    }
}
