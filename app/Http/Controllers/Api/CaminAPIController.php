<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CaminResource;
use App\Models\Camin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CaminAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $camins = CaminResource::collection(Camin::all());

        return response()->json([
            'status' => true,
            'camins' => $camins
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        Camin::create([
            'nama' => $request->nama,
            'angkatan_id' => $request->angkatan_id,
            'nrp' => $request->nrp,
            'jurusan' => $request->jurusan,
        ]);

        return response()->json('', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Camin  $camin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $camin = new CaminResource(Camin::findorfail($id));
        return response()->json([
            'status' => true,
            'camin' => $camin
        ]);
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
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $camin = Camin::findorfail($id);
        
        $camin_data = [
            'nama' => $request->nama,
            'angkatan_id' => $request->angkatan_id,
            'nrp' => $request->nrp,
            'jurusan' => $request->jurusan,
        ];

        $camin->update($camin_data);

        return response()->json('', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Camin  $camin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $camin = Camin::findorfail($id);
        $camin->delete();
    }
}
