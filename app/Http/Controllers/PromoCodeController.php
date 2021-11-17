<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PromoCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PromoCode::select('code', 'type', 'value', 'percent_off', 'expires_after', 'used_times')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedAttributes =  $request->validate([
            'code' => 'required|string|unique:promo_codes',
            'type' => 'required|string',
            'value' => 'numeric|nullable',
            'percent_off' => 'numeric|nullable',
            'expires_after' => 'numeric'
        ], [
            'unique' => 'There is an existing promocode with this code.'
        ]);

        PromoCode::create($validatedAttributes);

        return PromoCode::select('code', 'type', 'value', 'percent_off', 'expires_after', 'used_times')->get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PromoCode $promoCode, Request $request)
    {
        if (Order::where('user_id', $request->user()->id)->where('promocode_used', $promoCode->code)->doesntExist()) {
            if ($promoCode->expires_after > $promoCode->used_times) {
                return $promoCode->calculateDiscount($request->subTotal);
            }

            throw ValidationException::withMessages(['expired' => ["Sorry, this promo code has expired!"]]);
        }

        throw ValidationException::withMessages(['expired' => ["Sorry, you can't use the same promo code twice!"]]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PromoCode $promoCode)
    {
        $promoCode->delete();

        return PromoCode::select('code', 'type', 'value', 'percent_off', 'expires_after', 'used_times')->get();
    }
}
