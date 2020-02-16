<?php

declare(strict_types=1);

namespace App\Service;

use App\Builder\Director;
use App\Builder\GoldmanOfferBuilder;
use App\Model\Offer;
use App\Enum\GoldmanPageEnum;
use App\Enum\OfferPatternEnum;
use App\Provider\ScraperProvider;

/**
 * Class ScraperService
 * @package App\Service
 */
class ScraperService
{
    /**
     * @var ScraperProvider
     */
    private $provider;
    
    /**
     * @var OfferListService
     */
    private $offerListService;
    
    /**
     * ScraperService constructor.
     * @param ScraperProvider  $provider
     * @param OfferListService $offerListService
     */
    public function __construct(ScraperProvider $provider, OfferListService $offerListService)
    {
        $this->provider = $provider;
        $this->offerListService = $offerListService;
    }
    
    /**
     * @return array
     * @throws \Exception
     */
    public function createObjects(): array
    {
        $this->setSourceToScrap(GoldmanPageEnum::OFFER_LIST);
        $path = $this->provider->getXPath();
        $offerLinks = $this->offerListService->getOfferLinksByDOMXPath($path, OfferPatternEnum::LINK_TO_OFFER);
        $this->provider->resetPath();

        $objects = [];
        foreach($offerLinks as $link) {
            $offer = new Offer();
            $offerId = $this->getIdFromString($link);
            $offer->setId($offerId);
            $objects[$link] = $offer;
        }

        return $objects;
    }
    
    /**
     * @param array $objects
     * @return array
     * @throws \Exception
     */
    public function updateObjects(array $objects)
    {
        $builder = new GoldmanOfferBuilder();
        $director = new Director($builder);

        foreach ($objects as $key => $object) {
            $this->setSourceToScrap(GoldmanPageEnum::MAIN.$key);
            $path = $this->provider->getXPath();
            
            $builder->setOffer($object);
            $builder->setDOMXPath($path);
            
            $director->buildOtherElements();
            
            $objects[$object->getId()] = $object;
            unset($objects[$key]);
        }
        
        return $objects;
    }
    
    /**
     * @param string $source
     * @throws \Exception
     */
    private function setSourceToScrap(string $source): void
    {
        $this->provider->setLink($source);
        $this->provider->loadProvider();
    }
    
    /**
     * @param string $string
     * @return int
     */
    private function getIdFromString(string $string): int
    {
        preg_match('!\d+!',$string, $matches);
        
        return (int) $matches[0];
    }
}
