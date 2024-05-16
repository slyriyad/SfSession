<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $modules = $entityManager->getRepository(Module::class)->findAll();
        return $this->render('module/index.html.twig', [
            'modules' => $modules
        ]);
    }

    #[Route('/module/new', name: 'new_module')]
    #[Route('/module/{id}/edit', name: 'edit_module')]
    public function new_edit(Module $module = null , Request $request, EntityManagerInterface $entityManager): Response
    {
        // If no enterprise ID is provided, create a new enterprise instance
        if(!$module) {
            $module = new Module();
        }
        
        // Create a form instance for adding/editing enterprises
        $form = $this->createForm(ModuleType::class, $module);
        
        // Handle form submissions
        $form->handleRequest($request);
        
        // If the form is submitted and valid, persist the enterprise to the database
        if ($form->isSubmitted() && $form->isValid()) {
            $module = $form->getData();
            $entityManager->persist($module);
            $entityManager->flush();
            
            // Redirect to the index page after successful submission
            return $this->redirectToRoute('app_module');
        }
        
        // Render the form for adding/editing enterprises
        return $this->render('module/new.html.twig', [
            'formAddmodule' => $form,
            'edit' => $module->getId()
        ]);
    }
    
    #[Route('/module/{id}', name: 'show_module')]
    public function show(Module $module): Response
    {
        // Render the page displaying details of a specific enterprise
        return $this->render('module/show.html.twig', [
            'module' => $module,
        ]);
    }

    #[Route('/module/{id}/delete', name: 'delete_module')]
    public function delete(Module $module, EntityManagerInterface $entityManager)
    {
        // Remove the enterprise from the database
        $entityManager->remove($module);
        $entityManager->flush();

        // Redirect to the index page after successful deletion
        return $this->redirectToRoute('app_module');
    }
}
