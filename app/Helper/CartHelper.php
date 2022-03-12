<?php

namespace App\Helper;

use Illuminate\Support\Str;

class CartHelper
{
    private $cart;
    private $total_amount;
    private $total_quantity;

    public function __construct()
    {
        $this->cart = session('cart') ? session('cart') : [];
        $this->total_quantity = $this->totalQuantity();
        $this->total_amount = $this->totalAmount();
    }

    public function checkItemExists($room_id)
    {
        foreach ($this->cart as $key => $item) {
            if ($room_id == $item['room_id']) {
                return $key;
            }
        }
        return false;
    }

    public function add($room, $quantity)
    {
        if (!$quantity || $quantity < 1) {
            $quantity = 1;
        }

        $rowId = Str::random();

        $item = [
            'room_id' => $room->id,
            'name' => $room->name,
            'image' => $room->image,
            'price' => $room->sale_price > 0 ? $room->sale_price : $room->price,
            'quantity' => $quantity,
            'room' => $room
        ];

        // Check item status
        $check = $this->checkItemExists($room->id);

        if ($check) {
            $this->cart[$check]['quantity'] += $quantity;
        } else {
            $this->cart[$rowId] = $item;
        }

        // Save cart
        session(['cart' => $this->cart]);
    }

    public function update($rowId, $quantity)
    {
        // Check quantity valid
        if ($quantity < 0 || !is_numeric($quantity)) {
            $quantity = $this->cart[$rowId]['quantity'];
        }

        // Increment quantity to old room
        $this->cart[$rowId]['quantity'] = $quantity;

        session(['cart' => $this->cart]);
    }

    public function content()
    {
        return $this->cart;
    }

    // Remove item by 'rowId'
    public function remove($rowId)
    {
        if (isset($this->cart[$rowId])) {

            // Remove item in cart array
            unset($this->cart[$rowId]);

            // Save cart
            session(['cart' => $this->cart]);
        }
    }

    // Remove all item
    public function destroy()
    {
        session(['cart' => []]);
    }

    // Total quantity
    public function totalQuantity()
    {
        $total_quantity = 0;

        foreach ($this->cart as $item) {
            $total_quantity += $item['quantity'];
        }

        return $total_quantity;
    }

    public function getTotalQuantity()
    {
        return $this->total_quantity;
    }

    // Total price
    public function totalAmount()
    {
        $total_amount = 0;

        foreach ($this->cart as $item) {
            $total_amount += $item['price'] * $item['quantity'];
        }

        return $total_amount;
    }

    public function getTotalAmount()
    {
        return $this->total_amount;
    }
}
