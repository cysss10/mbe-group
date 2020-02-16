<?php

declare(strict_types=1);

namespace App\Model;

class Description
{
    /**
     * @var string
     */
    private $title;
    
    /**
     * @var array
     */
    private $paragraphs;
    
    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
    
    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    
    /**
     * @return array
     */
    public function getParagraphs(): array
    {
        return $this->paragraphs;
    }
    
    /**
     * @param array $paragraphs
     */
    public function setParagraphs(array $paragraphs): void
    {
        $this->paragraphs = $paragraphs;
    }
}
