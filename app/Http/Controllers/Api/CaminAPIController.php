<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CaminResource;
use App\Models\Camin;
use Exception;
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
        ], 200);
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
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 400);
        }

        try{
            Camin::create([
                'nama' => $request->nama,
                'angkatan_id' => $request->angkatan_id,
                'nrp' => $request->nrp,
                'jurusan' => $request->jurusan,
            ]);
            
            return response()->json([
                'status' => true,
                'message' => 'Camin created'
            ], 201);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'error' => 'Conflicting NRP'
            ], 409);
        }

    }

    public function store_multiple(Request $request){
        $caminsData = $request->all();
        $response = [];

        foreach($caminsData as $camin){
            $validator = Validator::make($camin, [
                'nama' => 'required',
                'nrp' => 'required|numeric',
                'jurusan' => 'required',
                'angkatan_id' => 'required',
            ],
            [
                'nama.required' => 'Name can\'t be empty',
                'nrp.required' => 'NRP can\'t be empty',
                'jurusan.required' => 'Jurusan can\'t be empty',
                'angkatan_id' => 'Please choose your angkatan',
            ]);
            
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                $str = 'Validation failed with error(s): ' . implode(", ", $errors);
                array_push($response, [400, $str . '.']);
            }
            else{
                try{
                    Camin::create([
                        'nama' => $camin['nama'],
                        'angkatan_id' => $camin['angkatan_id'],
                        'nrp' => $camin['nrp'],
                        'jurusan' => $camin['jurusan'],
                    ]);
                    array_push($response, [201, 'Camin created']);
                }
                catch(Exception $e){
                    array_push($response, [409, 'Camin not created (Conflicting NRP)']);
                }
            }
            
        }

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Camin  $camin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $camin = new CaminResource(Camin::findorfail($id));
            return response()->json([
                'status' => true,
                'camin' => $camin
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'error' => 'Data camin not found'
            ], 404);
        }
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
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()
            ], 400);
        }

        try{
            $camin = Camin::findorfail($id);
            
            $camin_data = [
                'nama' => $request->nama,
                'angkatan_id' => $request->angkatan_id,
                'nrp' => $request->nrp,
                'jurusan' => $request->jurusan,
            ];
    
            $camin->update($camin_data);
    
            return response()->json([
                'status' => true,
                'message' => 'Updated'
            ], 201);
        }
        catch(Exception $e){
            if($e->getCode() == 0){
                return response()->json([
                    'status' => 'error',
                    'error' => 'Data camin not found'
                ], 404);
            }
            return response()->json([
                'status' => 'error',
                'error' => 'Conflicting NRP'
            ], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Camin  $camin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $camin = Camin::findorfail($id);
            $camin->delete();
            return response()->json([
                'status' => true,
                'message' => 'deleted'
        ], 200);
        }
        catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'error' => 'Data camin not found'
            ], 404);
        }
    }
}
