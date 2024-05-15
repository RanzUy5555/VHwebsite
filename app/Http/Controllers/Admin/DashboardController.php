<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function __construct()
    {
        DB::statement("SET SQL_MODE=''"); // set the strict to false
    }

    public function __invoke(Request $request)
    {
        $products = Product::query();
        $orders = Order::query();
        
        return view('admin.dashboard.index', [
            'activities' => Activity::latest()->take(5)->get(),
            'total_order' => $orders->count(),
            'total_product' => $products->count(),
            'total_active_user' => User::ByRole('student')->active()->count(),
            'total_inactive_user' => User::ByRole('student')->inactive()->count(),
            'orders' => $orders->groupBy('transaction_no')->paginate(10),
            'products' => $products->paginate(10),
            'users' => User::whereRelation('role', 'name', '!=', 'admin')->latest()->paginate(10),
            'monthly_customers' => $this->getMonthlyCustomers(),
            'chart_products_by_category' => $this->getTotalProductsByCategory(),
            'monthly_sales' => $this->getMonthlySales(month: $request->input('month')),
        ]);
    }

    private function getTotalProductsByCategory()
    {
        $categories = [];
        $total_products = [];

        foreach (Category::with('products')->get() as $category) {
            $categories[] = $category->name ;
            $total_products[] = $category->products->count();
        }

        return [$categories, $total_products];
    }

    private function getMonthlySales($month = "")
    {
        $sales = Order::selectRaw("
        SUM(products.price * orders.qty) as total_sales, 
        month(orders.created_at) as month_no, 
        DATE_FORMAT(orders.created_at, '%M-%Y') AS new_date, 
        YEAR(orders.created_at) AS year, 
        monthname(orders.created_at) AS month
        ")
        ->join('products', 'orders.product_id', 'products.id')
        // ->when(blank($month), fn($query) => $query->whereMonth('orders.created_at', now()))
        ->when($month, fn($query) => $query->whereMonth('orders.created_at', $month))
        ->where('status', Order::DELIVERED)
        ->groupBy('month_no')
        ->orderByRaw('month_no')
        ->get();

        $months = array();
        
        $total_monthly_sales = array();

        foreach ($sales as $sale) {
            $months[] = $sale->month;
            $total_monthly_sales[] = $sale->total_sales;

        }

        return [$months, $total_monthly_sales];
    }

    private function getMonthlyCustomers()
    {
        $monthly_customers = User::selectRaw("
        count(id) AS total_users, 
        month(created_at) as month_no, 
        DATE_FORMAT(created_at, '%M-%Y') AS new_date,
        YEAR(created_at) AS year,
        monthname(created_at) AS month"
        )
        ->groupBy('new_date')
        ->orderByRaw('month_no')
        ->get();

        $months = array();
        
        $total_monthly_customers = array();

        foreach ($monthly_customers as $month) {
            $months[] = $month->month;
        }

        foreach ($monthly_customers as $total) {
            $total_monthly_customers[] = $total->total_users;
        }

        return [$months, $total_monthly_customers]; // sorted
    }

    
}