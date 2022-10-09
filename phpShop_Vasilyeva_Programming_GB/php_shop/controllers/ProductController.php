<?php
namespace app\controllers;

//use app\model\repositories\ProductRepo;
use app\engine\App;
use http\Header;

class ProductController extends Controller
{
    public function actionIndex()
    {
        $page = $_GET['page'] ?? 0;
        $goods = App::call()->productRepo->getLimit(($page + 1) * App::call()->config['product_per_page']);

        echo $this->rend->renderCatalog($goods, $page);
    }

    public function actionCard()
    {
        $id = (int)$_GET['id'];
        $product = App::call()->productRepo->getOne($id);
        if (!$product)
        {
            header("Location: App::call()->request->getPreviousPage()");
            die();
        }
        $category = App::call()->productRepo->getCategory($product->category_id);

        echo $this->rend->renderCard($product, $category);
    }

    public function actionFilter()
    {
        $search = trim(App::call()->request->getParams()['search']);
        if (!$search)
        {
            header("Location: App::call()->request->getPreviousPage()");
            die();
        }

        $search = strtolower($search);
        $goods = App::call()->productRepo->getFilter($search);

        echo $this->rend->renderFilter($goods, $search);
    }
}