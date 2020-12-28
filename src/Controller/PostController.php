<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Entity\Post;
use App\Repository\PostRepository;

class PostController extends AbstractController
{
    /**
    *
    */
    public function __construct(CategoryRepository $repoCategory)
    {
      $this->repository = $repoCategory;
    }

    /**
     * @Route("/", name="home")
     * @Route("/post", name="post")
     */
    public function index(CategoryRepository $repoCategory): Response
    {
        $categories = $repoCategory->findAll();
        $repoPost = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repoPost->findAll();

        return $this->render('post/index.html.twig', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }

    /**
    * @Route("/post/{id}", name="post_show")
    */
    public function show(CategoryRepository $repoCategory, $id): Response
    {
      $categories = $repoCategory->findAll();
      $repo = $this->getDoctrine()->getRepository(Post::class);
      $post = $repo->find($id);

      return $this->render('post/show.html.twig', [
        'post' => $post,
        'categories' => $categories,
      ]);
    }
}
