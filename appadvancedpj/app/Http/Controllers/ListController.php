<?php

namespace App\Http\Controllers;
use App\Models\Todo;

use Illuminate\Http\Request;
use App\Http\Requests\ListRequest;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (isset($user)){
        $todos = Todo::all();

        $param = ['todos' => $todos, 'user' =>$user];
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
        $form = $request->all();
        unset($form['_token']);
        Todo::find($request->id)->update($form);
        return redirect('/');
    }

        public function remove(ListRequest $request)
    {
        //dd($request->task);
        Todo::find($request->id)->delete();
        return redirect('/');
    }

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
