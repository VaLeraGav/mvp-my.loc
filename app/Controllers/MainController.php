<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\UserModel;
use Core\App;
use Core\Base\Model;
use Core\Cache;
use Core\Connection;

class MainController extends AppController
{
    public $meta = ['title' => 'Главная страница', 'desc' => 'desc', 'keywords' => 'keywords'];

    public function index(): void
    {
        $brands = Model::requestObj("brand", "LIMIT 3");

        $hits = Model::requestObj("product", "WHERE hit = '1' AND status = '1' LIMIT 8");

        $this->view('pages/index', [
            'brands' => $brands,
            'hits' => $hits,
        ]);
    }

    public function close(): void
    {
        $user = new UserModel();
        if (!$user::isAuth()) {
            redirect("/login");
        }
        $this->view('pages/index');
    }

    // выбор валюты
    public function changeCurrency(): void
    {
        $currency = !empty($_GET['curr']) ? $_GET['curr'] : null;
        if ($currency) {
            $curr = App::$app->getProperty('currencies');
            $hasCurr = array_key_exists($currency, $curr);

            if ($hasCurr) {
                setcookie('currency', $currency, time() + 3600 * 24 * 7, '/');
                CartModel::recalc($curr[$currency]);
            }
        }
        redirect();
    }

}