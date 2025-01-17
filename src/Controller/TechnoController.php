<?php
namespace App\Controller;

use App\Entity\Techno;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/technologie')]
class TechnoController extends AbstractController
{
    #[Route('/', name: 'app_technologie_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $technologies = $entityManager->getRepository(Techno::class)->findAll();

        return $this->render('technologie/index.html.twig', [
            'technologies' => $technologies,
        ]);
    }

    #[Route('/{id}', name: 'app_technologie_show', requirements: ['id' => '\\d+'], methods: ['GET'])]
    public function show(int $id, EntityManagerInterface $entityManager): Response
    {
        $technologie = $entityManager->getRepository(Techno::class)->find($id);

        if (!$technologie) {
            throw $this->createNotFoundException('Technologie non trouvée.');
        }

        return $this->render('technologie/show.html.twig', [
            'technologie' => $technologie,
        ]);
    }
}
