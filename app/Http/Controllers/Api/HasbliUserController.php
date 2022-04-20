<?php

namespace App\Http\Controllers\Api;



use App\Http\Controllers\Controller;
use App\Http\Resources\hasbliUserResource;
use Illuminate\Support\Facades\Validator;
use App\Models\hasbli_user;
use Illuminate\Http\Request;

class HasbliUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new hasbliUserResource(hasbli_user::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'username'   => 'required',
            'password'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $user = hasbli_user::create([
            'username'     => $request->username,
            'password'     => md5($request->password)
        ]);

        return new hasbliUserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\hasbli_user  $hasbli_user
     * @return \Illuminate\Http\Response
     */
    public function show(hasbli_user $hasbli_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\hasbli_user  $hasbli_user
     * @return \Illuminate\Http\Response
     */
    public function edit(hasbli_user $hasbli_user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\hasbli_user  $hasbli_user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, hasbli_user $user)
    {

        // dd($request);
         //set validation
        //  $validator = Validator::make($request->all(), [
        //     'username'   => 'required',
        //     'password'   => 'required'
        // ]);

        // //response error validation
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 400);
        // }

        //update to database
        $user->update([
            'username'     => $request->username,
            'password'     => md5($request->password)
        ]);

        return new hasbliUserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\hasbli_user  $hasbli_user
     * @return \Illuminate\Http\Response
     */
    public function destroy(hasbli_user $user)
    {
        // dd($user);
        $user->delete();
        
        return new hasbliUserResource($user);
    }
}
