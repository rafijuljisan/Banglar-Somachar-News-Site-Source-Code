<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GeneralSettings;
use Validator;

class GeneralSettingsController extends Controller
{
    protected $rules =
    [
        'logo'              => 'mimes:jpeg,jpg,png,svg',
        'favicon'           => 'mimes:jpeg,jpg,png,svg',
        'loader'            => 'mimes:gif',
        'admin_loader'      => 'mimes:gif',
        'error_photo'       => 'mimes:jpeg,jpg,png,svg',
        'footer_logo'       => 'mimes:jpeg,jpg,png,svg',
		'lazy_baner'       => 'mimes:jpeg,jpg,png,svg',
		'og_images'       => 'mimes:jpeg,jpg,png,svg',
    ];

    public function update(Request $request){
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
          return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }

        $data   = GeneralSettings::find(1);
        $input  = $request->all();
        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $name = time().$logo->getClientOriginalName();
            $logo->move('assets/images/logo/',$name);
            @unlink('assets/images/logo/'.$data->logo);
            $input['logo'] = $name;
        }
        if($request->hasFile('footer_logo')){
            $footer_logo = $request->file('footer_logo');
            $name = time().$footer_logo->getClientOriginalName();
            $footer_logo->move('assets/images/logo/',$name);
            @unlink('assets/images/logo/'.$data->footer_logo);
            $input['footer_logo'] = $name;
        }

        if($request->hasFile('lazy_baner')){
            $lazy_baner = $request->file('lazy_baner');
            $name = time().$lazy_baner->getClientOriginalName();
            $lazy_baner->move('assets/images/logo/',$name);
            @unlink('assets/images/logo/'.$data->lazy_baner);
            $input['lazy_baner'] = $name;
        }
        if($request->hasFile('og_images')){
            $og_images = $request->file('og_images');
            $name = time().$og_images->getClientOriginalName();
            $og_images->move('assets/images/logo/',$name);
            @unlink('assets/images/logo/'.$data->og_images);
            $input['og_images'] = $name;
        }

        if($request->hasFile('favicon')){
            $favicon = $request->file('favicon');
            $name = time().$favicon->getClientOriginalName();
            $favicon->move('assets/images/',$name);
            @unlink('assets/images/'.$data->favicon);
            $input['favicon'] = $name;
        }



		
        if($request->hasFile('loader')){
            $loader = $request->file('loader');
            $name = time().$loader->getClientOriginalName();
            $loader->move('assets/images/',$name);
            @unlink('assets/images/'.$data->loader);
            $input['loader'] = $name;
        }
        if($request->hasFile('admin_loader')){
            $admin_loader = $request->file('admin_loader');
            $name = time().$admin_loader->getClientOriginalName();
            $admin_loader->move('assets/images/',$name);
            @unlink('assets/images/'.$data->admin_loader);
            $input['admin_loader'] = $name;
        }
        if($request->hasFile('error_photo')){
            $error_photo = $request->file('error_photo');
            $name = time().$error_photo->getClientOriginalName();
            $error_photo->move('assets/images/',$name);
            @unlink('assets/images/'.$data->error_photo);
            $input['error_photo'] = $name;
        }
        $data->update($input);
        $msg = 'Data Updated Successfully';
        return response()->json($msg);

    }
    public function logo(){
        $data = GeneralSettings::find(1);
        return view('admin.generalsettings.logo',compact('data'));
    }
    public function favicon(){
        $data = GeneralSettings::find(1);
        return view('admin.generalsettings.favicon',compact('data'));
    }
	    public function lazy_baner(){
        $data = GeneralSettings::find(1);
        return view('admin.generalsettings.lazy_baner',compact('data'));
    }
    public function loader(){
        $data = GeneralSettings::find(1);
        return view('admin.generalsettings.loader',compact('data'));
    }
    public function websiteContent(){
        $data = GeneralSettings::find(1);
        return view('admin.generalsettings.websiteContent',compact('data'));
    }
    public function popularTags(){
        $data = GeneralSettings::find(1);
        return view('admin.generalsettings.popularTags',compact('data'));
    }
    public function footer(){
        $data = GeneralSettings::find(1);
        return view('admin.generalsettings.footer',compact('data'));
    }
    public function errorPage(){
        $data = GeneralSettings::find(1);
        return view('admin.generalsettings.errorPage',compact('data'));
    }

    public function tawkto($id){
        $data  = GeneralSettings::findOrFail(1);
        if($id ==1){
            $data->is_talkto =1;
            $data->update();
            return response()->json($id);
        }else{
            $data->is_talkto =0;
            $data->update();
            return response()->json($id);
        }
    }

    public function disqus($id){
        $data  = GeneralSettings::findOrFail(1);
        if($id ==1){
            $data->is_disqus =1;
            $data->update();
            return response()->json($id);
        }else{
            $data->is_disqus =0;
            $data->update();
            return response()->json($id);
        }
        
    }

    public function smtp($id){
        $data  = GeneralSettings::findOrFail(1);
        if($id ==1){
            $data->is_smtp =1;
            $data->update();
            return response()->json($id);
        }else{
            $data->is_smtp =0;
            $data->update();
            return response()->json($id);
        }
        
    }
}
