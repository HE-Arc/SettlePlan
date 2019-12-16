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
            ->where('categories.user_id' , $userId)->get();*/

        //dd($tasks[1]->files()->get());

        //A Modifier
        /*$files = null;

        foreach ($tasks as $key => $value) {
          $filesTask = $value->files()->get();
          if(isset($filesTask[0]))
          {
            $files[$value->id] = $filesTask[0]->path;
          }
        }*/
        //dd($files);
        //dd($tasks);
        //$tasks = Task::with('category')->where('user_id', $userId)->get();
        //return  view('tasks/index', ['tasks' => $tasks, 'files' => $files]);
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
        $i = 1;

        while($file = $request->file('file' . $i))
        {
         $path = Storage::putFile('file', $file);
         $fileDB = new \App\File();
         $fileDB->path = $path;
         $fileDB->name = $file->getClientOriginalName();
         $fileDB->save();

          $task->files()->attach($fileDB->id);
          $i++;
        }

        return redirect("/categories/". $task->category_id)->with('success', 'Task Created!');
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
        $task = Task::with('category')->find($id);
        $files = $task->files()->get();

        if($task->category->user_id === $userId)
        {
            return view('tasks.edit', ['task' => $task , 'categories' => $categories,  'files' => $files]);
        }
        else
        {
            return redirect()->action('HomeController@index');
        }
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


        $i = 1;

        while($file = $request->file('file' . $i))
        {
             $path = Storage::putFile('file', $file);
             $fileDB = new \App\File();
             $fileDB->path = $path;
             $fileDB->name = $file->getClientOriginalName();
             $fileDB->save();

             $task->files()->attach($fileDB->id);
             $i++;
          }

        $task->save();
        return redirect('/categories/'. $task->category_id)->with('success', 'Task updated!');
        //return redirect('/categories/'. $task->category_id)->with('success', 'Task updated!');
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

        $files = $task->files()->get();

        foreach ($files as $value) {
          $fileDB = \App\File::find($value->id);
          Storage::delete($fileDB->path);

          $fileDB->delete();
        }

        $categoryID = $task->category_id;

        $task->delete();

        return redirect('/categories/'. $categoryID)->with('success', 'Task deleted!');

    }

    public function deleteFile($task_id, $file_id)
    {
      $fileDB = \App\File::find($file_id);
      Storage::delete($fileDB->path);

      $fileDB->delete();

      return redirect('/tasks/'. $task_id . '/edit');
    }


    public function download($category_id , $task_id , $file_id)
    {
      $fileDB = \App\File::find($file_id);

      //return  Storage::download($fileDB->path, $fileDB->name);

      return response()->download(storage_path('app/'.$fileDB->path), $fileDB->name);
    }
}
