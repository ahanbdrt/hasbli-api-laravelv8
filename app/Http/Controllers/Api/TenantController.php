<?php

namespace App\Http\Controllers\Api;

use App\Models\tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;
use Illuminate\Support\Facades\Validator;
use DB;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result =[];
        $tenant =  DB::select('select * from tenants');
       
        
        return response()->json(['data' => $tenant]);
        // return new TenantResource(tenant::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd("ayam goreng penyetan, + es teh");
        // dd("asik");

        //         dump("ini isi request all");
        //         dump($request->all());
        // dump("klo ini hanya isinya nama_tenant");
        // dump($request->nama_tenant);    
        //         die;



        //set validation
        $validator = Validator::make($request->all(), [
            'nama_tenant'   => 'required',
            'deskripsi'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $tenant = tenant::create([
            'nama_tenant'     => $request->nama_tenant,
            'deskripsi'     => $request->deskripsi
        ]);

        return new TenantResource($tenant);
    }

    /**
     * Display the specified resource.
     *
     * @param  tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(tenant $tenant)
    {
        return new TenantResource($tenant);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, tenant $tenant)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'nama_tenant'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //update to database
        $tenant->update([
            'nama_tenant'     => $request->nama_tenant
        ]);

        return new TenantResource($tenant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  tenant $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(tenant $tenant)
    {
        $tenant->delete();

        return new TenantResource($tenant);
    }
}
