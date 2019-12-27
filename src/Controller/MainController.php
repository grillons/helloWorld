<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function homeAction()
    {
        // return $this->render('main/index.html.twig');
        return $this->render('main/home.html.twig',
          ['project_name' => 'Share and Fly'],
        );
    }
}
