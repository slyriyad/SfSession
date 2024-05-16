<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager->getRepository(Category::class)->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }
    
    #[Route('/category/new', name: 'new_category')]
    #[Route('/category/{id}/edit', name: 'edit_category')]
    public function new_edit(Category $category = null , Request $request, EntityManagerInterface $entityManager): Response
    {
        // If no enterprise ID is provided, create a new enterprise instance
        if(!$category) {
            $category = new Category();
        }
        
        // Create a form instance for adding/editing enterprises
        $form = $this->createForm(CategoryType::class, $category);
        
        // Handle form submissions
        $form->handleRequest($request);
        
        // If the form is submitted and valid, persist the enterprise to the database
        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $entityManager->persist($category);
            $entityManager->flush();
            
            // Redirect to the index page after successful submission
            return $this->redirectToRoute('app_category');
        }
        
        // Render the form for adding/editing enterprises
        return $this->render('category/new.html.twig', [
            'formAddcategory' => $form,
            'edit' => $category->getId()
        ]);
    }
    
    #[Route('/category/{id}', name: 'show_category')]
    public function show(Category $category): Response
    {
        // Render the page displaying details of a specific enterprise
        return $this->render('category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/category/{id}/delete', name: 'delete_category')]
    public function delete(Category $category, EntityManagerInterface $entityManager)
    {
        // Remove the enterprise from the database
        $entityManager->remove($category);
        $entityManager->flush();

        // Redirect to the index page after successful deletion
        return $this->redirectToRoute('app_category');
    }
}
