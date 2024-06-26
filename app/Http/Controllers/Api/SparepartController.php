<?php

namespace App\Http\Controllers\Api;

use App\Models\Sparepart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SparepartController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'tipe' => 'required',
            'jumlah_stock' => 'required',
            'harga' => 'required'
        ]);

        $newsparepart = $request->nama;
        $currentsparepart = Sparepart::where('nama', $newsparepart)->first();

        if($currentsparepart){
            $stock = $currentsparepart->jumlah_stock;
            $newstock = $stock + $request->jumlah_stock;

            $sparepart = $currentsparepart->update(['jumlah_stock' => $newstock]);
            
            return $this->responseOk($sparepart, 'sparepart berhasil ditambah');
        } else {
            $sparepart = Sparepart::create($request->all());


            return $this->responseOk($sparepart, 'sparepart berhasil ditambah');
        }
    }


    public function get()
    {
        $sparepart = Sparepart::all();

        return $this->responseOk($sparepart, 'Ambil data berhasil');
    }

    public function searchSparepart($name)
    {
        
        $sparepart = Sparepart::where(function($query) use ($name) {
        $query->where('nama', 'like', '%'.$name.'%')        
            ->orWhere('tipe', 'like', '%'.$name.'%');        
            })
            ->orderBy('nama')
            ->get();

        if(count($sparepart) > 0) {
            return $this->responseOk($sparepart,'search ditemukan');
        } else {
            return $this->responseError('Data tidak ditemukan');
        }    
    }

    public function update(Request $request, $id) 
    {
        $sparepart = Sparepart::findOrFail($id);
        $sparepart->update($request->all());

        return $this->responseOk($sparepart, 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $sparepart = Sparepart::findOrFail($id);
        $sparepart->delete();

        return $this->responseOk($sparepart, 'Data berhasil dihapus');
    }
}
