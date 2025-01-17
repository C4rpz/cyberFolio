<?php
namespace App\Controller;

use App\Entity\Projet;
use App\Form\ProjetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/projet')]
class ProjetController extends AbstractController
{
    #[Route('/', name: 'app_projet_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $projets = $entityManager->getRepository(Projet::class)->findAll();

        return $this->render('projet/index.html.twig', [
            'projets' => $projets,
        ]);
    }

    #[Route('/projet/new', name: 'app_projet_new', methods: ['GET', 'POST'])]
public function new(Request $request, EntityManagerInterface $entityManager): Response
{
    $projet = new Projet();
    $form = $this->createForm(ProjetType::class, $projet);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $screenshot = $form->get('screenshot')->getData();
        if ($screenshot) {
            $fileName = uniqid() . '.' . $screenshot->guessExtension();
            $screenshot->move($this->getParameter('uploads_directory'), $fileName);
            $projet->setScreenshot($fileName);
        }

        $entityManager->persist($projet);
        $entityManager->flush();

        $this->addFlash('success', 'Projet créé avec succès !');
        return $this->redirectToRoute('app_projet_index');
    }

    return $this->render('projet/new.html.twig', [
        'form' => $form->createView(),
    ]);
}

#[Route('/projet/{id}/edit', name: 'app_projet_edit', methods: ['GET', 'POST'])]
public function edit(Request $request, Projet $projet, EntityManagerInterface $entityManager): Response
{
    $form = $this->createForm(ProjetType::class, $projet);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $screenshot = $form->get('screenshot')->getData();
        if ($screenshot) {
            $fileName = uniqid() . '.' . $screenshot->guessExtension();
            $screenshot->move($this->getParameter('uploads_directory'), $fileName);
            $projet->setScreenshot($fileName);
        }

        $entityManager->flush();

        $this->addFlash('success', 'Projet mis à jour avec succès !');
        return $this->redirectToRoute('app_projet_index');
    }

    return $this->render('projet/edit.html.twig', [
        'form' => $form->createView(),
        'projet' => $projet,
    ]);
}

}
