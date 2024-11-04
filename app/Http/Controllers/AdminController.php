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


    public function login_show(Request $request)
    {

        $request->validate
        ([
            'email' => 'required',
            'password' => 'required',

        ]);
            $adminlogin = Admin::where('email', $request->email)->first();

        if ($adminlogin && Hash::check($request->password, $adminlogin->password))
         {
            return redirect()->route('dashboard')->with('success', 'successfully Login Admin');
         }
           return redirect()->back()->with('error', 'Please Eneter Valid Email and Pasword');
    }


    public function create()
    {
        $post =  Postblog::paginate(10);
        return view('admin.post-list', ['post' => $post]);
    }


    public function users_list()
    {
        $posts = User::paginate(10);
        return view('admin.users-list', ['posts' => $posts]);
    }


    public function edits($id)
    {
        $post = Postblog::find($id);
        return view('admin.edit', ['post' => $post]);
    }


    public function update_post(Request $request, $id)
    {
        $post = Postblog::find($id);
        if (!$post) {
            return redirect()->back()->with('error', 'Post Not Updated!');
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $post->title = $request->title;
        $post->description = $request->description;
        $post->save();
        return redirect('dashboard')->with('success', 'Post SuccessFully Updated!');
    }


    public function toggle_button($id)
    {
        $post = User::find($id);
        if ($post->status == 1) {

            $post->status  = 0;
        } else {

            $post->status  = 1;
        }
        $post->save();
        $meassasge =  $post->status == 0 ? 'User Block SuccessFully!' : 'User Unblock SuccessFully!';
        return redirect()->back()->with('success', $meassasge);
    }

    public function toggle_post($id)
    {
        $post = Postblog::find($id);
        if ($post->status == 1) {
            $post->status = 0;
        } else {
            $post->status = 1;
        }

        $post->save();
        $meassasge =  $post->status == 0 ? 'Post Block SuccessFully!' : 'Post Unblock SuccessFully!';
        return redirect()->back()->with('success', $meassasge);
    }


    public function delete_post($id)
    {
        $post = Postblog::find($id);
        if (!is_null($post)) {
            $post->delete();
        }
        return redirect('dashboard')->with('error', 'success', 'Post Deleted SuccessFully!');
    }
}
