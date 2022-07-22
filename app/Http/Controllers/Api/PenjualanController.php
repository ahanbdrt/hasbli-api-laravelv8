<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\penjualan;
use App\Models\product;
use App\Models\TransaksiDetail;
use Illuminate\Http\Request;
use App\Http\Resources\PenjualanResource;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new PenjualanResource(penjualan::all());
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
    public function store(Request $r)
    {
        $order = penjualan::create([
            'total' => 0,
        ]);
        $totalPrice = 0;
        foreach ($r->cart as $data_cart) {
            $qty = $data_cart['qty'];
            $price = $data_cart['price'];
            $subtotal = $price * $qty;

            $create = TransaksiDetail::create([
                'id_penjualan' => $order->id,
                'id_barang' => $data_cart['id'],
                'qty' => $data_cart['qty'],
                'price' => $price,
                'subtotal' => $subtotal,
            ]);

            $totalPrice += $subtotal;
        }
        penjualan::find($order->id)->update(['total' => $totalPrice]);
        return response()->json(['status' => true, 'message' => '<b>Transaksi Sukses!</b>']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'total'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //update to database
        $penjualan = penjualan::where('id', $request->id)->update([
            'total'     => $request->total
        ]);

        $result = penjualan::where('id', $request->id)->first();

        return new PenjualanResource($penjualan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $penjualan = penjualan::where('id', $request->id)->delete();

        $result = array("status" => "sukses", "message" => "Hapus Berhasil");

        return new PenjualanResource($result);
    }
}
