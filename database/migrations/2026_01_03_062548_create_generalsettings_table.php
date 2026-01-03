<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('generalsettings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('logo', 100);
            $table->string('footer_logo', 100);
            $table->string('favicon', 191)->nullable();
            $table->string('loader', 100)->nullable();
            $table->string('admin_loader', 100)->nullable();
            $table->string('title', 100)->nullable();
            $table->string('theme_color', 100)->nullable();
            $table->string('footer_color', 100)->nullable();
            $table->tinyInteger('is_capcha')->default(0);
            $table->longText('copyright_text')->nullable();
            $table->string('copyright_color', 100)->nullable();
            $table->text('footer_text')->nullable();
            $table->text('tags')->nullable();
            $table->string('error_photo', 100)->nullable();
            $table->string('error_title', 191)->nullable();
            $table->text('error_text')->nullable();
            $table->string('driver', 100)->nullable();
            $table->string('smtp_host', 100)->nullable();
            $table->string('smtp_port', 100)->nullable();
            $table->string('email_encryption', 100)->nullable();
            $table->string('smtp_user', 100)->nullable();
            $table->string('smtp_pass', 100)->nullable();
            $table->string('from_email', 100)->nullable();
            $table->string('from_name', 100)->nullable();
            $table->string('time_zone', 100)->nullable();
            $table->tinyInteger('is_smtp')->default(0);
            $table->tinyInteger('is_verification_email')->default(0);
            $table->longText('notice')->nullable();
            $table->longText('sompadok')->nullable();
            $table->longText('nirbahi_sompadok')->nullable();
            $table->longText('barta_sompadok')->nullable();
            $table->longText('address')->nullable();
            $table->longText('email_address')->nullable();
            $table->longText('mobile')->nullable();
            $table->string('lazy_baner', 100)->nullable();
            $table->longText('live_tv')->nullable();
            $table->longText('facebookpage_id')->nullable();
            $table->string('dhaka', 110)->nullable();
            $table->string('khulna', 110)->nullable();
            $table->string('ctg', 110)->nullable();
            $table->string('maymonsingh', 110)->nullable();
            $table->string('barishal', 110)->nullable();
            $table->string('rangpur', 110)->nullable();
            $table->longText('syleth')->nullable();
            $table->longText('rajshahi')->nullable();
            $table->longText('sidebar_ads')->nullable();
            $table->longText('header_728')->nullable();
            $table->longText('header1_728')->nullable();
            $table->longText('header2_728')->nullable();
            $table->longText('header3_728')->nullable();
            $table->longText('header4_728')->nullable();
            $table->longText('adsense_code')->nullable();
            $table->longText('search_console')->nullable();
            $table->longText('homepageads1_970')->nullable();
            $table->longText('homepageads2_970')->nullable();
            $table->longText('homepageads3_970')->nullable();
            $table->longText('homepageads4_970')->nullable();
            $table->longText('og_images')->nullable();
            $table->longText('google_map')->nullable();
            $table->longText('sidebar1_ads')->nullable();
            $table->longText('sidebar2_ads')->nullable();
            $table->longText('fazar')->nullable();
            $table->longText('jahar')->nullable();
            $table->longText('achar')->nullable();
            $table->longText('magrib')->nullable();
            $table->longText('esha')->nullable();
            $table->longText('jumma')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('generalsettings');
    }
};
