<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SalesReportController extends Controller
{
    public function __invoke(Request $request)
    {
        DB::statement("SET SQL_MODE=''"); // set the strict to false

        return view('admin.sales_report.index', [
            'chart_total_daily_sales' => $this->get_total_daily_sales(),
            'chart_total_weekly_sales' => $this->get_total_weekly_sales(),
            'chart_total_monthly_sales' => $this->get_total_monthly_sales(),
            'chart_total_yearly_sales' => $this->get_total_yearly_sales(),
            'chart_total_product_by_category' => $this->get_total_product_by_category(),
            'chart_top_selling_product' => $this->get_top_selling_product(),
        ]);
    }

     /**
    * get top selling product
    *
    */
    private function get_top_selling_product()
    {
        $orders = Order::query()
        ->with('product', 'product_variety')
        ->where('status', Order::DELIVERED)
        // ->groupBy('transaction_no')
        ->get();
        

        $unfiltered_products = array();

        foreach ($orders as $order) {

            $unfiltered_products[] = $order->product->name ?? $order->product_variety->product->name;
        }

        $results = array_count_values($unfiltered_products);

        $products = array_keys($results);
        $total = array_values($results);

        return [$products, $total];
    }

    /**
    * get all product by category
    *
    */
    private function get_total_product_by_category()
    {
        $categories = [];
        $total_products = [];
        $category = request()->query('category');

        $get_categories = Category::query()
        ->when($category, fn($query) => $query->whereId($category))
        ->with('products')
        ->get();

        foreach ($get_categories as $cat) {
            $categories[] = $cat->name;
            $total_products[] = $cat->products->count();
        }

        return [$categories, $total_products];
    }

    /**
    * get product daily sales
    *
    */
    private function get_total_daily_sales()
    {
        $daily = request()->query('daily');
      
        $sales = Order::selectRaw("
            SUM(products.price * orders.qty) + SUM(product_varieties.price * orders.qty) as total_sales, 
            DATE(orders.created_at) as date, 
            DATE_FORMAT(orders.created_at, '%M %d,%Y') AS new_date
        ")
        ->leftJoin('products', 'orders.product_id', 'products.id')
        ->leftJoin('product_varieties', 'orders.product_variety_id', 'product_varieties.id')
        ->when($daily, fn($query) => $query->whereDate('orders.created_at', $daily))
        ->when(!$daily, function($query) {
            return $query->whereDate('orders.created_at', now()->format('Y-m-d'));
        })
        ->where('status', Order::DELIVERED)
        ->groupBy('date')
        ->orderBy('date')
        ->get();
    
        $dates = $sales->pluck('new_date')->toArray();
        $total_daily_sales = $sales->pluck('total_sales')->toArray();


        return [$dates, $total_daily_sales];


          // SUM(products.price * orders.qty) +
        // ->join('product_varieties', 'products.id', 'product_varieties.id')
       
    }

     /**
    * get product weekly sales
    *
    */
    private function get_total_weekly_sales()
    {
        $start_date = request()->query('start_date');
        $end_date = request()->query('end_date');

        $sales = Order::selectRaw("
            SUM(products.price * orders.qty) + SUM(product_varieties.price * orders.qty) as total_sales, 
            DATE(orders.created_at) as date, 
            DATE_FORMAT(orders.created_at, '%M %d,%Y') AS new_date
        ")
        ->leftJoin('products', 'orders.product_id', 'products.id')
        ->leftJoin('product_varieties', 'orders.product_variety_id', 'product_varieties.id')
        ->when(filled($start_date) && filled($end_date), function ($query) use ($start_date, $end_date) {
            $startOfWeek = Carbon::parse($start_date)->startOfWeek();
            $endOfWeek = Carbon::parse($end_date)->endOfWeek();
            return $query->whereBetween('orders.created_at', [$startOfWeek, $endOfWeek]);
        })
        ->when(!filled($start_date) && filled($end_date), function ($query) {
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();
            return $query->whereBetween('orders.created_at', [$startOfWeek, $endOfWeek]);
        })
        ->where('status', Order::DELIVERED)
        ->groupBy('date')
        ->orderBy('date')
        ->get();
    
        $dates = $sales->pluck('new_date')->toArray();
        $total_weekly_sales = $sales->pluck('total_sales')->toArray();
    
        return [$dates, $total_weekly_sales];
       
    }

    /**
    * get product monthly sales
    *
    */
    private function get_total_monthly_sales()
    {
        $month = request()->query('month');
        
        $sales = Order::selectRaw("
        SUM(products.price * orders.qty) + SUM(product_varieties.price * orders.qty) as total_sales, 
        month(orders.created_at) as month_no, 
        DATE_FORMAT(orders.created_at, '%M-%Y') AS new_date, 
        YEAR(orders.created_at) AS year, 
        monthname(orders.created_at) AS month
        ")
        ->leftJoin('products', 'orders.product_id', 'products.id')
        ->leftJoin('product_varieties', 'orders.product_variety_id', 'product_varieties.id')
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

    /**
    * get product yearly sales
    *
    */
    private function get_total_yearly_sales()
    {
        $year = request()->query('year');
        
        $sales = Order::selectRaw("
        SUM(products.price * orders.qty) + SUM(product_varieties.price * orders.qty) as total_sales, 
        month(orders.created_at) as month_no, 
        DATE_FORMAT(orders.created_at, '%M-%Y') AS new_date, 
        YEAR(orders.created_at) AS year, 
        monthname(orders.created_at) AS month
        ")
        ->leftJoin('products', 'orders.product_id', 'products.id')
        ->leftJoin('product_varieties', 'orders.product_variety_id', 'product_varieties.id')
        ->when($year, fn($query) => $query->whereYear('orders.created_at', $year))
        ->where('status', Order::DELIVERED)
        ->groupBy('year')
        ->orderByRaw('year')
        ->get();

        $years = array();
        
        $total_yearly_sales = array();

        foreach ($sales as $sale) {
            $years[] = $sale->year;
            $total_yearly_sales[] = $sale->total_sales;

        }

        return [$years, $total_yearly_sales];
    }
}