<?php

namespace App\Http\Controllers\Admin;

use App\Size;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        return view('admin.size.index');
    }

    public function create()
    {
        return datatables()->of(Size::latest()->get())
            ->addColumn('action', function(Size $data) {
                return "<a href='javascript:void(0);' data-id='" .$data->id."' class='action-icon btn-edit'> <i class='fas fa-1x fa-edit'></i></a>
                    <a href='javascript:void(0);' data-id='" .$data->id. "' class='action-icon btn-delete'> <i class='fas fa-trash-alt'></i></a>";
            })
            ->editColumn('status', function(Size $data) {
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
        $size = new Size();
        $size->sizeName = $request->sizeName;
        $result = $size->save();
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'Successfully Added Size';
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Add Size';
        }
        return response()->json($response, 201);
    }

    public function edit($id)
    {
        $size = Size::find($id);
        return response()->json($size, 201);
    }

    public function update(Request $request, $id)
    {
        $size = Size::find($id);
        $size->sizeName = $request->sizeName;
        $result = $size->save();
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'Successfully Updated Size';
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Update Size';
        }
        return response()->json($response, 201);
    }

    public function destroy($id)
    {
        $size = Size::find($id);
        $result = $size->delete();
        if($result){
            $response['status'] = 'success';
            $response['message'] = 'Successfully Deleted Size';
        }else{
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Delete Size';
        }
        return response()->json($response, 201);
    }

    public function status(Request $request)
    {
        $size = Size::find($request->id);
        $size->status = $request->status;
        $result = $size->save();
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
                Size::find($id)->delete();
            }
            $response['status'] = 'success';
            $response['message'] = 'Successfully Deleted Sizes';
        }else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Delete Sizes';
        }
        return response()->json($response, 201);
    }
}
