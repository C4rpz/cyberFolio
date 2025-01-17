<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/contact')]
class ContactController extends AbstractController
{
    #[Route('/', name: 'app_contact_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig');
    }

    #[Route('/send', name: 'app_contact_send', methods: ['POST'])]
    public function send(Request $request): Response
    {
        $data = $request->request->all();
        $this->addFlash('success', 'Votre message a été envoyé avec succès !');

        return $this->redirectToRoute('app_contact_index');
    }
}
