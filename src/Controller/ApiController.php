<?php

namespace App\Controller;

use JsonSerializable;
use App\Repository\ProgramRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/api', name: 'api_')]
class ApiController extends AbstractController
{

    #[Route('/program_details/{id}', methods: ['GET'], name: 'program_details')]
    public function details(ProgramRepository $programRepository, int $id): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        $seasons= [];
        foreach($program->getSeasons() as $season)
        {
            $seasons[] = ['id' => $season->getId(), 'number' => $season->getNumber()];
        }
        return new JsonResponse($seasons);
    }
}