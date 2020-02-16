<?php

declare(strict_types=1);

namespace App\Builder;

/**
 * Class Director
 * @package App\Builder
 */
class Director
{
    /**
     * @var BuilderInterface
     */
    private $builder;
    
    /**
     * Director constructor.
     * @param BuilderInterface $builder
     */
    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }
    
    /**
     *
     */
    public function buildOtherElements(): void
    {
        $this->builder->buildTitle();
        $this->builder->buildRefNUmber();
        $this->builder->buildSmallDesc();
        $this->builder->buildLink();
        $this->builder->buildDesc();
    }
}
