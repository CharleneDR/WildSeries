<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/myfav', name: 'app_user_fav', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function myfav(): Response
    {
        $programs = $this->getUser()->getWatchlist();

        return $this->render('user/favourites.html.twig', [
            'programs' => $programs,
        ]);
    }
}
