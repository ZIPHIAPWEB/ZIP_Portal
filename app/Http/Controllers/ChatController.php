<?php

namespace App\Http\Controllers;

use App\Coordinator;
use App\Events\MessageSentEvent;
use App\Http\Resources\ChatResource;
use App\Message;
use App\Student;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function get_contacts(Request $request)
    {
        if (Auth::user()->hasRole('student')) {
            $contacts = Coordinator::where('program', $request->input('program_id'))
                ->where('firstName', 'like', '%'. $request->input('search') . '%')
                ->orWhere('lastName', 'like', '%'. $request->input('search') . '%')
                ->select(['coordinators.user_id', 'coordinators.firstName', 'coordinators.lastName'])
                ->get();
        } else {
            $contacts = Student::where('program_id', $request->input('program_id'))
                ->where('first_name', 'like', '%'. $request->input('search') . '%')
                ->orWhere('last_name', 'like', '%'. $request->input('search') . '%')
                ->select(['students.user_id', 'students.first_name', 'students.last_name'])
                ->get();
        }

        $unreadIds = Message::select(DB::raw('`receiver_id`, count(`receiver_id`) as messages_count'))
                            ->where('sender_id', Auth::user()->id)
                            ->where('read', false)
                            ->groupBy('receiver_id')
                            ->get();

        $contacts = $contacts->map(function ($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('receiver_id', $contact->user_id)->first();

            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;

            return $contact;
        });

        return ChatResource::collection($contacts);
    }

    public function get_messages(Request $request)
    {
        Message::where('receiver_id', $request->input('userId'))
               ->where('sender_id', Auth::user()->id)
               ->update([
                   'read'   =>  true
               ]);

        if (Auth::user()->hasRole('coordinator')) {
            $sender = User::join('messages', 'users.id', '=', 'messages.sender_id')
                ->join('students', 'users.id', '=', 'messages.sender_id')
                ->where('messages.receiver_id', $request->input('userId'))
                ->where('messages.sender_id', Auth::user()->id)
                ->where('students.user_id', $request->input('userId'))
                ->select(['messages.*', 'students.first_name', 'students.middle_name', 'students.last_name'])
                ->get();

            $receiver = User::join('messages', 'users.id', '=', 'messages.receiver_id')
                ->where('messages.sender_id', $request->input('userId'))
                ->where('users.id', Auth::user()->id)
                ->select(['messages.*'])
                ->get();
        } else {
            $sender = User::join('messages', 'users.id', '=', 'messages.sender_id')
                ->join('coordinators', 'users.id', '=', 'messages.sender_id')
                ->where('messages.receiver_id', $request->input('userId'))
                ->where('messages.sender_id', Auth::user()->id)
                ->where('coordinators.user_id', $request->input('userId'))
                ->select(['messages.*', 'coordinators.firstName', 'coordinators.middleName', 'coordinators.lastName'])
                ->get();

            $receiver = User::join('messages', 'users.id', '=', 'messages.receiver_id')
                ->where('messages.sender_id', $request->input('userId'))
                ->where('users.id', Auth::user()->id)
                ->select(['messages.*'])
                ->get();
        }

        $collection = collect(array_merge($sender->toArray(), $receiver->toArray()));
        $sorted = $collection->sortBy('created_at');

        return response()->json($sorted->values()->all());
    }

    public function send_message(Request $request)
    {
        $message = Message::create([
            'sender_id'     =>  $request->input('selectedRecipient'),
            'receiver_id'   =>  Auth::user()->id,
            'message'       =>  $request->input('inputted_text'),
            'read'          =>  false
        ]);

        broadcast(new MessageSentEvent($message));

        return response()->json($message);
    }
}
