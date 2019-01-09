<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'product';
    }
    
    public function getProducts()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}