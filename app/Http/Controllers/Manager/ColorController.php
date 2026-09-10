<?php

namespace App\Http\Controllers\Manager;

use App\Color;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        return view('manager.color.index');
    }

    public function create()
    {
        return datatables()->of(Color::latest()->get())
            ->addColumn('action', function(Color $data) {
                return "<a href='javascript:void(0);' data-id='" .$data->id."' class='action-icon btn-edit'> <i class='fas fa-1x fa-edit'></i></a>
                    <a href='javascript:void(0);' data-id='" .$data->id. "' class='action-icon btn-delete'> <i class='fas fa-trash-alt'></i></a>";
            })
            ->editColumn('status', function(Color $data) {
                if($data->status == 'Active'){
                    return '<button type="button" class="btn btn-success btn-xs btn-status" data-status="Inactive" name="status" value="'. $data->id . '">Active</button>';
                }else{
                    return '<button type="button" class="btn btn-warning btn-xs btn-status" data-status="Active" name="status" value="'. $data->id . '" >Inactive</button>';
                }
            })
            ->escapeColumns([])->toJson();
    }

    public function store(Request $request)
    {
        $color = new Color();
        $color->colorName = $request->colorName;
        $color->colorCode = $request->colorCode; // Assuming there is a colorCode field
        $result = $color->save();
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'Successfully Added Color';
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Add Color';
        }
        return response()->json($response, 201);
    }

    public function edit($id)
    {
        $color = Color::find($id);
        return response()->json($color, 201);
    }

    public function update(Request $request, $id)
    {
        $color = Color::find($id);
        $color->colorName = $request->colorName;
        $color->colorCode = $request->colorCode; // Assuming there is a colorCode field
        $result = $color->save();
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'Successfully Updated Color';
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Update Color';
        }
        return response()->json($response, 201);
    }

    public function destroy($id)
    {
        $color = Color::find($id);
        $result = $color->delete();
        if($result){
            $response['status'] = 'success';
            $response['message'] = 'Successfully Deleted Color';
        }else{
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Delete Color';
        }
        return response()->json($response, 201);
    }

    public function status(Request $request)
    {
        $color = Color::find($request->id);
        $color->status = $request->status;
        $result = $color->save();
        if($result){
            $response['status'] = 'success';
            $response['message'] = 'Successfully Updated Status to '.$request['status'];
        }else{
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to update Status '.$request['status'];
        }
        return response()->json($response, 201);
    }

    public function delete(Request $request)
    {
        if($request->ids){
            foreach ($request->ids as $id) {
                Color::find($id)->delete();
            }
            $response['status'] = 'success';
            $response['message'] = 'Successfully Deleted Colors';
        }else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Delete Colors';
        }
        return response()->json($response, 201);
    }
}
