<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller {
    /**
     * @Route("/", name="product_list")
     */
    public function productListAction() {
        return $this->render('product/list.html.twig');
    }
}