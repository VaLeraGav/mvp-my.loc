<?php

namespace Core\Libs;

class Pagination
{
    public $currentPage;   // текущая страница
    public $perpage;       // сколько выводить записей на страницу
    public $total;         // общее количество записей
    public $countPages;    // общее количество страниц
    public $uri;           // адрес для пагинации

    public function __construct($page, $perpage, $total)
    {
        $this->perpage = $perpage;
        $this->total = $total;
        $this->countPages = $this->getCountPages();
        $this->currentPage = $this->getCurrentPage($page);
        $this->uri = $this->getParams();
    }

    public function getCountPages()
    {
        return ceil($this->total / $this->perpage) ?: 1;
    }

    public function getCurrentPage($page)
    {
        if (!$page || $page < 1) {
            $page = 1;
        }
        if ($page > $this->countPages) {
            $page = $this->countPages;
        }
        return $page;
    }

    public function getParams()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);

        $uri = $url[0] . '?';
        if (isset($url[1]) && $url[1] != '') {
            $params = explode('&', $url[1]);
            foreach ($params as $param) {
                if (!preg_match("#page=#", $param)) {
                    $uri .= "{$param}&amp;";
                }
            }
        }
        return urldecode($uri);
    }

    public function getStart()
    {
        return ($this->currentPage - 1) * $this->perpage;
    }

    public function getHtml()
    {
        $back = null; // ссылка НАЗАД
        $forward = null; // ссылка ВПЕРЕД
        $startpage = null; // ссылка В НАЧАЛО
        $endpage = null; // ссылка В КОНЕЦ
        $page2left = null; // вторая страница слева
        $page1left = null; // первая страница слева
        $page2right = null; // вторая страница справа
        $page1right = null; // первая страница справа

        if ($this->currentPage > 1) {
            $back = "<li class='page-item'><a class='nav-link page-link' href='{$this->uri}page=" . ($this->currentPage - 1) . "'>&lt;</a></li>";
        }
        if ($this->currentPage < $this->countPages) {
            $forward = "<li class='page-item'><a class='nav-link page-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>&gt;</a></li>";
        }
        if ($this->currentPage > 3) {
            $startpage = "<li class='page-item'><a class='nav-link page-link' href='{$this->uri}page=1'>&laquo;</a></li>";
        }
        if ($this->currentPage < ($this->countPages - 2)) {
            $endpage = "<li class='page-item'><a class='nav-link page-link' href='{$this->uri}page={$this->countPages}'>&raquo;</a></li>";
        }
        if ($this->currentPage - 2 > 0) {
            $page2left = "<li class='page-item'><a class='nav-link page-link' href='{$this->uri}page=" . ($this->currentPage - 2) . "'>" . ($this->currentPage - 2) . "</a></li>";
        }
        if ($this->currentPage - 1 > 0) {
            $page1left = "<li class='page-item'><a class='nav-link page-link' href='{$this->uri}page=" . ($this->currentPage - 1) . "'>" . ($this->currentPage - 1) . "</a></li>";
        }
        if ($this->currentPage + 1 <= $this->countPages) {
            $page1right = "<li class='page-item'><a class='nav-link page-link' href='{$this->uri}page=" . ($this->currentPage + 1) . "'>" . ($this->currentPage + 1) . "</a></li>";
        }
        if ($this->currentPage + 2 <= $this->countPages) {
            $page2right = "<li class='page-item'><a class='nav-link page-link' href='{$this->uri}page=" . ($this->currentPage + 2) . "'>" . ($this->currentPage + 2) . "</a></li>";
        }

        return '<ul class="pagination">' . $startpage . $back . $page2left . $page1left . '<li class="active page-item"><a class="page-link">' . $this->currentPage . '</a></li>' . $page1right . $page2right . $forward . $endpage . '</ul>';
    }

    public function __toString()
    {
        return $this->getHtml();
    }

}