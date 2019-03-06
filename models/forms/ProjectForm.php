<?php

namespace app\models\forms;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property int $tag
 * @property double $price
 * @property int $date_start
 * @property int $client
 * @property double $debet
 * @property double $credit
 */
class ProjectForm extends Model
{

    public $name;
    public $tag;
    public $price;
    public $date_start;
    public $client;
    public $project_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'tag', 'price', 'date_start', 'client'], 'required'],
            [['tag', 'client', 'project_id'], 'integer'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название проекта',
            'tag' => 'Категория',
            'price' => 'Цена',
            'date_start' => 'Дата начала',
            'client' => 'Client',
        ];
    }
}
