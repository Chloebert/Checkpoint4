<?php

namespace App\Service;

use App\Repository\RateRepository;

class RatingPerCat
{
    public function ratingPerCat(int $catId, RateRepository $rateRepository): float
    {
        $ratings = $rateRepository->findBy(['catId' => $catId]);

        $totalRatings = 0;

        foreach ($ratings as $rating) {
            $totalRatings += $rating->getRating();
        }
        $averageRating = $totalRatings / count($ratings);

        return $averageRating;
    }
}
