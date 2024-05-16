<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $sessions = $entityManager->getRepository(Session::class)->findAll();
        return $this->render('session/index.html.twig', [
            'sessions' => $sessions
        ]);
    }

    #[Route('/session/new', name: 'new_session')]
    #[Route('/session/{id}/edit', name: 'edit_session')]
    public function new_edit(Session $session = null , Request $request, EntityManagerInterface $entityManager): Response
    {
        // If no enterprise ID is provided, create a new enterprise instance
        if(!$session) {
            $session = new Session();
        }
        
        // Create a form instance for adding/editing enterprises
        $form = $this->createForm(SessionType::class, $session);
        
        // Handle form submissions
        $form->handleRequest($request);
        
        // If the form is submitted and valid, persist the enterprise to the database
        if ($form->isSubmitted() && $form->isValid()) {
            $session = $form->getData();
            $entityManager->persist($session);
            $entityManager->flush();
            
            // Redirect to the index page after successful submission
            return $this->redirectToRoute('app_session');
        }
        
        // Render the form for adding/editing enterprises
        return $this->render('session/new.html.twig', [
            'formAddsession' => $form,
            'edit' => $session->getId()
        ]);
    }
    
    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session): Response
    {
        // Render the page displaying details of a specific enterprise
        return $this->render('session/show.html.twig', [
            'session' => $session,
        ]);
    }

    #[Route('/session/{id}/delete', name: 'delete_session')]
    public function delete(Session $session, EntityManagerInterface $entityManager)
    {
        // Remove the enterprise from the database
        $entityManager->remove($session);
        $entityManager->flush();

        // Redirect to the index page after successful deletion
        return $this->redirectToRoute('app_session');
    }
}
