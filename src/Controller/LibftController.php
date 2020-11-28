<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LibftController extends AbstractController
{
    /**
     * @Route("/libft", name="libft")
     */
    public function index(): Response
    {
        return $this->render('libft/index.html.twig', [
            'controller_name' => 'LibftController',
        ]);
    }
}
