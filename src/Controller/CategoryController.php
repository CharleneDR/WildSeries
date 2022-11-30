<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{
     // Correspond à la route /program/ et au name "program_index"
     #[Route('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

     // Correspond à la route /program/new et au name "program_new"
    #[Route('/new', name: 'new')]
    public function new(): Response
    {
         // ...
    }

    #[Route('/{categoryName<\w+>}', methods: ['GET'], name: 'show')]
    public function show(string $categoryName, CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $categories = $categoryRepository->findAll();
        $categorieExists = $categoryRepository->findOneBy(['name' => $categoryName]);

        if (!empty($categorieExists)) {
            $programsByCategory = $programRepository->findBy(['category' => $categorieExists], ['id' => 'DESC'], 3);
        } else {
            throw $this->createNotFoundException("Aucune catégorie nommée " . $categoryName);
        }

        return $this->render('category/show.html.twig', [
            'categoryName' => $categoryName,
            'categories' => $categories,
            'programs' => $programsByCategory
        ]);
    }
}