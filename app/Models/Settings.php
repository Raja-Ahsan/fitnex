<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('photo_logo', 'photo_favicon', 'top_bar_email', 'top_bar_phone', 'footer_col1_title', 'footer_col2_title', 'footer_col3_title', 'footer_col4_title', 'footer_copyright', 'footer_address', 'footer_email', 'footer_phone', 'footer_recent_news_item', 'footer_recent_portfolio_item', 'newsletter_text', 'cta_text', 'cta_button_text', 'cta_button_url', 'cta_background_photo', 'send_email_from', 'receive_email_to', 'photo1', 'photo2', 'photo3', 'photo4', 'photo5', 'photo6', 'photo7', 'photo8', 'photo9', 'photo10', 'photo11', 'photo12', 'photo13', 'photo14', 'photo15', 'sidebar_total_recent_post', 'sidebar_news_heading_category', 'sidebar_news_heading_recent_post', 'sidebar_total_upcoming_event', 'sidebar_total_past_event', 'sidebar_event_heading_upcoming', 'sidebar_event_heading_past', 'sidebar_service_heading_service', 'sidebar_service_heading_quick_contact', 'sidebar_portfolio_heading_project_detail', 'sidebar_portfolio_heading_quick_contact', 'front_end_color');
}
