<?php

namespace App\Controller;

use App\Entity\Program;
use Doctrine\ORM\EntityManagerInterface;
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
}
