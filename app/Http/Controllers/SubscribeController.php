<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SubscribeController extends Controller
{
    public function __invoke(Request $request): View
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'url'   => ['required', 'string']
        ]);

        $url   = $request->get('url');
        $email = $request->get('email');
        $html  = Http::acceptJson()->get($url);
        $name  = Str::between($html, '<h4 class="css-1juynto">', '</h4></div><style data-emotion="css');
        $price = (int) filter_var(Str::between($html, '<h3 class="css-12vqlj3">', '</h3>'), FILTER_SANITIZE_NUMBER_INT);

        $queryProduct = Product::query()->where(['url' => $url]);

        if ($queryProduct->exists()) {
            $oldPrice = $queryProduct->first()->price;
            $queryProduct->update([
                'old_price' => $oldPrice,
                'price' => $price,
            ]);
            $product = $queryProduct->first();
        } else {
            $product = Product::query()->create([
                'name' => $name,
                'url' => $url,
                'old_price' => null,
                'price' => $price,
            ]);
        }

        $userQuery = User::query()->where(['email' => $email]);

        if ($userQuery->exists()) {
            if (is_null($userQuery->first()->products()->where(['url' => $url])->first())) {
                $userQuery->first()->products()->attach($product);
            }
        } else {
            $user = User::query()->firstOrCreate([
                'name' => explode('@', $email)[0],
                'email' => $email,
                'password' => Hash::make($email),
            ]);
            $user->products()->attach($product);
        }

        return view('app.index');
    }
}
