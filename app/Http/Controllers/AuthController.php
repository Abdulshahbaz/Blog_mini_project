<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\User;
 use App\Models\Postblog;
 use Hash;
 use Auth;
 use Session;
class AuthController extends Controller
{
    public function index()
    {
   
      //check auth id or user_id same hai ya nhai 
        if(Auth::check())
        {
       $post = Postblog::where('user_id',Auth::id())
               ->where('status',1) //--->status 1 hai  
               ->orderBy('created_at', 'desc') //-->latest post is  top
               ->paginate(10); //--->show  10 records
        return view('home-page',['post'=>$post]); //--->send data blade 
        }

        else
        {
            $post = Postblog::orderBy('created_at', 'desc')
                    ->where('status',1)
                    ->paginate(10);
                    return view('home-page',['post'=>$post]);
        }
        
    }
   
 // shoe register page
    public function register_view()
    {
       return view('auth.register');
    }

    // save data in register page 
    public function register_store(Request $request)
    {
       $request->validate([
         'name' => 'required| string|max:255',
         'email' => 'required|email|unique:users',
         'password' => 'required|string|min:8',

       ]);

       $register = new User;
       $register->name = $request->input('name');
       $register->email = $request->input('email');
       $register->password =Hash::make($request->password);
      // dd($register);
       $register->save();

        //check user is registed are not 
       // user register form submit then redirect  dashboard
       if(Auth::attempt($request->only('email','password'))){
        return redirect('/')->with('success','User Register SuccessFully!');
       }
       return redirect()->back()->with('error','Please Enter Valid Email and Password');
    }

    //show login apge
    public function login()
    {
         return view('auth.login');
    }

    //login user
    public function login_user(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
   
        ]);
             $credentials = $request->only('email','password');
             $user = User::where('email',$credentials['email'])->first();
             
             //check $user or $user->status same is 0  
          if($user && $user->status == 0)
          {
            return redirect()->back()->with('error','Your Account is Block!');
          }   

          //check user is registed are not
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/');
           }
           return redirect()->back()->with('error','Please Eneter Valid Email and Pasword');
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
       // dd($post);
        $post->save();

        return redirect('/')->with('success','Post Create SuccessFully!');
    }

    public function my_blog()
    {
        $mypost = Postblog::where('user_id',Auth::id())->get();     
        return view('my-blog',compact('mypost'));
    }


    public function edit($id)
    {
        $data = Postblog::find($id);
        return view('edit',compact('data'));
    }

    public function update(Request $request,$id)
    {
        $mydata = Postblog::find($id);
         
         if(!$mydata)
         {
            return redirect()->back()->with('error','Not Update Your Record!');
         }

      //  dd($request);
        $request->validate([
            'title' => 'required',
            'description' => 'required',
          ]);
           

          $mydata->title = $request->input('title');
          $mydata->description = $request->input('description');
        //   $mydata->user_id = Auth()->user()->id;
        //  dd($mydata);
          $mydata->save();
  
          return redirect('my-blog')->with('success','Post Updated SuccessFully!');
  
    }

    public function delete($id)
    {
        $data = Postblog::find($id);
        $data->delete();
        return redirect('my-blog')->with('success','Your Post is Deleted SuccessFully!');
    }

    public function logout()
      {
           Session::flush();
           Auth::logout();
           return redirect('/');
       }
}
