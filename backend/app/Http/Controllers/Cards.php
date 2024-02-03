<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Cards extends Controller
{
    function index()
    {
        return json_decode(Storage::disk('res')->get('dumData.json'));
    }

    function store(Request $request)
    {
        $arrayData = json_decode(Storage::disk('res')->get('dumData.json'));

        array_push($arrayData,json_decode($request->getContent()));

        Storage::disk('res')->put('dumData.json',json_encode($arrayData));

        return json_decode(Storage::disk('res')->get('dumData.json'));
    }
}
