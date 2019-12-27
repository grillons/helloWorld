<?php

namespace App\Controller;

use App\Entity\Task;
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
     * @Route("/product/add", name="product.add")
     */
    public function add(Request $request)
    {
      $form = $this->createFormBuilder()
        ->add("name", TextType::class)
        ->add("releaseOn", DateType::class, [
                "widget" => "single_text"
              ])
        ->add("save", SubmitType::class, ["label" => "create Product"])
        ->getForm();

      return $this->render('product/add.html.twig', [
         'controller_name' => 'ProductController',
         'form_content'    => $form->createView()
      ]);
    }
}
