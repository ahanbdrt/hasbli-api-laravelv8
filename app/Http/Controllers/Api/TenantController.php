<?php

namespace App\Http\Controllers\Api;

use App\Models\tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TenantResource;
use App\Models\jenis_barang_tenant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenant =  DB::table('tenants')
                ->join('jenis_barang_tenants','tenants.id', '=', 'jenis_barang_tenants.id_tenant')
                ->select('tenants.id', 'tenants.nama_tenant','tenants.deskripsi',)
                ->get();
        return response()->json(['data' =>$tenant]);
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
            'nama_tenant'   => 'required',
            'deskripsi'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //update to database
        $tenant->update([
            'nama_tenant'     => $request->nama_tenant,
            'deskripsi'     => $request->deskripsi
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