<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/")
 * @Security("is_granted('ROLE_MANAGE_PRODUCT')")
 */
class ProductController extends Controller {
    /**
     * @Route("/", name="products_redirect")
     */
    public function redirectAction() {
        return $this->redirectToRoute('product_list', array(), 301);
    }

    /**
     * @Route("/products", name="product_list")
     */
    public function productListAction() {
        $em = $this->getDoctrine()->getManager();
        $products = $em->getRepository('AppBundle:Product')->findAll();
        return $this->render('product/list.html.twig', ['products' => $products]);
    }

    /**
     * @Route("/products/{id}", name="product_show")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->findOneBy(['id' => $id]);
        return $this->render('product/show.html.twig', ['product' => $product]);
    }

    /**
     * @Route("/products/{id}/delete", name="product_delete")
     * @Method("POST")
     */
    public function deleteGuestAction(Product $product) {
        if (!$product) throw $this->createNotFoundException('No product found');

        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return new Response('The product was deleted');
    }
}