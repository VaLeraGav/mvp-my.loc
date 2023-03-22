<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\UserModel;
use Core\Base\Model;

class ProductController extends AppController
{
    public function index($alias): void
    {
        $productModel = new ProductModel();

        $product = $productModel->getProduct($alias);

        $related = $productModel->relatedProducts($product->id);
        $gallery = $productModel->getGallery($product->id);

        // запись в куки запрошенного товара
        $productModel->setRecentlyViewed($product->id);

        // просмотренный товар
        $r_viewed = $productModel->getRecentlyViewed();
        $recentlyViewed = null;
        if ($r_viewed) {
            $slot = implode(', ', $r_viewed);
            $recentlyViewed = Model::requestArr("SELECT * FROM product  WHERE id IN ({$slot}) LIMIT 3");
        }

        $this->setMeta($product->title, $product->description, $product->keywords);
        $this->view('pages/product', [
            'product' => $product,
            'related' => $related,
            'gallery' => $gallery,
            'recentlyViewed' => $recentlyViewed
        ]);
    }
}