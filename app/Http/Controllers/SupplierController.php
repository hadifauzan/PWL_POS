<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index(){
        $breadcrumb = (object)[
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];
    
        $page = (object)[
            'title' => 'Daftar supplier yang terdaftar dalam sistem'
        ];
    
        $activeMenu = 'supplier'; //set menu yang sedang aktif

        $supplier = SupplierModel::all(); //ambil data supplier untuk filter supplier
    
        return view('supplier.index',['breadcrumb'=>$breadcrumb, 'page' => $page, 'supplier' => $supplier,'activeMenu'=>$activeMenu]);
    }
    
    // Ambil data supplier dalam bentuk json untuk datatables
    public function list(Request $request)
    {
        $suppliers = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_nama', 'supplier_alamat')
            ->with('supplier');
        
        //Filter data supplier berdasarkan supplier_id
        if ($request->supplier_id) {
            $suppliers->where('supplier_id', $request->supplier_id);
        }

        return DataTables::of($suppliers)
        // menambahkan kolom index / no urut (default supplier_nama kolom: DT_RowIndex)
        ->addIndexColumn()
        ->addColumn('aksi', function ($supplier) { // menambahkan kolom aksi
            $btn = '<a href="'.url('/supplier/' . $supplier->supplier_id).'" class="btn btn-info btn-sm">Detail</a> ';
            // $btn .= '<a href="'.url('/supplier/' . $supplier->supplier_id. '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            // $btn .= '<form class="d-inline-block" method="POST" action="'. url('/supplier/'.$supplier->supplier_id).'">'
            // . csrf_field() . method_field('DELETE') .
            // '<button type="submit" class="btn btn-danger btn-sm" onclick="return
            // confirm(\'Apakah Anda yakit menghapus data ini?\');">Hapus</button></form>';
            
            $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
            $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $supplier->supplier_id . '/show_ajax') . '\')" class="btn btn-primary btn-sm">Detail Ajax</button> ';

            return $btn;
        })
        ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
        ->make(true);
    }

    //Menampilkan halaman form tambah supplier
    public function create(){
        $breadcrumb = (object)[
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'Supplier', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah supplier baru'
        ];
        $supplier = SupplierModel::all(); //ambil data supplier untuk ditampilkan di form
        $activeMenu = 'supplier'; //set menu yang sedang aktif
        return view('supplier.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $supplier, 'activeMenu' => $activeMenu]);
    }

    //Menyimpan data supplier baru
    public function store(Request $request){
        $request -> validate([
            //supplier_kode harus diisi, berupa string, minimal 3 karakter, dan bernilai unik di tabel m_supplier kolom supplier_kode
            'supplier_kode' => 'required|string|min:3|unique:m_supplier,supplier_kode',
            'supplier_nama' => 'required|string|max:100', //supplier_nama harus diisi, berupa string, dan maksimal 100 karakter
            'supplier_alamat' => 'required|string', //supplier_nama harus diisi, berupa string
        ]);
        SupplierModel::create([
            'supplier_kode' => $request->supplier_kode,
            'supplier_nama' => $request -> supplier_nama,
            'supplier_alamat' => $request -> supplier_alamat,
            'supplier_id' => $request->supplier_id
        ]);
        return redirect('/supplier') -> with('success', 'Data supplier berhasil disimpan');
    }
    
    //Menampilkan detail supplier
    public function show(String $id){
        $supplier = SupplierModel::with('supplier') -> find($id);
        $breadcrumb = (object)[
            'title' => 'Detail Supplier',
            'list' => ['Home', 'Supplier', 'Detail']
        ];
        $page = (object)[
            'title' => 'Detail supplier'
        ];
        $activeMenu = 'supplier'; //set menu yang sedang aktif
        return view('supplier.show', ['breadcrumb' => $breadcrumb, 'page'=>$page, 'supplier'=>$supplier, 'activeMenu'=>$activeMenu]);
    }

    //Menampilkan halaman form edit supplier
    public function edit(string $id){
        $supplier = SupplierModel::find($id);
        $breadcrumb = (object)[
            'title' => 'Edit supplier',
            'list' => ['Home', 'Supplier', 'Edit']
        ];
        $page = (object)[
            'title' => 'Edit Supplier'
        ];
        $activeMenu = 'supplier';
        return view ('supplier.edit', ['breadcrumb'=>$breadcrumb, 'page'=>$page, 'supplier'=>$supplier, 'activeMenu'=>$activeMenu]);
    }
    //Menyimpan perubahan data supplier
    public function update(Request $request, string $id)
    {
        $request->validate([
            'supplier_kode' => 'required|string|min:3|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
            'supplier_nama' => 'required|string|max:100',
            'supplier_alamat' => 'required|string', //supplier_nama harus diisi, berupa string
            // 'supplier_id' => 'required|integer'
        ]);
        SupplierModel::find($id)->update([
            'supplier_kode' => $request->supplier_kode,
            'supplier_nama' => $request->supplier_nama,
            'supplier_alamat' => $request->supplier_alamat,
            'supplier_id' => $request->supplier_id
        ]);
        return redirect('/supplier')->with('success' . "data supplier berhasil diubah");
    }

    //Mengapus data supplier
    public function destroy(string $id)
    {
        $check = SupplierModel::find($id);
        if (!$check) {
            return redirect('/supplier')->with('error','Data supplier tidak ditemukan');
        }
        try{
            supplierModel::destroy($id);
            return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/supplier')->with('error','Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function create_ajax()
    {
        return view('supplier.create_ajax');
    }
    public function store_ajax(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'supplier_kode' => 'required|min:2|max:5',
            'supplier_nama' => 'required|min:3|max:100',
            'supplier_alamat' => 'required|min:5|max:255' // Menyesuaikan field alamat supplier
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msgField' => $validator->errors()
            ]);
        }
        $supplier = new SupplierModel();
        $supplier->supplier_kode = $request->supplier_kode;
        $supplier->supplier_nama = $request->supplier_nama;
        $supplier->supplier_alamat = $request->supplier_alamat; // Menyimpan alamat supplier
        $supplier->save();
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil disimpan'
        ]);
    }

    public function edit_ajax($id)
    {
        $supplier = SupplierModel::find($id);
        return view('supplier.edit_ajax', ['supplier' => $supplier]);
    }
    public function update_ajax(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'supplier_kode' => 'required|min:2|max:5',
            'supplier_nama' => 'required|min:3|max:100',
            'supplier_alamat' => 'required|min:5|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msgField' => $validator->errors()
            ]);
        }
        $supplier = SupplierModel::find($id);
        if ($supplier) {
            $supplier->supplier_kode = $request->supplier_kode;
            $supplier->supplier_nama = $request->supplier_nama;
            $supplier->supplier_alamat = $request->supplier_alamat;
            $supplier->save();
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diperbarui'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }
    }
    public function confirm_ajax(string $id)
    {
        $supplier = SupplierModel::find($id);
        return view('supplier.confirm_ajax', ['supplier' => $supplier]);
    }
    public function delete_ajax(Request $request, $id)
    {
        // cek apakah request dari ajax
        if ($request->ajax() || $request->wantsJson()) {
            $level = SupplierModel::find($id);
            if ($level) {
                $level->delete();
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
    // Menampilkan halaman detail Supllier ajax
    public function show_ajax($id)
    {
        $supplier = SupplierModel::find($id); // Mengambil data supplier berdasarkan ID
        if (!$supplier) {
            return response()->json(['status' => false, 'message' => 'Supplier tidak ditemukan']);
        }
    
        return view('supplier.show_ajax', compact('supplier')); // Mengirimkan data supplier ke view
    }
}