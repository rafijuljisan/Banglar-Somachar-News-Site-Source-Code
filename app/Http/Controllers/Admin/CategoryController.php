<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Language;
use App\Models\Post;
use Datatables;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    public function categoriesDatatables()
    {
        $datas = Category::where('parent_id', '=', NULL)
            ->orderBy('id', 'desc')
            ->get();

        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->addColumn('action', function (Category $data) {
                return '<div class="action-list"><a data-href="' . route('categories.categoriesEdit', $data->id) . '" class="edit" data-toggle="modal" data-target="#modal1"> <i class="fas fa-edit"></i>Edit</a><a href="javascript:;" data-href="' . route('categories.categoriesDelete', $data->id) . '" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i></a></div>';
            })
            ->editColumn('show_at_homepage', function (Category $data) {
                $show_at_homepage = $data->show_at_homepage == 1 ? '<span class="btn btn-success btn-sm" style="border-radius: 15px;"> active</span>' : '<span class="btn btn-danger btn-sm" style="border-radius: 15px;"> Inactive</span>';
                return $show_at_homepage;
            })
            ->editColumn('show_on_menu', function (Category $data) {
                $show_on_menu = $data->show_on_menu == 1 ? '<span class="btn btn-success btn-sm" style="border-radius: 15px;"> active</span>' : '<span class="btn btn-danger btn-sm" style="border-radius: 15px;"> Inactive</span>';
                return $show_on_menu;
            })
            ->editColumn('color', function (Category $data) {
                $color = $data->color ? '<div style="width: 60px; height: 30px; background-color:' . $data->color . ' ;"></div>' : '';
                return $color;
            })
            ->editColumn('language_id', function (Category $data) {
                return $language_id = $data->language_id ? $data->language->language : '';
            })

            ->rawColumns(['action', 'show_at_homepage', 'show_on_menu', 'color', 'language_id'])
            ->toJson(); //--- Returning Json Data To Client Side
    }
    public function categories()
    {
        return view('admin.category.index');
    }
    public function categoriesCreate()
    {
        $cat_id = Category::all()->map(function ($item, $key) {
            return $item->id;
        });
        $datas = Language::orderBy('id', 'desc')->get();
        return view('admin.category.create', compact('datas', 'cat_id'));
    }
    public function categorySlug(Request $request)
    {
        $val = $request->title;
        $output = slug_create($val); //slug_create() from helper.php
        return $output;
    }

    public function categoriesStore(Request $request)
    {

        //validation area
        $rules = [
            'language_id' => 'required',
            'title' => 'required',
            'slug' => 'required|unique:categories',
            'category_order' => 'required',
            'show_at_homepage' => 'required',
            'show_on_menu' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }
        //validation area end

        $menu_order = Category::where('category_order', $request->category_order)->first();
        if (!empty($menu_order)) {
            $msg[] = 'Opss!Menu Order Available...';
            return response()->json(['errors' => $msg]);
        } else {
            //create a new instance of Category Model
            $data = new Category();
            $input = $request->all(); //taking all fields value

            $data->fill($input)->save(); //Save data to the categories table
            $msg = 'New Data Added Successfully.';
            return response()->json($msg);
        }

    }
    public function categoriesEdit($id){
        $data = Category::findOrFail($id);
        $languages = Language::all();
        
        // NEW: Get all Main Categories (except the one we are editing) to show in dropdown
        $allCategories = Category::where('parent_id', NULL)
                                 ->where('id', '!=', $id)
                                 ->where('language_id', $data->language_id) // Optional: Match language
                                 ->get();

        return view('admin.category.edit',compact('data','languages', 'allCategories'));
    }

    public function categoriesUpdate(Request $request, $id){
        // 1. Validation
        $rules = [
            'language_id' => 'required',
            'title'       => 'required',
            'slug'        => 'required|unique:categories,slug,'.$id,
            'category_order' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }

        $category = Category::findOrFail($id);
        $input = $request->all();

        // 2. Determine Parent ID Logic
        $newParentId = null;
        if ($request->has('parent_id') && !empty($request->parent_id)) {
            $newParentId = $request->parent_id;
        }

        // 3. AUTO-MIGRATE POSTS LOGIC
        // Check if we are changing status (Main <-> Sub)
        $wasMain = ($category->parent_id == null);
        $isNowSub = ($newParentId != null);

        // Scenario A: It was Main, now becoming Sub
        if ($wasMain && $isNowSub) {
            // Move posts: Old 'category_id' (this id) becomes 'subcategories_id'
            // New 'category_id' becomes the Parent ID
            \App\Models\Post::where('category_id', $id)->update([
                'category_id' => $newParentId,
                'subcategories_id' => $id
            ]);
        }

        // Scenario B: It was Sub, now becoming Main
        if (!$wasMain && !$isNowSub) {
            // Move posts: Old 'subcategories_id' (this id) becomes 'category_id'
            \App\Models\Post::where('subcategories_id', $id)->update([
                'category_id' => $id,
                'subcategories_id' => null
            ]);
        }
        
        // Scenario C: Moving from one Parent to another Parent
        if (!$wasMain && $isNowSub && $category->parent_id != $newParentId) {
            \App\Models\Post::where('subcategories_id', $id)->update([
                'category_id' => $newParentId
            ]);
        }

        // 4. Save Category
        $input['parent_id'] = $newParentId;
        
        // Infinite loop protection
        if($input['parent_id'] == $id) {
             return response()->json(['errors' => ['Category cannot be its own parent']]);
        }

        $category->update($input);
        $msg = 'Category Moved & Updated Successfully';
        return response()->json($msg);
    }
    public function categoriesDelete($id)
    {
        $data = Category::findOrFail($id);
        foreach ($data->posts as $post) {
            $post = Post::find($post->id);

            if ($post->post_type == 'audio') {
                @unlink('assets/audios/' . $post->audio);
            }
            if ($post->post_type == 'video') {
                @unlink('assets/videos/' . $post->video);
            }

            if ($post->post_type == 'Trivia Quiz') {
                if ($post->tquizs->count() > 0) {
                    foreach ($post->tquizs as $quiz) {
                        if ($quiz->answers->count() > 0) {
                            foreach ($quiz->answers as $answer) {
                                @unlink('assets/images/quizanswer/' . $answer->answer_photo);
                                $answer->delete();
                            }
                        }
                        @unlink('assets/images/quiz/' . $quiz->question_photo);
                        $quiz->delete();
                    }
                }
                if ($post->tresults->count() > 0) {
                    foreach ($post->tresults as $tresult) {
                        @unlink('assets/images/quizresult/' . $tresult->result_photo);
                        $tresult->delete();
                    }
                }
            }

            if ($post->post_type == 'Personality Quiz') {
                if ($post->pquizs->count() > 0) {
                    foreach ($post->pquizs as $quiz) {
                        if ($quiz->answers->count() > 0) {
                            foreach ($quiz->answers as $answer) {
                                @unlink('assets/images/panswer/' . $answer->answer_photo);
                                $answer->delete();
                            }
                        }
                        @unlink('assets/images/pquiz/' . $quiz->question_photo);
                        $quiz->delete();
                    }
                }

                if ($post->presults->count() > 0) {
                    foreach ($post->presults as $presult) {
                        @unlink('assets/images/presult/' . $presult->result_photo);
                        $presult->delete();
                    }
                }
            }

            if ($post->post_type == 'Sorted List') {
                if ($post->sorts->count() > 0) {
                    foreach ($post->sorts as $sort) {
                        @unlink('assets/images/sort/' . $sort->item_photo);
                        $sort->delete();
                    }
                }
            }
            @unlink('assets/images/post/' . $data->image_big);
            $post->delete();
        }
        $data->delete();
        $msg = 'Data Successfully Deleted';
        return response()->json($msg);
    }
}
