<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string("photo_logo")->nullable();
            $table->string("photo_favicon")->nullable();
            $table->string("top_bar_email")->nullable();
            $table->string("top_bar_phone")->nullable();
            $table->string("footer_col1_title")->nullable();
            $table->string("footer_col2_title")->nullable();
            $table->string("footer_col3_title")->nullable();
            $table->string("footer_col4_title")->nullable();
            $table->longText("footer_copyright")->nullable();
            $table->longText("footer_address")->nullable();
            $table->string("footer_email")->nullable();
            $table->string("footer_phone")->nullable();
            $table->string("footer_recent_news_item")->nullable();
            $table->longText("footer_recent_portfolio_item")->nullable();
            $table->longText("newsletter_text")->nullable();
            $table->string("cta_text")->nullable();
            $table->longText("cta_button_text")->nullable();
            $table->longText("cta_button_url")->nullable();
            $table->string("cta_background_photo")->nullable();
            $table->string("send_email_from")->nullable();
            $table->string("receive_email_to")->nullable();
            $table->string("photo1")->nullable();
            $table->string("photo2")->nullable();
            $table->string("photo3")->nullable();
            $table->string("photo4")->nullable();
            $table->string("photo5")->nullable();
            $table->string("photo6")->nullable();
            $table->string("photo7")->nullable();
            $table->string("photo8")->nullable();
            $table->string("photo9")->nullable();
            $table->string("photo10")->nullable();
            $table->string("photo11")->nullable();
            $table->string("photo12")->nullable();
            $table->string("photo13")->nullable();
            $table->string("photo14")->nullable();
            $table->string("photo15")->nullable();
            $table->string("sidebar_total_recent_post")->nullable();
            $table->string("sidebar_news_heading_category")->nullable();
            $table->string("sidebar_news_heading_recent_post")->nullable();
            $table->string("sidebar_total_upcoming_event")->nullable();
            $table->string("sidebar_total_past_event")->nullable();
            $table->string("sidebar_event_heading_upcoming")->nullable();
            $table->string("sidebar_event_heading_past")->nullable();
            $table->string("sidebar_service_heading_service")->nullable();
            $table->string("sidebar_service_heading_quick_contact")->nullable();
            $table->string("sidebar_portfolio_heading_project_detail")->nullable();
            $table->string("sidebar_portfolio_heading_quick_contact")->nullable();
            $table->string("front_end_color")->nullable();




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
