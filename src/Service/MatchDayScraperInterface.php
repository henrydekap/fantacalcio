<?php

namespace App\Service;

use App\Entity\MatchDay;
use Doctrine\ORM\EntityManagerInterface;

interface MatchDayScraperInterface
{
    public function scrape(MatchDay $match_day): void;
}