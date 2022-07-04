<?php

namespace App\Repository\Product;

Interface ProductRepository
{
    public function getAll();
    public function getProductBySlug($slug);
    public function getProductMostSeller();
    public function getProductRelated($id);
}