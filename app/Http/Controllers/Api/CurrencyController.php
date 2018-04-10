<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CurrencyCollection;
use App\Services\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    /**
     * @var Currency
     */
    private $currency;

    /**
     * CurrencyController constructor.
     * @param Currency $currency
     */
    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CurrencyCollection($this->currency->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regex = "/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/";
        $data = $request->validate([
            'from_currency' => 'required',
            'from_amount' => ['required', 'regex:' . $regex],
            'to_currency' => 'required|different:from_currency'
        ], [
            'from_amount.regex' => 'Invalid from amount'
        ]);

        return response(json_encode($this->currency->calculate($data)));
    }
}
