<?php

namespace App\Http\Controllers\Api;

use App\Models\jenis_user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Jenis_userResource;
use Illuminate\Support\Facades\Validator;

class Jenis_userController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new Jenis_userResource(jenis_user::all());
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
            'jenis_user'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $jenis_user = jenis_user::create([
            'jenis_user'     => $request->jenis_user
        ]);

        return new Jenis_userResource($jenis_user);
    }

    /**
     * Display the specified resource.
     *
     * @param  jenis_user $jenis_user
     * @return \Illuminate\Http\Response
     */
    public function show(jenis_user $jenis_user)
    {
        return new Jenis_userResource($jenis_user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  jenis_user $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jenis_user $jenis_user)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'jenis_user'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //update to database
        $jenis_user->update([
            'jenis_user'     => $request->jenis_user
        ]);

        return new Jenis_userResource($jenis_user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  jenis_user $jenis_user
     * @return \Illuminate\Http\Response
     */
    public function destroy(jenis_user $jenis_user)
    {
        $jenis_user->delete();

        return new Jenis_userResource($jenis_user);
    }
}
