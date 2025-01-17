<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/welcome')]
class WelcomeController extends AbstractController
{
    #[Route('/', name: 'app_welcome_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('welcome/index.html.twig');
    }



}