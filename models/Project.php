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
    public $sumPrice;
    public $sumDebet;
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
            [['name', 'tag', 'price', 'date_start', 'date_update', 'client', 'debet', 'credit', 'status'], 'required'],
            [['tag', 'date_start', 'date_update', 'client', 'status'], 'integer'],
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
            'date_update' => 'Date Update',
            'client' => 'Client',
            'debet' => 'Debet',
            'credit' => 'Credit',
            'status' => 'Status',
        ];
    }

    public function getTransactions(){
        return $this->hasMany(Transaction::className(), ['project_id' => 'id']);
    }

    public function getClientinfo(){
        return $this->hasOne(Client::className(),['id' => 'client']);
    }

    public function getTaginfo(){
        return $this->hasOne(Tag::className(),['id' => 'tag']);
    }
}
