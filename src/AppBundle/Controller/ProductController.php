<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/")
 * @Security("is_granted('ROLE_MANAGE_PRODUCT')")
 */
class ProductController extends Controller {
    /**
     * @Route("/", name="product_list")
     */
    public function productListAction() {
        return $this->render('product/list.html.twig');
    }
}