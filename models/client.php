<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 16.01.2019
 * Time: 21:50
 */

namespace app\models;

use yii\db\ActiveRecord;
class Client extends ActiveRecord
{
    public static function TableName (){
        return 'client';
    }
    
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