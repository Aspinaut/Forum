<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Category;
use App\Repository\CategoryRepository;

class PostController extends AbstractController
{

    /**
     * @Route("/", name="home")
     * @Route("/post", name="post")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Category::class);
        $categories = $repository->findAll();
        return $this->render('post/index.html.twig', [
            'categories' => $categories,
            'controller_name' => 'PostController',
        ]);
    }
}
