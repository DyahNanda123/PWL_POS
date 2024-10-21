<?php

namespace App\Http\Controllers;

use App\Models\StokModel;
use App\Models\SupplierModel; // Pastikan ini sesuai dengan nama model yang kamu gunakan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SupplierController extends Controller
{
    // Menampilkan halaman daftar supplier
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];
        $page = (object) [
            'title' => 'Daftar supplier yang terdaftar dalam sistem'
        ];
        $activeMenu = 'supplier'; // set menu yang sedang aktif

        $supplier = StokModel::all(); // ambil data supplier untuk filter

        return view('stok.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        // $supplier = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat');

        // // ftidak perlu ada filter pada supplier
        // // if ($request->supplier_id) {
        // //     $supplier->where('supplier_id', $request->supplier_id);
        // // }

        // return DataTables::of($supplier)
        //     // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        //     ->addIndexColumn()
        //     ->addColumn('aksi', function ($supplier) { // menambahkan kolom aksi
        //         $btn = '<a href="' . url('/supplier/' . $supplier->supplier_id) . '" class="btn btn-info btn-sm">Detail</a> ';
        //         $btn .= '<a href="' . url('/supplier/' . $supplier->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
        //         $btn .= '<form class="d-inline-block" method="POST" action="' .
        //             url('/supplier/' . $supplier->supplier_id) . '">'
        //             . csrf_field() . method_field('DELETE') .
        //             '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm
        //             (\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
        //         return $btn;
        //     })
        //     ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        //     ->make(true);

        $supplier = StokModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat');
        // Filter data supplier berdasarkan supplier_id
        // if ($request->supplier_id) {
        //     $supplier->where('supplier_id', $request->supplier_id);
        // }
        return DataTables::of($supplier)
        ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex) 
        ->addColumn('aksi', function ($supplier) { // menambahkan kolom aksi 
            // $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm">Detail</a> '; //tidak menggunakan ajax
            $btn = '<button onclick="modalAction(\'' . url('/stok/' . $supplier->supplier_id . '/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> '; //menggunakan ajax
            $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $supplier->supplier_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/stok/' . $supplier->supplier_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html 
        ->make(true);
    }

    // Menampilkan halaman form tambah supplier
    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'Supplier', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah supplier baru'
        ];

        $activeMenu = 'supplier'; // set menu yang sedang aktif
        return view('stok.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function create_ajax()
    {
        return view('stok.create_ajax');
    }
    // Menyimpan data supplier baru
    public function store(Request $request)
    {
        $request->validate([
            'supplier_kode' => 'required|string|unique:m_supplier,supplier_kode', // supplier_kode harus unik
            'supplier_nama' => 'required|string|max:100', // supplier_nama harus diisi dan maksimal 100 karakter
            'supplier_alamat' => 'nullable|string|max:255' // supplier_alamat opsional
        ]);

        StokModel::create([
            'supplier_kode' => $request->supplier_kode,
            'supplier_nama' => $request->supplier_nama,
            'supplier_alamat' => $request->supplier_alamat,
        ]);

        return redirect('/stok')->with('success', 'Data supplier berhasil disimpan');
    }

    public function store_ajax(Request $request)
    {
        // cek apakah request berupa ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
            'supplier_kode' => 'required|string|unique:m_supplier,supplier_kode', // supplier_kode harus unik
            'supplier_nama' => 'required|string|max:100', // supplier_nama harus diisi dan maksimal 100 karakter
            'supplier_alamat' => 'nullable|string|max:255' // supplier_alamat opsional
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status'    => false, // response status, false: error/gagal, true: berhasil
                    'message'   => 'Validasi Gagal',
                    'msgField'  => $validator->errors(), // pesan error validasi
                ]);
            }
            StokModel::create($request->all());
            return response()->json([
                'status'    => true,
                'message'   => 'Data level berhasil disimpan'
            ]);
        }
        redirect('/');
    }

    // Menampilkan detail supplier
    public function show(string $id)
    {
        $supplier = StokModel::find($id);

        if (!$supplier) {
            return redirect('/stok')->with('error', 'Data supplier tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Supplier',
            'list' => ['Home', 'Supplier', 'Detail']
        ];
        $page = (object) [
            'title' => 'Detail supplier'
        ];
        $activeMenu = 'stok'; // set menu yang sedang aktif
        return view('stok.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    public function show_ajax(string $id)
    {
        $supplier = StokModel::find($id);

        if (!$supplier) {
            return response()->json([
                'status' => false,
                'message' => 'Data level tidak ditemukan'
            ]);
        }

        return view('stok.show_ajax', ['supplier' => $supplier]);
    }

    // Menampilkan halaman form edit supplier
    public function edit(string $id)
    {
        $supplier = StokModel::find($id);

        if (!$supplier) {
            return redirect('/stok')->with('error', 'Data supplier tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Edit Supplier',
            'list' => ['Home', 'Supplier', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit supplier'
        ];

        $activeMenu = 'supplier'; // set menu yang sedang aktif
        return view('stok.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    public function edit_ajax(string $id)
    {
        $supplier = StokModel::find($id);
        return view('stok.edit_ajax', ['supplier' => $supplier]);
    }

    // Menyimpan perubahan data supplier
    public function update(Request $request, string $id)
    {
        $request->validate([
            'supplier_kode' => 'required|string|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
            'supplier_nama' => 'required|string|max:100',
            'supplier_alamat' => 'nullable|string|max:255'
        ]);

        $supplier = StokModel::find($id);

        if (!$supplier) {
            return redirect('/stok')->with('error', 'Data supplier tidak ditemukan');
        }

        $supplier->update([
            'supplier_kode' => $request->supplier_kode,
            'supplier_nama' => $request->supplier_nama,
            'supplier_alamat' => $request->supplier_alamat
        ]);

        return redirect('/stok')->with('success', 'Data supplier berhasil diubah');
    }

    public function update_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
            'supplier_kode' => 'required|string|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
            'supplier_nama' => 'required|string|max:100',
            'supplier_alamat' => 'nullable|string|max:255'
            ];
            // use Illuminate\Support\Facades\Validator;
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false, // respon json, true: berhasil, false: gagal
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors() // menunjukkan field mana yang error
                ]);
            }
            $check = StokModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $supplier = StokModel::find($id);
        return view('stok.confirm_ajax', ['supplier' => $supplier]);
    }

    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $supplier = StokModel::find($id);
            if ($supplier) {
                $supplier->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    // Menghapus data supplier
    public function destroy(string $id)
    {
        $supplier = StokModel::find($id);

        if (!$supplier) {
            return redirect('/stok')->with('error', 'Data supplier tidak ditemukan');
        }

        try {
            $supplier->delete(); // Hapus data supplier
            return redirect('/stok')->with('success', 'Data supplier berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/stok')->with('error', 'Data supplier gagal dihapus karena masih terkait dengan data lain');
        }
    }

    public function import()
    {
        return view('stok.import');
    }
    
    public function import_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_stok' => ['required', 'mimes:xlsx', 'max:1024'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status'   => false,
                    'message'  => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $file = $request->file('file_stok'); // ambil file dari request
            $reader = IOFactory::createReader('Xlsx'); //load reader file excel
            $reader->setReadDataOnly(true); // membaca data
            $spreadsheet = $reader->load($file->getRealPath()); // load file excel
            $sheet = $spreadsheet->getActiveSheet(); // amengambil sheet aktif
            $data = $sheet->toArray(null, false, true, true); //ambil data excel

            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        $insert[] = [
                            'supplier_id'  => $value['A'],
                            'supplier_kode'  => $value['B'],
                            'supplier_nama'  => $value['C'],
                            'supplier_alamat'  => $value['D'],
                            'created_at'   => now(),
                        ];
                    }
                }
            }

            if (count($insert) > 0) {
                stokModel::insertOrIgnore($insert);
            }

            return response()->json([
                'status'  => true,
                'message' => 'Data berhasil diimport'
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'Tidak ada data yang diimport'
            ]);
        }
        return redirect('/');
    }
    public function export_excel()
    {
        // ambil data barang yang akan di export
        $level = stokModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat')
            ->get();

        // load library excel
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet(); // ambil sheet yang aktif
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Kode Supplier');
        $sheet->setCellValue('C1', 'Nama Supplier');
        $sheet->setCellValue('D1', 'Alamat Supplier');

        $sheet->getStyle('A1:F1')->getFont()->setBold(true); // bold header

        $supplier_id = 1; // nomor data dimulai dari 1
        $baris = 2; // baris data dimulai dari baris ke 2
        foreach ($level as $key => $value) {
            $sheet->setCellValue('A' . $baris, $supplier_id);
            $sheet->setCellValue('B' . $baris, $value->supplier_kode);
            $sheet->setCellValue('C' . $baris, $value->supplier_nama);
            $sheet->setCellValue('D' . $baris, $value->supplier_alamat);
            $baris++;
            $supplier_id++;
        }

        foreach (range('A', 'D') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true); // set auto size untuk kolom
        }
        
        $sheet->setTitle('Data Supplier'); // set title sheet
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data Supplier ' . date('Y-m-d H:i:s') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified:' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');
        $writer->save('php://output');
        exit;
    }

    public function export_pdf()
    {
        $stok = stokModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat')
            ->get();
        // use Barryvdh\DomPDF\Facade\Pdf;
        $pdf = Pdf::loadView('stok.export_pdf', ['stok' => $stok]);
        $pdf->setPaper('a4', 'portrait'); // set ukuran kertas dan orientasi
        $pdf->setOption("isRemoteEnabled", true); // set true jika ada gambar dari url $pdf->render();
        return $pdf->stream('Data Supplier' . date('Y-m-d H:i:s') . '.pdf');
    }
}
