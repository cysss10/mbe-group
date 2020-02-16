<?php

declare(strict_types=1);

namespace App\Service;

use DOMXPath;

/**
 * Class OfferListService
 * @package App\Service
 */
class OfferListService
{
    /**
     * @param DOMXPath $path
     * @param string   $pattern
     * @return array
     */
    public function getOfferLinksByDOMXPath(DOMXPath $path, string $pattern): array
    {
        $elements = $path->query($pattern);

        $arrayOfElements = [];
        foreach($elements as $element) {
            $nodes = $element->getElementsByTagName("a");
            foreach ($nodes as $node) {
                $arrayOfElements[] = $node->getAttribute("href");
            }
        }

        return $arrayOfElements;
    }
}
