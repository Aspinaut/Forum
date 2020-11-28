<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function index(): Response
    {
      $post = new Post();
      $post->setTitle("Bonjour à tous ! J'ai un problème avec ma norminette...");
      $em = $this->getDoctrine()->getManager();
      $em->persist($post);
      $em->flush();
      return $this->render('post/index.html.twig', [
        'controller_name' => 'PostController',
      ]);
    }
}
