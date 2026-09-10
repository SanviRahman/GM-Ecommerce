<?php

namespace App\Http\Controllers\Manager;

use App\Section;
use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
class SectionController extends Controller
{
    public function index()
    {
        $categories = Category::where('status','Active')->get();
        return view('manager.section.index',compact('categories'));
    }

    public function create()
    {
        
        return datatables()->of(Section::with('category')->orderBy('sort')->get())
            ->addColumn('action', function(Section $data) {
                return "<a href='javascript:void(0);' data-id='" .$data->id."' class='action-icon btn-edit'> <i class='fas fa-1x fa-edit'></i></a>
                    <a href='javascript:void(0);' data-id='" .$data->id. "' class='action-icon btn-delete'> <i class='fas fa-trash-alt'></i></a>";
            })
            ->editColumn('status', function(Section $data) {
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
        $section = new Section();
        $section->category_id = $request->category_id;
        $section->max = $request->max;
        $section->sort = $request->sort;
        $result = $section->save();
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'Successfully Added Section';
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Add Section';
        }
        return response()->json($response, 201);
    }

    public function edit($id)
    {
        $section = Section::find($id);
        return response()->json($section, 201);
    }

    public function update(Request $request, $id)
    {
        $section = Section::find($id);
         $section->category_id = $request->category_id;
        $section->max = $request->max;
        $section->sort = $request->sort;
        $result = $section->save();
        if ($result) {
            $response['status'] = 'success';
            $response['message'] = 'Successfully Updated Section';
        } else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Update Section';
        }
        return response()->json($response, 201);
    }

    public function destroy($id)
    {
        $section = Section::find($id);
        $result = $section->delete();
        if($result){
            $response['status'] = 'success';
            $response['message'] = 'Successfully Deleted Section';
        }else{
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Delete Section';
        }
        return response()->json($response, 201);
    }

    public function status(Request $request)
    {
        $section = Section::find($request->id);
        $section->status = $request->status;
        $result = $section->save();
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
                Section::find($id)->delete();
            }
            $response['status'] = 'success';
            $response['message'] = 'Successfully Deleted Sections';
        }else {
            $response['status'] = 'failed';
            $response['message'] = 'Unsuccessful to Delete Sections';
        }
        return response()->json($response, 201);
    }
}
