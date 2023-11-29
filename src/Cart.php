<?php

class Cart
{
    public function __construct()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    public function addMovie($idMovie, $quantity)
    {
        if (isset($_SESSION['cart'][$idMovie])) {
            $_SESSION['cart'][$idMovie] += $quantity;
        } else {
            $_SESSION['cart'][$idMovie] = $quantity;
        }
    }

    public function removeMovie($idMovie)
    {
        if (isset($_SESSION['cart'][$idMovie])) {
            unset($_SESSION['cart'][$idMovie]);
        }
    }
    public function clearCart()
    {
        $_SESSION['cart'] = [];
    }

    public function displayCart()
    {

        return $_SESSION['panier'];
    }
}
