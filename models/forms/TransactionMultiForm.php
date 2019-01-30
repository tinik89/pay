<?php
/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 28.01.2019
 * Time: 22:09
 */

namespace app\models\forms;


use yii\base\Model;

class TransactionMultiForm extends Model
{
    public $type;
    public $manager_id;
    public $update_id;

    public $schedule;

    public function init()
    {
        parent::init();

        $this->schedule = [
            [
                'client_id' => '',
                'project_id' => '',
                'price' => '',
                'cash' => '',
                'date' => '',
                'implementer' => '',
                'implementer_id' => '',
            ],
        ];
    }

    public function rules()
    {
        return [
            [['type', 'schedule', 'update_id', 'manager_id'], 'trim'],
            [['update_id'], 'integer'],
            [['schedule'], 'scheduleValidate'],
        ];
    }

    public function scheduleValidate($attribute, $params)
    {
        foreach ($this->schedule as $array) {

            if (!is_numeric($array['price'])) {
                $this->addError($attribute, 'Одна из сумм не является числом!');
            };
        }
    }
}