<?php

namespace App\Models;

use Core\App;
use Core\Base\Model;

class CategoryModel extends AppModel
{
    public string $table = 'category';

    public array $attributes = [
        'title' => '',
        'parent_id' => '',
        'keywords' => '',
        'description' => '',
        'alias' => ''
    ];

    public array $rules = [
        'title' => 'require',
        'parent_id' => 'require',
        'alias' => 'require'
    ];

    public function getIds($id)
    {
        $cats = App::$app->getProperty('cats');
        $ids = null;
        foreach ($cats as $k => $v) {
            if ($v['parent_id'] == $id) {
                $ids .= $k . ', ';
                $ids .= $this->getIds($k);
            }
        }
        return $ids;
    }

    public function str2url($str)
    {
        // переводим в транслит
        $str = self::rus2translit($str);
        // в нижний регистр
        $str = strtolower($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return $str;
    }

    private function rus2translit($string)
    {
        $converter = array(

            'а' => 'a',
            'б' => 'b',
            'в' => 'v',

            'г' => 'g',
            'д' => 'd',
            'е' => 'e',

            'ё' => 'e',
            'ж' => 'zh',
            'з' => 'z',

            'и' => 'i',
            'й' => 'y',
            'к' => 'k',

            'л' => 'l',
            'м' => 'm',
            'н' => 'n',

            'о' => 'o',
            'п' => 'p',
            'р' => 'r',

            'с' => 's',
            'т' => 't',
            'у' => 'u',

            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',

            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sch',

            'ь' => '\'',
            'ы' => 'y',
            'ъ' => '\'',

            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',


            'А' => 'A',
            'Б' => 'B',
            'В' => 'V',

            'Г' => 'G',
            'Д' => 'D',
            'Е' => 'E',

            'Ё' => 'E',
            'Ж' => 'Zh',
            'З' => 'Z',

            'И' => 'I',
            'Й' => 'Y',
            'К' => 'K',

            'Л' => 'L',
            'М' => 'M',
            'Н' => 'N',

            'О' => 'O',
            'П' => 'P',
            'Р' => 'R',

            'С' => 'S',
            'Т' => 'T',
            'У' => 'U',

            'Ф' => 'F',
            'Х' => 'H',
            'Ц' => 'C',

            'Ч' => 'Ch',
            'Ш' => 'Sh',
            'Щ' => 'Sch',

            'Ь' => '\'',
            'Ы' => 'Y',
            'Ъ' => '\'',

            'Э' => 'E',
            'Ю' => 'Yu',
            'Я' => 'Ya',

        );
        return strtr($string, $converter);
    }

}