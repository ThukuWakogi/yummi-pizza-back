<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCartItem;
use Illuminate\Http\Request;

class ShoppingCartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(ShoppingCartItem::all(), 200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingCartItem  $shoppingCartItem
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shoppingCartItem = ShoppingCartItem::find($id);

        if (is_null($shoppingCartItem)) return response()->json(["message" => "Record Not Found!"], 404);

        return response()->json(
            [
                "id" => $shoppingCartItem->id,
                "order_id" => $shoppingCartItem->order_id,
                "pizza_id" => $shoppingCartItem->pizza_id,
                "pizza_quantity" => $shoppingCartItem->pizza_quantity,
                "created_at" => $shoppingCartItem->created_at,
                "updated_at" => $shoppingCartItem->updated_at,
                "order" => $shoppingCartItem->order,
                "pizza" => $shoppingCartItem->pizza,
            ],
            200
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingCartItem  $shoppingCartItem
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingCartItem $shoppingCartItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShoppingCartItem  $shoppingCartItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shoppingCartItem = ShoppingCartItem::find($id);

        if(is_null($shoppingCartItem)) return response()->json(["message" => "Record not found"], 404);

        $shoppingCartItem->update($request->all());

        return response()->json(
            [
                "id" => $shoppingCartItem->id,
                "order_id" => $shoppingCartItem->order_id,
                "pizza_id" => $shoppingCartItem->pizza_id,
                "pizza_quantity" => $shoppingCartItem->pizza_quantity,
                "created_at" => $shoppingCartItem->created_at,
                "updated_at" => $shoppingCartItem->updated_at,
                "order" => $shoppingCartItem->order,
                "pizza" => $shoppingCartItem->pizza,
            ],
            200
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingCartItem  $shoppingCartItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingCartItem $shoppingCartItem)
    {
        //
    }
}
