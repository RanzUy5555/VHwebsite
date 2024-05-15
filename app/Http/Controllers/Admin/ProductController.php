<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ImageUploadService;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Resources\Product\ProductResource;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if(request()->ajax())
        {
            $products = ProductResource::collection(
                Product::query()
                ->when($request->filled('qty'), fn($query) => $query->whereBetween('qty',  explode(',', $request->qty)))
                ->with('supplier','category', 'media', 'varieties')
                ->latest()
                ->get()
            );

            return DataTables::of($products)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);
                    // $route_show = route('admin.products.show', $new_row['slug']);
                    $route_edit = route('admin.products.edit', $new_row['slug']);
                    

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                              
                                <a class='dropdown-item' href='$route_edit'>Edit</a>";

                                if ($new_row['is_available'] == true) {
                                    $btn .= "
                                    <a class='dropdown-item' href='javascript:void(0)' onclick='crud_activate_deactivate($new_row[id], `admin.products.update` , `deactivate`, `.product_dt`, `Deactivate Product`)'> Deactivate </a>";
                                } else {
                                    $btn .= "
                                    <a class='dropdown-item' href='javascript:void(0)' onclick='crud_activate_deactivate($new_row[id], `admin.products.update` , `activate`, `.product_dt`, `Activate Product`)'> Activate </a>";
                                }
                
                               $btn .="<a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($new_row[id],`admin.products.destroy`,`.product_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.product.index');
    }

    public function create()
    {
        return view('admin.product.create', [
            'suppliers' => Supplier::all(),
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }

    public function store(ProductRequest $request, ImageUploadService $service)
    {
        $product = Product::create($request->validated() + [
            'slug' => Str::slug($request->name),
            'code' => mt_rand(123456,999999),
        ]);

        if(isset($request->product_variety_name, $request->product_variety_price, $request->product_variety_qty)) 
        {
            for($i=0; $i < count($request->product_variety_name); $i++)
            {
                $product->varieties()->create([
                    'name' => $request->product_variety_name[$i], 
                    'price' => $request->product_variety_price[$i],
                    'qty' => $request->product_variety_qty[$i],
                ]);
                
            }
        }

        $service->handleImageUpload(model:$product, images: $request->image, collection:'product_images', conversion_name:'', action:'create');

        return to_route('admin.products.index')->with(['success' => "Product Added Successfully"]);
    }

    public function show(Product $product)
    {
        return view('admin.product.show', [
            'product' => $product->load('media', 'category', 'varieties', 'supplier'),
        ]);
    }

    public function edit(Product $product)
    {
        return view('admin.product.edit', [
            'product' => $product,
            'suppliers' => Supplier::all(),
            'categories' => Category::all(),
            'brands' => Brand::all(),
        ]);
    }

    public function update(ProductRequest $request, ImageUploadService $service, Product $product)
    {
        if ($request->option) {
            return match($request->option) {
                'activate' => $product->update(['is_available' => true]),
                'deactivate' => $product->update(['is_available' => false]),
            };
        }

        $product->update($request->validated() + [
            'slug' => Str::slug($request->name),
        ]); // update product
        
        if(isset($request->product_variety_name, $request->product_variety_price)) 
        {
            $product->varieties()->delete(); // remove all product varieties and populate new one

            for($i=0; $i<count($request->product_variety_name); $i++)
            {

                if(filled($request->product_variety_name[$i]) && filled($request->product_variety_price[$i]) && filled($request->product_variety_qty[$i]))
                {
                    $product->varieties()->create([
                        'name' => $request->product_variety_name[$i], 
                        'price' => $request->product_variety_price[$i],
                        'qty' => $request->product_variety_qty[$i],
                    ]);
                }
                
            }

        }

        if ($request->image) 
        {
            $service->handleImageUpload(model:$product, images: $request->image, collection:'product_images', conversion_name:'', action:'update');
        }

        return to_route('admin.products.index')->with(['success' => 'Product Updated Successfully']);
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return $this->res(['success' => 'Product Deleted Successfully']);
    }
}