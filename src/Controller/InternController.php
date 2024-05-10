<?php

namespace App\Controller;

use App\Entity\Intern;
use Doctrine\ORM\EntityManagerInterface;
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
}
