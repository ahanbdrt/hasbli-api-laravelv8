<?php

namespace App\Http\Controllers\Api;

use App\Models\jenis_barang_tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\JenisBarangTenantResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class JenisBarangTenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jenis_barang_tenant =  DB::select('SELECT * from jenis_barang_tenants');
        return response()->json(['data' => $jenis_barang_tenant]);
        //
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
            'jenis_barang'   => 'required',
            'id_tenant'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $jenis_barang_tenant = jenis_barang_tenant::create([
            'jenis_barang'     => $request->jenis_barang,
            'id_tenant'     => $request->id_tenant
        ]);

        return new JenisBarangTenantResource($jenis_barang_tenant);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(jenis_barang_tenant $jenis_barang_tenant)
    {
        return new JenisBarangTenantResource($jenis_barang_tenant);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, jenis_barang_tenant $jenis_barang_tenant)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'jenis_barang'   => 'required',
            'id_tenant'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //update to database
        $jenis_barang_tenant->update([
            'jenis_barang'     => $request->jenis_barang,
            'id_tenant'     => $request->id_tenant
        ]);

        return new JenisBarangTenantResource($jenis_barang_tenant);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(jenis_barang_tenant $jenis_barang_tenant)
    {
        $jenis_barang_tenant->delete();
        
        return new JenisBarangTenantResource($jenis_barang_tenant);
    }
}