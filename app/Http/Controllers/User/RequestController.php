<?php

namespace App\Http\Controllers\User;

use App\Models\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\Request\UserRequest;
use App\Http\Resources\Request\RequestResource;
use App\Models\Service;

class RequestController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $requests = RequestResource::collection(Request::with('user', 'service')->whereBelongsTo(auth()->user())->get());

            return DataTables::of($requests)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);
                    $route_edit = route('user.requests.edit', $new_row['id']);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>";

                             // show only the action buttons if its not viewed
                                if(!$new_row['is_reviewed'])
                                {   
                                    $btn.= "<a class='dropdown-item' href='$route_edit'>Edit</a>";
                                    
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

        return view('user.request.index');
    }

    public function create()
    {
        return view('user.request.create', [
            'services' => Service::pluck('name', 'id'),
        ]);
    }

    public function store(UserRequest $request)
    {
       Request::create($request->validated());

       return $this->res(['success' => 'Quotation Requested Successfully']);
    }

    public function edit(Request $request)
    {
        return view('user.request.edit', [
            'services' => Service::pluck('name', 'id'),
            'request' => $request
        ]);
    }


    public function update(UserRequest $user_request, Request $request)
    {
       $request->update($user_request->validated());

       return to_route('user.requests.index')->with(['success' => 'Requested Quotation Updated Successfully']);
    }

    public function destroy(Request $request)
    {
        $request->delete();

       return $this->res(['success' => 'Requested Quotation Deleted Successfully']);
    }
}