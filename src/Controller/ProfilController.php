<?php
namespace App\Controller;

use App\Entity\Profil;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/profil')]
class ProfilController extends AbstractController
{
    #[Route('/', name: 'app_profil_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $profils = $entityManager->getRepository(Profil::class)->findAll();

        return $this->render('profil/index.html.twig', [
            'profils' => $profils,
        ]);
    }

    #[Route('/{id}', name: 'app_profil_show', requirements: ['id' => '\\d+'], methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        $profil = $entityManager->getRepository(Profil::class)->find($id);

        if (!$profil) {
            throw $this->createNotFoundException('Profil non trouvé.');
        }

        return $this->render('profil/show.html.twig', [
            'profil' => $profil,
        ]);
    }
}
