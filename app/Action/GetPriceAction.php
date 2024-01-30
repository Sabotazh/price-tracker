<?php

declare(strict_types=1);

namespace App\Action;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GetPriceAction
{
    public function getPrice($product): void
    {
        try {
            $html  = Http::acceptJson()->get($product->url);
            $name  = Str::between($html, '<h4 class="css-1juynto">', '</h4></div><style data-emotion="css');
            $price = (int) filter_var(Str::between($html, '<h3 class="css-12vqlj3">', '</h3>'), FILTER_SANITIZE_NUMBER_INT);
            if ($price !== $product->price) {
                $oldPrice = $product->price;
                $product->update([
                    'old_price' => $oldPrice,
                    'price' => $price,
                ]);
                $product->users->map(function ($user) use($product) {
                    (new SendEmailAction())->send(
                        'info@undercontrol.io',
                        'Price Tracker',
                        $user->email,
                        $user->name,
                        'The price of the ' . $product->name . ' on your list has changed!',
                        '<h1><s>' . $product->old_price . '</s> to ' . $product->price . '</h1>'
                    );
                });
            }
        } catch (Exception $exception) {
            Info('GetPriceAction@getPrice - ' . $exception->getMessage());
        }
    }
}
