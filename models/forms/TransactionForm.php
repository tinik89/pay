<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 18.01.2019
 * Time: 19:39
 */

namespace app\models\forms;


use yii\base\Model;

class TransactionForm extends Model
{
    public $manager_id;
    public $update_id;
    public $type;
    public $client;
    public $client_id;
    public $project;
    public $project_id;
    public $price;
    public $cash;
    public $date;
    public $comment;
    public $implementer;
    public $implementer_id;

    public function rules()
    {
        return [
            [['client_id', 'project_id', 'price', 'cash', 'date', 'type', 'manager_id'], 'required'],
            [['client_id', 'project_id', 'cash', 'date', 'implementer_id', 'update_id', 'manager_id'], 'integer'],
            [['price'], 'number'],
            [['type', 'comment', 'implementer', 'client', 'project'], 'string', 'max' => 255],
            ];
    }

    public function attributeLabels()
    {
        return [
            'client_id' => 'Клиент',
            'project_id' => 'Проект',
            'price' => 'Сумма',
            'cash' => 'Наличные/Безналичные',
            'date' => 'Дата',
            'type' => 'Тип',
            'implementer' => 'Исполнитель',
            'comment' => 'Комментарий',
        ];
    }
}