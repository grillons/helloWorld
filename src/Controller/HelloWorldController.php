<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HelloWorldController extends AbstractController
{
     /**
     * @Route("/hello/{name}", name="hello_world") //add this comment to annotations
     */
    public function index($name="World")
    {
        return $this->render('hello_world/index.html.twig', [
            'controller_name' => 'HelloWorldController',
            'name'            => $name
        ]);
    }
}
