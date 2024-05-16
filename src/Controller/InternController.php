<?php

namespace App\Controller;

use App\Entity\Intern;
use App\Form\InternType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InternController extends AbstractController
{
    #[Route('/intern', name: 'app_intern')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $interns = $entityManager->getRepository(Intern::class)->findAll();
        return $this->render('intern/index.html.twig', [
            'interns' => $interns
        ]);
    }

    #[Route('/intern/new', name: 'new_intern')]
    #[Route('/intern/{id}/edit', name: 'edit_intern')]
    public function new_edit(Intern $intern = null , Request $request, EntityManagerInterface $entityManager): Response
    {
        // If no enterprise ID is provided, create a new enterprise instance
        if(!$intern) {
            $intern = new Intern();
        }
        
        // Create a form instance for adding/editing enterprises
        $form = $this->createForm(InternType::class, $intern);
        
        // Handle form submissions
        $form->handleRequest($request);
        
        // If the form is submitted and valid, persist the enterprise to the database
        if ($form->isSubmitted() && $form->isValid()) {
            $intern = $form->getData();
            $entityManager->persist($intern);
            $entityManager->flush();
            
            // Redirect to the index page after successful submission
            return $this->redirectToRoute('app_intern');
        }
        
        // Render the form for adding/editing enterprises
        return $this->render('intern/new.html.twig', [
            'formAddintern' => $form,
            'edit' => $intern->getId()
        ]);
    }
    
    #[Route('/intern/{id}', name: 'show_intern')]
    public function show(Intern $intern): Response
    {
        // Render the page displaying details of a specific enterprise
        return $this->render('intern/show.html.twig', [
            'intern' => $intern,
        ]);
    }

    #[Route('/intern/{id}/delete', name: 'delete_intern')]
    public function delete(Intern $intern, EntityManagerInterface $entityManager)
    {
        // Remove the enterprise from the database
        $entityManager->remove($intern);
        $entityManager->flush();

        // Redirect to the index page after successful deletion
        return $this->redirectToRoute('app_intern');
    }
}
