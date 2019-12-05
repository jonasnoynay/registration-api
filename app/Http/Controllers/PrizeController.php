<?php

namespace App\Http\Controllers;

use App\Prize;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Resources\PrizeCollection;
use App\Http\Resources\PrizeTableResource;

class PrizeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get All Prizes
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPrizes()
    {
        //dd(__DIR__);
        $prizes = file_get_contents('prizes.json', true);

        return response()->json(json_decode($prizes));
    }

    /**
     * Get All Prizes Table
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function prizesTable(Request $request)
    {
        $prizes = Prize::select('id', 'name', 'available');

        $prizes = $prizes->paginate($request->get('per_page', 12));

        $prizes = PrizeTableResource::collection($prizes);

        return response()->json($prizes->resource);
    }
}
