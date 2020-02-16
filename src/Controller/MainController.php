<?php

namespace App\Controller;

use App\Service\ScraperService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    private $scraperService;

    public function __construct(ScraperService $scraperService)
    {
        $this->scraperService = $scraperService;
    }

    /**
     * @Route("/offers", name="offers")
     *
     * @return Response
     * @throws \Exception
     */
    public function offers(): Response
    {
        /*
         * Poniższe rozwiązanie służy tylko do załadowania ofert. Tego kodu tutaj nie powinno być. Oferty powinny być ładowane z bazy lub np. z cache`u.
        */
       $offers = $this->scraperService->createObjects();
       $offers = $this->scraperService->updateObjects($offers);
       
       dump($offers); // celowo zostawiłem "dumpa", aby można było podejrzeć jak wyglądają oferty.
       return $this->render('base.html.twig', [
           'offers' => $offers
       ]);
    }
    
    /**
     * @Route("/offer/{id}", name="offer")
     *
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function offer(int $id): Response
    {
        /*
         * Poniższe rozwiązanie służy tylko do załadowania ofert. Tego kodu tutaj nie powinno być. Oferty powinny być ładowane z bazy lub np. z cache`u.
        */
        $offers = $this->scraperService->createObjects();
        $offers = $this->scraperService->updateObjects($offers);
        
        return $this->render('offer.html.twig', [
            'offer' => $offers[$id],
        ]);
    }
}
