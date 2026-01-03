<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    protected $fillable = [
        'logo',
        'footer_logo',
        'favicon',
        'lazy_baner',
		'og_images',
        'loader',
        'admin_loader',
        'title',
        'theme_color',
        'footer_color',
        'time_zone',
        'copyright_text',
        'copyright_color',
        'footer_text',
        'notice',
        'sompadok',
        'nirbahi_sompadok',
        'barta_sompadok',
        'live_tv',
        'facebookpage_id',
        'address',
        'email_address',
		'google_map',


'dhaka',
'khulna',
'rajshahi',
'ctg',
'maymonsingh',
'barishal',
'rangpur',
'syleth',
'fazar',
'jahar',
'achar',
'magrib',
'esha',
'jumma',
'sidebar_ads',
'sidebar1_ads',
'sidebar2_ads',
'header_728',
'header1_728',
'header2_728',
'header3_728',
'header4_728',
'adsense_code',
'search_console',
'homepageads1_970',
'homepageads2_970',
'homepageads3_970',
'homepageads4_970',

        'mobile',
        'tags',
        'error_photo',
        'error_title',
        'error_text',
        'driver',
        'smtp_host',
        'smtp_port',
        'email_encryption',
        'smtp_user',
        'smtp_pass',
        'from_email',
        'from_name',
        'is_smtp',
        'is_verification_email'
    ];
    protected $table    = 'generalsettings';
    public $timestamps  = false;
}
