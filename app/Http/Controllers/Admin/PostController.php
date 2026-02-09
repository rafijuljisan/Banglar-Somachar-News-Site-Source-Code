<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Language;
use App\Models\View;
use App\Models\Admin;
use Carbon\Carbon;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Enhanced datatables with comprehensive filtering
     */
    public function datatables(Request $request)
{
    $input = $request->all();
    $user = Auth::guard('admin')->user();
    $userRole = $user->role;

    // 1. SELECT SPECIFIC FIELDS & EAGER LOAD RELATIONSHIPS
    // Added 'subcategory' here so it loads with the post
    $query = Post::with(['category', 'subcategory', 'language', 'admin', 'views'])
        ->select('posts.*') 
        ->where('posts.status', '=', 'true')
        ->where('posts.schedule_post', '=', 0)
        ->where('posts.schedule_post_date', '=', NULL);

    // Apply role-based restrictions
    if ($userRole->name != 'admin' && $userRole->name != 'moderator') {
        $query->where('posts.admin_id', $user->id);
    }

    // --- FILTERS (Using strict 'posts.' prefix to avoid ambiguity) ---

    if (isset($input['lang']) && $input['lang'] != '') {
        $query->where('posts.language_id', $input['lang']);
    }

    if (isset($input['category']) && $input['category'] != '') {
        $query->where('posts.category_id', $input['category']);
    }

    // Filter for Subcategory
    if (isset($input['subcategory']) && $input['subcategory'] != '') {
        $query->where('posts.subcategories_id', $input['subcategory']);
    }

    if (isset($input['author']) && $input['author'] != '') {
        $query->where('posts.admin_id', $input['author']);
    }

    if (isset($input['post_type']) && $input['post_type'] != '') {
        $query->where('posts.post_type', $input['post_type']);
    }

    if (isset($input['approval_status']) && $input['approval_status'] != '') {
        $query->where('posts.is_pending', $input['approval_status']);
    }

    if (isset($input['slider_status']) && $input['slider_status'] != '') {
        $query->where('posts.is_slider', $input['slider_status']);
    }

    if (isset($input['breaking_status']) && $input['breaking_status'] != '') {
        $query->where('posts.is_trending', $input['breaking_status']);
    }

    if (isset($input['feature_status']) && $input['feature_status'] != '') {
        $query->where('posts.is_feature', $input['feature_status']);
    }

    if (isset($input['date_from']) && $input['date_from'] != '') {
        $query->whereDate('posts.created_at', '>=', $input['date_from']);
    }
    if (isset($input['date_to']) && $input['date_to'] != '') {
        $query->whereDate('posts.created_at', '<=', $input['date_to']);
    }

    if (isset($input['search_text']) && $input['search_text'] != '') {
        $query->where(function($q) use ($input) {
            $q->where('posts.title', 'like', '%' . $input['search_text'] . '%')
              ->orWhere('posts.tags', 'like', '%' . $input['search_text'] . '%');
        });
    }

    // Popular Sort
    if (isset($input['popular']) && $input['popular'] == 'true') {
        // Note: Sort logic usually needs specific handling with eager loading, 
        // but if simple sorting is required we stick to ID for stability unless views_count is appended
        $query->orderBy('posts.views', 'desc'); 
    } else {
        $query->orderBy('posts.id', 'desc');
    }

    // Filter by View Counts
    if (isset($input['min_views']) && $input['min_views'] != '') {
        // If 'views' is an integer column
        $query->where('posts.views', '>=', $input['min_views']);
    }
    if (isset($input['max_views']) && $input['max_views'] != '') {
         $query->where('posts.views', '<=', $input['max_views']);
    }

    return Datatables::of($query)
        ->addColumn('action', function(Post $data) {
            $slider = $data->is_slider == 0 
                ? '<a href="'.route('post.sliderChange',$data->id).'"><i class="fa fa-plus"></i> Add Into Slider</a>' 
                : '<a href="'.route('post.sliderChange',$data->id).'"><i class="fa fa-minus"></i> Remove From Slider</a>';
            
            $is_trending = $data->is_trending == 0 
                ? '<a href="'.route('post.trendingChange',$data->id).'"><i class="fa fa-plus"></i> Add Into Breaking</a>' 
                : '<a href="'.route('post.trendingChange',$data->id).'"><i class="fa fa-minus"></i> Remove Breaking</a>';
            
            $is_approve = $data->is_pending == 0 
                ? '<a href="'.route('post.pendingChange',$data->id).'"><i class="fa fa-file"></i> Make Post Pending</a>' 
                : '<a href="'.route('post.pendingChange',$data->id).'"><i class="fa fa-file"></i> Make Post Approve</a>';
            
            $is_slider_lefts = $data->is_feature == 0 
                ? '<a href="'.route('post.feature',$data->id).'"><i class="fa fa-plus"></i> Add into Feature</a>' 
                : '<a href="'.route('post.feature',$data->id).'"><i class="fa fa-minus"></i> Remove Feature</a>';
            
            $is_slider_rights = $data->slider_right == 0 
                ? '<a href="'.route('post.sliderright',$data->id).'"><i class="fa fa-plus"></i> Add into sliderRight</a>' 
                : '<a href="'.route('post.sliderright',$data->id).'"><i class="fa fa-minus"></i> Remove sliderRight</a>';
            
            $edit = ($data->post_type=='rss') ? '' : '<a href="'.route('post.edit',$data->id).'"> <i class="fas fa-edit"></i> Edit</a>';
            
            $details = '<a href="'.route('frontend.details',[$data->id,$data->slug]).'" target="_blank"> <i class="fa fa-info-circle" aria-hidden="true"></i> View on Frontend</a>';
            $analytics = '<a href="'.route('post.analytics',$data->id).'"> <i class="fa fa-chart-line"></i> View Analytics</a>';
            
            return '<div class="godropdown"><button class="go-dropdown-toggle"> Actions<i class="fas fa-chevron-down"></i></button><div class="action-list">'.$details.''.$edit.''.$analytics.''.$slider.''.$is_trending.''.$is_slider_lefts.''.$is_slider_rights.''. $is_approve.'<a href="javascript:;" data-href="'.route('post.delete',$data->id).'" data-toggle="modal" data-target="#confirm-delete" class="delete"><i class="fas fa-trash-alt"></i> Delete</a></div></div>';
        })
        ->addColumn('checkbox', function(Post $data) {
            return '<input type="checkbox" class="form-check-input m-0 p-0 postCheck" value="'.$data->id.'">';
        })
        ->editColumn('category_id', function(Post $data) {
            // --- FIXED SUBCATEGORY DISPLAY ---
            $cat = $data->category ? $data->category->title : 'N/A';
            // If subcategory exists, append it with a small arrow
            $sub = $data->subcategory ? '<br><small class="text-muted" style="font-size:11px;"> &raquo; '.$data->subcategory->title.'</small>' : '';
            
            return '<span class="badge badge-primary">'.$cat.'</span>'.$sub;
        })
        ->editColumn('language_id', function(Post $data) {
            return $data->language_id ? '<span class="badge badge-info">'.$data->language->language.'</span>' : '';
        })
        ->addColumn('is_approve', function(Post $data) {
            return $data->is_pending == 0 
                ? '<span class="badge badge-success">Approved</span>'
                : '<span class="badge badge-danger">Pending</span>';
        })
        ->editColumn('post_type', function(Post $data) {
            return $data->post_type ? '<span class="badge badge-secondary">'.$data->post_type.'</span>' : '';
        })
        ->editColumn('image_big', function(Post $data) {
            if($data->post_type == 'rss'){
                $rss_image = $data->rss_image ? $data->rss_image : url('assets/images/nopic.png');
                return '<img src="'.$rss_image.'" alt="Image">';
            } else {
                $image_big = $data->image_big ? url('assets/images/post/'.$data->image_big) : url('assets/images/nopic.png');
                return '<img src="'.$image_big.'" alt="Image">';
            }
        })
        ->editColumn('created_at', function(Post $data) {
            return $data->created_at->toFormattedDateString();
        })
        ->editColumn('admin_id', function(Post $data) {
            return $data->admin_id ? $data->admin->name : '';
        })
        ->addColumn('view_count', function(Post $data) {
            // FIX for "Call to count() on int"
            // If views is numeric (column value), use it directly
            if (is_numeric($data->views)) {
                return '<span class="badge badge-info">'.$data->views.' views</span>';
            }
            // If views is a relationship collection, count it
            return '<span class="badge badge-info">'.$data->views->count().' views</span>';
        })
        ->rawColumns(['checkbox', 'image_big', 'category_id', 'language_id', 'action', 'is_approve', 'post_type', 'created_at', 'admin_id', 'view_count'])
        ->make(true);
}

    /**
     * Display index page with filter options
     */
    public function index(Request $request)
    {
        $languages = Language::orderBy('id', 'desc')->get();
        $categories = Category::where('parent_id', NULL)->get();
        $authors = Admin::all();
        
        // Get unique post types
        $postTypes = Post::select('post_type')
            ->distinct()
            ->whereNotNull('post_type')
            ->pluck('post_type');

        return view('admin.post.index', compact('languages', 'categories', 'authors', 'postTypes'));
    }

    /**
     * Get subcategories for the filter dropdown
     * Returns Raw HTML <options> to match your app style
     */
    public function getSubcategories($id) 
    {
        // Get subcategories where parent_id matches the selected category
        $subcategories = Category::where('parent_id', $id)->get();
        
        $output = '<option value="">All Subcategories</option>';
        
        foreach($subcategories as $subcategory) {
            $output .= '<option value="'.$subcategory->id.'">'.$subcategory->title.'</option>';
        }
        
        // Return raw string (not JSON)
        return $output;
    }

    /**
     * Get author statistics
     */
    public function getAuthorStats(Request $request)
    {
        $authorId = $request->author_id;
        $dateFrom = $request->date_from;
        $dateTo = $request->date_to;

        // Base Query
        $query = Post::where('admin_id', $authorId)
            ->where('status', 'true'); // Ensure this matches your DB value (1 or 'true')

        if ($dateFrom) {
            $query->whereDate('created_at', '>=', $dateFrom);
        }
        if ($dateTo) {
            $query->whereDate('created_at', '<=', $dateTo);
        }

        // Basic Counts
        $stats = [
            'total_posts' => (clone $query)->count(),
            'approved_posts' => (clone $query)->where('is_pending', 0)->count(),
            'pending_posts' => (clone $query)->where('is_pending', 1)->count(),
            'slider_posts' => (clone $query)->where('is_slider', 1)->count(),
            'breaking_posts' => (clone $query)->where('is_trending', 1)->count(),
            'featured_posts' => (clone $query)->where('is_feature', 1)->count(),
        ];

        // --- FIX IS HERE ---
        // Old Code: Looped through posts to count views (Crashed because views is an int)
        // New Code: Ask DB to SUM the 'views' column directly. Much faster and bug-free.
        $stats['total_views'] = (clone $query)->sum('views');

        // Posts by type
        $stats['posts_by_type'] = (clone $query)
            ->select('post_type', DB::raw('count(*) as count'))
            ->whereNotNull('post_type')
            ->groupBy('post_type')
            ->get();

        // Posts by category
        // We use 'posts.category_id' to avoid ambiguity if joined
        $stats['posts_by_category'] = (clone $query)
            ->join('categories', 'posts.category_id', '=', 'categories.id')
            ->select('categories.title', DB::raw('count(*) as count'))
            ->groupBy('categories.title')
            ->get();

        // Recent performance (last 30 days)
        $stats['recent_posts_30_days'] = Post::where('admin_id', $authorId)
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();

        return response()->json($stats);
    }

    /**
     * Get analytics dashboard data
     */
    public function getAnalyticsDashboard(Request $request)
    {
        $dateFrom = $request->date_from ?? Carbon::now()->subDays(30)->format('Y-m-d');
        $dateTo = $request->date_to ?? Carbon::now()->format('Y-m-d');

        $data = [
            // Overall stats
            'total_posts' => Post::whereBetween('created_at', [$dateFrom, $dateTo])->count(),
            'total_views' => View::whereBetween('created_at', [$dateFrom, $dateTo])->count(),
            'approved_posts' => Post::whereBetween('created_at', [$dateFrom, $dateTo])
                ->where('is_pending', 0)->count(),
            'pending_posts' => Post::whereBetween('created_at', [$dateFrom, $dateTo])
                ->where('is_pending', 1)->count(),

            // Top authors
            'top_authors' => Post::whereBetween('created_at', [$dateFrom, $dateTo])
                ->select('admin_id', DB::raw('count(*) as post_count'))
                ->groupBy('admin_id')
                ->orderBy('post_count', 'desc')
                ->limit(10)
                ->with('admin')
                ->get(),

            // Top categories
            'top_categories' => Post::whereBetween('created_at', [$dateFrom, $dateTo])
                ->select('category_id', DB::raw('count(*) as post_count'))
                ->whereNotNull('category_id')
                ->groupBy('category_id')
                ->orderBy('post_count', 'desc')
                ->limit(10)
                ->with('category')
                ->get(),

            // Posts by type
            'posts_by_type' => Post::whereBetween('created_at', [$dateFrom, $dateTo])
                ->select('post_type', DB::raw('count(*) as count'))
                ->whereNotNull('post_type')
                ->groupBy('post_type')
                ->get(),

            // Daily post count (for chart)
            'daily_posts' => Post::whereBetween('created_at', [$dateFrom, $dateTo])
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get(),
        ];

        return response()->json($data);
    }

    /**
     * Get individual post analytics
     */
    public function analytics($id)
    {
        $post = Post::with(['views', 'admin', 'category', 'language'])->findOrFail($id);
        
        $analytics = [
            'total_views' => $post->views->count(),
            'unique_views' => $post->views->unique('ip_address')->count(),
            'views_by_date' => $post->views()
                ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                ->groupBy('date')
                ->orderBy('date', 'desc')
                ->limit(30)
                ->get(),
            'avg_views_per_day' => $post->views->count() / max(1, $post->created_at->diffInDays(now())),
        ];

        return view('admin.post.analytics', compact('post', 'analytics'));
    }

    /**
     * Enhanced category filter with language support
     */
    public function categoryFilter($id)
    {
        $categories = Category::where('language_id', $id)
                              ->where('parent_id', NULL)
                              ->get();
        
        $output = '<option value="" data-href="'.route('post.datatables').'?lang='.$id.'">All Categories</option>';
        
        foreach($categories as $category) {
            $subcategoryCount = Category::where('parent_id', $category->id)->count();
            $categoryLabel = $category->title . ($subcategoryCount > 0 ? ' ('.$subcategoryCount.' subs)' : '');
            $output .= '<option value="'.$category->id.'" data-href="'.route('post.datatables').'?category='.$category->id.'&lang='.$id.'">'.$categoryLabel.'</option>';
        }
        
        return $output;
    }

    // ============================================
    // KEEP ALL YOUR EXISTING METHODS BELOW
    // ============================================
    
    public function edit($id)
    {
        $data = Post::find($id);
        $categories = Category::where('parent_id', '=', NULL)->get();
        $languages = Language::orderBy('id', 'desc')->get();

        if($data->post_type == 'article'){
            return view('admin.article.edit', compact('categories', 'languages', 'data'));
        }
        elseif($data->post_type == 'video') {
            return view('admin.video.edit', compact('categories', 'languages', 'data'));
        }
        elseif($data->post_type == 'Sorted List') {
            return view('admin.shortlist.edit', compact('categories', 'languages', 'data'));
        }
        elseif($data->post_type == 'Trivia Quiz'){
            return view('admin.quiz.edit', compact('categories', 'languages', 'data'));
        }
        elseif($data->post_type == 'Personality Quiz'){
            return view('admin.pquiz.edit', compact('categories', 'languages', 'data'));
        }
        else {
            return view('admin.audio.edit', compact('categories', 'languages', 'data'));
        }
    }

    public function view($id)
    {
        $data = Post::find($id);
        if($data->post_type == 'article'){
            return view('admin.article.view', compact('data'));
        }
    }

    public function sliderChange($id)
    {
        $data = Post::find($id);

        if($data->is_slider == 1){
           $data->is_slider = 0;
        }else{
            $data->is_slider = 1;
        }
        $data->update();
        return back()->with('success','Slider Status Updated successfully!');
    }

    public function sliderBulk(Request $request)
    {
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->is_slider == 0){
               $post->update(['is_slider'=> 1]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function removesliderBulk(Request $request)
    {
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->is_slider == 1){
               $post->update(['is_slider'=> 0]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function breakingBulk(Request $request)
    {
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->is_trending == 0){
               $post->update(['is_trending'=> 1]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function removebreakingBulk(Request $request)
    {
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->is_trending == 1){
               $post->update(['is_trending'=> 0]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function featureBulk(Request $request)
    {
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->is_feature == 0){
               $post->update(['is_feature'=> 1]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function removefeatureBulk(Request $request)
    {
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->is_feature == 1){
               $post->update(['is_feature'=> 0]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function rightBulk(Request $request)
    {
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->slider_right == 0){
               $post->update(['slider_right'=> 1]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function removerightBulk(Request $request)
    {
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $post = Post::findOrFail($data);
            if($post->slider_right == 1){
               $post->update(['slider_right'=> 0]);
            }
        }
        return back()->with('success','Data Updated successfully!');
    }

    public function trendingChange($id)
    {
        $data = Post::find($id);

        if($data->is_trending == 1){
           $data->is_trending = 0;
        }else{
            $data->is_trending = 1;
        }
        $data->update();
        return back()->with('success','Breaking News Status Updated successfully!');
    }

    public function featureChange($id)
    {
        $data = Post::find($id);

        if($data->is_feature == 1){
           $data->is_feature = 0;
        }else{
            $data->is_feature = 1;
        }
        $data->update();
        return back()->with('success','Data Updated successfully!');
    }

    public function sliderright($id)
    {
        $data = Post::find($id);

        if($data->slider_right == 1){
           $data->slider_right = 0;
        }else{
            $data->slider_right = 1;
        }
        $data->update();
        return back()->with('success','Data Updated successfully!');
    }

    public function pendingChange($id)
    {
        $data = Post::find($id);

        if($data->is_pending == 1){
           $data->is_pending = 0;
        }else{
            $data->is_pending = 1;
        }
        $data->update();
        return back()->with('success','Pending Status Updated successfully!');
    }

    public function delete($id)
    {
        $data = Post::find($id);
        foreach($data->views as $view){
           $view->delete();
        }
        if($data->post_type == 'audio'){
            @unlink('assets/audios/'.$data->audio);
        }
        if($data->post_type == 'video'){
            @unlink('assets/videos/'.$data->video);
        }
        if($data->post_type == 'Trivia Quiz'){
            if($data->tquizs->count()>0){
                foreach ($data->tquizs as $quiz) {
                   if($quiz->answers->count()>0){
                       foreach($quiz->answers as $answer){
                        @unlink('assets/images/quizanswer/'.$answer->answer_photo);
                        $answer->delete(); 
                       }
                   }
                   @unlink('assets/images/quiz/'.$quiz->question_photo);
                   $quiz->delete();
                }
            }
            if($data->tresults->count()>0){
                foreach($data->tresults as $tresult){
                    @unlink('assets/images/quizresult/'.$tresult->result_photo);  
                    $tresult->delete();
                }
            }
        }

        if($data->post_type == 'Personality Quiz'){
            if($data->pquizs->count()>0){
                foreach ($data->pquizs as $quiz) {
                   if($quiz->answers->count()>0){
                       foreach($quiz->answers as $answer){
                        @unlink('assets/images/panswer/'.$answer->answer_photo); 
                        $answer->delete(); 
                       }
                   }
                   @unlink('assets/images/pquiz/'.$quiz->question_photo);
                   $quiz->delete();
                }
            }

            if($data->presults->count()>0){
                foreach($data->presults as $presult){
                    @unlink('assets/images/presult/'.$presult->result_photo); 
                    $presult->delete();
                }
            }
        }

        if($data->post_type == 'Sorted List'){
            if($data->sorts->count()>0){
                foreach($data->sorts as $sort){
                    @unlink('assets/images/sort/'.$sort->item_photo);
                    $sort->delete();
                }
            }
        }

        @unlink('assets/images/post/'.$data->image_big);
        $data->delete();
        $msg = 'Data Successfully Deleted';
        return response()->json($msg);
    }

    public function bulkdelete(Request $request)
    {
        $datas =  explode(',',$request->ids);
        foreach($datas as $data){
            $views = Post::find($data)->views;
            foreach($views as $view){
                $view->delete();
             }
            $post = Post::findOrFail($data);
            if($post->post_type == 'audio'){
                @unlink('assets/audios/'.$data->audio);
            }
            if($post->post_type == 'video'){
                @unlink('assets/videos/'.$data->video);
            }
            if($post->post_type == 'Trivia Quiz'){
                if($post->tquizs->count()>0){
                    foreach ($post->tquizs as $quiz) {
                       if($quiz->answers->count()>0){
                           foreach($quiz->answers as $answer){
                            @unlink('assets/images/quizanswer/'.$answer->answer_photo);
                            $answer->delete(); 
                           }
                       }
                       @unlink('assets/images/quiz/'.$quiz->question_photo);
                       $quiz->delete();
                    }
                }
                if($post->tresults->count()>0){
                    foreach($post->tresults as $tresult){
                        @unlink('assets/images/quizresult/'.$tresult->result_photo);  
                        $tresult->delete();
                    }
                }
            }
    
            if($post->post_type == 'Personality Quiz'){
                if($post->pquizs->count()>0){
                    foreach ($post->pquizs as $quiz) {
                       if($quiz->answers->count()>0){
                           foreach($quiz->answers as $answer){
                            @unlink('assets/images/panswer/'.$answer->answer_photo); 
                            $answer->delete(); 
                           }
                       }
                       @unlink('assets/images/pquiz/'.$quiz->question_photo);
                       $quiz->delete();
                    }
                }
    
                if($post->presults->count()>0){
                    foreach($post->presults as $presult){
                        @unlink('assets/images/presult/'.$presult->result_photo); 
                        $presult->delete();
                    }
                }
            }
    
            if($post->post_type == 'Sorted List'){
                if($post->sorts->count()>0){
                    foreach($post->sorts as $sort){
                        @unlink('assets/images/sort/'.$sort->item_photo);
                        $sort->delete();
                    }
                }
            }
    
            @unlink('assets/images/post/'.$post->image_big);
            $post->delete();
        }
        return back()->with('success','Data Deleted successfully!');
    }
}