<?php

namespace App\Controller;

use App\Entity\Task;
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
     * @Route("/product/show/{product}", name="product.show")
     */
    public function show(Product $product)
    {
      return $this->render('product/show.html.twig', [
      ]);
    }

    /**
     * @Route("/product/add", name="product.add")
     */
    public function add(Product $product)
    {
      $form = $this->createFormBuilder()
        ->add("name", TextType::class)
        ->add("releaseOn", DateType::class, [
                "widget" => "single_text"
              ])
        ->add("save", SubmitType::class, ["label" => "create Product"])
        ->getForm();

      // $result = [];
      $form->handleRequest($product);
      if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();

        $em->persist($product);
        $em->flush();
        return $this->redirectToRoute("product.all");
      }

      return $this->render('product/add.html.twig', [
         'form_content'    => $form->createView(),
      ]);
      // return ['form_content' => $form->createView()];
    }

    /**
     * @Route("/product/update/{product}", name="product.update")
     */
    public function update(Product $product)
    {
      return $this->render('product/update.html.twig', [
      ]);
    }

    /**
     * @Route("/product/delete/{product}", name="product.delete")
     */
    public function delete(Product $product)
    {
      $em = $this->getDoctrine()->getManager();
      $em->remove($product);
      $em->flush();

      return $this->redirectToRoute("product.all");
    }

}
