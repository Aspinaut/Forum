<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Category;
use App\Entity\Subcategory;
use App\Entity\Post;
use App\Entity\PostLike;
use App\Entity\Comment;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\SubcategoryRepository;
use App\Repository\PostRepository;
use App\Repository\PostLikeRepository;
use App\Form\CommentType;

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
    * @Route("/post/{id}/edit", name="post_edit")
    */
    public function create(Post $post = null, CategoryRepository $repoCategory, Request $request, EntityManagerInterface $em, SubcategoryRepository $repoSubcategory): Response
    {
      $categories = $repoCategory->findAll();
      $repo = $this->getDoctrine()->getRepository(Post::class);

      if (!$post)
      {
        $post = new Post();
      }

      $form = $this->createFormBuilder($post)
                   ->add('title')
                   ->add('content')
                   ->getForm();

      $subcategory = $request->request->get('postCategory');
      $post->setSubcategory($repoSubcategory->find((int) $subcategory));

      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid())
      {
        if (!$post->getId())
        {
          $post->setCreatedAt(new \DateTime())
          ->setIsSolved(0)
          ->setAuthor($request->request->get('author'));
        }
        $em->persist($post);
        $em->flush();

        return $this->redirectToRoute('post_show', [
          'id' => $post->getId()
        ]);
      }

      return $this->render('post/create.html.twig', [
        'post' => $post,
        'formPost' => $form->createView(),
        'editMode' => $post->getId() !== null,
        'categories' => $categories
      ]);
    }

    /**
    * @Route("/post/{id}", name="post_show")
    */
    public function show(CategoryRepository $repoCategory, $id, Request $request, EntityManagerInterface $em): Response
    {
      $categories = $repoCategory->findAll();
      $repo = $this->getDoctrine()->getRepository(Post::class);
      $post = $repo->find($id);
      $comment = new Comment();

      $formComment = $this->createFormBuilder($comment)
                          ->add('content')
                          ->getForm();
      $formComment->handleRequest($request);

      if ($formComment->isSubmitted() && $formComment->isValid())
      {
        $comment->setCreatedAt(new \DateTime())
                ->setAuthor($request->request->get('author'))
                ->setPostId($post);
        $em->persist($comment);
        $em->flush();

        return $this->redirectToRoute('post_show', [
          'id' => $id
        ]);
      }

      return $this->render('post/show.html.twig', [
        'post' => $post,
        'formComment' => $formComment->createView(),
        'categories' => $categories,
      ]);
    }

    /**
    * @Route("/post/{id}/like", name="post_like")
    */
    public function like(Post $post, EntityManagerInterface $em, PostLikeRepository $repoLike): Response
    {
      $user = $this->getUser();

      if(!$user){
       return $this->json([
        'code' => 403,
        'message' => "Unauthorized"], 403);
      }

      if ($post->isLikedByUser($user)) {
        $like = $repoLike->findOneBy([
          'post' => $post,
          'user' => $user
        ]);

        $em->remove($like);
        $em->flush();

        return $this->json([
          'code' => 200,
          'message' => 'Successfully unliked',
          'likes' => $repoLike->count(['post' => $post])
        ], 200);
      }

      $like = new PostLike();
      $like->setPost($post)
           ->setUser($user);

      $em->persist($like);
      $em->flush();

      return $this->json([
        'code' => 200,
        'message' => 'Successfully liked',
        'likes' => $repoLike->count(['post' => $post])
      ], 200);
    }
    /**
    * @Route("/post/{id}/delete", name="post_delete")
    */
    public function deletePost(Post $post, EntityManagerInterface $em): Response
    {
      $em->remove($post);
      $em->flush();

      return $this->redirectToRoute('home');
    }

    /**
    * @Route("/comment/{id}/delete", name="comment_delete")
    */
    public function deleteComment(Comment $comment, EntityManagerInterface $em): Response
    {
      $id = $comment->getPostId();
      $em->remove($comment);
      $em->flush();

      return $this->redirectToRoute('post_show', [
        'id' => $id->getId()
      ]);
    }
}
