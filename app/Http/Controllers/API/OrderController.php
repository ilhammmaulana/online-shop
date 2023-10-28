<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use App\Http\Requests\API\CartIdsRequest;
use App\Http\Requests\API\SingleProductCheckoutRequest;
use App\Http\Resources\API\OrderResource;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['carts.product.category'])->where('created_by', $this->guard()->id())->latest()->get();
        // return $this->requestSuccessData($orders);
        return $this->requestSuccessData(OrderResource::collection($orders));
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
    public function store(CartIdsRequest $cartIdsRequest)
    {
        try {

            DB::beginTransaction();
            $input = $cartIdsRequest->only('id_carts');
            $idArray = explode(',', $input['id_carts']);

            $uniqueIds = array_unique($idArray);

            if (count($uniqueIds) != count($idArray)) {
                return $this->badRequest('duplicated_id', 'Failed!, Duplicated on your id_carts');
            }

            $carts = Cart::with('product')->whereIn('id', $idArray)
                ->where('created_by', $this->guard()->id())
                ->whereNull('order_id')
                ->get();
            if (!$carts->isNotEmpty()) {
                return $this->badRequest('invalid_id', 'Failed!, One of the IDs has been checked out');
            }
            $errorProducts = [];
            $order = Order::create(['created_by' => $this->guard()->id(), 'status_transaction' => 'pending']);
            $totalPrice = 0;
            foreach ($carts as $cart) {
                $product = $cart->product;
                $qty = $cart->qty;
                if ($product->stock >= $qty) {
                    $product->stock -= $qty;
                    $product->save();
                    $cartPrice = $product->price * $qty;
                    $totalPrice += $cartPrice;
                    $cart->order_id = $order->id;
                    $cart->singular_price = $product->price;
                    $cart->cart_price = $cartPrice;
                    $product->save();
                    $cart->save();
                } else {
                    $errorProducts[] = [
                        'id_product' => $cart->product_id,
                        "name" => $product->name,
                        "message" => "Insufficient stock of goods. Only " . $product->stock . " left in stock.",
                    ];
                }
            }
            if (!empty($errorProducts)) {
                DB::rollBack();
                return $this->requestValidation($errorProducts);
            }

            $order->update(['status_transaction' => 'success', 'total_price' => $totalPrice]);
            DB::commit();
            return $this->requestSuccess();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $order = Order::with(['carts.product.category'])
                ->where('created_by', $this->guard()->id())
                ->where('id', $id)
                ->where('status_transaction', 'success')
                ->first();

            if (!$order) {
                return $this->requestNotFound('Order not found!');
            }

            return $this->requestSuccessData(new OrderResource($order));
        } catch (\Throwable $th) {
            //throw $th;
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
    public function single(SingleProductCheckoutRequest $singleProductCheckoutRequest)
    {
        try {
            $input = $singleProductCheckoutRequest->only('product_id', 'qty');
            $product = Product::where('id', $input['product_id'])->firstOrFail();

            // Check if the requested quantity is available in stock
            if ($input['qty'] > $product->stock) {
                return $this->badRequest('Failed! Quantity exceeds available stock', 'not_available_stocks');
            }

            DB::beginTransaction();

            $order = Order::create(['created_by' => $this->guard()->id(), 'status_transaction' => 'pending']);

            $total_price = $input['qty'] * $product->price;

            Cart::create([
                'product_id' => $input['product_id'],
                'qty' => $input['qty'],
                'created_by' => $this->guard()->id(),
                'singular_price' => $product->price,
                'cart_price' => $total_price,
                'order_id' => $order->id,
            ]);
            $order->update(['status_transaction' => 'success', 'total_price' => $total_price]);
            $product->decrement('stock', $input['qty']);
            DB::commit();

            return $this->requestSuccess();
        } catch (ModelNotFoundException $th) {
            return $this->requestNotFound('Product not found!');
        } catch (\Throwable $th) {
            throw $th;
            DB::rollBack();
        }
    }
}
