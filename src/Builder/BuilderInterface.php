<?php

declare(strict_types=1);

namespace App\Builder;

use DOMXPath;

/**
 * Interface BuilderInterface
 * @package App\Builder
 */
interface BuilderInterface
{
    public function buildTitle(): void;

    public function buildRefNUmber(): void;

    public function buildSmallDesc(): void;

    public function buildDesc(): void;

    public function buildLink(): void;
}