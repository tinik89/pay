<?php

/**
 * Created by PhpStorm.
 * User: TIN
 * Date: 04.03.2019
 * Time: 19:57
 */
namespace app\components;

use yii\base\Widget;

class DeleteWidget extends Widget
{
    public $deleteForm;

    public function run()
    {
        return $this->render('delete', ['deleteForm' => $this->deleteForm]);
    }
}