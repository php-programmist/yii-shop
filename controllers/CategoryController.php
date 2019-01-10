<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\Pagination;

class CategoryController extends AppController
{
    
    public function actionIndex()
    {
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta('E-SHOPPER');
        
        return $this->render('index', compact('hits'));
    }
    
    public function actionView($id)
    {
        // $id = Yii::$app->request->get('id');
        $category = Category::findOne($id);
        if (empty($category)) {
            throw new \yii\web\HttpException(404, 'Такой категории нет');
        }
        $pageSize = 3;
        $query    = Product::find()->where(['category_id' => $id]);
        $pages    = new Pagination([
            'totalCount'     => $query->count(),
            'pageSize'       => $pageSize,
            'forcePageParam' => false,//Не показывать параметры пагинации на первой странице
            'pageSizeParam'  => false,//Не передавать в адресную строку параметр per-page
        ]);
    
        $products = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        $this->setMeta('E-SHOPPER | ' . $category->name, $category->keywords, $category->description);
        
        return $this->render('view', compact('products', 'category', 'pages'));
    }
    
} 