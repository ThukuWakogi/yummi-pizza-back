<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCartItem;
use Illuminate\Http\Request;
use JWTAuth;
use App\Models\Order;

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
        $validate = $request->validate([
            'pizza_id' => 'required|integer',
            'pizza_quantity' => 'required|integer'
        ]);
        $user = JWTAuth::user();

        if (count($user->pendingOrder) > 0)
        {
            $shoppingCartItem = ShoppingCartItem::create([
                'order_id' => $user->pendingOrder[0]->id,
                'pizza_id' => $request->input('pizza_id'),
                'pizza_quantity' => $request->input('pizza_quantity'),
            ]);

            return response()->json(
                [
                    'pendingOrder' => $user->pendingOrder,
                    'shoppingCart' => $this->expandShoppingCart($user->pendingOrder)
                ],
                201
            );
        }

        if (count($user->pendingOrder) == 0)
        {
            $order = Order::create(['user_id' => $user->id]);
            $shoppingCartItem = ShoppingCartItem::create([
                'order_id' => $order->id,
                'pizza_id' => $request->input('pizza_id'),
                'pizza_quantity' => $request->input('pizza_quantity'),
            ]);

            return response()->json(
                [
                    'pendingOrder' => [$order],
                    'shoppingCart' => $this->expandShoppingCart([$order])
                ],
                201
            );
        }

        return response()->json(['message' => 'We are not supposed to reach here'], 400);
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

    private function expandShoppingCart($pendingOrder) {
        $expandedShoppingCart = [];
        $shoppingCart = ShoppingCartItem::where('order_id', $pendingOrder[0]->id)->get();
        foreach($shoppingCart as $item)
        {
            array_push(
                $expandedShoppingCart,
                [
                    'id' => $item->id,
                    'order_id' => $item->order_id,
                    'pizza' =>
                        [
                            'id' => $item->pizza->id,
                            'name' => $item->pizza->name,
                            'price' => $item->pizza->price
                        ],
                    'pizza_quantity' => $item->pizza_quantity,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ]
            );
        }

        return $expandedShoppingCart;
    }
}
