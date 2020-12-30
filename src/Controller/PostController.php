<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Entity\Subcategory;
use App\Repository\SubcategoryRepository;
use App\Entity\Post;
use App\Repository\PostRepository;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class PostController extends AbstractController
{
    /**
    * @var ObjectManager
    */
    private $em;

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
    * @Route("/post/create", name="post_create")
    */
    public function create(CategoryRepository $repoCategory, Request $request, EntityManagerInterface $em, SubcategoryRepository $repoSubcategory): Response
    {
      $categories = $repoCategory->findAll();
      $repo = $this->getDoctrine()->getRepository(Post::class);

      $post = new Post();

      $form = $this->createFormBuilder($post)
                   ->add('title')
                   ->add('content')
                   ->add('author')
                   ->getForm();
      $subcategory = $request->request->get('postCategory');
      $post->setSubcategory($repoSubcategory->find((int) $subcategory));
      dump($request);

      $form->handleRequest($request);


      if ($form->isSubmitted())
      {
        $post->setCreatedAt(new \DateTime());
        $em->persist($post);
        $em->flush();
      }

      return $this->render('post/create.html.twig', [
        'post' => $post,
        'formPost' => $form->createView(),
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
