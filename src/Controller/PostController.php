<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Post;
use App\Repository\PostRepository;

class PostController extends AbstractController
{

    /**
     * @Route("/", name="home")
     * @Route("/post", name="post")
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Post::class);
        $all = $repository->findAll();
        return $this->render('post/index.html.twig', [
            'all' => $all,
            'controller_name' => 'PostController',
        ]);
    }
}
