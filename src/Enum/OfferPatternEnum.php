<?php

declare(strict_types=1);

namespace App\Enum;

class OfferPatternEnum
{
    public const LINK_TO_OFFER = '//div[@class="item"]//div[@class="title"]';
    public const TITLE = '//div[@class="col-9"]//div[@class="title"]';
    public const REF_NUMBER = '//div[@class="col-9"]//div[@class="number"]';
    public const SMALL_DESC = '//div[@class="col-9"]//div[@class="lead"]';
    public const DESC = '//div[@id=""]';
    public const LINK = '//div[@class="buttonFilled orangeBg"]';
}