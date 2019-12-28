<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ProductController extends AbstractController
{
    /**
     * @Route("/product")
     */
    public function index()
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }

    /**
     * @Route("/product/all", name="product.all")
     */
    public function all()
    {
      $em       = $this->getDoctrine()->getManager();
      $products = $em->getRepository(Product::class)->findAll();

      return $this->render('product/all.html.twig', ['products' => $products]);
    }

    /**
     * @Route("/product/show/{product_id}", name="product.show")
     */
    public function show(Product $product)
    {
      return $this->render('product/show.html.twig', [
      ]);
    }

    /**
     * @Route("/product/add/", name="product.add")
     */
    public function add(Request $request)
    {
      $product = new Product();

      $form = $this->createFormBuilder($product)
        ->add("name", TextType::class)
        ->add("releaseOn", DateType::class, [
                "widget" => "single_text"
              ])
        ->add("save", SubmitType::class, ["label" => "create Product"])
        ->getForm();

      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager(); // Fetch the EntityManager via $this->getDoctrine()
        $entityManager->persist($product); // Tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->flush(); // Actually executes the queries (i.e. the INSERT query)

        return $this->redirectToRoute("product.all");
        // return new Response('Saved new product with id '.$product->getId());
      }

      return $this->render('product/add.html.twig', [
         'form_content'    => $form->createView(),
      ]);
    }

    /**
     * @Route("/product/update/{product_id}", name="product.update")
     */
    public function update(Product $product)
    {
      return $this->render('product/update.html.twig', [
      ]);
    }

    /**
     * @Route("/product/delete/{product_id}", name="product.delete")
     */
    public function delete(Product $product)
    {
      $em = $this->getDoctrine()->getManager();
      $em->remove($product);
      $em->flush();

      return $this->redirectToRoute("product.all");
    }

}
