<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 16.01.2019
 * Time: 21:50
 */

namespace app\models\forms;

use yii\base\Model;

class ClientForm extends Model
{
    public $name;
    
    public function rules()
    {
        return [
            [['name'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Клиент',
        ];
    }
}