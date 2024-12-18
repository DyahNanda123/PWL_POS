<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function __invoke(Request $request)
    {
        $action = $request->get('action', 'index'); // Tentukan action default sebagai 'index'

        switch ($action) {
            case 'index':
                return $this->index();
            case 'store':
                return $this->store($request);
            case 'show':
                return $this->show($request->get('id'));
            case 'update':
                return $this->update($request, $request->get('id'));
            case 'destroy':
                return $this->destroy($request->get('id'));
            default:
                return response()->json(['error' => 'Aksi tidak valid'], 400);
        }
    }

    protected function index()
    {
        $barang = BarangModel::all();
        return response()->json($barang, 200);
    }

    protected function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barang_kode' => 'required|min:1|max:20|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'kategori_id' => 'required|integer|exists:m_kategori,kategori_id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path('images'), $imageName);
        }

        $barang = BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'deskripsi' => $request->deskripsi,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'kategori_id' => $request->kategori_id,
            'image' => $imageName,
        ]);

        return response()->json([
            'success' => true,
            'data' => $barang,
        ], 201);
    }

    protected function show($id)
    {
        $barang = BarangModel::find($id);

        if (!$barang) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($barang, 200);
    }

    protected function update(Request $request, $id)
    {
        $barang = BarangModel::find($id);

        if (!$barang) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $validator = Validator::make($request->all(), [
            'barang_kode' => 'sometimes|required|min:1|max:20|unique:m_barang,barang_kode,' . $barang->id,
            'barang_nama' => 'sometimes|required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga_beli' => 'sometimes|required|numeric',
            'harga_jual' => 'sometimes|required|numeric',
            'kategori_id' => 'sometimes|required|integer|exists:m_kategori,kategori_id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if ($request->hasFile('image')) {
            if ($barang->image && file_exists(public_path('images/' . $barang->image))) {
                unlink(public_path('images/' . $barang->image));
            }
            $image = $request->file('image');
            $imageName = $image->hashName();
            $image->move(public_path('images'), $imageName);
            $barang->image = $imageName;
        }

        $barang->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $barang,
        ], 200);
    }

    protected function destroy($id)
    {
        $barang = BarangModel::find($id);

        if (!$barang) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        if ($barang->image && file_exists(public_path('images/' . $barang->image))) {
            unlink(public_path('images/' . $barang->image));
        }

        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus',
        ], 200);
    }
}
