<?php


function dpre($value)
{
    echo '<pre>';
    print_r($value);
    // var_dump($value);
    echo '</pre>';
}

function redirect($route = '/', $statusCode = 302)
{
    if ($route !== '/') {
        $redirect = $route; // адрес куда нужно отправить
    } else {
        $redirect = $_SERVER['HTTP_REFERER'] ?? '/'; // на ту же самую
    }
    header('Location: ' . $redirect, true, $statusCode);
    return null;
}