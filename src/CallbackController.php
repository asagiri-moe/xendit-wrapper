<?php

namespace AsagiriMoe\XenditWrapper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CallbackController extends Controller
{
    public function callback( Request $request )
    {
        Log::info($request->all());

        return response()->json(['status' => 'success'], 200);
    }
}