<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class MailerController extends AbstractController
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
     * @Route("/mailer", name="mailer")
     */
    public function send_email(MailerInterface $mailer, Request $request, UserRepository $repoUser, CategoryRepository $repoCategory): Response
    {
        $categories = $repoCategory->findAll();

        $user_email = $request->request->get('_username');
        dump($request);
        if ($repoUser->findByEmail($user_email))
        {
          $email = (new TemplatedEmail())
              ->from('vincentmasse3@yopmail.com')
              ->to($user_email)
              ->subject('Reset your password')
              ->htmlTemplate('mailer/email_reset.html.twig');

          $mailer->send($email);
        }

        return $this->render('mailer/reset_password.html.twig', [
            'categories' => $categories,
            'user_email' => $user_email
        ]);
    }
}
