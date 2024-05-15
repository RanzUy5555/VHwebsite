<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Service\ServiceRequest;
use App\Http\Resources\Service\ServiceResource;
use App\Models\Category;
use App\Services\ImageUploadService;

class ServiceController extends Controller
{
    public function index()
    {
        if(request()->ajax())
        {
            $services = ServiceResource::collection(Service::with('media')->get());

            return DataTables::of($services)
                   ->addIndexColumn()
                   ->addColumn('actions', function($row) {

                    $new_row = collect($row);

                    $route_edit = route('admin.services.edit', $new_row['id']);

                    $btn = "
                        <div class='dropdown'>
                            <a class='btn btn-sm btn-icon-only text-light' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <i class='fas fa-ellipsis-v'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>

                                <a class='dropdown-item' role='button' href='$route_edit'>Edit</a>

                                <a class='dropdown-item' role='button' onclick='c_destroy($new_row[id],`admin.services.destroy`,`.services_dt`)'>Delete</a>
                            </div>
                        </div> ";
    
                    return $btn;
    
                   })
                   ->rawColumns(['actions'])
                   ->make(true);
        }

        return view('admin.service.index');
    }

    public function create()
    {
        return view('admin.service.create');
    }

    public function store(ServiceRequest $request, ImageUploadService $image_upload_service)
    {
        $service = Service::create($request->validated());

        if($request->image) 
        {
            $image_upload_service->handleImageUpload(model:$service, images: $request->image, collection:'service_images', conversion_name:'card', action:'create');
        }

        return to_route('admin.services.index')->with(['success' => 'Service Added Successfully']);
    }

    public function edit(Service $service)
    {
        return view('admin.service.edit', [
            'service' => $service,
        ]);
    }

    public function update(ServiceRequest $request, ImageUploadService $image_upload_service, Service $service)
    {
       $service->update($request->validated());

       if($request->image) 
       {
           $image_upload_service->handleImageUpload(model:$service, images: $request->image, collection:'service_images', conversion_name:'card', action:'update');
       }

       return to_route('admin.services.index')->with(['success' => 'Service Updated Successfully']);
    }

    public function destroy(Service $service)
    {
        $service->delete();

       return $this->res(['success' => 'Service Deleted Successfully']);
    }
}