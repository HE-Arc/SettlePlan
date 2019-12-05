<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Category;
use Illuminate\Database\Eloquent\Builder;



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
        $userId = auth()->user()->id;

        $tasks = Task::all();
        //$tasks = Task::with('category')->where('categories.user_id' , $userId)->get(); 



        return  view('tasks/index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
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
          'end_at' => 'nullable|date'
        ]);

        $task = new Task([
          'name' => $request->get('name'),
          'description' => $request->get('description'),
          'end_at' => $request->get('end_at'),
          'category_id' => $request->get('category'),
        ]);

        $task->save();
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $categories = Category::all();
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
