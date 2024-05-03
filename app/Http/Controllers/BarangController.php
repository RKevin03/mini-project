<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\barang;
use App\Models\satuan;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = 'barang List';
        $barang = barang::all();
        return view('barang.index', [
            'pageTitle' => $pageTitle,
            'barang' => $barang
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageTitle = 'Create barang';
        // ELOQUENT
        $satuan = satuan::all();
        return view('barang.create', compact('pageTitle', 'satuan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'harga_barang' => 'required|email',
            'deskripsi_barang' => 'required|numeric',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // INSERT QUERY
        DB::table('barang')->insert([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'harga_barang' => $request->harga_barang,
            'deskripsi_barang' => $request->deskripsi_barang,
        ]);
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pageTitle = 'barang Detail';
        // ELOQUENT
        $barang = barang::find($id);
        return view('barang.show', compact('pageTitle', 'barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pageTitle = 'Edit barang';
        // ELOQUENT
        $satuan = satuan::all();
        $barang = barang::find($id);
        return view('barang.edit', compact(
            'pageTitle',
            'barang','satuan'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
        ];
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
        ], $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // ELOQUENT
        $barang = barang::find($id);
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barrang;
        $barang->harga_barang = $request->harga_barang;
        $barang->deskripsi_barang = $request->deskripsi_barang;
        $barang->save();
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // ELOQUENT
        barang::find($id)->delete();
        return redirect()->route('employees.index');
    }
}
