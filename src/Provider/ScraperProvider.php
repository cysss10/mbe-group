<?php

declare(strict_types=1);

namespace App\Provider;

use DOMXPath;
use Exception;

/**
 * Class ScraperProvider
 * @package App\Provider
 */
class ScraperProvider implements ProviderInterface
{
    private $link;

    private $path;

    /**
     * @throws Exception
     */
    public function loadProvider(): void
    {
        $this->initWebScrapping();
    }

    /**
     * @param string $link
     */
    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return DOMXPath|null
     */
    public function getXPath(): ?DOMXPath
    {
        return $this->path;
    }

    /**
     * @param DOMXPath $path
     */
    public function setXPath(DOMXPath $path): void
    {
        $this->path = $path;
    }
    
    /**
     *
     */
    public function resetLink()
    {
        $this->link = null;
    }
    
    /**
     *
     */
    public function resetPath()
    {
        $this->path = null;
    }

    /**
     * @throws Exception
     */
    private function initWebScrapping(): void
    {
        if (null === $this->link) {
            throw new Exception('Not found URL!');
        }

        $curl = curl_init($this->link);
        curl_setopt($curl, CURLOPT_URL, $this->link);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

        $page = curl_exec($curl);
        curl_close($curl);

        $doc = new \DOMDocument();
        $internalErrors = libxml_use_internal_errors(true);

        $doc->loadHTML($page);

        libxml_use_internal_errors($internalErrors);

        $path = new DOMXPath($doc);

        $this->setXPath($path);
    }


}