<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\ServiceResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Serviceitem;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Return_;

class ServiceController extends Controller
{
    public function createService(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'home_pickup' => 'required',
            'no_polisi' => 'required',
            'mobil' => 'required',
            'jenis_service' => 'required',
        ]);

        $request['user_id'] = Auth::user()->id;
        $tanggal = Service::where('tanggal',$request->tanggal)->first();
        $jumlahTanggal = Serviceitem::where('tanggal', $request->tanggal)->count();

        if($jumlahTanggal == 5){
            return $this->responseError('Antrian sudah penuh', 200);
        }

        if(!$tanggal){
            Service::create($request->all());
        }

        $service = Serviceitem::create($request->all());

        return $this->responseOk($service, 'Data berhasil ditambah');

    }    

    public function showByUser()
    {
        $service = Serviceitem::where('user_id', Auth::user()->id)->get();

        return $this->responseOk($service);
    }

    public function showByTanggal()
    {
        $service = Service::all();

        return $this->responseOk(ServiceResource::collection($service->loadMissing('serviceByTanggal')));
    }
}
