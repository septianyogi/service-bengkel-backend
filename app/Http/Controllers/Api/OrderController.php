<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Orderitem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sparepart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function createOrder(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required',
            'jumlah' => 'required',
        ]);

        $user = Auth::user()->id;
        $request['user_id'] = $user;
        $request['tanggal'] = Carbon::now()->format('d-m-Y');
        $request['status'] = 'menunggu pembayaran';
        $request['sparepart_id'] = $id;

        $sparepart = Sparepart::findOrFail($id);

        $harga = $sparepart->harga;
        $request['harga'] = $harga;

        $totalHarga = $request->jumlah * $harga;
        $request['total_harga'] = $totalHarga;

        $order = Order::where('id', $user)->first();

        if(!$order){
            Order::create($request->all());
        }

        $orderitem = Orderitem::create($request->all());

        return $this->responseOk($orderitem, 'Data berhasil ditambahkan');
    }

    public function pembayaran(Request $request, $id)
    {
        if($request->file){
            $filename = $this->generateRandomString();
            $extension = $request->file->extension();
            $imageName = $filename.'.'.$extension;

            Storage::putFileAs('image', $request->file, $filename.'.'.$extension);
        }

        $request['pembayaran'] = $imageName;
        $request['status'] = 'sudah membayar';
        $ordertitem = Orderitem::where('id', $id)->first();
        $ordertitem->update($request->all());

        return $this->responseOk($ordertitem, 'file berhasil diupload');
    }

    public function konfirmasiOrder(Request $request, $id)
    {
        $request['status'] = 'pembayaran terkonfirmasi';
        $orderitem = Orderitem::where('id', $id)->first();
        $orderitem->update($request->all());
        
        return $this->responseOk($orderitem, 'Data berhasil diupdate');
    }

    public function orderDikirim(Request $request, $id)
    {
        $request['status'] = 'order dikirim';
        $orderitem = Orderitem::where('id', $id)->first();
        $orderitem->update($request->all());
        
        return $this->responseOk($orderitem, 'Data berhasil diupdate');
    }

    function generateRandomString($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
