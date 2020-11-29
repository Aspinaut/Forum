<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
    * @var PostRepository
    */
    private $repository;

    public function __construct(PostRepository $repository)
    {
      $this->repository = $repository;
    }
    /**
     * @Route("/post", name="post")
     * @return Response
     */
    public function index(): Response
    {
      return $this->render('post/index.html.twig', [
        'controller_name' => 'PostController',
      ]);
    }
}
