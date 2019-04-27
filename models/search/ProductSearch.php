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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['id', 'store_id'], 'integer'],
            [['store_id', 'category', 'date_inserted', 'date_removed', 'product_name', 'product_sku', 'product_model_number', 'product_description', 'product_url', 'product_image', 'variant_name', 'category_list'], 'safe'],
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

        /*$query->innerJoin('prices', 'prices.product = products.id');*/
       // $query->select(['products.id','products.product_name', 'products.product_url', 'products.product_image', 'prices.normal_price', 'prices.sale_price']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        //join prices table for price


        //set the category list
        $this->category_list = $this->getProductCategory($this->store_id);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

      /*  // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'store_id' => $this->store_id,
            'date_inserted' => $this->date_inserted,
            'date_removed' => $this->date_removed,
        ]);*/

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


        /*$query->andFilterWhere(['like', 'category', trim($this->category)])
            ->andFilterWhere(['like', 'product_name', $this->product_name])
            ->andFilterWhere(['like', 'product_sku', $this->product_sku])
            ->andFilterWhere(['like', 'product_model_number', $this->product_model_number])
            ->andFilterWhere(['like', 'product_description', $this->product_description])
            ->andFilterWhere(['like', 'product_url', $this->product_url])
            ->andFilterWhere(['like', 'product_image', $this->product_image])
            ->andFilterWhere(['like', 'variant_name', $this->variant_name]);*/

        return $dataProvider;
    }
}
