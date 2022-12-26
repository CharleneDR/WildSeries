<?php

namespace App\Controller;

use App\Entity\Season;
use App\Entity\Comment;
use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Category;
use App\Form\CommentType;
use App\Form\ProgramType;
use App\Form\SearchProgramType;
use App\Service\ProgramDuration;
use Symfony\Component\Mime\Email;
use App\Repository\UserRepository;
use App\Repository\SeasonRepository;
use App\Repository\CommentRepository;
use App\Repository\EpisodeRepository;
use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
     // Correspond à la route /program/ et au name "program_index"
     #[Route('/', name: 'index')]
    public function index(Request $request, ProgramRepository $programRepository, CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(SearchProgramType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];

            $programs = $programRepository->findLikeName($search);
        } else {
        $programs = $programRepository->findAll();
        }
        
        $categories = $categoryRepository->findAll();;

        return $this->renderForm('program/index.html.twig', [
            'programs' => $programs,
            'categories' => $categories,
            'form' => $form
        ]);
    }

     // Correspond à la route /program/new et au name "program_new"
     #[Route('/new', name: 'new')]
     public function new(Request $request, MailerInterface $mailer, ProgramRepository $programRepository, SluggerInterface $slugger): Response
     {
     // Create a new Category Object
     $program = new Program();
 
     // Create the associated Form
     $form = $this->createForm(ProgramType::class, $program);
 
     // Get data from HTTP request
     $form->handleRequest($request);
     // Was the form submitted ?
     if ($form->isSubmitted() && $form->isValid()) {
        
        $slug = $slugger->slug($program->getTitle());
        $program->setSlug($slug);
        $program->setOwner($this->getUser());

        $programRepository->save($program, true);

        $email = (new Email())
        ->from($this->getParameter('mailer_from'))
        ->to('your_email@example.com')
        ->subject('Une nouvelle série vient d\'être publiée !')
        ->html($this->renderView('program/newProgramEmail.html.twig', ['program' => $program]));
        $mailer->send($email);   

        $this->addFlash('mainColor', 'The new program has been created');        
         
        return $this->redirectToRoute('program_index');
     }
         
         // Render the form (best practice)
        return $this->renderForm('program/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{slug}', methods: ['GET'], name: 'show')]
    public function show(Program $program, ProgramRepository $programRepository, ProgramDuration $programDuration, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('program/show.html.twig', [
            'categories' => $categories,
            'program' => $program,
            'programDuration' => $programDuration->calculate($program),
        ]);
    }

    #[Route('/{slug}/edit', name: 'app_program_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Program $program, ProgramRepository $programRepository, SluggerInterface $slugger): Response
    {
        if ($this->getUser() !== $program->getOwner()) {    
            throw $this->createAccessDeniedException('Vous n\'êtes pas le propriétaire de ce programme!');
        }
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $slug = $slugger->slug($program->getTitle());
            $program->setSlug($slug);
    
            $programRepository->save($program, true);

            return $this->redirectToRoute('program_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('program/edit.html.twig', [
            'program' => $program,
            'form' => $form,
        ]);
    }

    #[Route('/{programSlug}/season/{seasonId<\d+>}', methods: ['GET'], name: 'season_show')]
    #[Entity('program', options: ['mapping' => ['programSlug' => 'slug']])]
    #[Entity('season', options: ['mapping' => ['seasonId' => 'id']])]
    public function showSeason(Program $program, Season $season, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('program/season_show.html.twig', [
            'season' => $season,
            'categories' => $categories,
            'program' => $program
        ]);
    }

    #[Route('/{programSlug}/season/{seasonId<\d+>}/episode/{episodeSlug}', name: 'episode_show')]
    #[Entity('program', options: ['mapping' => ['programSlug' => 'slug']])]
    #[Entity('season', options: ['mapping' => ['seasonId' => 'id']])]
    #[Entity('episode', options: ['mapping' => ['episodeSlug' => 'slug']])]
    public function showEpisode(Request $request, CommentRepository $commentrepository, Program $program, Season $season, Episode $episode, CategoryRepository $categoryRepository, EpisodeRepository $episodeRepository)
    {
        $categories = $categoryRepository->findAll();
        
        if($this->isGranted('IS_AUTHENTICATED_FULLY')){
            $comment = new Comment();
            $comment->setAuthor($this->container->get('security.token_storage')->getToken()->getUser());
            $comment->setEpisode($episode);
            $form = $this->createForm(CommentType::class, $comment);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $commentrepository->save($comment, true);
            }

            return $this->renderForm('program/episode_show.html.twig', [
                'program' => $program,
                'season' => $season,
                'episode' => $episode,
                'categories' => $categories,
                'form' => $form
            ]);
        }

        return $this->renderForm('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
            'categories' => $categories,
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Program $program, ProgramRepository $programRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$program->getId(), $request->request->get('_token'))) {
            $programRepository->remove($program, true);
            $this->addFlash('secondColor', 'The program has been deleted');        

        }

        return $this->redirectToRoute('program_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/watchlist', name: 'watchlist', methods: ['POST', 'GET'])]
    #[IsGranted('ROLE_USER')]
    public function addToWatchlist(int $id, Program $program, UserRepository $userRepository)
    {
        if (!$program) {
            throw $this->createNotFoundException('Aucun programme trouvé.');
        }

        if ($this->getUser()->isInWatchList($program))
        {
            $this->getUser()->removeFromWatchlist($program);
        } else {
            $this->getUser()->addToWatchlist($program);
        }

        $userRepository->save($this->getUser(), true); 

        return $this->json([
            'isInWatchlist' => $this->getUser()->isInWatchlist($program)
        ]);    }
}
