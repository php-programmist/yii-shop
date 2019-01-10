<?php

namespace app\controllers;

use app\models\Product;
use app\models\Cart;
use Yii;

class CartController extends AppController
{
    
    public function actionAdd($id, $qty = 1)
    {
        $qty = (int)$qty;
        if ( ! $qty) {
            $qty = 1;
        }
        $product = Product::findOne($id);
        if (empty($product)) {
            return false;
        }
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        if ( ! Yii::$app->request->isAjax) {//У пользователя отключен JS
            $session->setFlash('msg', "Товар добавлен в корзину");
            $this->redirect(Yii::$app->request->referrer);
            
            return false;
        } else {
            $this->layout = false;
        }
        
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionClear()
    {
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionDelItem($id)
    {
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->recalc($id);
        $this->layout = false;
        
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionShow()
    {
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionView()
    {
        return $this->render('view');
    }
    
} 