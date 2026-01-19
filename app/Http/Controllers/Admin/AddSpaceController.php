<?php

namespace App\Http\Controllers\Admin;

use Datatables;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Image; 

class AddSpaceController extends Controller
{
    public function datatables()
    {
        $datas = Advertisement::orderBy('id','desc')->get();
        return Datatables::of($datas)
            ->addColumn('action', function(Advertisement $data) {
                return '<div class="action-list">
                            <a href="'.route('ads.edit',$data->id) .'" class="edit"> <i class="fas fa-edit"></i> Edit</a>
                            <a href="javascript:;" data-href="'.route('ads.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a>
                        </div>';
            })
            ->editColumn('photo', function(Advertisement $data){
                if($data->banner_type == 'upload'){
                    $photo = $data->photo ? asset('assets/images/addBanner/'.$data->photo) : asset('assets/images/noimage.png');
                    return '<img src="'.$photo.'" alt="Ad Image" style="max-height:50px;">';
                } 
                elseif($data->banner_type == 'url'){
                    return '<img src="'.$data->photo_url.'" alt="External Ad" style="max-height:50px;">';
                }
                else {
                    return '<span class="badge badge-dark">Script/Code</span>';
                }
            })
            ->editColumn('add_placement', function(Advertisement $data){
                return '<span class="badge badge-primary">'.ucwords(str_replace('_', ' ', $data->add_placement)).'</span>';
            })
            ->editColumn('addSize', function(Advertisement $data){
                return $data->addSize ? '<span class="badge badge-info">'.$data->addSize.'</span>' : '';
            })
            ->editColumn('status', function(Advertisement $data){
                return $data->status == 1 
                    ? '<span class="badge badge-success">Active</span>'
                    : '<span class="badge badge-danger">Inactive</span>';
            })
            ->rawColumns(['action','photo','add_placement','addSize','status'])
            ->toJson();
    }

    public function index(){
        return view('admin.ads.index');
    }

    public function create(){
        return view('admin.ads.create');
    }

    public function store(Request $request){
        // 1. Validation 
        $rules = [
            'add_placement' => 'required',
            'banner_type'   => 'required',
            'status'        => 'required',
            // File upload validation (Added gif, webp)
            'photo'         => 'required_if:banner_type,upload|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5000',
            // REMOVED '|url' rule to prevent format errors
            'photo_url'     => 'required_if:banner_type,url', 
            'banner_code'   => 'required_if:banner_type,code',
            'link'          => 'nullable' 
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        
        $data  = new Advertisement();
        $input = $request->all();

        // 2. Handle Image Upload
        if($file = $request->file('photo')){
            $name = time().Str::random(8).'.'.$file->getClientOriginalExtension();
            $path = public_path('assets/images/addBanner');
            if(!file_exists($path)) mkdir($path, 0777, true);

            $file->move($path, $name);
            $input['photo'] = $name;
        }

        // 3. Cleanup DB fields
        if($input['banner_type'] == 'upload') {
            $input['photo_url'] = null;
            $input['banner_code'] = null;
        } elseif($input['banner_type'] == 'url') {
            $input['photo'] = null;
            $input['banner_code'] = null;
        } elseif($input['banner_type'] == 'code') {
            $input['photo'] = null;
            $input['photo_url'] = null;
            $input['link'] = null; 
        }

        $data->fill($input)->save();
        $msg = 'Advertisement Added Successfully';
        return response()->json($msg);
    }

    public function edit($id){
        $data = Advertisement::find($id);
        return view('admin.ads.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $rules = [
            'add_placement' => 'required',
            'banner_type'   => 'required',
            'status'        => 'required',
            'photo'         => 'image|mimes:jpeg,png,jpg,gif,webp,svg|max:5000',
            // REMOVED '|url' rule here too
            'photo_url'     => 'required_if:banner_type,url',
            'banner_code'   => 'required_if:banner_type,code',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        
        $data = Advertisement::find($id);
        $input = $request->all();

        // Handle File Upload
        if($file = $request->file('photo')){
            $name = time().Str::random(8).'.'.$file->getClientOriginalExtension();
            $path = public_path('assets/images/addBanner');
            
            $file->move($path, $name);
            
            if($data->photo){
                @unlink($path.'/'.$data->photo);
            }
            $input['photo'] = $name;
        }

        // Cleanup fields
        if($input['banner_type'] == 'upload') {
            $input['photo_url'] = null;
            $input['banner_code'] = null;
        } elseif($input['banner_type'] == 'url') {
            $input['banner_code'] = null;
        } elseif($input['banner_type'] == 'code') {
            $input['photo_url'] = null;
            $input['link'] = null;
        }

        $data->update($input);
        $msg = 'Advertisement Updated Successfully';
        return response()->json($msg);
    }

    public function delete($id){
        $data = Advertisement::find($id);
        if($data->photo){
            @unlink(public_path('assets/images/addBanner/'.$data->photo));
        }
        $data->delete();
        $msg = 'Data Deleted Successfully';
        return response()->json($msg);
    }
}