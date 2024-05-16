<?php

namespace App\Controller;

use App\Entity\Formation;
use App\Form\FormationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormationController extends AbstractController
{
    #[Route('/formation', name: 'app_formation')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $formations = $entityManager->getRepository(Formation::class)->findAll();
        return $this->render('formation/index.html.twig', [
            'formations' => $formations
        ]);
    }
    
    #[Route('/formation/new', name: 'new_formation')]
    #[Route('/formation/{id}/edit', name: 'edit_formation')]
    public function new_edit(Formation $formation = null , Request $request, EntityManagerInterface $entityManager): Response
    {
        // If no enterprise ID is provided, create a new enterprise instance
        if(!$formation) {
            $formation = new Formation();
        }
        
        // Create a form instance for adding/editing enterprises
        $form = $this->createForm(FormationType::class, $formation);
        
        // Handle form submissions
        $form->handleRequest($request);
        
        // If the form is submitted and valid, persist the enterprise to the database
        if ($form->isSubmitted() && $form->isValid()) {
            $formation = $form->getData();
            $entityManager->persist($formation);
            $entityManager->flush();
            
            // Redirect to the index page after successful submission
            return $this->redirectToRoute('app_formation');
        }
        
        // Render the form for adding/editing enterprises
        return $this->render('formation/new.html.twig', [
            'formAddformation' => $form,
            'edit' => $formation->getId()
        ]);
    }
    
    #[Route('/formation/{id}', name: 'show_formation')]
    public function show(Formation $formation): Response
    {
        // Render the page displaying details of a specific enterprise
        return $this->render('formation/show.html.twig', [
            'formation' => $formation,
        ]);
    }

    #[Route('/formation/{id}/delete', name: 'delete_formation')]
    public function delete(formation $formation, EntityManagerInterface $entityManager)
    {
        // Remove the enterprise from the database
        $entityManager->remove($formation);
        $entityManager->flush();

        // Redirect to the index page after successful deletion
        return $this->redirectToRoute('app_formation');
    }
    
}