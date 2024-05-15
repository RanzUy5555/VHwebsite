<?php

namespace App\Http\Controllers\Admin;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\SupplierRequest;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Supplier::all())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_edit(`#m_supplier`, `.supplier_form :input`, [`#m_supplier_title`, `Edit supplier`], [`.btn_add_supplier`, `.btn_update_supplier`], $row)'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`admin.suppliers.destroy`,`.supplier_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.supplier.index');
    }

    public function store(SupplierRequest $request)
    {
       Supplier::create($request->validated() + ['department_id' => 1]);

       return $this->res(['success' => 'Supplier Added Successfully']);
    }

    public function update(SupplierRequest $request, Supplier $supplier)
    {
       $supplier->update($request->validated());

       return $this->res(['success' => 'Supplier Updated Successfully']);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

       return $this->res(['success' => 'Supplier Deleted Successfully']);
    }
}