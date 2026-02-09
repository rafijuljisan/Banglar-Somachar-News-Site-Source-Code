<?php

use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\SitemapGenerator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Organized and Cleaned Route File
|
*/

// =============================================================
//  1. GLOBAL REDIRECTS & SYSTEM
// =============================================================

Route::redirect('admin', 'admin/login');

// Fallback login named route (often required by Laravel Auth middleware)
Route::get('/test', function () {
    //
})->name('login');


// =============================================================
//  2. ADMIN PANEL ROUTES (Prefix: /admin)
// =============================================================

Route::prefix('admin')->namespace('Admin')->group(function () {

    // --- Admin Auth ---
    Route::get('/login', 'LoginController@loginForm')->name('admin.loginForm');
    Route::post('/login', 'LoginController@login')->name('admin.login');
    Route::get('/forgot', 'LoginController@showForgotForm')->name('admin.forgot');
    Route::post('/forgot', 'LoginController@forgot')->name('admin.forgot.submit');
    Route::get('/logout', 'DashboardController@logout')->name('admin.logout');

    // --- Dashboard & Profile ---
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('/profile', 'DashboardController@profile')->name('admin.profile');
    Route::post('/profile', 'DashboardController@profileUpdate')->name('admin.profile.update');
    Route::get('/password', 'DashboardController@passwordreset')->name('admin.password');
    Route::post('/password', 'DashboardController@changepass')->name('admin.password.update');

    // --- System Maintenance ---
    Route::get('/check/movescript', 'DashboardController@movescript')->name('admin-move-script');
    Route::get('/generate/backup', 'DashboardController@generate_bkup')->name('admin-generate-backup');
    Route::get('/clear/backup', 'DashboardController@clear_bkup')->name('admin-clear-backup');
    Route::get('/activation', 'DashboardController@activation')->name('admin-activation-form');
    Route::post('/activation', 'DashboardController@activation_submit')->name('admin-activate-purchase');

    // --- Menu Builder ---
    Route::middleware('permissions:menu_builder')->group(function () {
        Route::get('menu-builder', 'MenuBuilderController@index')->name('admin.menu.builder');
        Route::post('menu-builder/store', 'MenuBuilderController@store')->name('admin.menu.builder.store');
    });

    // --- Categories & Subcategories ---
    Route::middleware('permissions:categories')->group(function () {
        // Categories
        Route::get('/categories/datatables', 'CategoryController@categoriesDatatables')->name('categories.datatables');
        Route::get('/categories', 'CategoryController@categories')->name('categories.index');
        Route::get('/category/slug', 'CategoryController@categorySlug')->name('categories.categorySlug');
        Route::get('/categories/create', 'CategoryController@categoriesCreate')->name('categories.categoriesCreate');
        Route::post('/categories', 'CategoryController@categoriesStore')->name('categories.categoriesStore');
        Route::get('/categories/edit/{id}', 'CategoryController@categoriesEdit')->name('categories.categoriesEdit');
        Route::post('/categories/update/{id}', 'CategoryController@categoriesUpdate')->name('categories.categoriesUpdate');
        Route::get('/categories/delete/{id}', 'CategoryController@categoriesDelete')->name('categories.categoriesDelete');

        // Subcategories
        Route::get('/subcategories/datatables', 'SubCategoryController@datatables')->name('subcategories.datatables');
        Route::get('/subcategories', 'SubCategoryController@index')->name('subcategories.index');
        Route::get('/subcategories/create', 'SubCategoryController@create')->name('subcategories.create');
        Route::post('/subcategories', 'SubCategoryController@store')->name('subcategories.store');
        Route::get('/subcategories/edit/{id}', 'SubCategoryController@edit')->name('subcategories.edit');
        Route::post('/subcategories/update/{id}', 'SubCategoryController@update')->name('subcategories.update');
        Route::get('/subcategories/delete/{id}', 'SubCategoryController@delete')->name('subcategories.delete');
        Route::get('/subcategories/languageOnUpdate/{x}/{y}', 'SubCategoryController@languageOnUpdate')->name('subcategories.languageOnUpdate');
    });

    // --- Post Creation (Formats) ---
    Route::middleware('permissions:add_post')->group(function () {
        
        // Format Selection
        Route::get('/add-post', function () {
            return view('admin.post.format');
        })->name('admin.post.format');

        // Articles
        Route::get('/add-article', 'ArticleController@create')->name('article.create');
        Route::post('/add-article', 'ArticleController@store')->name('article.store');
        Route::post('/article/update/{id}', 'ArticleController@update')->name('article.update');
        Route::get('/add-article/subcategory/{id}', 'ArticleController@subcategory')->name('article.subcategory');
        Route::get('/edit-article/subcategoryUpdate/{x}/{y}', 'ArticleController@subcategoryUpdate')->name('article.subcategoryUpdate');
        Route::get('/add-article/slugCreate/', 'ArticleController@slugCreate')->name('article.slugCreate');
        Route::get('/add-article/slugCheck/', 'ArticleController@slugCheck')->name('article.slugCheck');
        Route::get('/add-article/languageOnUpdate/{x}/{y}', 'ArticleController@languageOnUpdate')->name('article.languageOnUpdate');
        Route::get('/add-article/language/{id}', 'ArticleController@language')->name('article.language');

        // Audio
        Route::get('/add-audio', 'AudioController@create')->name('audio.create');
        Route::post('/add-audio', 'AudioController@store')->name('audio.store');
        Route::post('/audio/update/{id}', 'AudioController@update')->name('audio.update');
        Route::get('/add-audio/subcategory/{id}', 'AudioController@subcategory')->name('audio.subcategory');
        Route::get('/edit-audio/subcategoryUpdate/{x}/{y}', 'AudioController@subcategoryUpdate')->name('audio.subcategoryUpdate');
        Route::get('/add-audio/slugCreate/', 'AudioController@slugCreate')->name('audio.slugCreate');
        Route::get('/add-audio/slugCheck/', 'AudioController@slugCheck')->name('audio.slugCheck');
        Route::get('/add-audio/language/{id}', 'AudioController@language')->name('audio.language');
        Route::get('/add-audio/languageOnUpdate/{x}/{y}', 'AudioController@languageOnUpdate')->name('audio.languageOnUpdate');

        // Video
        Route::get('/add-video', 'VideoController@create')->name('video.create');
        Route::post('/add-video', 'VideoController@store')->name('video.store');
        Route::post('/video/update/{id}', 'VideoController@update')->name('video.update');
        Route::get('/add-video/subcategory/{id}', 'VideoController@subcategory')->name('video.subcategory');
        Route::get('/edit-video/subcategoryUpdate/{x}/{y}', 'VideoController@subcategoryUpdate')->name('video.subcategoryUpdate');
        Route::get('/add-video/slugCreate/', 'VideoController@slugCreate')->name('video.slugCreate');
        Route::get('/add-video/slugCheck/', 'VideoController@slugCheck')->name('video.slugCheck');
        Route::get('/add-video/language/{id}', 'VideoController@language')->name('video.language');
        Route::get('/add-video/languageOnUpdate/{x}/{y}', 'VideoController@languageOnUpdate')->name('video.languageOnUpdate');

        // Trivia Quiz
        Route::get('/add-tquiz', 'TQuizController@create')->name('tquiz.create');
        Route::post('/add-tquiz/submit', 'TQuizController@store')->name('tquiz.store');
        Route::post('/add-tquiz/update/{id}', 'TQuizController@update')->name('tquiz.update');
        Route::get('/remove-tquizquestion/{id}', 'TQuizController@removequestion')->name('tquiz.removequestion');
        Route::get('/remove-tquizanswer/{id}', 'TQuizController@removeanswer')->name('tquiz.removeanswer');
        Route::get('/remove-tquizresult/{id}', 'TQuizController@removeresult')->name('tquiz.removeresult');

        // Personality Quiz
        Route::get('/add-pquiz', 'PQuizController@create')->name('pquiz.create');
        Route::post('/add-pquiz', 'PQuizController@store')->name('pquiz.store');
        Route::post('/add-pquiz/update/{id}', 'PQuizController@update')->name('pquiz.update');
        Route::get('/remove-pquizanswer/{id}', 'PQuizController@removeanswer')->name('pquiz.removeanswer');
        Route::get('/remove-pquizresult/{id}', 'PQuizController@removepresult')->name('pquiz.removeresult');
        Route::get('/remove-pquizquestion/{id}', 'PQuizController@removepquestion')->name('pquiz.removepquestion');

        // Short List
        Route::get('/add-shortlist', 'ShortListController@create')->name('shortlist.create');
        Route::post('/add-shortlist', 'ShortListController@store')->name('shortlist.store');
        Route::post('/add-shortlist/update/{id}', 'ShortListController@update')->name('shortlist.update');
        Route::get('/remove-shortlist/{id}', 'ShortListController@remove')->name('shortlist.remove');
    });

    // --- Post Management (Main, Slider, Feature, Breaking) ---
    Route::middleware('permissions:posts')->group(function () {
        
        // --- Enhanced Post Routes (Consolidated) ---
        Route::get('/posts', 'PostController@index')->name('post.index'); // Alias for index
        Route::get('/post', 'PostController@index')->name('post.index.legacy'); // Legacy
        Route::get('/posts/datatables', 'PostController@datatables')->name('post.datatables');
        Route::get('/post/datatables', 'PostController@datatables')->name('post.datatables.legacy');

        // Filters & Analytics
        Route::get('/post/subcategories/{id}', 'PostController@getSubcategories')->name('post.subcategories');
        Route::get('/category-filter/language/{id}', 'PostController@categoryFilter')->name('category.filter.language');
        Route::get('/post/author-stats', 'PostController@getAuthorStats')->name('post.author.stats');
        Route::get('/post/analytics-dashboard', 'PostController@getAnalyticsDashboard')->name('post.analytics.dashboard');
        Route::get('/post/analytics/{id}', 'PostController@analytics')->name('post.analytics');
        Route::post('/post/export-filtered', 'PostController@exportFilteredData')->name('post.export.filtered');
        Route::get('/category-filter/language/{id}', 'PostController@categoryFilter')->name('categoryFilter.language'); // Duplicate name kept for safety

        // CRUD Operations
        Route::get('/post/edit/{id}', 'PostController@edit')->name('post.edit');
        Route::get('/post/view/{id}', 'PostController@view')->name('post.view');
        Route::get('/post/delete/{id}', 'PostController@delete')->name('post.delete');
        
        // Bulk Operations
        Route::post('/post/bulk-delete', 'PostController@bulkdelete')->name('post.bulkdelete'); // Enhanced version
        Route::get('/post/bulkdelete', 'PostController@bulkdelete')->name('post.bulkdelete.legacy'); // Legacy version

        // Status Toggles (Single)
        Route::get('/post/slider-change/{id}', 'PostController@sliderChange')->name('post.sliderChange');
        Route::get('/post/slider/{id}', 'PostController@sliderChange')->name('post.sliderChange.legacy');
        Route::get('/post/trending-change/{id}', 'PostController@trendingChange')->name('post.trendingChange');
        Route::get('/post/trending/{id}', 'PostController@trendingChange')->name('post.trendingChange.legacy');
        Route::get('/post/feature-change/{id}', 'PostController@featureChange')->name('post.feature');
        Route::get('/post/feature/{id}', 'PostController@featureChange')->name('post.feature.legacy');
        Route::get('/post/slider-right/{id}', 'PostController@sliderright')->name('post.sliderright');
        Route::get('/post/sliderright/{id}', 'PostController@sliderright')->name('post.sliderright.legacy');
        Route::get('/post/pending-change/{id}', 'PostController@pendingChange')->name('post.pendingChange');
        Route::get('/post/pending/{id}', 'PostController@pendingChange')->name('post.pendingChange.legacy');

        // Bulk Toggles (Add)
        Route::post('/post/bulk-slider', 'PostController@sliderBulk')->name('post.slider.bulk');
        Route::get('/post/sliderBulk', 'PostController@sliderBulk')->name('post.add.sliderBulk');
        Route::post('/post/bulk-breaking', 'PostController@breakingBulk')->name('post.breaking.bulk');
        Route::get('/post/breakingBulk', 'PostController@breakingBulk')->name('post.add.breakingBulk');
        Route::post('/post/bulk-feature', 'PostController@featureBulk')->name('post.feature.bulk');
        Route::get('/post/featureBulk', 'PostController@featureBulk')->name('post.add.feature');
        Route::post('/post/bulk-right', 'PostController@rightBulk')->name('post.right.bulk');
        Route::get('/post/rightBulk', 'PostController@rightBulk')->name('post.add.rightBulk');

        // Bulk Toggles (Remove)
        Route::post('/post/bulk-remove-slider', 'PostController@removesliderBulk')->name('post.slider.bulk.remove');
        Route::get('/post/remove/sliderBulk', 'PostController@removesliderBulk')->name('post.remove.sliderBulk');
        Route::post('/post/bulk-remove-breaking', 'PostController@removebreakingBulk')->name('post.breaking.bulk.remove');
        Route::get('/post/remove/breakingBulk', 'PostController@removebreakingBulk')->name('post.remove.breakingBulk');
        Route::post('/post/bulk-remove-feature', 'PostController@removefeatureBulk')->name('post.feature.bulk.remove');
        Route::get('/post/remove/featureBulk', 'PostController@removefeatureBulk')->name('post.remove.featureBulk');
        Route::post('/post/bulk-remove-right', 'PostController@removerightBulk')->name('post.right.bulk.remove');
        Route::get('/post/remove/rightBulk', 'PostController@removerightBulk')->name('post.remove.rightBulk');

        // --- Specialized Lists (Slider/Feature/Breaking/Pending) ---
        
        // Slider List
        Route::get('/slider/datatables', 'SliderController@datatables')->name('slider.datatables');
        Route::get('/slider', 'SliderController@index')->name('slider.index');
        Route::get('/slider/category-filter/language/{id}', 'SliderController@categoryFilter')->name('slider.categoryFilter.language');

        // Feature List
        Route::get('/feature/datatables', 'FeaturedController@datatables')->name('feature.datatables');
        Route::get('/feature', 'FeaturedController@index')->name('feature.index');
        Route::get('/feature/category-filter/language/{id}', 'FeaturedController@categoryFilter')->name('feature.categoryFilter.language');

        // Breaking List
        Route::get('/breaking/datatables', 'BreakingController@datatables')->name('breaking.datatables');
        Route::get('/breaking', 'BreakingController@index')->name('breaking.index');
        Route::get('/breaking/category-filter/language/{id}', 'BreakingController@categoryFilter')->name('breaking.categoryFilter.language');

        // Pending List
        Route::get('/pending/datatables', 'PendingController@datatables')->name('pending.datatables');
        Route::get('/pending', 'PendingController@index')->name('pending.index');
        Route::get('/pending/category-filter/language/{id}', 'PendingController@categoryFilter')->name('pending.categoryFilter.language');
    });

    // --- Scheduled Posts ---
    Route::middleware('permissions:schedule_post')->group(function () {
        Route::get('/schedule/datatables', 'ScheduleController@datatables')->name('schedule.datatables');
        Route::get('/schedule', 'ScheduleController@index')->name('schedule.index');
        Route::get('/schedule/postApprove', 'ScheduleController@postApprove')->name('schedule.postApprove');
    });

    // --- Drafts ---
    Route::middleware('permissions:drafts')->group(function () {
        Route::get('/draft/datatables', 'DraftController@datatables')->name('draft.datatables');
        Route::get('/draft', 'DraftController@index')->name('draft.index');
        Route::get('/draft/article/approve', 'DraftController@draftArticle')->name('draft.article');
        Route::get('/draft/audio/approve', 'DraftController@draftAudio')->name('draft.audio');
        Route::get('/draft/video/approve', 'DraftController@draftVideo')->name('draft.video');
    });

    // --- RSS Feeds ---
    Route::middleware('permissions:rss_feeds')->group(function () {
        Route::get('/rss/datatables', 'RssFeedsController@datatables')->name('rss.datatables');
        Route::get('/rss', 'RssFeedsController@index')->name('rss.index');
        Route::get('/rss/create', 'RssFeedsController@create')->name('rss.create');
        Route::post('/rss', 'RssFeedsController@store')->name('rss.store');
        Route::get('/rss/edit/{id}', 'RssFeedsController@edit')->name('rss.edit');
        Route::post('/rss/update/{id}', 'RssFeedsController@update')->name('rss.update');
        Route::get('/rss/delete/{id}', 'RssFeedsController@delete')->name('rss.delete');
        Route::get('/rss/category/{id}', 'RssFeedsController@categoryByLanguage')->name('rss.category');
        Route::get('/rss/categoryUpdate/{x}/{y}', 'RssFeedsController@categoryByLanguageUpdate')->name('rss.categoryUpdate');
        Route::get('rss-feed/update/{id}', 'RssFeedsController@feedUpdate')->name('rss.feedUpdate');
        Route::get('rss-feed/cronJobUpdate', 'RssFeedsController@cronJobUpdate')->name('rss.cronJobUpdate');
    });

    // --- Languages ---
    Route::middleware('permissions:languages')->group(function () {
        // Frontend Languages
        Route::get('/language/datatables', 'LanguageController@datatables')->name('language.datatables');
        Route::get('/add-language', 'LanguageController@index')->name('admin.language.index');
        Route::get('/add-language/create', 'LanguageController@create')->name('admin.language.create');
        Route::post('/add-language', 'LanguageController@store')->name('admin.language.store');
        Route::get('/add-language/edit/{id}', 'LanguageController@edit')->name('admin.language.edit');
        Route::post('/add-language/update/{id}', 'LanguageController@update')->name('admin.language.update');
        Route::get('/add-language/delete/{id}', 'LanguageController@delete')->name('admin.language.delete');
        Route::get('/languages/status/{id}', 'LanguageController@status')->name('admin.language.status');

        // Admin Languages
        Route::get('/admin-language/datatables', 'AdminLanguageController@datatables')->name('admin_language.datatables');
        Route::get('/admin-add-language', 'AdminLanguageController@index')->name('admin.admin_language.index');
        Route::get('/admin-add-language/create', 'AdminLanguageController@create')->name('admin.admin_language.create');
        Route::post('/admin-add-language', 'AdminLanguageController@store')->name('admin.admin_language.store');
        Route::get('/admin-add-language/edit/{id}', 'AdminLanguageController@edit')->name('admin.admin_language.edit');
        Route::post('/admin-add-language/update/{id}', 'AdminLanguageController@update')->name('admin.admin_language.update');
        Route::get('/admin-add-language/delete/{id}', 'AdminLanguageController@delete')->name('admin.admin_language.delete');
        Route::get('/admin-languages/status/{id}', 'AdminLanguageController@status')->name('admin.admin_language.status');
    });

    // --- Polls ---
    Route::middleware('permissions:polls')->group(function () {
        // Polls
        Route::get('/add-polls/datatables', 'PollController@datatables')->name('addPolls.datatables');
        Route::get('/add-polls', 'PollController@index')->name('addPolls.index');
        Route::get('/add-polls/create', 'PollController@create')->name('addPolls.create');
        Route::post('/add-polls', 'PollController@store')->name('addPolls.store');
        Route::get('/add-polls/edit/{id}', 'PollController@edit')->name('addPolls.edit');
        Route::post('/add-polls/update/{id}', 'PollController@update')->name('addPolls.update');
        Route::get('/add-polls/delete/{id}', 'PollController@delete')->name('addPolls.delete');
        Route::get('/add-polls/showOnHomePage', 'PollController@showOnHomePage')->name('addPolls.showOnHomePage');

        // Poll Options
        Route::get('/poll-option/create/{id}', 'PollController@pollcreate')->name('pollOption.create');
        Route::post('/poll-option/create', 'PollController@pollstore')->name('pollOption.pollstore');
        Route::get('/poll-option/edit/{id}', 'PollController@polledit')->name('pollOption.polledit');
        Route::get('/poll-option/update/{id}', 'PollController@pollupdate')->name('pollOption.pollupdate');
        Route::get('/poll-option/view/{id}', 'PollController@pollview')->name('pollOption.pollview');
        Route::get('/poll-option/delete/{id}', 'PollController@optiondelete')->name('pollOption.optiondelete');
    });

    // --- Widgets ---
    Route::middleware('permissions:widgets')->group(function () {
        Route::get('/widget/datatables', 'WidgetController@datatables')->name('widget.datatables');
        Route::get('/widget/index', 'WidgetController@index')->name('widget.index');
        Route::get('widget/create', 'WidgetController@create')->name('widget.create');
        Route::post('widget/store', 'WidgetController@store')->name('widget.store');
        Route::get('widget/edit/{id}', 'WidgetController@edit')->name('widget.edit');
        Route::post('widget/update/{id}', 'WidgetController@update')->name('widget.update');
        Route::get('widget/delete/{id}', 'WidgetController@delete')->name('widget.delete');
        Route::get('widget-settings', 'WidgetController@widgetSettings')->name('widget.settings');
        Route::post('widget-settings/update', 'WidgetController@widgetSettingsUpdate')->name('widget.settings.update');
    });

    // --- Advertisements ---
    Route::middleware('permissions:create_ads')->group(function () {
        Route::get('/ads/datatables', 'AddSpaceController@datatables')->name('ads.datatables');
        Route::get('/ads/index', 'AddSpaceController@index')->name('ads.index');
        Route::get('/ads/create', 'AddSpaceController@create')->name('ads.create');
        Route::post('/ads/store', 'AddSpaceController@store')->name('ads.store');
        Route::get('/ads/edit/{id}', 'AddSpaceController@edit')->name('ads.edit');
        Route::post('/ads/update/{id}', 'AddSpaceController@update')->name('ads.update');
        Route::get('/ads/delete/{id}', 'AddSpaceController@delete')->name('ads.delete');
    });

    // --- Galleries (Simple & Advanced) ---
    
    // Simple Gallery
    Route::get('/gallery/show', 'GalleryController@show')->name('admin.gallery.show');
    Route::post('/gallery/store', 'GalleryController@store')->name('admin.gallery.store');
    Route::get('/gallery/delete', 'GalleryController@destroy')->name('admin.gallery.delete');

    // Image Gallery System
    Route::middleware('permissions:add_gallery')->group(function () {
        // Albums
        Route::get('/image-album/datatables', 'ImageAlbumController@datatables')->name('image.album.datatables');
        Route::get('/image-album', 'ImageAlbumController@index')->name('image.album.index');
        Route::get('/image-album/create', 'ImageAlbumController@create')->name('image.album.create');
        Route::post('/image-album', 'ImageAlbumController@store')->name('image.album.store');
        Route::get('/image-album/edit/{id}', 'ImageAlbumController@edit')->name('image.album.edit');
        Route::post('/image-album/update/{id}', 'ImageAlbumController@update')->name('image.album.update');
        Route::get('/image-album/delete/{id}', 'ImageAlbumController@delete')->name('image.album.delete');

        // Categories
        Route::get('/image-category/datatables', 'ImageCategoryController@datatables')->name('image.category.datatables');
        Route::get('/image-category', 'ImageCategoryController@index')->name('image.category.index');
        Route::get('/image-category/create', 'ImageCategoryController@create')->name('image.category.create');
        Route::post('/image-category', 'ImageCategoryController@store')->name('image.category.store');
        Route::get('/image-category/edit/{id}', 'ImageCategoryController@edit')->name('image.category.edit');
        Route::post('/image-category/update/{id}', 'ImageCategoryController@update')->name('image.category.update');
        Route::get('/image-category/delete/{id}', 'ImageCategoryController@delete')->name('image.category.delete');
        Route::get('/categoryByLanguage/{id}', 'ImageCategoryController@categoryByLanguage')->name('image.categoryByLanguage');
        Route::get('/languageOnUpdate/{x}/{y}', 'ImageCategoryController@languageOnUpdate')->name('image.languageOnUpdate');

        // Gallery Items
        Route::get('/image-gallery/datatables', 'ImageGalleryController@datatables')->name('image.gallery.datatables');
        Route::get('/image-gallery', 'ImageGalleryController@index')->name('image.gallery.index');
        Route::get('/image-gallery/create', 'ImageGalleryController@create')->name('image.gallery.create');
        Route::post('/image-gallery', 'ImageGalleryController@store')->name('image.gallery.store');
        Route::get('/image-gallery/edit/{id}', 'ImageGalleryController@edit')->name('image.gallery.edit');
        Route::post('/image-gallery/update/{id}', 'ImageGalleryController@update')->name('image.gallery.update');
        Route::get('/image-gallery/delete/{id}', 'ImageGalleryController@delete')->name('image.gallery.delete');
        Route::get('/image-gallery/galleryShow/{id}', 'ImageGalleryController@galleryShow')->name('image.gallery.galleryShow');
        Route::get('/albumByLanguage/{id}', 'ImageGalleryController@albumByLanguage')->name('gallery.albumByLanguage');
        Route::get('/categoryByAlbum/{id}', 'ImageGalleryController@categoryByAlbum')->name('gallery.categoryByAlbum');
        Route::get('/albumByLanguageUpdate/{x}/{y}', 'ImageGalleryController@albumByLanguageUpdate')->name('gallery.albumByLanguageUpdate');
        Route::get('/categoryByAlbumUpdate/{x}/{y}', 'ImageGalleryController@categoryByAlbumUpdate')->name('gallery.categoryByAlbumUpdate');
    });

    // --- General Settings & SEO ---
    Route::middleware('permissions:general_settings')->group(function () {
        
        // Settings
        Route::post('/generalsettings/update', 'GeneralSettingsController@update')->name('admin.generalsettings.update');
        Route::get('/generalsettings/logo', 'GeneralSettingsController@logo')->name('admin.generalsettings.logo');
        Route::get('/generalsettings/favicon', 'GeneralSettingsController@favicon')->name('admin.generalsettings.favicon');
        Route::get('/generalsettings/loader', 'GeneralSettingsController@loader')->name('admin.generalsettings.loader');
        Route::get('/generalsettings/website/content', 'GeneralSettingsController@websiteContent')->name('admin.generalsettings.websiteContent');
        Route::get('/generalsettings/footer', 'GeneralSettingsController@footer')->name('admin.generalsettings.footer');
        Route::get('/generalsettings/error/page', 'GeneralSettingsController@errorPage')->name('admin.generalsettings.errorPage');
        Route::get('/generalsettings/popular/tags', 'GeneralSettingsController@popularTags')->name('admin.generalsettings.popularTags');
        
        // Integrations
        Route::get('/generalsettings/tawakto/{x}', 'GeneralSettingsController@tawkto')->name('admin.generalsettings.tawkto');
        Route::get('/generalsettings/disqus/{x}', 'GeneralSettingsController@disqus')->name('admin.generalsettings.disqus');
        Route::get('/generalsettings/smtp/{x}', 'GeneralSettingsController@smtp')->name('admin.generalsettings.smtp');

        // Media Manager
        Route::get('/media-manager', 'MediaController@index')->name('admin.media.index');
        Route::post('/media-manager/store', 'MediaController@store')->name('admin.media.store');
        Route::post('/media-manager/delete', 'MediaController@delete')->name('admin.media.delete');
        Route::post('/media-manager/replace', 'MediaController@replace')->name('admin.media.replace');

        // Language Based Logo
        Route::get('/language/logo/datatables', 'LogoController@datatables')->name('admin.languagelogo.datatables');
        Route::get('/language/logo', 'LogoController@index')->name('admin.languagelogo.index');
        Route::get('/language/logo/create', 'LogoController@create')->name('admin.languagelogo.create');
        Route::post('/language/logo', 'LogoController@store')->name('admin.languagelogo.store');
        Route::get('/language/logo/edit/{id}', 'LogoController@edit')->name('admin.languagelogo.edit');
        Route::post('/language/logo/update/{id}', 'LogoController@update')->name('admin.languagelogo.update');
        Route::get('/language/logo/delete/{id}', 'LogoController@delete')->name('admin.languagelogo.delete');

        // Photocard Frames
        Route::get('/photocard/frames', 'PhotocardFrameController@index')->name('admin.photocard.index');
        Route::post('/photocard/frames/store', 'PhotocardFrameController@store')->name('admin.photocard.store');
        Route::get('/photocard/frames/delete/{id}', 'PhotocardFrameController@delete')->name('admin.photocard.delete');
    });

    // --- SEO Tools ---
    Route::middleware('permissions:seo_tools')->group(function () {
        Route::post('seo/update', 'SeoController@update')->name('seo.update');
        Route::get('seo/google-analytics', 'SeoController@googleAnalytics')->name('seo.google.analytics');
        Route::get('seo/meta-keywords', 'SeoController@metaKeywords')->name('seo.meta.keywords');
    });

    // --- Social Settings ---
    Route::middleware('permissions:social_settings')->group(function () {
        Route::post('social-settings/update', 'SocialSettingsController@update')->name('social.settings.update');
        Route::get('social-settings/google', 'SocialSettingsController@google')->name('social.settings.google');
        Route::get('social-settings/facebook', 'SocialSettingsController@facebook')->name('social.settings.facebook');

        // Social Links
        Route::get('social-link/datatables', 'SocialLinkController@datatables')->name('social.link.datatables');
        Route::get('social-link', 'SocialLinkController@index')->name('social.link.index');
        Route::get('social-link/create', 'SocialLinkController@create')->name('social.link.create');
        Route::post('social-link', 'SocialLinkController@store')->name('social.link.store');
        Route::get('social-link/edit/{id}', 'SocialLinkController@edit')->name('social.link.edit');
        Route::post('social-link/update/{id}', 'SocialLinkController@update')->name('social.link.update');
        Route::get('social-link/delete/{id}', 'SocialLinkController@delete')->name('social.link.delete');
    });

    // --- Pages ---
    Route::middleware('permissions:pages')->group(function () {
        Route::get('page/datatables', 'PageController@datatables')->name('admin.page.datatables');
        Route::get('/page', 'PageController@index')->name('admin.page.index');
        Route::get('/page/create', 'PageController@create')->name('admin.page.create');
        Route::post('/page', 'PageController@store')->name('admin.page.store');
        Route::get('/page/edit/{id}', 'PageController@edit')->name('admin.page.edit');
        Route::post('/page/update/{id}', 'PageController@update')->name('admin.page.update');
        Route::get('/page/delete/{id}', 'PageController@delete')->name('admin.page.delete');
        Route::get('/page/slugCreate', 'PageController@slugCreate')->name('admin.page.slugCreate');
    });

    // --- Emails ---
    Route::middleware('permissions:emails_settings')->group(function () {
        Route::get('email/config', 'EmailController@config')->name('admin.email.config');
        Route::get('email/group', 'EmailController@group')->name('admin.email.group');
        Route::post('email/group', 'EmailController@groupmailsend')->name('admin.email.groupmailsend');
    });

    // --- Newsletter / Subscribers ---
    Route::middleware('permissions:newsLetter')->group(function () {
        Route::get('/subscriber/datatables', 'SubscriberController@datatables')->name('admin.subscriber.datatables');
        Route::get('/subscriber', 'SubscriberController@index')->name('admin.subscriber.index');
        Route::get('/subscriber/download', 'SubscriberController@download')->name('admin.subscriber.download');
        Route::get('/send-mail', 'SubscriberController@email')->name('admin.subscriber.email');
        Route::post('/send-mail', 'SubscriberController@sendemail')->name('admin.subscriber.sendemail');
    });

    // --- Roles & Users ---
    Route::middleware('permissions:role_management')->group(function () {
        Route::get('/role/datatables', 'RoleController@datatables')->name('admin.role.datatables');
        Route::get('/role', 'RoleController@index')->name('admin.role.index');
        Route::get('/role/create', 'RoleController@create')->name('admin.role.create');
        Route::post('/role', 'RoleController@store')->name('admin.role.store');
        Route::get('/role/edit/{id}', 'RoleController@edit')->name('admin.role.edit');
        Route::post('/role/update/{id}', 'RoleController@update')->name('admin.role.update');
        Route::get('/role/update/{id}', 'RoleController@delete')->name('admin.role.delete');
    });

    Route::middleware('permissions:user_management')->group(function () {
        Route::get('/user/datatables', 'StaffController@datatables')->name('admin.staff.datatables');
        Route::get('/user', 'StaffController@index')->name('admin.staff.index');
        Route::get('/user/create', 'StaffController@create')->name('admin.staff.create');
        Route::post('/user', 'StaffController@store')->name('admin.staff.store');
        Route::get('/user/edit/{id}', 'StaffController@edit')->name('admin.staff.edit');
        Route::post('/user/update/{id}', 'StaffController@update')->name('admin.staff.update');
        Route::get('/user/delete/{id}', 'StaffController@delete')->name('admin.staff.delete');
    });

    Route::middleware('permissions:administration_management')->group(function () {
        Route::get('/administator/datatables', 'AdministerController@datatables')->name('admin.administator.datatables');
        Route::get('/administator', 'AdministerController@index')->name('admin.administator.index');
        Route::get('/administator/create', 'AdministerController@create')->name('admin.administator.create');
        Route::post('/administator', 'AdministerController@store')->name('admin.administator.store');
        Route::get('/administator/edit/{id}', 'AdministerController@edit')->name('admin.administator.edit');
        Route::post('/administator/update/{id}', 'AdministerController@update')->name('admin.administator.update');
    });

    // --- Utilities (Fonts, Cache, SiteMap) ---
    Route::middleware('permissions:site_map')->group(function () {
        // Site map placeholder from original file
    });

    Route::middleware('permissions:font_option')->group(function () {
        Route::get('/fonts/datatables', 'FontController@datatables')->name('admin.fonts.datatables');
        Route::get('/fonts', 'FontController@index')->name('fonts.index');
        Route::get('/fonts/status/{id}', 'FontController@status')->name('admin.fonts.status');
    });

    Route::middleware('permissions:cache_management')->group(function () {
        Route::get('/cache', 'CacheController@clear')->name('admin.cache.clear');
    });

}); // End Admin Group


// =============================================================
//  3. FRONTEND ROUTES (Public)
// =============================================================

Route::namespace('Front')->group(function () {
    
    // --- Home & General ---
    Route::get('/', 'FrontendController@index')->name('frontend.index');
    Route::get('/social-share-image/{id}', 'FrontendController@socialShareImage')->name('social.share.image');
    
    // Static Views
    Route::get('/family', function () { return view('frontend.family'); });
    Route::get('/photo', function () { return view('frontend.photo'); });
    Route::get('/video', function () { return view('frontend.video'); });
    
    // --- Search & Details ---
    Route::get('/tag/{search}', 'FrontendController@searchByTag')->name('tag.search');
    Route::get('/details/{id}/{slug}', 'FrontendController@details')->name('frontend.details');
    Route::get('/print/{id}/{slug}', 'FrontendController@print')->name('frontend.print');
    
    // --- Subscriptions & External ---
    Route::post('the/elitedesign/ocean/2441139', 'FrontendController@subscription');
    Route::get('finalize', 'FrontendController@finalize');
    Route::post('/subscribers', 'SubscriberController@store')->name('front.subscribers.store');
    
    // --- Polls & Gallery ---
    Route::post('/poll-vote', 'PollVoteController@vote')->name('front.poll.vote');
    Route::get('/poll-result/{id}', 'PollVoteController@result')->name('front.poll.result');
    Route::get('/all-poll', 'FrontendController@allPoll')->name('front.allPoll');
    Route::get('/all-poll-result', 'FrontendController@allPollResult')->name('front.allPollResult');
    Route::get('/gallery-view/{id}', 'GalleryController@view')->name('gallery.view');

    // --- Loading & Dynamic ---
    Route::get('/load-more', 'FrontendController@loadMore')->name('frontend.loadMore');
    Route::get('/post/post-by-date', 'FrontendController@postByDate')->name('frontend.postByDate');
    Route::get('/news-search', 'FrontendController@newsSearch')->name('front.news_search');
    Route::get('/page/{sl}', 'FrontendController@page')->name('dynamic.page');
    Route::get('/language/{id}', 'FrontendController@language')->name('front.language');
    Route::get('/click/count/{id}', 'FrontendController@clickCount')->name('frontend.click.count');

    // --- Profile & Followers ---
    Route::get('/profile/{admin}', 'FrontendController@authorProfile')->name('front.authorProfile');
    Route::get('/follower', 'FrontendController@follower')->name('front.follower');
    Route::get('/follower/create/{id}', 'FollowController@followerCreate')->name('front.followerCreate');
    Route::get('/follower/{admin}', 'FollowController@following')->name('front.following');

    // --- Auth (Frontend) ---
    Route::get('/contact/refresh_code', 'FrontendController@refresh_code');
    Route::get('/log-reg', 'RegisterController@LogReg')->name('front.LogReg');
    Route::post('/register', 'RegisterController@register')->name('front.register');
    Route::get('/register/verify/{token}', 'RegisterController@token')->name('user.register.token');
    Route::post('/login', 'LoginController@login')->name('front.login');
    Route::get('/logout', 'LoginController@logout')->name('front.logout');

    // Social Login
    Route::get('auth/{provider}', 'SocialRegisterController@redirectToProvider')->name('social.provider');
    Route::get('auth/{provider}/callback', 'SocialRegisterController@handleProviderCallback');

    // --- Tools (Print & Photocard) ---
    Route::get('/tools/print/{id}', 'FrontendController@loadPrintModal')->name('post.tool.print');
    Route::get('/tools/photocard/{id}', 'FrontendController@loadPhotocardModal')->name('post.tool.photocard');
});

// =============================================================
//  4. SITEMAPS
// =============================================================

Route::prefix('')->namespace('Admin')->group(function() {
    Route::get('/sitemaps', 'SiteMapController@all')->name('admin.sitemap.all');
    Route::get('/sitemap.xml', 'SiteMapController@index')->name('sitemap.index');
    Route::get('/sitemap/categories.xml', 'SiteMapController@categories')->name('sitemap.categories');
    Route::get('/sitemap/subcategories.xml', 'SiteMapController@subcategories')->name('sitemap.subcategories');
    Route::get('/sitemap/posts.xml', 'SiteMapController@posts')->name('sitemap.posts');
});

// =============================================================
//  5. CATCH-ALL ROUTES (Must be last)
// =============================================================

Route::namespace('Front')->group(function () {
    Route::get('/{category}/{subcategory}', 'FrontendController@postBySubcategory')->name('frontend.postBySubcategory');
    Route::get('/{category}', 'FrontendController@category')->name('frontend.category');
});