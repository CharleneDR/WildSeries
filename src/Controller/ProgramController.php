<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
     // Correspond à la route /program/ et au name "program_index"
     #[Route('/', name: 'index')]
     public function index(): Response
     {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
        ]);
     }

     // Correspond à la route /program/new et au name "program_new"
     #[Route('/new', name: 'new')]
     public function new(): Response
     {
         // ...
     }

     #[Route('/{id<\d+>}', methods: ['GET'], name: 'program_show')]
     public function show(int $id): Response
     {
        return $this->render('program/show.html.twig', [
            'idProgram' => $id,
        ]);
     }
     }