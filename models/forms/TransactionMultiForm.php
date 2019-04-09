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
            if (empty($array['date'])) {
                $this->addError($attribute, 'Не заполнена одна из дат!Мне очень жаль но теперь нужно заново заполнить всех клиентов и проекты)Впреть будьте внимательнее;)');
            };
            if (!is_numeric($array['price'])) {
                $this->addError($attribute, 'Одна из сумм не является числом!Мне очень жаль но теперь нужно заново заполнить всех клиентов и проекты)Впреть будьте внимательнее;)');
            };
            if (empty($array['client_id'])) {
                $this->addError($attribute, 'Один из клиентов не заполнен, либо заполнен некорректно!Мне очень жаль но теперь нужно заново заполнить всех клиентов и проекты)Впреть будьте внимательнее;)');
            };
            if (empty($array['project_id'])) {
                $this->addError($attribute, 'Один из проектов не заполнен, либо заполнен некорректно!Мне очень жаль но теперь нужно заново заполнить всех клиентов и проекты)Впреть будьте внимательнее;)');
            };
            if (empty($array['implementer']) && $this->type == 'charge') {
                $this->addError($attribute, 'Один из исполнителей не заполнен!Мне очень жаль но теперь нужно заново заполнить всех клиентов и проекты)Впреть будьте внимательнее;)');
            };

        }
    }
}