<?php

declare(strict_types=1);

namespace App\Model;

/**
 * Class Offer
 * @package App\Entity
 */
class Offer
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $refNumber;

    /**
     * @var string
     */
    private $smallDesc;

    /**
     * @var array
     */
    private $desc;

    /**
     * @var string
     */
    private $link;
    
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

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
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getRefNumber(): string
    {
        return $this->refNumber;
    }

    /**
     * @param string $refNumber
     */
    public function setRefNumber(?string $refNumber): void
    {
        $this->refNumber = $refNumber;
    }

    /**
     * @return string
     */
    public function getSmallDesc(): string
    {
        return $this->smallDesc;
    }

    /**
     * @param string $smallDesc
     */
    public function setSmallDesc(?string $smallDesc): void
    {
        $this->smallDesc = $smallDesc;
    }

    /**
     * @return array
     */
    public function getDesc(): array
    {
        return $this->desc;
    }

    /**
     * @param array $desc
     */
    public function setDesc(?array $desc): void
    {
        $this->desc = $desc;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink(?string $link): void
    {
        $this->link = $link;
    }
}