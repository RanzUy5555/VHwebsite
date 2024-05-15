<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\AdminOrderRequest;
use App\Http\Resources\Order\OrderResource;

class OrderController extends Controller
{
    public function __construct()
    {
        DB::statement("SET SQL_MODE=''"); // set the strict to false
    }
    
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $orders = OrderResource::collection(Order::query()
            ->when($request->has('status'), fn($query) => $query->where('status', $request->status))
            ->with('user')
            ->groupBy('transaction_no')
            ->get());

            return DataTables::of($orders)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);

                    $route_show  = route('admin.orders.show', $new_row['id']);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='$route_show'>View</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.order.index');
    }

    public function create()
    {
        return view('admin.order.create', [
            'users' => User::byRole('user')->get(),
        ]);
    }

    /** Process the order from walkin */
    // public function store(AdminWalkinOrderRequest $request)
    // {
    //     $transaction_no = mt_rand(123456,999999);

    //     foreach(array_combine($request->product_id, $request->qty) as $product => $qty) {

    //          $product = Product::find($product); // find product by id

    //          $request =  $product->orders()->create([
    //                     'cashier_id' => auth()->id(),
    //                     'user_id' => $request->user_id,
    //                     'qty' => $qty, 
    //                     'transaction_no' => $transaction_no,
    //                     'is_online' => false,
    //                     'status' => Order::PICK_UP,
    //                 ]); // create customer transaction


    //          $product->decrement('qty', $qty); // update the product qty ( Decrease)

    //          if($product->qty === 0 ) {
    //             $product->update(['is_available' => false]); // mark as out of stock
    //          }

    //     }

    //     return $this->res([
    //         'results' => $request->product_id
    //     ]);
    // }


    public function show(Order $order)
    {
        return view('admin.order.show', [
            'orders' => Order::with(['product' => fn($query) => $query->with('media', 'category'), 'user.municipality'])
            ->where('transaction_no', $order->transaction_no)
            ->get(),
        ]);
    }

    public function update(AdminOrderRequest $request, OrderService $service, Order $order)
    {
        $service->handleOrder(request:$request->validated(), orders: Order::with('user')->where('transaction_no', $order->transaction_no)->get());

        return back()->with(['success' => "Order Status Updated Successfully"]);
    }

    public function getProductByCode()
    {
        return $this->res([
            'results' => Product::with('category')->where('code', request('code'))->where('is_available', true)->first()
        ]);
    }
}