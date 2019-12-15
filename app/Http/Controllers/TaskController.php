<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Category;
//use App\File;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;



class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$userId = auth()->user()->id;
        $tasks = Task::select('tasks.*')->with('category')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->where('categories.user_id' , $userId)->get();
        return  view('tasks/index', ['tasks' => $tasks]);*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = auth()->user()->id;



        $categories = Category::where('user_id', $userId)->get();
        return  view('tasks/create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dump($request);
        $request->validate([
          'name'=>'required',
          'description'=>'required',
          'category' => 'required',
          'end_at' => 'nullable|date',
        ]);

        $task = new Task([
          'name' => $request->get('name'),
          'description' => $request->get('description'),
          'end_at' => $request->get('end_at'),
          'category_id' => $request->get('category'),
        ]);

        $task->save();

         if ($file = $request->file('file')) {
             $path = Storage::putFile('file', $file);
             $fileDB = new \App\File();
             $fileDB->setPath($path);
             $fileDB->save();

             $task->files()->attach($fileDB->id);
          }


        return redirect('/tasks')->with('success', 'Task saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /*public function show($id , $id2)
    {
        dd("test");
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userId = auth()->user()->id;

        $categories = Category::where('user_id', $userId)->get();
        $task = Task::find($id);
        return view('tasks.edit', ['task' => $task , 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
          'name'=>'required',
          'description'=>'required',
          'category' => 'required',
          'end_at' => 'nullable|date'
        ]);

        $task = Task::find($id);
        $task->name = $request->get('name');
        $task->description = $request->get('description');
        $task->end_at = $request->get('end_at');
        $task->category_id = $request->get('category');
        $task->save();

        return redirect('/tasks')->with('success', 'Task updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();

        return redirect('/tasks')->with('success', 'Task deleted!');
    }
}
