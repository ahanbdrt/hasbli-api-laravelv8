<?php

namespace App\Http\Controllers\Api;

use App\Models\hasblidb_example;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExampleResource;
use Illuminate\Support\Facades\Validator;

class ExampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ExampleResource(hasblidb_example::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'provinsi'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $example = hasblidb_example::create([
            'provinsi'     => $request->provinsi
        ]);

        return new ExampleResource($example);
    }

    /**
     * Display the specified resource.
     *
     * @param  hasblidb_example $example
     * @return \Illuminate\Http\Response
     */
    public function show(hasblidb_example $example)
    {
        return new ExampleResource($example);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  hasblidb_example $example
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, hasblidb_example $example)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'provinsi'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //update to database
        $example->update([
            'provinsi'     => $request->provinsi
        ]);

        return new ExampleResource($example);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  hasblidb_example $example
     * @return \Illuminate\Http\Response
     */
    public function destroy(hasblidb_example $example)
    {
        $example->delete();
        
        return new ExampleResource($example);
    }
}
