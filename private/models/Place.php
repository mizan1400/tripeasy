<?php
/**
 * Created by PhpStorm.
 * User: w3e81
 * Date: 2/20/19
 * Time: 3:48 PM
 */

class Place extends Helper
{
    public $id;
    public $admin_id;
    public $itm_img_id;
    public $latitude;
    public $longitude;
    public $description;
    public $featured;
    public $place_title;
    public $address;



    public static function imageName($itm_img_id)
    {
        $item_images = new Item_Images();
        $itmImgModel = $item_images->where(['id' => $itm_img_id])->one();

        if (!empty($itmImgModel)) {
            return $itmImgModel->image;
        } else {
            return '';
        }
    }


    public static function multiple_img($type_id)
    {
        $item_images = new Item_Images();
        $itemImageModel = $item_images->where(['type_id' => $type_id])->andWhere(['type' => 1])->all(); // type =1 for place
        if (!empty($itemImageModel)) {
            return $itemImageModel;
        } else {
            $datas = [];
            return $datas;
        }
    }

}