<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cars;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function add(Request $request) {
        $request->validate([
            'nomor_polisi' => 'required',
            'mobil' => 'required',
        ]);

        $request['user_id'] = Auth::user()->id;
        
        $car = Cars::create($request->all());

        return $this->responseOk($car, 'Data berhasil ditambah');
    }

    public function get() {
        $id = Auth::user()->id;
        $car = Cars::where('user_id', $id)->get();

        return $this->responseOk($car);
    }
}
