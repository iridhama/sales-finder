<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%stores}}".
 *
 * @property int $id
 * @property string $store_name
 * @property string $country
 *
 * @property Products[] $products
 */
class Stores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%stores}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_name'], 'string', 'max' => 254],
            [['country'], 'string', 'max' => 90],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'store_name' => 'Store Name',
            'country' => 'Country',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Products::className(), ['store_id' => 'id']);
    }
}
