<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;

class SettingController extends Controller
{
    public function index()
    {
        $Settingsview = Settings::all();
        return View('admin.setting.index', compact("Settingsview"));
    }

    public function update(Request $request, $id)
    {
        $update = Settings::find($id);

        if (isset($request->photo_logo)) {
            $photo_logo = date('d-m-Y-His').'.'.$request->file('photo_logo')->getClientOriginalExtension();
            $Image = $request->photo_logo->move(public_path('/admin/assets/img'), $photo_logo);
            $update->photo_logo = $photo_logo;
            $update->update();
        }
        if (isset($request->photo_favicon)) {
            $photo_favicon = date('dmYhis').$request->file('photo_favicon')->getClientOriginalName();
            $Image = $request->photo_favicon->move(public_path('/admin/assets/img'), $photo_favicon);
            $update->photo_favicon = $photo_favicon;
            $update->update();
        }
        if (isset($request->cta_background_photo)) {
            $cta_background_photo = $request->file('cta_background_photo')->getClientOriginalName();
            $Image = $request->cta_background_photo->move(public_path('/admin/assets/img'), $cta_background_photo);
            $update->cta_background_photo = $cta_background_photo;
            $update->update();
        }
        if (isset($request->photo1)) {
            $photo1 = $request->file('photo1')->getClientOriginalName();
            $Image = $request->photo1->move(public_path('/admin/assets/img'), $photo1);
            $update->photo1 = $photo1;
            $update->update();
        }
        if (isset($request->photo2)) {
            $photo2 = $request->file('photo2')->getClientOriginalName();
            $Image = $request->photo2->move(public_path('/admin/assets/img'), $photo2);
            $update->photo2 = $photo2;
            $update->update();
        }
        if (isset($request->photo3)) {
            $photo3 = $request->file('photo3')->getClientOriginalName();
            $Image = $request->photo3->move(public_path('/admin/assets/img'), $photo3);
            $update->photo3 = $photo3;
            $update->update();
        }
        if (isset($request->photo4)) {
            $photo4 = $request->file('photo4')->getClientOriginalName();
            $Image = $request->photo4->move(public_path('/admin/assets/img'), $photo4);
            $update->photo4 = $photo4;
            $update->update();
        }
        if (isset($request->photo5)) {
            $photo5 = $request->file('photo5')->getClientOriginalName();
            $Image = $request->photo5->move(public_path('/admin/assets/img'), $photo5);
            $update->photo5 = $photo5;
            $update->update();
        }
        if (isset($request->photo6)) {
            $photo6 = $request->file('photo6')->getClientOriginalName();
            $Image = $request->photo6->move(public_path('/admin/assets/img'), $photo6);
            $update->photo6 = $photo6;
            $update->update();
        }
        if (isset($request->photo7)) {
            $photo7 = $request->file('photo7')->getClientOriginalName();
            $Image = $request->photo7->move(public_path('/admin/assets/img'), $photo7);
            $update->photo7 = $photo7;
            $update->update();
        }
        if (isset($request->photo8)) {
            $photo8 = $request->file('photo8')->getClientOriginalName();
            $Image = $request->photo8->move(public_path('/admin/assets/img'), $photo8);
            $update->photo8 = $photo8;
            $update->update();
        }
        if (isset($request->photo9)) {
            $photo9 = $request->file('photo9')->getClientOriginalName();
            $Image = $request->photo9->move(public_path('/admin/assets/img'), $photo9);
            $update->photo9 = $photo9;
            $update->update();
        }
        if (isset($request->photo10)) {
            $photo10 = $request->file('photo10')->getClientOriginalName();
            $Image = $request->photo10->move(public_path('/admin/assets/img'), $photo10);
            $update->photo10 = $photo10;
            $update->update();
        }
        if (isset($request->photo11)) {
            $photo11 = $request->file('photo11')->getClientOriginalName();
            $Image = $request->photo11->move(public_path('/admin/assets/img'), $photo11);
            $update->photo11 = $photo11;
            $update->update();
        }
        if (isset($request->photo12)) {
            $photo12 = $request->file('photo12')->getClientOriginalName();
            $Image = $request->photo12->move(public_path('/admin/assets/img'), $photo12);
            $update->photo12 = $photo12;
            $update->update();
        }
        if (isset($request->photo13)) {
            $photo13 = $request->file('photo13')->getClientOriginalName();
            $Image = $request->photo13->move(public_path('/admin/assets/img'), $photo13);
            $update->photo13 = $photo13;
            $update->update();
        }
        if (isset($request->photo14)) {
            $photo14 = $request->file('photo14')->getClientOriginalName();
            $Image = $request->photo14->move(public_path('/admin/assets/img'), $photo14);
            $update->photo14 = $photo14;
            $update->update();
        }
        if (isset($request->photo15)) {
            $photo15 = $request->file('photo15')->getClientOriginalName();
            $Image = $request->photo15->move(public_path('/admin/assets/img'), $photo15);
            $update->photo15 = $photo15;
            $update->update();
        }

        $update->top_bar_email = $request->input('top_bar_email');
        $update->top_bar_phone = $request->input('top_bar_phone');
    
        $update->footer_col1_title = $request->input('footer_col1_title');
        $update->footer_col2_title = $request->input('footer_col2_title');
        $update->footer_col3_title = $request->input('footer_col3_title');
        $update->footer_col4_title = $request->input('footer_col4_title');
        $update->footer_copyright = $request->input('footer_copyright');
        $update->footer_address = $request->input('footer_address');
        $update->footer_email = $request->input('footer_email');
        $update->footer_phone = $request->input('footer_phone');
        $update->footer_recent_news_item = $request->input('footer_recent_news_item');
        $update->footer_recent_portfolio_item = $request->input('footer_recent_portfolio_item');
    
        $update->newsletter_text = $request->input('newsletter_text');
    
        $update->cta_text = $request->input('cta_text');
        $update->cta_button_text = $request->input('cta_button_text');
        $update->cta_button_url = $request->input('cta_button_url');
    
        $update->send_email_from = $request->input('send_email_from');
        $update->receive_email_to = $request->input('receive_email_to');
    
        $update->sidebar_total_recent_post = $request->input('sidebar_total_recent_post');
        $update->sidebar_news_heading_category = $request->input('sidebar_news_heading_category');
        $update->sidebar_news_heading_recent_post = $request->input('sidebar_news_heading_recent_post');
        $update->sidebar_total_upcoming_event = $request->input('sidebar_total_upcoming_event');
        $update->sidebar_total_past_event = $request->input('sidebar_total_past_event');
        $update->sidebar_event_heading_upcoming = $request->input('sidebar_event_heading_upcoming');
        $update->sidebar_event_heading_past = $request->input('sidebar_event_heading_past');
        $update->sidebar_service_heading_service = $request->input('sidebar_service_heading_service');
        $update->sidebar_service_heading_quick_contact = $request->input('sidebar_service_heading_quick_contact');
        $update->sidebar_portfolio_heading_project_detail = $request->input('sidebar_portfolio_heading_project_detail');
        $update->sidebar_portfolio_heading_quick_contact = $request->input('sidebar_portfolio_heading_quick_contact');
    
        $update->front_end_color = $request->input('front_end_color');

        $update->update();

        return redirect()->route('setting.index')->with('message', 'Setting updated successfully !');
    }
}
