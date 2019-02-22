<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property int $client_id
 * @property int $project_id
 * @property double $price
 * @property int $date
 * @property string $type
 * @property int $implementer
 * @property string $comment
 * @property int $update_id
 * @property int $manager_id
 */
class Transaction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'project_id', 'price', 'cash', 'date', 'type', 'manager_id'], 'required'],
            [['client_id', 'project_id', 'cash', 'date', 'implementer', 'update_id', 'manager_id'], 'integer'],
            [['price'], 'number'],
            [['type', 'comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'project_id' => 'Project ID',
            'price' => 'Price',
            'cash' => 'Cash',
            'date' => 'Date',
            'type' => 'Type',
            'implementer' => 'Implementer',
            'comment' => 'Comment',
            'update_id' => 'Update ID',
            'manager_id' => 'Manager ID',
        ];
    }
    
    public function getClient(){
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }
    public function getProject(){
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }
    public function getImplementerinfo(){
        return $this->hasOne(Implementer::className(), ['id' => 'implementer']);
    }
}
