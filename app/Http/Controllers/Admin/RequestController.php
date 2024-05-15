<?php

namespace App\Http\Controllers\Admin;

use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Resources\Request\RequestResource;
use App\Models\Request;

class RequestController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $requests = RequestResource::collection(Request::with('user', 'service')->get());

            return DataTables::of($requests)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);
                    $route_show = route('admin.requests.show', $new_row['id']);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>";

                             // show only the action buttons if its not viewed
                                if(!$new_row['is_reviewed'])
                                {   
                                    $btn.= "<a class='dropdown-item' href='$route_show'>View</a>";
                                    
                                    $btn.=      "
                                    <a class='dropdown-item' href='javascript:void(0)' onclick='c_destroy($new_row[id],`admin.requests.destroy`,`.request_dt`)'>Delete</a>";
                                }
                                else
                                {
                                    $btn.= "<a class='dropdown-item' href='javascript:void(0)'>No Actions Available</a>";
                                }

                          
                            "</div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.request.index');
    }

    public function show(Request $request)
    {
        $request->update(['is_reviewed' => true]); // toggle

        return view('admin.request.show', [
            'request' => $request->load('user', 'service'),
        ]);
    }


    public function destroy(Request $request)
    {
        $request->delete();

       return $this->res(['success' => 'Requested Quotation Deleted Successfully']);
    }
}