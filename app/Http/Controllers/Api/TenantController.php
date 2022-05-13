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
        $result = [];
        $tenant =  DB::table('tenants')
            ->join('jenis_barang_tenants', 'tenants.id', '=', 'jenis_barang_tenants.id_tenant')
            ->select('*')
            ->orderBy('jenis_barang_tenants.id_tenant')
            ->get();

        foreach ($tenant as $key => $sub) {
            $tenantJb = DB::table('tenants')
                ->join('jenis_barang_tenants', 'tenants.id', '=', 'jenis_barang_tenants.id_tenant')
                ->select('*')
                ->orderBy('jenis_barang_tenants.id_tenant')
                ->where('jenis_barang_tenants.id', '=', $sub->id)
                // ->where('tenants.id', '=', $sub->id_tenant)
                ->get();
            $result[$key]['id'] = $sub->id;
            $result[$key]['nama_tenant'] = $sub->nama_tenant;
            $result[$key]['deskripsi'] = $sub->deskripsi;
            $subCat = array();
            foreach ($tenantJb as $k => $subcat) {
                $jenisBT = [];
                $subCat['id'] = $subcat->id;
                $subCat['jenis_barang'] = $subcat->jenis_barang;
                $subCat['id_tenant'] = $subcat->id_tenant;
            }
            $result[$key]['jenis_barang'] = $subCat;
        }

        return response()->json(['data' => $result]);
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
