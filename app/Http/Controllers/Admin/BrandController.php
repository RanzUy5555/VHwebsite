<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brand\BrandRequest;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Brand::all())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_edit(`#m_brand`, `.brand_form :input`, [`#m_brand_title`, `Edit brand`], [`.btn_add_brand`, `.btn_update_brand`], $row)'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`admin.brands.destroy`,`.brand_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.brand.index');
    }

    public function store(BrandRequest $request)
    {
       Brand::create($request->validated());

       return $this->res(['success' => 'Brand Added Successfully']);
    }

    public function update(BrandRequest $request, Brand $brand)
    {
       $brand->update($request->validated());

       return $this->res(['success' => 'Brand Updated Successfully']);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

       return $this->res(['success' => 'Brand Deleted Successfully']);
    }
}