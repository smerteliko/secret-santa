<?php

namespace App\Controller;

use App\Entity\Person;
use App\Services\MailService;
use App\Services\SantaService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SantaMainController extends AbstractController
{
    #[Route('/', name: 'app_santa_main')]
    public function index()
    {
        return $this->render('santa_main/index.html.twig', []);
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/submit', name: 'app_santa_submit', methods: ['POST'])]
    public function formSubmitting(Request $request, MailService $mailService) {
        $data = json_decode($request->getContent(), true);
        if (count($data) < 4 ) {
            return (new Response())->setStatusCode(Response::HTTP_NOT_ACCEPTABLE, "At least 4 persons must be entered");
        }

        $personsAsCollection = (new Person())->setPersonsCollectionAsEntity($data);
        $santaService = new SantaService($personsAsCollection, $mailService);
        $santaService->serve();
        return new JsonResponse([ 'code' =>  Response::HTTP_OK, ], Response::HTTP_OK);
    }
}
