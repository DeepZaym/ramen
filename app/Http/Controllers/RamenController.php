<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ramen;

class RamenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rows = Ramen::all();
        return view('ramen.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ramen.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ramen_id' => 'bail|required|unique:tb_ramen',
            'ramen_nama' => 'required' 
        ], 
        [
            'ramen_id.required' => 'ID wajib diisi',
            'ramen_id.unique' => 'ID sudah ada',
            'ramen_nama.required' => 'Nama wajib diisi' 
        ]);

        Ramen::create([
            'ramen_id' => $request->ramen_nim,
            'ramen_nama' => $request->ramen_nama,
            'ramen_deskripsi' => $request->ramen_deskripsi,
            'ramen_harga' => $request->ramen_harga
        ]);

        return redirect('ramen');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        {
            $row = Ramen::find($id);
            return view('ramen.edit', compact('row'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'ramen_id' => 'bail|required',
            'ramen_nama' => 'required'
         ], 
         [
            'ramen_id.required' => 'Id wajib diisi',
            'ramen_id.unique' => 'Nama Tahun sudah ada',
            'ramen_nama.required' => 'Nama wajib diisi'
         ]);
 
         $row = Ramen::findOrFail($id);
         $row->update([
             'ramen_id' => $request->ramen_id,
             'ramen_nama' => $request->ramen_nama,
             'ramen_deskripsi' => $request->ramen_deskripsi,
             'ramen_harga' => $request->ramen_harga
         ]);
 
         return redirect('ramen');
 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $row = Ramen::findOrFail($id); 
        $row->delete(); 

        return redirect('ramen'); 
    }
}
