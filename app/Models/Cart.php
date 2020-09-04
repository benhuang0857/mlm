<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart)
        {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id, $num)
    {
        $levelcat01 = auth()->user()->levelcat01;
        $levelcat02 = auth()->user()->levelcat02;
        $price;
        if ($item->category == '美妝')
        {
            switch ($levelcat01) {
                case "A":
                    $price = $item->a_price;
                    break;
                case "B":
                    $price = $item->b_price;
                    break;
                case "C":
                    $price = $item->c_price;
                    break;
                case "D":
                    $price = $item->d_price;
                    break;
                case "E":
                    $price = $item->e_price;
                    break;
                case "F":
                    $price = $item->f_price;
                    break;
            }
        }
        elseif($item->category == '保健')
        {
            switch ($levelcat02) {
                case "A":
                    $price = $item->a_price;
                    break;
                case "B":
                    $price = $item->b_price;
                    break;
                case "C":
                    $price = $item->c_price;
                    break;
                case "D":
                    $price = $item->d_price;
                    break;
                case "E":
                    $price = $item->e_price;
                    break;
                case "F":
                    $price = $item->f_price;
                    break;
            }
        }

        $storeItem = ['qty' => 0, 'price' => $price, 'item' => $item];
        if ($this->items)
        {
            if (array_key_exists($id, $this->items))
            {
                $storeItem = $this->items[$id];
            }
        }
        $storeItem['qty'] += $num;
        $storeItem['price'] = $price * $storeItem['qty'];
        $this->items[$id] = $storeItem;
        $this->totalQty += $num;
        $this->totalPrice += $price*$num;
    }

    public function removeItem($id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
