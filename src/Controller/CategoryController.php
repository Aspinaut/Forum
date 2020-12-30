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

class CategoryController extends AbstractController
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
     * @Route("/subcategory/{subcategory_id}", name="postby_subcategory")
     */
    public function index(CategoryRepository $repoCategory, $subcategory_id): Response
    {
        $categories = $repoCategory->findAll();
        $repoPost = $this->getDoctrine()->getRepository(Post::class);
        $posts = $repoPost->findBySubcategory($subcategory_id);

        return $this->render('category/index.html.twig', [
            'posts' => $posts,
            'categories' => $categories,
        ]);
    }
}
