<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use App\User;
class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user=User::whereId(\Auth::user()->id)->first();
        $ids=\Auth::user()->id;
        $messages=Message::where('user_id',$id)->orWhere('receiver_id',$id)
        ->get();
        // $messages=$message->where('receiver_id',$ids)->where('receiver_id',$id)->get();
        $receiver=User::whereId($id)->first();
        // $messages=$user->sender()->where('receiver_id',$id)->get();
        // dd($messages);
        // dd($receiver);
        return view('message',compact('receiver','messages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'message'=>'required'
        ]);

        $message=new Message([
            'user_id'=>\Auth::user()->id,
            'receiver_id'=>$request->receiver_id,
            'message'=>$request->message
        ]);
        if($message->save()){
            return redirect()->back()->with('status','Your message was sent');
        }else{
            return redirect()->back()->with('status','message sending failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
