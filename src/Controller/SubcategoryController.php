<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubcategoryController extends AbstractController
{
    /**
     * @Route("/subcategory", name="subcategory")
     */
    public function index(): Response
    {
        return $this->render('subcategory/index.html.twig', [
            'controller_name' => 'SubcategoryController',
        ]);
    }
}
