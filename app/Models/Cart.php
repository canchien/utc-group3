<?php

namespace App\Models;

class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    public $productQty = 0;

    public function __construct($oldCart, $productQty)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
        $this->productQty = (int) $productQty;
    }

    public function add($item, $id)
    {
        $storedItem = [
            'qty' => 0,
            'price' => $item->price,
            'item' => $item,
        ];

        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty'] += $this->productQty;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty += $this->productQty;
        $this->totalPrice += $item->price * $this->productQty;
    }

    public function remove($id)
    {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $this->totalQty -= $this->items[$id]['qty'];
                $this->totalPrice -= $this->items[$id]['price'];
                unset($this->items[$id]);
            }
        }
    }

    public function minusQty($id)
    {
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                if ($this->items[$id]['qty'] > 0) {
                    $this->items[$id]['qty'] -= 1;
                    $this->items[$id]['price'] -= $this->items[$id]['item']->price;
                    $this->totalQty -= 1;
                    $this->totalPrice -= $this->items[$id]['item']->price;
                }
                if ($this->items[$id]['qty'] == 0) {
                    $this->remove($id);
                }
            }
        }
    }
}
