<?php

namespace App\Http\Controllers\Manager;

use App\Option;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class OptionController extends Controller
{
    public function index()
    {
        return view('manager.option.index');
    }

    public function create()
    {
        return datatables()->of(Option::latest()->get())
            ->addColumn('action', function(Option $data) {
                return "<a href='javascript:void(0);' data-id='" .$data->id."' class='action-icon btn-edit'> <i class='fas fa-1x fa-edit'></i></a>
                    <a href='javascript:void(0);' data-id='" .$data->id. "' class='action-icon btn-delete'> <i class='fas fa-trash-alt'></i></a>";
            })
            ->editColumn('status', function(Option $data) {
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
        $option = new Option();
        $option->optionName = $request->optionName;
        $result = $option->save();
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'Successfully Added Option';
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Add Option';
        }
        return response()->json($response, 201);
    }

    public function edit($id)
    {
        $option = Option::find($id);
        return response()->json($option, 201);
    }

    public function update(Request $request, $id)
    {
        $option = Option::find($id);
        $option->optionName = $request->optionName;
        $result = $option->save();
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'Successfully Updated Option';
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Update Option';
        }
        return response()->json($response, 201);
    }

    public function destroy($id)
    {
        $option = Option::find($id);
        $result = $option->delete();
        if($result){
            $response['status'] = 'success';
            $response['message'] = 'Successfully Deleted Option';
        }else{
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Delete Option';
        }
        return response()->json($response, 201);
    }

    public function status(Request $request)
    {
        $option = Option::find($request->id);
        $option->status = $request->status;
        $result = $option->save();
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
                Option::find($id)->delete();
            }
            $response['status'] = 'success';
            $response['message'] = 'Successfully Deleted Options';
        }else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Delete Options';
        }
        return response()->json($response, 201);
    }
}
