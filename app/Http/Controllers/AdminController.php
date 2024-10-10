<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Mail\RegisteredMail;
use App\Http\Requests\ResetPassword;
use Hash;
use Str;
use Mail;


class AdminController extends Controller
{
    public function AdminDashboard(Request $request){

        

        // dd($request->all());
         $user = User::selectRaw('count(id) as count , DATE_FORMAT(created_at,"%Y-%m") as month')
                ->groupBy('month')
                ->orderBy('month', 'asc')
                ->get();

                $data['months'] = $user->pluck('month');
                $data['counts'] = $user->pluck('count');
             

        return view('admin.index', $data);
    }
        
    public function AdminLogin(Request $request){
    
        return view ('admin/admin_login');
   }
   
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
   }


   public function admin_profile(Request $request)
   {

    
    $data['getRecord'] = User::find(Auth::user()->id);

     return view ('admin/admin_profile', $data );
   }

    public function admin_profile_update(Request $request){
        // dd($request->all());----------------json reader
        $user = request()->validate([
            'email'=> 'required|unique:users,email,'.Auth::user()->id
        ]);

         

        $user = User::find(Auth::user()->id );
        $user->name =trim($request->name );
        $user->username =trim($request->username );
        $user->phone =trim($request->phone );
        $user->email =trim($request->email );
        if(!empty($request->password)){
            $user->password =trim($request->password );
        }
        if(!empty($request->file('photo'))){
           $file= $request->file('photo');
           $randomStr = Str::random(30);
           $filename = $randomStr .'.'.$file->getClientOriginalExtension();
           $file->move('upload/',$filename);
           $user->photo=$filename;
        }
        $user->address = trim($request->address );
        $user->about =trim($request->about );
        $user->website =trim($request->website );
        $user->save();

        return redirect('admin/profile')->with('success', ' profile Update Successfully...');
    } 

    public function admin_users(Request $request){
        $data['getRecord'] = User::getRecord( $request);
        return view ('admin.users.list', $data);
   }

   public function admin_users_view($id){
    $data['getRecord'] = User::find($id);
    return view ('admin.users.view', $data);
   }
    
   public function admin_add_users(Request $request){
     return view('admin.users.add');
   }

   public function admin_add_users_store(Request $request) {
    // Validate input
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',  // Correct validation for unique email
        'role' => 'required',
        'status' => 'required'
    ]);

       // Create a new User instance and save data
       $save = new User;
       $save->name = trim($request->name);
       $save->username = trim($request->username);
       $save->email = trim($request->email);
       $save->phone = trim($request->phone);
       $save->role = trim($request->role);
       $save->status = trim($request->status);
       $save->remember_token= Str::random(50);
       $save->save();

       Mail::to($save->email)->send(new RegisteredMail($save));

      // Redirect with success message
       return redirect('admin/users')->with('success', 'Record successfully created.');
    }

    public function set_new_password($token){
        $data['token'] = $token;
       return view('auth.reset_pass' ,  $data);
    }

    public function set_new_password_post($token, ResetPassword $request) {
        // Find the user with the provided token
        $user = User::where('remember_token', '=',$token)->first();
        
        // Check if the user exists
        if (!$user->count() == 0) {
            abort(403); // 403 Forbidden error
        }
    
        // Set the new password and update the user's status
        $user=$user->first();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(50); // Generate a new token
        $user->status = 'active'; // Activate the user
        $user->save(); // Save the changes
    
        // Redirect to the login page with a success message
        return redirect('admin.login')->with('success', 'Password has been set.');
    }
    

    


}