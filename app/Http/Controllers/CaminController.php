<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use App\Models\Camin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CaminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $camins = Camin::all();
        return view('camin.index', compact('camins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $angkatans = Angkatan::all();
        return view('camin.create', compact('angkatans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nrp' => 'required|numeric',
            'jurusan' => 'required',
            'angkatan_id' => 'required',
        ],
        [
            'nama.required' => 'Name can\'t be empty!',
            'nrp.required' => 'NRP can\'t be empty!',
            'jurusan.required' => 'Jurusan can\'t be empty!',
            'angkatan_id' => 'Please choose your angkatan',
        ]);

        Camin::create([
            'nama' => $request->nama,
            'angkatan_id' => $request->angkatan_id,
            'nrp' => $request->nrp,
            'jurusan' => $request->jurusan,
            ]);

        return redirect('/camin');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Camin  $camin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $camins = Camin::findorfail($id);
        return view('camin.show', compact('camins'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Camin  $camin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $camins = Camin::findorfail($id);
        $angkatans = Angkatan::all();
        return view('camin.edit', compact('camins', 'angkatans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Camin  $camin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'nrp' => 'required|numeric',
            'jurusan' => 'required',
            'angkatan_id' => 'required',
        ],
        [
            'nama.required' => 'Name can\'t be empty!',
            'nrp.required' => 'NRP can\'t be empty!',
            'jurusan.required' => 'Jurusan can\'t be empty!',
            'angkatan_id' => 'Please choose your angkatan',
        ]);

        $camins = Camin::findorfail($id);
        
        $camin_data = [
            'nama' => $request->nama,
            'angkatan_id' => $request->angkatan_id,
            'nrp' => $request->nrp,
            'jurusan' => $request->jurusan,
        ];

        $camins->update($camin_data);

        return view('camin.show', compact('camins'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Camin  $camin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $camins = Camin::findorfail($id);
        $camins->delete();

        return redirect('/camin');
    }
}
