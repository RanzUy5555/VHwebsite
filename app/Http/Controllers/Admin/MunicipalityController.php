<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Municipality\MunicipalityRequest;
use App\Models\Municipality;
use Yajra\DataTables\Facades\DataTables;

class MunicipalityController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            return DataTables::of(Municipality::all())
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_edit(`#m_municipality`, `.municipality_form :input`, [`#m_municipality_title`, `Edit municipality`], [`.btn_add_municipality`, `.btn_update_municipality`], $row)'>Edit</a>

                                <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($row->id,`admin.categories.destroy`,`.municipality_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.municipality.index');
    }

    public function store(MunicipalityRequest $request)
    {
       Municipality::create($request->validated());

       return $this->res(['success' => 'Municipality Added Successfully']);
    }

    public function update(MunicipalityRequest $request, Municipality $municipality)
    {
       $municipality->update($request->validated());

       return $this->res(['success' => 'Municipality Updated Successfully']);
    }

    public function destroy(Municipality $municipality)
    {
        $municipality->delete();

       return $this->res(['success' => 'Municipality Deleted Successfully']);
    }
}