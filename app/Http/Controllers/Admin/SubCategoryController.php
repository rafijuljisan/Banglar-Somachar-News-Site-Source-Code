<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;
use Datatables;

class SubCategoryController extends Controller
{
    public function datatables(){
        // Get all categories that have a parent (Subcategories)
        $datas = Category::where('parent_id','!=',NULL)->orderBy('id','desc')->get();

        return Datatables::of($datas)
            ->addColumn('action', function(Category $data) {
                return '<div class="action-list"><a data-href="'.route('subcategories.edit',$data->id) .'" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="'.route('subcategories.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
            })
            // 1. Show Parent Name
            ->editColumn('parent_id', function(Category $data){
                return $data->parent_id ? $data->parent->title : 'Root';
            })
            // 2. Show Language Name
            ->editColumn('language_id',function(Category $data){
                return $data->language_id ? $data->language->language : '';
            })
            // 3. Show Color Box
            ->editColumn('color',function(Category $data){
                $color = $data->color ? '<div style="width: 60px; height: 30px; background-color:'.$data->color.' ;"></div>' : '';
                return $color;
            })
            // 4. Show Homepage Badge
            ->editColumn('show_at_homepage',function(Category $data){
                $show_at_homepage = $data->show_at_homepage == 1 ? '<span class="btn btn-success btn-sm" style="border-radius: 15px;"> active</span>' : '<span class="btn btn-danger btn-sm" style="border-radius: 15px;"> Inactive</span>';
                return $show_at_homepage;
            })
            // 5. Show Menu Badge
            ->editColumn('show_on_menu',function(Category $data){
                $show_on_menu = $data->show_on_menu == 1 ? '<span class="btn btn-success btn-sm" style="border-radius: 15px;"> active</span>' : '<span class="btn btn-danger btn-sm" style="border-radius: 15px;"> Inactive</span>';
                return $show_on_menu;
            })
            // Allow HTML rendering for these columns
            ->rawColumns(['action','show_on_menu','show_at_homepage','color','parent_id'])
            ->toJson();
    }

    public function index(){
        return view('admin.subcategory.index');
    }

    public function create(){
        $default_language = Language::where('is_default',1)->first();
        $categories = Category::where('parent_id','=',NULL)->where('language_id',$default_language->id)->get();
        $datas = Language::orderBy('id','desc')->get();
        return view('admin.subcategory.create',compact('categories','datas'));
    }

    public function store(Request $request){

         // 1. Validation
        $rules =[
            'language_id'      => 'required',
            'title'            => 'required|unique:categories',
            'slug'             => 'required|unique:categories', // Validate Slug
            'parent_id'        => 'nullable',                   // Allow null for Main Category
            'category_order'   => 'required',
            'show_at_homepage' => 'required',
            'show_on_menu'     => 'required'
        ];
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
        }

        $data  = new Category(); 
        $input = $request->all();

        // 2. Logic for Slug: Use user input or create from title
        if(!empty($request->slug)){
             $input['slug'] = slug_create($request->slug);
        } else {
             $input['slug'] = slug_create($request->title);
        }

        // 3. Logic for Parent ID: If empty, set to NULL
        if(empty($request->parent_id)){
            $input['parent_id'] = null;
        }

        $data->fill($input)->save();
        $msg = 'Data Added Successfully';
        return response()->json($msg);
    }

    public function edit($id){
        $data = Category::find($id);
        $default_language = Language::where('is_default',1)->first();
        // Pass all main categories so user can switch parents
        $categories = Category::where('parent_id','=',NULL)->where('language_id',$default_language->id)->get();
        return view('admin.subcategory.edit',compact('data','categories'));
    }

    public function languageOnUpdate( $x, $y){
        // Get all Main Categories for the new language
        $datas = Language::find($x)->categories()->where('parent_id','=',NULL)->get();
        
        // Get the current category being edited
        $currentCategory = Category::find($y);
        
        // Safely get the parent ID (if it exists)
        // This prevents a crash if the category is currently a Main Category
        $currentParentId = $currentCategory->parent ? $currentCategory->parent->id : null;

        // Updated default option
        $output = '<option value="">Set as Main Category</option>';
        
        foreach($datas as $data){
            // Check if this option matches the current parent
            if($data->id == $currentParentId){
                $msg = 'selected';
            }else{
                $msg = '';
            }
            $output .= '<option value="'.$data->id.'" '.$msg.'>'.$data->title.'</option>';
        }
        return $output;
    }

    // === UPDATED FUNCTION TO ALLOW MOVING TO MAIN CATEGORY ===
    public function update(Request $request, $id){
         // 1. Validation
         $rules =[
            'title'            => 'required|unique:categories,title,'.$id,
            'slug'             => 'required|unique:categories,slug,'.$id,
            'parent_id'        => 'nullable',
            'category_order'   => 'required', // Validate Order
            'show_at_homepage' => 'required', // Validate Homepage status
            'show_on_menu'     => 'required'  // Validate Menu status
        ];
        
        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
        }
         
         $data = Category::find($id); 
         $input = $request->all(); 

         // 2. Logic to handle moving Sub -> Main
         if(empty($request->parent_id)) {
             $input['parent_id'] = null;

             // Move posts from 'subcategories_id' to 'category_id'
             \App\Models\Post::where('subcategories_id', $id)->update([
                 'category_id' => $id,
                 'subcategories_id' => null
             ]);
         } elseif ($data->parent_id != $request->parent_id) {
             // Moving from one Parent to a DIFFERENT Parent
             \App\Models\Post::where('subcategories_id', $id)->update([
                 'category_id' => $request->parent_id
             ]);
         }

         if($slg = $request->title){
             $input['slug'] = slug_create($slg);
         }
         $input['slug'] = slug_create($request->slug);

         // This will automatically save color, category_order, show_at_homepage
         // because they are in the $input array and are fillable in the Model.
         $data->update($input);     
         
         $msg = 'Data Updated Successfully';
         return response()->json($msg);
    }

    public function delete($id){
        $data  = Category::findOrFail($id); // delete a record by id
        foreach($data->subcategoryPosts as $post){
            $post->delete();
        }
        $data->delete();
        $msg = 'Data Successfully Deleted';
        return response()->json($msg);
    }
}