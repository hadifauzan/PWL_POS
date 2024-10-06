<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index() {

    $breadcrumb = (object)[
        'title' => 'Daftar Kategori',
        'list' => ['Home', 'Kategori']
    ];

    $page = (object)[
        'title' => 'Daftar kategori yang terdaftar dalam sistem'
    ];

    $activeMenu = 'kategori'; //set menu yang sedang aktif
    $kategori = KategoriModel::all(); // Ambil data kategori untuk filter kategori
    
    return view('kategori.index', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'kategori' =>$kategori,
        'activeMenu' => $activeMenu
    ]);
}

// Ambil data kategori dalam bentuk JSON untuk datatables
public function list(Request $request)
{
    $kategoris = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');
    
    // Filter data kategori berdasarkan kategori_id
    if ($request->kategori_id) {
        $kategoris->where('kategori_id', $request->kategori_id);
    }

    return DataTables::of($kategoris)
        ->addIndexColumn() // Menambahkan kolom index / no urut
        ->addColumn('aksi', function ($kategori) { // Menambahkan kolom aksi
            $btn = '<a href="'.url('/kategori/' . $kategori->kategori_id).'" class="btn btn-info btn-sm">Detail</a> ';
            // $btn .= '<a href="'.url('/kategori/' . $kategori->kategori_id. '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            // $btn .= '<form class="d-inline-block" method="POST" action="'. url('/kategori/'.$kategori->kategori_id).'">'
            //     . csrf_field() . method_field('DELETE') .
            //     '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/kategori/' . $kategori->kategori_id . '/show_ajax') . '\')" class="btn btn-primary btn-sm">Detail Ajax</button> ';

            return $btn;
        })
        ->rawColumns(['aksi']) // Kolom aksi adalah HTML
        ->make(true);
}

// Menampilkan halaman form tambah kategori
public function create() 
{
    $breadcrumb = (object)[
        'title' => 'Tambah Kategori',
        'list' => ['Home', 'Kategori', 'Tambah']
    ];
    
    $page = (object)[
        'title' => 'Tambah kategori baru'
    ];
    
    $kategori = KategoriModel::all(); // Ambil data kategori untuk ditampilkan di form
    $activeMenu = 'kategori'; // Set menu yang sedang aktif

    return view('kategori.create', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'kategori' => $kategori,
        'activeMenu' => $activeMenu
    ]);
}

    public function create_ajax()
    {
        return view('kategori.create_ajax');
    }

// Menyimpan data kategori baru
public function store(Request $request)
{
    $request->validate([
        'kategori_kode' => 'required|string|min:3|unique:m_kategori,kategori_kode',
        'kategori_nama' => 'required|string|max:100'
    ]);

    KategoriModel::create([
        'kategori_kode' => $request->kategori_kode,
        'kategori_nama' => $request->kategori_nama
    ]);

    return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan');
}

// Menampilkan detail kategori
public function show(String $id)
{
    $kategori = KategoriModel::find($id);

    if (!$kategori) {
        return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
    }

    $breadcrumb = (object)[
        'title' => 'Detail kategori',
        'list' => ['Home', 'Kategori', 'Detail']
    ];

    $page = (object)[
        'title' => 'Detail kategori'
    ];
    
    $activeMenu = 'kategori'; // Set menu yang sedang aktif

    return view('kategori.show', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'kategori' => $kategori,
        'activeMenu' => $activeMenu
    ]);
}

// Menampilkan halaman form edit kategori
public function edit(string $id)
{
    $kategori = KategoriModel::find($id);

    if (!$kategori) {
        return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
    }

    $breadcrumb = (object)[
        'title' => 'Edit kategori',
        'list' => ['Home', 'Kategori', 'Edit']
    ];
    
    $page = (object)[
        'title' => 'Edit kategori'
    ];

    $activeMenu = 'kategori';

    return view('kategori.edit', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'kategori' => $kategori,
        'activeMenu' => $activeMenu
    ]);
}

// Menyimpan perubahan data kategori
public function update(Request $request, string $id)
{
    $request->validate([
        'kategori_kode' => 'required|string|min:3|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
        'kategori_nama' => 'required|string|max:100'
    ]);

    $kategori = KategoriModel::find($id);

    if (!$kategori) {
        return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
    }

    $kategori->update([
        'kategori_kode' => $request->kategori_kode,
        'kategori_nama' => $request->kategori_nama
    ]);

    return redirect('/kategori')->with('success', 'Data kategori berhasil diubah');
}

// Menghapus data kategori
public function destroy(string $id)
{
    $kategori = KategoriModel::find($id);

    if (!$kategori) {
        return redirect('/kategori')->with('error', 'Data kategori tidak ditemukan');
    }

    try {
        KategoriModel::destroy($id);
        return redirect('/kategori')->with('success', 'Data kategori berhasil dihapus');
    } catch (\Illuminate\Database\QueryException $e) {
        return redirect('/kategori')->with('error', 'Data kategori gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
    }
}

public function store_ajax(Request $request)
{
    // cek apakah request berupa ajax
    if ($request->ajax() || $request->wantsJson()) {
        $rules = [
            'kategori_kode'    => 'required|string|min:3|unique:m_kategori,kategori_kode',
            'kategori_nama'    => 'required|string|max:100',
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
        KategoriModel::create($request->all());
        return response()->json([
            'status'    => true,
            'message'   => 'Data kategori berhasil disimpan'
        ]);
    }
    redirect('/');
}

public function edit_ajax(string $id)
{
    $kategori = KategoriModel::find($id);
    // Jika level tidak ditemukan
    if (!$kategori) {
        return response()->json([
            'status' => false,
            'message' => 'Data level tidak ditemukan'
        ]);
    }
    return view('kategori.edit_ajax', ['kategori' => $kategori]);
}
public function update_ajax(Request $request, $id)
{
    if ($request->ajax() || $request->wantsJson()) {
        $rules = [
            'kategori_kode' => 'required|string|max:20|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
            'kategori_nama' => 'required|string|max:100',
        ];
        // Validasi data input
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal.',
                'msgField' => $validator->errors()
            ]);
        }
        $kategori = KategoriModel::find($id);
        if ($kategori) {
            $kategori->update($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Data kategori berhasil diupdate'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data kategori tidak ditemukan'
            ]);
        }
    }
    return redirect('/');
}
public function show_ajax(string $id)
{
    $kategori = KategoriModel::find($id);
    if ($kategori) {
        // Tampilkan halaman show_ajax dengan data kategori
        return view('kategori.show_ajax', ['kategori' => $kategori]);
    } else {
        // Tampilkan pesan kesalahan jika kategori tidak ditemukan
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan'
        ]);
    }
}
public function confirm_ajax(string $id)
{
    $kategori = KategoriModel::find($id);
    return view('kategori.confirm_ajax', ['kategori' => $kategori]);
}
public function delete_ajax(Request $request, $id)
{
    // cek apakah request dari ajax
    if ($request->ajax() || $request->wantsJson()) {
        $kategori = KategoriModel::find($id);
        if ($kategori) {
            $kategori->delete();
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

}
