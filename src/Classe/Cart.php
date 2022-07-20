<?php

namespace App\Classe;

use Symfony\Component\HttpFoundation\Session\SessionInterface;



class Cart
{

    private $session;

    public function __Construct(SessionInterface $session)
    {
        $this->session = $session;

    }
        
        
    public function add($id)
    {
        $cart = $this->session->get('app_cart', []);

        if (!empty($cart[$id])){
            $cart[$id]++;
        }else{
            $cart[$id] = 1;
        }

        $this->session->set('app_cart', $cart);
    }

    public function get()
    {
        return $this->session->get('app_cart');
    }

    public function remove()
    {
        return $this->session->remove('products');
    }

}