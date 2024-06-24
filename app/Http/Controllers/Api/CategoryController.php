<?php

namespace App\Http\Controllers\Api;

use App\Models\CategoryService;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function get() {
        $category = CategoryService::all();

        return $this->responseOk($category);
    }

    public function add(Request $request) {
        $request->validate([
            'nama' => 'required',
            'keterangan' => 'required'
        ]);

        $category = CategoryService::create($request->all());

        return $this->responseOk($category, 'data berhasil ditamah');
    }

    public function delete($id) {
        $category = CategoryService::where('id', $id)->get();

        $category->delete();

        return $this->responseOk($category, 'data berhasil dihapus');
    }
}
