<?php
/**
 * Created by PhpStorm.
 * User: ajay pathak
 * Date: 11/9/2018
 * Time: 7:44 PM
 */

namespace app\component;


class Helper
{

    public static function getArrayAsKeyVal($arr, $removeField = false)
    {
        $retArr = [];
        foreach($arr as $val) {
            if($removeField && $removeField == $val) continue;
            $retArr[$val] = ucwords($val);
        }
        return $retArr;
    }

    public static function getDiscountPercent($salePrice, $normalPrice){
        if($salePrice > $normalPrice){
            $diff = $salePrice - $normalPrice;
            $dis = (($diff)*100)/$salePrice;
        }else{
            $diff = $normalPrice - $salePrice;
            $dis = (($diff)*100)/$normalPrice;
        }



        return number_format($dis);
    }
}