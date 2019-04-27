<?php

namespace app\models;

use app\models\base\Products as BaseProducts;


class Products extends BaseProducts {

    const DEFAULT_CATEGORY_LIMIT = 5;

    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(),[
            'store_id' => ''
        ]);
    }

    public static function getProductCategory($storeList){

        $query = self::find();
        $query->select(['category', 'count(*) as count']);
        $query->groupBy('category');

        //check if list is empty set limit to 5
        if(!is_array($storeList) || array_sum($storeList) <= 0){
            $query->limit(self::DEFAULT_CATEGORY_LIMIT);
        }else{
            $query->where(['IN', 'store_id', $storeList]);
        }

        $query->asArray();
        return $query->all();
    }
}
