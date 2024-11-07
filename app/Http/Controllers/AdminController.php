<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Postblog;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{


    public function login()
    {
        return view('admin.admin-login');
    }


    public function admin_login(Request $request)
    {

        $request->validate
        ([
            'email' => 'required',
            'password' => 'required',

        ]);
            // $adminlogin = Admin::where('email', $request->email)->first();
            if (Auth::guard('admin')->attempt($request->only('email', 'password'))) {

            return redirect()->route('admin.dashboard')->with('success', 'successfully Login Admin');
         }
           return redirect()->back()->with('error', 'Please Eneter Valid Email and Pasword');
    }


    public function user_post_list()
    {
        $user_posts =  Postblog::paginate(10);
        return view('admin.blogs-list', ['user_posts' => $user_posts]);
        
    }


    public function users_list()
    {
        $user_lists = User::paginate(10);
        return view('admin.users-list', ['user_lists' => $user_lists]);
    }


    public function edits($id)
    {
        $edit_post = Postblog::find($id);
        return view('admin.blog-edit', ['edit_post' => $edit_post]);
    }


    public function update_post(Request $request, $id)
    {
        $post_update = Postblog::find($id);
        if (!$post_update) {
            return redirect()->back()->with('error', 'Post Not Updated!');
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $post_update->title = $request->title;
        $post_update->description = $request->description;
        $post_update->save();
        return redirect('admin.dashboard')->with('success', 'Post SuccessFully Updated!');
    }


    public function toggle_button($id)
    {
        $user_status = User::find($id);
        if ($user_status->status == 1) {

            $user_status->status  = 0;
        } else {

            $user_status->status  = 1;
        }
        $user_status->save();
        $meassasge =  $user_status->status == 0 ? 'User Block SuccessFully!' : 'User Unblock SuccessFully!';
        return redirect()->back()->with('success', $meassasge);
    }

    public function toggle_post($id)
    {
        $post_status = Postblog::find($id);

        if ($post_status->status == 1) {

            $post_status->status = 0;
        } 
        else {
            $post_status->status = 1;
        }
        $post_status->save();

        $meassasge =  $post_status->status == 0 ? 'Post Block SuccessFully!' : 'Post Unblock SuccessFully!';
        return redirect()->back()->with('success', $meassasge);
    }


    public function delete_post($id)
    {
        Postblog::destroy($id);
        return redirect('admin.dashboard')->with('success', 'success', 'Post Deleted SuccessFully!');
    }
}
