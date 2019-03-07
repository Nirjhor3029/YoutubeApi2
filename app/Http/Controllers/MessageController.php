<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\contactus;
use App\User;
use App\Models\inbox;
use App\Models\inboxchat;
use Illuminate\Support\Facades\Redirect;

class MessageController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }
  public function index(){

    $datas = contactus::all();
    //dd($querydatas);
    return view('admin.mess',compact('datas'));
  }

  public function show($id){
    $datas = contactus::where('id',$id);
    $open = contactus::find($id);
    $open->is_opened = 1;
    $open->save();
    return view('admin.mess-single', compact('datas'));
  }

  /*http://127.0.0.1:8000/inbox*/
  public function myMessage(){
    $datas = inbox::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->with('product')->with('catagory')->with('vendors')->get();
     //dd($datas);
    return view('user.inbox',compact('datas'));
  }

  public function singleMessage(Request $r){
    $id = $r->input('id');
    $datas = inbox::where('id',"=",$id)->with('catagory')->with('product')->with('vendors')->with('querys')->get();
    $open = inbox::where('id',"=",$id)->update(['is_open' => 1 ]);

    $chat = inboxchat::where('inbox_id',"=",$id)->orderBy('created_at','asc')->get();

    //dd($chat);
    //dd($datas);
    return view('extra.querymsg',compact('datas','chat'));
  }

  /*
   * Nir Edit for user inbox
   * */
  /*http://127.0.0.1:8000/inbox => send message*/
  public function sendMessage(Request $request){

    $msg = $request->user_message;
    $inbox_id = $request->queryid;

    //echo "msg: " . $msg ."<br> inbox_id : ".$inbox_id;
    //dd($request);


    $chat = new inboxchat();
    $chat->inbox_id = $inbox_id;
    $chat->msg = $msg;
    $chat->save();


    return redirect()->back()->withErrors([$inbox_id, $inbox_id]);

  }

  /* End of
   * Nir Edit for user inbox
   * */
}
