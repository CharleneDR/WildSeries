<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    #[IsGranted('ROLE_ADMIN')]
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
        $this->addFlash('mainColor', 'The new category has been created');        
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
        $categorieExists = $categoryRepository->findOneBy(['name' => $categoryName]);

        if (!empty($categorieExists)) {
            $programsByCategory = $programRepository->findBy(['category' => $categorieExists], ['id' => 'DESC'], 3);
        } else {
            throw $this->createNotFoundException("Aucune catégorie nommée " . $categoryName);
        }

        return $this->render('category/show.html.twig', [
            'categoryName' => $categoryName,
            'programs' => $programsByCategory
        ]);
    }

    #[Route('/{id}', name: 'app_category_delete', methods: ['POST'])]
    public function delete(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $categoryRepository->remove($category, true);
            $this->addFlash('secondColor', 'The category has been deleted');
        }
 
        return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    }
}