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
            $posts = Postblog::orderBy('created_at', 'desc')
                ->where('status', 1)
                ->paginate(10);
            return view('home-page', ['posts' => $posts]);
      
    }

    public function users_show()
    {
        if (Auth::check()) {
            $posts = Postblog::orderBy('created_at', 'desc')
                ->where('status', 1)
                ->orderBy('created_at', 'desc')
                ->paginate(10);
                return view('auth.home-page', ['posts' => $posts]);

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

        $user_register = new User;
        $user_register->name = $request->input('name');
        $user_register->email = $request->input('email');
        $user_register->password = Hash::make($request->password);
        $user_register->save();

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('users/dashboard')->with('success', 'User Register SuccessFully!');
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
        $user_login = User::where('email', $credentials['email'])->first();

        if ($user_login && $user_login->status == 0) {
            return redirect()->back()->with('error', 'Your Account is Block!');
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect('users/dashboard');
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

        return redirect('users/dashboard')->with('success', 'Post Create SuccessFully!');
    }

    public function my_blog()
    {
        $my_posts = Postblog::where('user_id', Auth::id())->get();
        return view('my-blog', ['my_posts' => $my_posts]);
    }


    public function edit($id)
    {
        $my_post = Postblog::find($id);
        return view('user-edit', ['my_post' => $my_post]);
    }

    public function update(Request $request, $id)
    {
        $my_post = Postblog::find($id);

        if (!$my_post) {
            return redirect()->back()->with('error', 'Not Update Your Post!');
        }


        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);


        $my_post->title = $request->input('title');
        $my_post->description = $request->input('description');
        $my_post->save();

        return redirect('my-blog')->with('success', 'Post Updated SuccessFully!');
    }

    public function delete($id)
    {
        Postblog::destroy($id);
        return redirect('my-blog')->with('success', 'Your Post is Deleted SuccessFully!');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/');
    }
}
