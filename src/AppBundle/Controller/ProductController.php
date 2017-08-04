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
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')->findAll();
        dump($products);
        return $this->render('product/list.html.twig', ['products' => $products]);
    }

    /**
     * @Route("/{id}", name="product_show")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->findOneBy(['id' => $id]);

        if (!$product) throw $this->createNotFoundException('No product found');


        return $this->render('product/show.html.twig', ['product' => $product]);
    }
}