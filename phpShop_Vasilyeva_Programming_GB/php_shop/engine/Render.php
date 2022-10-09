<?php
namespace app\engine;

use app\model\repositories\CartRepo;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once App::call()->config['root_dir'] . '/vendor/autoload.php'; // ПОДКЛЮЧЕНИЕ twig

class Render
{
    protected Environment|null $twig = null;
    protected array $navigation = [
[
'href' => '/product',
'caption' => 'HOME',
],
[
'href' => '#',
'caption' => 'MEN',
],
[
'href' => '#',
'caption' => 'WOMEN',
],
[
'href' => '#',
'caption' => 'KIDS',
],
[
'href' => '#',
'caption' => 'ACCESSORIES',
],
[
'href' => '#',
'caption' => 'FEATURED',
],
[
'href' => '#',
'caption' => 'HOT DEALS',
]
];
    public int|null $count = null;

    public function __construct()
    {
        $loader = new FilesystemLoader(App::call()->config['root_dir'] . '/templates');
        $this->twig = new Environment($loader);
    }

    public function renderCatalog($goods, $page=null): string
    {
        return $this->twig->render('index.twig', [
            'navigation' => $this->navigation,
            'goods' => $goods,
            'page' => ++$page,
            'userName' => $_SESSION['name'] ?? '',
            'count' => (new CartRepo())->getCountWhere('quantity','session_id', session_id())
        ]);
    }

    public function renderFilter($goods, $search): string
    {
        return $this->twig->render('filter.twig', [
            'navigation' => $this->navigation,
            'goods' => $goods,
            'search' => $search,
            'userName' => $_SESSION['name'] ?? '',
            'count' => (new CartRepo())->getCountWhere('quantity','session_id', session_id())
        ]);
    }

    public function renderCart($goods): string
    {
        return $this->twig->render('cart.twig', [
            'navigation' => $this->navigation,
            'goods' => $goods,
            'userName' => $_SESSION['name'] ?? '',
            'count' => (new CartRepo())->getCountWhere('quantity','session_id', session_id()),
            'sum' => (new CartRepo())->getCountWhere('subtotal','session_id', session_id()),
            'sessionId' => session_id()
        ]);
    }

    public function renderAuth($message = null): string
    {
        return $this->twig->render('auth.twig', [
            'navigation' => $this->navigation,
            'message' => $message,
            'count' => (new CartRepo())->getCountWhere('quantity','session_id', session_id())
        ]);
    }

    public function renderUser($user): string
    {
        return $this->twig->render('user.twig', [
            'navigation' => $this->navigation,
            'userName' => $user->name,
            'user' => $user,
            'count' => (new CartRepo())->getCountWhere('quantity','session_id', session_id())
        ]);
    }

    public function renderCard($product, $category): string
    {
        return $this->twig->render('card.twig', [
            'navigation' => $this->navigation,
            'product' => $product,
            'category' => $category,
            'userName' => $_SESSION['name'] ?? '',
            'count' => (new CartRepo())->getCountWhere('quantity','session_id', session_id())
        ]);
    }

    public function renderOrdering($goods, $user): string
    {
        return $this->twig->render('ordering.twig', [
            'navigation' => $this->navigation,
            'goods' => $goods,
            'userName' => $user->name,
            'user' => $user,
            'count' => (new CartRepo())->getCountWhere('quantity','session_id', session_id()),
            'sum' => (new CartRepo())->getCountWhere('subtotal','session_id', session_id())
        ]);
    }
}