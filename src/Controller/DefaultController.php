<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/en-construction', name: 'en_construction')]
    public function enConstruction(): Response
    {
        return $this->render('default/en_construction.html.twig');
    }
}
