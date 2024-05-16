<?php

namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgramController extends AbstractController
{
    #[Route('/program', name: 'app_program')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $programs = $entityManager->getRepository(Program::class)->findAll();
        return $this->render('program/index.html.twig', [
            'programs' => $programs
        ]);
    }

    #[Route('/program/new', name: 'new_program')]
    #[Route('/program/{id}/edit', name: 'edit_program')]
    public function new_edit(Program $program = null , Request $request, EntityManagerInterface $entityManager): Response
    {
        // If no enterprise ID is provided, create a new enterprise instance
        if(!$program) {
            $program = new Program();
        }
        
        // Create a form instance for adding/editing enterprises
        $form = $this->createForm(ProgramType::class, $program);
        
        // Handle form submissions
        $form->handleRequest($request);
        
        // If the form is submitted and valid, persist the enterprise to the database
        if ($form->isSubmitted() && $form->isValid()) {
            $program = $form->getData();
            $entityManager->persist($program);
            $entityManager->flush();
            
            // Redirect to the index page after successful submission
            return $this->redirectToRoute('app_program');
        }
        
        // Render the form for adding/editing enterprises
        return $this->render('program/new.html.twig', [
            'formAddprogram' => $form,
            'edit' => $program->getId()
        ]);
    }
    
    #[Route('/program/{id}', name: 'show_program')]
    public function show(Program $program): Response
    {
        // Render the page displaying details of a specific enterprise
        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
    }

    #[Route('/program/{id}/delete', name: 'delete_program')]
    public function delete(Program $program, EntityManagerInterface $entityManager)
    {
        // Remove the enterprise from the database
        $entityManager->remove($program);
        $entityManager->flush();

        // Redirect to the index page after successful deletion
        return $this->redirectToRoute('app_program');
    }
}
