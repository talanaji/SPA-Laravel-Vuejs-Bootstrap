<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    
    public function createpost (Request $request){
        $validator = Validator::make($request->all(),[
            'title'=>'required|min:3',
            'price'=>'required',
            'email'=>'required|email', 
        ]);
        if($validator ->fails()){
            return response()->json(['status'=>'error','errors'=>$validator->errors()]);
        }
        $post = new POST;
        $post->title= $request->title;
        $post->price= $request->price;
        $post->area= $request->area;
        $post->address= $request->address;
        $post->name= $request->name;
        $post->email= $request->email;
        $post->phoneNumber= $request->phoneNumber; 
        $post->save();
        return response()->json(['status'=>'success','data'=>$post]);

    }
    public function updatepost (Request $request,$postid){
        $validator = Validator::make($request->all(),[
            'title'=>'required|min:3',
            'price'=>'required',
            'email'=>'required|email', 
        ]);
        if($validator ->fails()){
            return response()->json(['status'=>'error','errors'=>$validator->errors()]);
        }
        $post =POST::find($postid);
        $post->title= $request->title;
        $post->price= $request->price;
        $post->area= $request->area;
        $post->address= $request->address;
        $post->name= $request->name;
        $post->email= $request->email;
        $post->phoneNumber= $request->phoneNumber; 
        $post->save();
        return response()->json(['status'=>'success','data'=>$post]);

    }
    public function getposts(){
        $posts = Post::all();
        
        return response()->json(['status'=>'success','data'=>$posts]);

    }
}