<?php

namespace App\Widgets\currency;

use Core\App;
use Core\Base\Model;

class Currency
{

    protected $tpl;
    protected $currencies;
    protected $currency;

    public function __construct()
    {
        $this->tpl = __DIR__ . '/currency_tpl/currency.php';
        $this->run();
    }

    protected function run()
    {
        $this->currencies = App::$app->getProperty('currencies');
        $this->currency = App::$app->getProperty('currency');
        echo $this->getHtml();
    }

    public static function getCurrencies()
    {
        return Model::requestArr(
            "SELECT code, title, symbol_left, symbol_right, value, base FROM currency ORDER BY base DESC",
            'code'
        );
    }

    public static function getCurrency($currencies)
    {
        if (isset($_COOKIE['currency']) && array_key_exists($_COOKIE['currency'], $currencies)) {
            $key = $_COOKIE['currency'];
        } else {
            $key = key($currencies);
        }
        $currency = $currencies[$key];;
        return $currency;
    }

    protected function getHtml()
    {
        ob_start();
        require_once $this->tpl;
        return ob_get_clean();
    }
}