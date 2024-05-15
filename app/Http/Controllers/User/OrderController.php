<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UserOrderRequest;

class OrderController extends Controller
{
    public function __construct()
    {
        DB::statement("SET SQL_MODE=''"); // set the strict to false
    }
    
    public function index()
    {
        return view('user.order.index', [
            'orders' => Order::with(['product' => fn($query) => $query->with('media', 'category')])
            ->whereBelongsTo(auth()->user())
            ->groupBy('transaction_no')
            ->orderBy('status', 'ASC')
            ->latest()
            ->get(),
        ]);    
    }

    public function show(Order $order)
    {
        return view('user.order.show', [
            'orders' => Order::with(['product' => fn($query) => $query->with('media', 'category'), 'user.municipality'])
            ->where('transaction_no', $order->transaction_no)
            ->whereBelongsTo(auth()->user())
            ->get(),
        ]);
    }


    public function store(UserOrderRequest $request, OrderService $service)
    {
        //check if the otp is correct
        if (!$service->checkOtp($request->otp)) {
            
            $service->clearOtp(); // empty otp

            return back()->with(['error' => 'Invalid OTP Code']);
        }

        $service->storeOrder( user: auth()->user(), request: $request); // handle order

        // return to_route('user.orders.index')->with(['success' => 'Thank you for purchasing! You will be receiving an email and sms notification once there is an update from your order request.']);


        return to_route('user.orders.index')->with([
            'success' => "
            Thank you for successfully placing your order with us! We are thrilled to have you as our valued customer and want to assure you that your order is in good hands. \n
            Shortly, you will receive both an email and an SMS order update to keep you informed about the progress of your purchase. These notifications will provide you with all the necessary details, including the expected delivery date and any other relevant information regarding your order.
            "
        ]);
    }
}