<?php

namespace app\models;

use Yii;

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
class Project extends \yii\db\ActiveRecord
{
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
            [['name', 'tag', 'price', 'date_start', 'client', 'debet', 'credit', 'status'], 'required'],
            [['tag', 'date_start', 'client', 'status'], 'integer'],
            [['price', 'debet', 'credit'], 'number'],
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
            'name' => 'Name',
            'tag' => 'Tag',
            'price' => 'Price',
            'date_start' => 'Date Start',
            'client' => 'Client',
            'debet' => 'Debet',
            'credit' => 'Credit',
            'status' => 'Status',
        ];
    }
}
