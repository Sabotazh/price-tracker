<?php

namespace App\Http\Controllers;

use App\Action\ParseAction;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke(Request $request): void
    {
        (new ParseAction())->parsePrices();
    }
}
