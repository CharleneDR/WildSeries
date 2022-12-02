<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Request;

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
    public function new(Request $request, CategoryRepository $categoryRepository): Response
    {
    // Create a new Category Object
    $category = new Category();

    // Create the associated Form
    $form = $this->createForm(CategoryType::class, $category);

    // Get data from HTTP request
    $form->handleRequest($request);
    // Was the form submitted ?
    if ($form->isSubmitted() && $form->isValid()) {
        $categoryRepository->save($category, true);            
        return $this->redirectToRoute('category_index');
    }
        
        // Render the form (best practice)
        return $this->renderForm('category/new.html.twig', [
            'form' => $form,
        ]);

        // Alternative
        // return $this->render('category/new.html.twig', [
        //   'form' => $form->createView(),
        // ]);
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