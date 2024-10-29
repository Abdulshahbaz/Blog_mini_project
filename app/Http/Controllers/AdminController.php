<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Postblog;
use App\Models\User;
use Hash;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    // see admin login page
    public function login()
    {
        return view('admin.admin-login');
    }

    // register admin login only
    public function login_show(Request $request)
    {
        
       $request->validate([
            'email' => 'required',
            'password' => 'required',
   
        ]);
  
          // thise condition check thise admin exits are not 

            $admin = Admin::where('email',$request->email)->first();
            if($admin && Hash::check($request->password,$admin->password))
            {            
                return redirect()->route('dashboard')->with('success','successfully Login Admin');
            }                                                  
           return redirect()->back()->with('error','Please Eneter Valid Email and Pasword');
    }


   // show list post  with pagination 10 record 
    public function create()
    {
        $post =  Postblog::paginate(10);
        return view('admin.post-list',['post'=>$post]);
    }   
    
    //show user list with pagination 10record
    public function users_list()
    {
        $users = User::paginate(10);
        return view('admin.users-list',['users'=>$users]);
    }

    // show edit post  
    public function edits($id)
    {
        $post = Postblog::find($id);
        return view('admin.edit',['post'=>$post]);
    }

    // update post 
    public function update_post(Request $request,$id)
    {
        $posts = Postblog::find($id);
        if(!$posts)
        {
            return redirect()->back()->with('error','Post Not Updated!');
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $posts->title = $request->title;
        $posts->description = $request->description;
        $posts->save();
        return redirect('dashboard')->with('success','Post SuccessFully Updated!');
    }

 
    // check user status 1 or not 1 is exits to change status is 0
    public function toggle_button($id)
    {
        $user = User::find($id);
        if($user->status == 1)
        {
           $user->status  = 0;
        }
        else
        {
            $user->status  = 1;
        }
        $user->save();
        return redirect()->back()->with('success','SuccessFully Update User');
    }

    // check post status 1 or not 1 is exits to change status is 0
    public function toggle_post($id)
    {
         $post = Postblog::find($id);
         if($post->status == 1)
         {
            $post->status = 0;
         }

         else
         {
            $post->status = 1;
         }

         $post->save();
         return redirect()->back()->with('success','User Post Block Successfully!');
    }

    // delete post 
    public function delete_post($id)
    {
        $postDelete = Postblog::find($id);
        if(!is_null($postDelete))
        {
            $postDelete->delete();
            
        }
        return redirect('dashboard')->with('error','success','Post Deleted SuccessFully!');
    }

}                  