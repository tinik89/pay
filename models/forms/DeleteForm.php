<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 25.01.2019
 * Time: 22:17
 */

namespace app\models\forms;


use yii\base\Model;

class DeleteForm extends Model
{
    public $id;
    public $object;

    public function rules()
    {
        return [
            [['id', 'object'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'Id',
            'object' => 'Object',
        ];
    }
}