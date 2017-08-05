<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
    public function productListAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $query = $em->getRepository('AppBundle:Product')->getPaginationQuery($em);

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate(
            $query,
            $request->query->getInt('page',1),
            $request->query->getInt('linit',5)
        );

        return $this->render('product/list.html.twig', ['products' => $result]);
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
     * @Route("/product/new", name="product_new")
     */
    public function newAction(Request $request) {
        $form = $this->createForm(ProductFormType::class);

        // only handles data on POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Product created');

            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/edit.html.twig', ['productForm' => $form->createView()]);
    }

    /**
     * @Route("/product/{id}/edit", name="product_edit")
     */
    public function editAction(Request $request, Product $product) {
        $form = $this->createForm(ProductFormType::class, $product);

        // only handles data on POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Product updated');

            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/edit.html.twig', ['productForm' => $form->createView()]);
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