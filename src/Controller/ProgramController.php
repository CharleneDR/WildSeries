<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use App\Repository\SeasonRepository;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
     // Correspond à la route /program/ et au name "program_index"
     #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository, CategoryRepository $categoryRepository): Response
    {
        $programs = $programRepository->findAll();
        $categories = $categoryRepository->findAll();;
        return $this->render('program/index.html.twig', [
            'programs' => $programs,
            'categories' => $categories
        ]);
    }

     // Correspond à la route /program/new et au name "program_new"
    #[Route('/new', name: 'new')]
    public function new(): Response
    {
         // ...
    }

    #[Route('/{id<\d+>}', methods: ['GET'], name: 'show')]
    public function show(int $id, ProgramRepository $programRepository, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        $program = $programRepository->findOneBy(['id' => $id]);

        return $this->render('program/show.html.twig', [
            'idProgram' => $id,
            'categories' => $categories,
            'program' => $program
        ]);
    }

    #[Route('/{programId<\d+>}/season/{seasonId<\d+>}', methods: ['GET'], name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, CategoryRepository $categoryRepository, SeasonRepository $seasonRepository): Response
{
    $categories = $categoryRepository->findAll();
    $season = $seasonRepository->findOneBy(['id' => $seasonId]);
    return $this->render('program/season_show.html.twig', [
        'season' => $season,
    ]);
}
}