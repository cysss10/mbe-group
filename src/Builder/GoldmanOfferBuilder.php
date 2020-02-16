<?php

declare(strict_types=1);

namespace App\Builder;

use App\Model\Description;
use App\Model\Offer;
use App\Enum\OfferPatternEnum;
use DOMXPath;

/**
 * Class GoldmanOfferBuilder
 * @package App\Builder
 */
class GoldmanOfferBuilder implements BuilderInterface
{
    /**
     * @var Offer
     */
    private $offer;

    /**
     * @var DOMXPath
     */
    private $xpath;
    
    /**
     *
     */
    public function buildTitle(): void
    {
        $title = $this->buildElementByDiv(OfferPatternEnum::TITLE);
        $this->offer->setTitle($title);
    }
    
    /**
     *
     */
    public function buildRefNUmber(): void
    {
        $refNumber = $this->buildElementByDiv(OfferPatternEnum::REF_NUMBER);
        $this->offer->setRefNumber($refNumber);
    }
    
    /**
     *
     */
    public function buildSmallDesc(): void
    {
        $smallDesc = $this->buildElementByDiv(OfferPatternEnum::SMALL_DESC);
        $this->offer->setSmallDesc($smallDesc);
    }
    
    /**
     *
     */
    public function buildDesc(): void
    {
        $desc = $this->buildDescription(OfferPatternEnum::DESC);
        $this->offer->setDesc($desc);
    }
    
    /**
     *
     */
    public function buildLink(): void
    {
        $string = $this->buildElementByHref(OfferPatternEnum::LINK);
        $this->offer->setLink($string);
    }
    
    /**
     * @param DOMXPath $path
     */
    public function setDOMXPath(DOMXPath $path): void
    {
        $this->xpath = $path;
    }
    
    /**
     * @param Offer $offer
     */
    public function setOffer(Offer $offer)
    {
        $this->offer = $offer;
    }
    
    /**
     * @param string $pattern
     * @return string|null
     */
    private function buildElementByDiv(string $pattern): ?string
    {
        $elements = $this->xpath->query($pattern);

        $string = null;
        foreach($elements as $element) {
            $nodes = $element->childNodes;
            
            foreach($nodes as $node) {
                $string = $node->nodeValue;
            }
        }

        return $string;
    }
    
    /**
     * @param string $pattern
     * @return string|null
     */
    private function buildElementByHref(string $pattern): ?string
    {
        $elements = $this->xpath->query($pattern);

        $string = null;
        foreach($elements as $element) {
            $nodes = $element->getElementsByTagName('a');

            foreach ($nodes as $node) {
                $string = $node->getAttribute('href');
            }
        }

        return $string;
    }
    
    /**
     * @param string $pattern
     * @return array
     */
    private function buildDescription(string $pattern): array
    {
        $elements = $this->xpath->query($pattern);

        $arr = [];
        foreach($elements as $key => $element) {
            $desc = new Description();
            $title = $element->getElementsByTagName('h2');
            foreach($title as $text) {
                $desc->setTitle($text->nodeValue);
            }

            $nodes = $element->getElementsByTagName('ul');
            foreach($nodes as $node) {
                $text =  trim(preg_replace("/[\r\n]+/", " ", $node->nodeValue));
                $desc->setParagraphs(preg_split('/\t/', $text));
            }
            
            $arr[$key] = $desc;
        }
        
        return $arr;
    }
}
