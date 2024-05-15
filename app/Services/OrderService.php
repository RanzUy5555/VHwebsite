<?php 

namespace App\Services;

use App\Models\Otp;
use App\Models\Order;
use App\Mail\OrderUpdate;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Order\OrderRequest;
use App\Http\Requests\Order\UserOrderRequest;
use App\Models\Delivery;

class OrderService extends ImageUploadService 
{
    public function __construct(public TextService $textService)
    {
        
    }

    public function storeOrder($user, UserOrderRequest $request)
    {
        $transaction_no = mt_rand(123456,999999);
        $order = '';

        if($request->has('product_id') && $request->has('qty'))
        {
            foreach (array_combine($request->product_id, $request->qty) as $product_id => $qty) 
            {
                $order = $user->orders()->create([
                    'address' => $request->address,
                    'municipality_id' => $request->municipality_id,
                    'contact' => $request->contact,
                    'product_id' => $product_id,
                    'qty' => $qty,
                    'payment_method_id' => $request->payment_method_id,
                    'reference_no' => $request->reference_no,
                    'transaction_no' => $transaction_no,
                    'note' => $request->note,
                ]);
            }
        }

        if($request->has('product_variety_id') && $request->has('product_variety_qty'))
        {
            foreach (array_combine($request->product_variety_id, $request->product_variety_qty) as $product_id => $qty) 
            {
                $order = $user->orders()->create([
                    'address' => $request->address,
                    'municipality_id' => $request->municipality_id,
                    'contact' => $request->contact,
                    'product_variety_id' => $product_id,
                    'qty' => $qty,
                    'payment_method_id' => $request->payment_method_id,
                    'reference_no' => $request->reference_no,
                    'transaction_no' => $transaction_no,
                    'note' => $request->note,
                ]);
            }
        }
      

        $user->carts()->delete();  // after insertion clear the cart

        $this->clearOtp(); // clear otp

        return $this->handleImageUpload(model:$order, images: $request->image, collection:'payment_receipts', conversion_name:'card', action:'create');
    }

    public function checkOtp($code)
    {
        $otp =  Otp::where('otp', $code)->first();
        
        return $otp ? true : false ;
    }

    public function clearOtp()
    {
        return Otp::where('user_id', auth()->id())
                ->update(['otp' => null]);
    }

    /**
     * handle Order Status Update
     *
     * @param [type] $request
     * @param [type] $orders
     * @return void
     */
    public function handleOrder($request, $orders)
    {
        // if order status is approved
        if ($request['status'] == Order::APPROVED) {

            $orders->each(function($order) 
            {
                if($order->product_id)
                {
                    $order->product->decrement('qty', $order->qty); // decrement product qty

                    if ($order->product->qty == 0) {
                      $order->product->update(['is_available' => false]); // update to unavailable / soldout
                    }
                }
                else
                {
                    $order->product_variety->product->decrement('qty', $order->qty); // decrement product qty

                    if ($order->product_variety->product->qty == 0) {
                      $order->product_variety->product->update(['is_available' => false]); // update to unavailable / soldout
                    }
                }
            });
        }

        $orders->toQuery()->update([
            //'cashier_id' => auth()->id(), // admin | cashier
            'status' => $request['status'],
            'remark' => $request['remark'],
        ]); // update order status


        $transaction_no = $orders[0]->transaction_no;

        $message = match ($request['status']) 
        {
            '1' => "Your order with transaction no. $transaction_no has been approved. You will be receiving an email and sms notification update from your request.",
            '2' => "Thank you for waiting. Unfortunatetly Virgilio Handicraft chooses to reject your order with transaction no. $transaction_no. 
            <br> Remark:' . $orders[0]->remark . '<br> Any Questions? You can visit our frequently asked question page or email us at virgilio.handicraft2@gmail.com",
            '3' => "Thank you for choosing Virgilio Handicraft for your recent order. We are pleased to inform you that your order with transaction no. $transaction_no is now on delivery",
            '4' => "Thank you for choosing Virgilio Handicraft for your recent order. We are pleased to inform you that your order with transaction no. $transaction_no has been successfully delivered.",
            '5' => "Thank you for your order $transaction_no. We regret to inform you that this order has been cancelled. We confirm that your account has not been debited since this order was cancelled. Virgilio Handicraft does not charge for any orders until they are shipped. Please be advised that cancelled orders cannot be reinstated. <br> Any Questions? You can visit our frequently asked question page or email us at virgilio.handicraft2@gmail.com",
        };

        $route = route('user.orders.index');

        return Mail::to($orders[0]->user->email)->send(new OrderUpdate($orders[0]->user->full_name, $message, $route));  // email user
    }
}