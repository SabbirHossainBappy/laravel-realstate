<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ComposeEmailModel;
use Mail;
use App\Mail\ComposeEmailMail;

class EmailController extends Controller
{
  
    public function admin_email_compose(Request $request){
        $data['getEmail'] = User::whereIn('role', ['agent', 'user'])->get();
        return view('admin.email.compose', $data);
    }

    public function admin_email_compose_post(Request $request){
        $save = new ComposeEmailModel;
        $save->user_id = $request->user_id;
        $save->cc_email = trim($request->cc_email);
        $save->subject = trim($request->subject);;
        $save->descriptions = trim($request->descriptions);
        $save->save();

        // email start
        $getUserEmail = User::Where('id', '=', $request->user_id)->first();
        Mail::to($getUserEmail->email)->cc($request->cc_email)->send(new ComposeEmailMail($save));
        // email send end 

        return redirect('admin/email/compose')->with('success', ' Email Successfully send !!');
        
    }


    public function admin_email_sent(Request $request){
        $data['getRecord'] = ComposeEmailModel::get();
        return view('admin.email.send', $data);
    }

    public function admin_email_sent_delete( Request $request){
        if(!empty($request->id)){
              $option =explode(',', $request->id );
              foreach ($option as $id){
                if(!empty($id)){
                    $getRecord= ComposeEmailModel::find($id);
                    $getRecord->delete();
                }
              }
        }

        return redirect()->back()->with('success', 'Send Email Successfully Deleted!');
     
    }
    public function admin_email_read($id, Request $request){
        $data['getRecord']= ComposeEmailModel::find($id);
        return view('admin.email.read', $data);
    }

    public function admin_email_read_delete($id, Request $request){
        $deleteRecord = ComposeEmailModel::find($id);
        $deleteRecord->delete();
         return redirect('admin/email/sent')->with('success', 'Send Email Successfully Deleted!');
    }



}