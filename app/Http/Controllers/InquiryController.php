<?php

namespace App\Http\Controllers;

use App\Notifications\InquiryNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class InquiryController extends Controller
{
    public function submitInquiry(Request $request)
    {
        $when = now()->addSeconds(10);

        $request->validate([
            'name'      =>  'required',
            'email'     =>  'required|email',
            'subject'   =>  'required',
            'message'   =>  'required|min:50'
        ]);

        $data = [
            'name'      =>  $request->input('name'),
            'email'     =>  $request->input('email'),
            'subject'   =>  $request->input('subject'),
            'message'   =>  $request->input('message')
        ];

        Notification::route('mail', 'system@ziptravel.com.ph')->notify((new InquiryNotification($data))->delay($when));

        return response()->json([
            'message'   =>  'Inquiry has been sent!'
        ]);
    }
}
