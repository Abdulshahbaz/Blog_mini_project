<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Postblog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function index()
    {

        if (Auth::check()) {
            $posts = Postblog::where('user_id', Auth::id())
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
            return view('home-page', ['posts' => $posts]);
        } else {
            $posts = Postblog::orderBy('created_at', 'desc')
                ->where('status', 1)
                ->paginate(10);
            return view('home-page', ['posts' => $posts]);
        }
    }


    public function register_view()
    {
        return view('auth.register');
    }

    public function register_store(Request $request)
    {
        $request->validate([
                'name' => 'required| string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',

            ]);

        $userregister = new User;
        $userregister->name = $request->input('name');
        $userregister->email = $request->input('email');
        $userregister->password = Hash::make($request->password);
        $userregister->save();

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/')->with('success', 'User Register SuccessFully!');
        }
        return redirect()->back()->with('error', 'Please Enter Valid Email and Password');
    }


    public function login()
    {
        return view('auth.login');
    }


    public function login_user(Request $request)
    {
        $request->validate([
                'email' => 'required',
                'password' => 'required',

            ]);
        $credentials = $request->only('email', 'password');
        $userlogin = User::where('email', $credentials['email'])->first();

        if ($userlogin && $userlogin->status == 0) {
            return redirect()->back()->with('error', 'Your Account is Block!');
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('/');
        }
        return redirect()->back()->with('error', 'Please Eneter Valid Email and Pasword');
    }

    public function post_blog()
    {

        return view('post-blog');
    }

    public function post_store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10|max:1000',
        ]);

        $post = new Postblog;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = Auth()->user()->id;
        $post->save();

        return redirect('/')->with('success', 'Post Create SuccessFully!');
    }

    public function my_blog()
    {
        $mypost = Postblog::where('user_id', Auth::id())->get();
        return view('my-blog', ['mypost' => $mypost]);
    }


    public function edit($id)
    {
        $mypost = Postblog::find($id);
        return view('edit', ['mypost' => $mypost]);
    }

    public function update(Request $request, $id)
    {
        $mypost = Postblog::find($id);

        if (!$mypost) {
            return redirect()->back()->with('error', 'Not Update Your Post!');
        }


        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);


        $mypost->title = $request->input('title');
        $mypost->description = $request->input('description');
        $mypost->save();

        return redirect('my-blog')->with('success', 'Post Updated SuccessFully!');
    }

    public function delete($id)
    {
        $mypost = Postblog::find($id);
        $mypost->delete();
        return redirect('my-blog')->with('success', 'Your Post is Deleted SuccessFully!');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
