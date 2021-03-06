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
        $user = $this->getUser();
        $query = $em->getRepository('AppBundle:Product')->getPaginationQuery($user);

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $result = $paginator->paginate($query, $request->query->getInt('page', 1), $request->query->getInt('linit', 5));

        return $this->render('product/list.html.twig', ['products' => $result, 'imageUrlPrefix' => $this->getParameter('product_image')['uri_prefix']]);
    }

    /**
     * @Route("/products/{id}", name="product_show")
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $product = $em->getRepository('AppBundle:Product')->findOneBy(['id' => $id]);
        return $this->render('product/show.html.twig', ['product' => $product, 'imageUrlPrefix' => $this->getParameter('product_image')['uri_prefix']]);
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

            // $file stores the uploaded file
            $file = $product->getImage();

            $fileName = $this->get('app.image')->move($file);

            // Update the 'avatar' property to store file name
            // instead of its contents
            $product->setImage($fileName);

            $product->setUser($this->getUser());

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $this->addFlash('success', 'Product created');

            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/edit.html.twig', ['productForm' => $form->createView(), 'imageName' => null]);
    }

    /**
     * @Route("/product/{id}/edit", name="product_edit")
     */
    public function editAction(Request $request, Product $product) {
        $imageName = $product->getImage();
        if ($imageName) {
            $file = null;
            $product->setImage($file);
        }

        $form = $this->createForm(ProductFormType::class, $product);

        // only handles data on POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formProduct = $form->getData();

            // $file stores the uploaded file
            $file = $formProduct->getImage();

            if ($file) {
                $fileName = $this->get('app.image')->move($file);

                // Update the 'image' property to store file name
                $formProduct->setImage($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($formProduct);
            $em->flush();

            $this->addFlash('success', 'Product updated');

            return $this->redirectToRoute('product_list');
        }

        return $this->render('product/edit.html.twig', ['productForm' => $form->createView(), 'imageName' => $imageName, 'imageUrlPrefix' => $this->getParameter('product_image')['uri_prefix']]);
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