<?php

namespace App\Repository\Cart;

Interface CartRepository
{
    public function getAll();
    public function store($id);
    public function update($id, $qty);
    public function delete($id);
}