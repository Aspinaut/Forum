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
use App\Repository\UserRepository;

use App\Entity\User;
use App\Form\RegistrationType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
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
     * @Route("/registration", name="security_registration")
     * @Route("/registration/user/{id}", name="security_registration_user")
     */
    public function registration(Request $request, EntityManagerInterface $em, UserPasswordEncoderInterface $encoder, CategoryRepository $repoCategory, UserRepository $repoUser): Response
    {
      $categories = $repoCategory->findAll();
      $user = new User();
      $formRegister = $this->createForm(RegistrationType::class, $user);

      $formRegister->handleRequest($request);
      if ($formRegister->isSubmitted() && $formRegister->isValid())
      {
        $hash = $encoder->encodePassword($user, $user->getPassword());
        $user->setPassword($hash);
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('login');
      }
      return $this->render('security/registration.html.twig', [
        'formRegister' => $formRegister->createView(),
        'categories' => $categories
      ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(CategoryRepository $repoCategory)
    {
      $categories = $repoCategory->findAll();

      return $this->render('security/login.html.twig', [
        'categories' => $categories
      ]);
    }
    /**
     * @Route("/logout", name="logout")
     */
     public function logout() {}
}
