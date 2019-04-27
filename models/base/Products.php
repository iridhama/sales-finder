<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $category
 * @property int $store_id
 * @property string $date_inserted
 * @property string $date_removed
 * @property string $product_name
 * @property string $product_sku
 * @property string $product_model_number
 * @property string $product_description
 * @property string $product_url
 * @property string $product_image
 * @property string $variant_name
 *
 * @property Prices[] $prices
 * @property Stores $store
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['store_id'], 'required'],
            [['store_id'], 'integer'],
            [['date_inserted', 'date_removed'], 'safe'],
            [['product_description'], 'string'],
            [['category'], 'string', 'max' => 1000],
            [['product_name', 'product_sku', 'product_model_number', 'product_url', 'product_image', 'variant_name'], 'string', 'max' => 254],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stores::className(), 'targetAttribute' => ['store_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Category',
            'store_id' => 'Store ID',
            'date_inserted' => 'Date Inserted',
            'date_removed' => 'Date Removed',
            'product_name' => 'Product Name',
            'product_sku' => 'Product Sku',
            'product_model_number' => 'Product Model Number',
            'product_description' => 'Product Description',
            'product_url' => 'Product Url',
            'product_image' => 'Product Image',
            'variant_name' => 'Variant Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrices()
    {
        return $this->hasMany(Prices::className(), ['product' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Stores::className(), ['id' => 'store_id']);
    }
}
