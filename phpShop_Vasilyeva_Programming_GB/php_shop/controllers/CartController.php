<?php

namespace app\controllers;

use app\engine\Request;
use app\model\entities\Cart;
use app\model\entities\Order;
use app\model\repositories\CartRepo;
use app\engine\App;

class CartController extends Controller
{
    public function actionIndex() {
        $goods = App::call()->cartRepo->getCart();
        echo $this->rend->renderCart($goods);
    }

    public function actionAdd() {
        $success = 'ok';
        $productId = App::call()->request->getParams()['id'];
        $checkProductId = App::call()->productRepo->getWhere('id', $productId);
        $session_id = session_id();
        $cartRepo = App::call()->cartRepo;

        if ($checkProductId) {

            $product = App::call()->cartRepo->getWhereAnd('session_id', 'product_id', $session_id, $productId);

            if ($product) {
                $product->quantity = $product->quantity + 1;
                $product->subtotal = $product->quantity * $product->price;
                $cartRepo->update($product);
            } else {
                $product = (new Cart($session_id, $productId));
                App::call()->cartRepo->insert($product);
                $product = App::call()->cartRepo->fixAndCalc($session_id, $productId);
            }
        } else {
            $success = 'Something went wrong';
        }

        $count = $cartRepo->getCountWhere('quantity', 'session_id', session_id());
        $sum = $cartRepo->getCountWhere('subtotal','session_id', session_id());
        
        $response = [
            'success' => $success,
            'count' => $count,
            'sum' => $sum
        ];
        
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function actionDelete() {
        $id = App::call()->request->getParams()['id'];
        $session_id = session_id();

        $productCart = App::call()->cartRepo->getWhereAnd('session_id','id', $session_id, $id);

        $product = new Cart();
        $product->id = $productCart->id;
        $product->session_id = $productCart->session_id;
        $product->product_id = $productCart->product_id;
        $product->quantity = $productCart->quantity;
        $product->price = $productCart->price;
        $product->subtotal = $productCart->subtotal;

        $cartRepo = new CartRepo();

        if ($product->quantity > 1) {
            $product->quantity = $product->quantity - 1;
            $product->subtotal = $product->quantity * $product->price;
            $cartRepo->update($product);

            $count = $cartRepo->getCountWhere('quantity', 'session_id', session_id());
            $sum = $cartRepo->getCountWhere('subtotal','session_id', session_id());

            $response = [
                        'success' => 'ok',
                             'id' => $id,
                          'count' => $count,
                'productQuantity' => $product->quantity,
                'productSubtotal' => $product->subtotal,
                            'sum' => $sum
            ];
            echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        } else {

            $cartRepo->delete($product);
            $count = $cartRepo->getCountWhere('quantity', 'session_id', session_id());
            $sum = $cartRepo->getCountWhere('subtotal','session_id', session_id());
            $response = [
                        'success' => 'ok',
                             'id' => $id,
                          'count' => $count,
                'productQuantity' => 0,
                'productSubtotal' => 0,
                            'sum' => $sum
            ];
            echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
    }

    public function actionClear() {
        (new CartRepo())->deleteAll();
        header('Location: /product'); // перенаправить на страницу входа
        die();
    }

    public function actionOrdering() {

        $goods = App::call()->cartRepo->getCart();
        $userId = App::call()->session->getSession('id');

        if ($userId) {
            $user = App::call()->userRepo->getOne($userId);
            if (App::call()->cartRepo->getCart()) {
                echo $this->rend->renderOrdering($goods, $user);
            } else {
                header('Location: /product');
                die();
            }

        } else {
            header('Location: /auth');
            die();
        }

    }

        public function actionPlacement() {
            
        $userId = (new Request())->getParams()['id'];
        $session_id = session_id();
        $order = new Order($session_id, $userId,);

        $id = App::call()->orderRepo->insert($order);
        App::call()->orderRepo->setDate('created_at', $id);
        App::call()->orderRepo->setOrderId($id, $session_id);

        $response = [
                    'success' => 'ok',
                'orderNumber' => $id
        ];

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        session_destroy();
    }
}