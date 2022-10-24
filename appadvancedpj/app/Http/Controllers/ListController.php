<?php

namespace App\Http\Controllers;
use App\Models\Todo;
use App\Models\Tag;

use Illuminate\Http\Request;
use App\Http\Requests\ListRequest;
use App\Http\Requests\FindRequest;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();

        if (isset($user)){
        $todos = Todo::all();
        $tags = Tag::all();

        $request->session()->forget('key');

        $param = ['todos' => $todos, 'tags' =>$tags,'user' =>$user];
        return view('todolist', $param);
        
        }else{
        return redirect('/login');
        }

    }

    public function create(ListRequest $request)
    {
        $form = $request->all();
        Todo::create($form);
        return redirect('/');
    }

        public function update(ListRequest $request)
    {
        $data = $request->all();
        unset($data['_token']);
        if(count($data)>3){
            Todo::find($request->id)->update($data);
            $forms=$request->session()->get('key');
            foreach($forms as &$form){
                if($form->id==$request->id){
                    $form->task=$request->task;
                    $form->tag_id=$request->tag_id;
                }
                unset($form);   
            }
            //$request->session()->put('key',$forms);
            unset($data['key']);
            return redirect('/find');    
        }else{
        Todo::find($request->id)->update($data);
        return redirect('/');
        }
    }

        public function remove(ListRequest $request)
    {
        //dd($request->task);
        $data = $request->all();
        if(count($data)>3){
            Todo::find($request->id)->delete();
            $forms=$request->session()->get('key');
            foreach($forms as $num =>$form){
                if($form->id==$request->id){
                    unset($forms[$num]);
                }  
            }
            //$request->session()->put('key',$forms);
            unset($data['key']);
            return redirect('/find');    
        }else{
        Todo::find($request->id)->delete();
        return redirect('/');
    }
}

        public function find(Request $request)
    {

        $forms=$request->session()->get('key');
        //$forms = [];
        //$form = $request->all();

     
        $user = Auth::user();

        if (isset($user)){
        $tags = Tag::all();

        $param = ['tags' =>$tags,'user' =>$user,'forms' =>$forms];
        return view('find', $param);
        
        }else{
        return redirect('/login');
        }

    }

    public function search(FindRequest $request)
    {    
        
        $user = Auth::user();

        if (isset($user)){
        $tags = Tag::all();
        $forms = Todo::where('user_id', '=',"$request->user_id");
        if($request->tag_id==0){
        }else{
        $forms=$forms->where('tag_id', '=', "$request->tag_id");
        }
        $forms=$forms->where('task', 'LIKE BINARY', "%{$request->task}%")->get();
//dd($forms);

$param = [
    'tags' =>$tags,
    'user' =>$user,
    'forms' => $forms
        ];

        $request->session()->put('key',$forms);

        return view('find', $param);
    //return redirect('/find');
}else{
        return redirect('/login');
        }

    }

   /* public function search(FindRequest $request)
    {    
        
        $user = Auth::user();

        if (isset($user)){
        $tags = Tag::all();
        $forms = Todo::where('user_id', '=',"$request->user_id");
        $forms=$forms->where('tag_id', '=', "$request->tag_id");
        $forms=$forms->where('task', 'LIKE BINARY', "%{$request->task}%")->get();
//dd($forms);

$param = [
    'tags' =>$tags,
    'user' =>$user,
    'forms' => $forms
        ];

        //return view('find', $param);
    return redirect('/find');}else{
        return redirect('/login');
        }

    }*/

/*
            public function change(ClientRequest $request)
    {
        //dd($request);
        if ($request->has('update')){
        $form = $request->all();
        unset($form['_token']);
        Todo::find($request->id)->update($form);
        return redirect('/');

        }elseif ($request->has('remove')){
            dd($request->id);
        Todo::find($request->id)->delete();
        dd($request->id);
        return redirect('/');
        }
    }
    */


}