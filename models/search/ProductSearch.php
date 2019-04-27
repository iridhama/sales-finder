<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Products;
use yii\helpers\ArrayHelper;

/**
 * ProductSearch represents the model behind the search form of `app\models\Products`.
 */
class ProductSearch extends Products
{
    public $category_list;
    public $min_price;
    public $max_price;
    public $discount;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['id', 'store_id'], 'integer'],
            [['store_id', 'category', 'date_inserted', 'date_removed', 'product_name', 'product_sku', 'product_model_number', 'product_description', 'product_url', 'product_image', 'variant_name', 'category_list', 'min_price', 'max_price', 'discount'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Products::find();

        //only when min and max price are involved
//        if(!empty($this->min_price) || !empty($this->max_price)){
            $query->innerJoin('prices', 'prices.product = products.id');
 //       }

        $query->select(['products.id','products.product_name', 'products.product_url', 'products.product_image']);
      //  $query->orderBy(['prices.sale_price' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);



        //set the category list
        $this->category_list = $this->getProductCategory($this->store_id);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        //when no category is selected
        if(!empty($this->category)){
            $query->where(['category' => trim($this->category)]);
        }else{
            $categoryList = ArrayHelper::getColumn($this->category_list, 'category');
            $query->where(['IN', 'category', $categoryList]);
        }

        //check for store id select
        if(is_array($this->store_id) && array_sum($this->store_id) > 0){
            $query->andWhere(['IN', 'store_id', $this->store_id]);
        }

        //conditions for mix max price
        if(!empty($this->min_price)){
            $query->andWhere(['>=', 'prices.sale_price',  $this->min_price]);
        }

        if(!empty($this->max_price)){
            $query->andWhere(['<=', 'prices.sale_price',  $this->max_price]);
        }

        $query->andFilterWhere(['like', 'product_name', $this->product_name]);

        return $dataProvider;
    }
}
