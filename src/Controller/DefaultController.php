<?php

namespace App\Controller;

use App\Repository\ActorRepository;
use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class DefaultController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(CategoryRepository $categoryRepository, ProgramRepository $programRepository, ActorRepository $actorRepository): Response
    {
        $categories = $categoryRepository->findAll();
        $programs = $programRepository->findBy([], ['id' => 'DESC'], 5);
        $actors = $actorRepository->findBy([], ['id' => 'DESC'], 5);
        return $this->render('home/index.html.twig', ['categories' => $categories, 'programs' => $programs, 'actors' => $actors]);
    }
} 