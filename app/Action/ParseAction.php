<?php

declare(strict_types=1);

namespace App\Action;

use App\Models\Product;
use Exception;

class ParseAction
{
    public function parsePrices(): void
    {
        try {
            Product::all()
                ->map(function ($product) {
                    (new GetPriceAction())->getPrice($product);
                });
        } catch (Exception $exception) {
            Info('ParseAction@parsePrices - ' . $exception->getMessage());
        }
    }
}
