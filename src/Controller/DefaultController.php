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
    public function index(ProgramRepository $programRepository, ActorRepository $actorRepository): Response
    {
        $programs = $programRepository->findBy([], ['id' => 'DESC'], 5);
        $actors = $actorRepository->findBy([], ['id' => 'DESC'], 5);
        return $this->render('home/index.html.twig', ['programs' => $programs, 'actors' => $actors]);
    }

    public function navbar(CategoryRepository $categoryRepository, ActorRepository $actorRepository): Response
    {
        return $this->render('_navbar.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'actors' => $actorRepository->findAll()
        ]);
    }
} 