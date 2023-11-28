<?php

namespace App\Http\Controllers;

use App\Notifications\InquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class InquiryController extends Controller
{
    public function submitInquiry(Request $request)
    {
        $request->validate([
            'name'      =>  'required',
            'email'     =>  'required|email',
            'message'   =>  'required'
        ]);

        $data = [
            'name'      =>  $request->input('name'),
            'email'     =>  $request->input('email'),
            'message'   =>  $request->input('message')
        ];

        Notification::route('mail', 'info@ziptravel.com.ph')->notify(new InquiryNotification($data));
        return redirect()->back()->with('message', 'Inquiry Submitted!');
    }
}
