<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Category;
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
        $userId = auth()->user()->id;
        $tasks = Task::select('tasks.*')->with('category')
            ->join('categories', 'category_id', '=', 'categories.id')
            ->where('categories.user_id' , $userId)->orderByRaw('end_at', 'DESC')->get();

        $files = null;
        foreach ($tasks as $key => $value)
        {
            $filesTask = $value->files()->get();
            if(isset($filesTask[0]))
            {
                $files[$value->id] = $filesTask;
            }
        }
        return  view('tasks/index', ['tasks' => $tasks, 'files' => $files]);
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
     * Show the form for creating a new resource with selected category.
     *
     * @return \Illuminate\Http\Response
     */
     public function createFromCategory($category_id)
     {
         $userId = auth()->user()->id;
         $categories = Category::where('user_id', $userId)->get();
         return  view('tasks/create', ['categories' => $categories , 'selectedCategory' => $category_id]);
     }

     /**
      * Display the specified resource for the category and the user concerned by the parameters.
      *
      * @param  int  $task_id
      * @return \Illuminate\Http\Response
      */
     public function import($task_id)
     {
         $task = Task::find($task_id);
          $files = $task->files()->get();
         $userId = auth()->user()->id;

         $categories = Category::where('user_id', $userId)->get();

         return  view('tasks/import', ['categories' => $categories, 'task' => $task, 'files' => $files]);
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

        $files = null;

        $files = $request->file('files');

        if($files != null)
        {
          foreach ($files as $file)
          {
            $path = Storage::putFile('file', $file);
            $fileDB = new \App\File();
            $fileDB->path = $path;
            $fileDB->name = $file->getClientOriginalName();
            $fileDB->save();

            $task->files()->attach($fileDB->id);
          }
        }

        return redirect("/categories/". $task->category_id)->with('success', 'Task Created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = auth()->user();

        $categories = Category::where('user_id', $user->id)->get();
        $task = Task::with('category')->find($id);
        $files = $task->files()->get();

        if ($user->can('crud',$task->category))
        {
            return view('tasks.edit', ['task' => $task , 'categories' => $categories,  'files' => $files]);
        }
        return redirect("home");
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

        $files = null;
        $files = $request->file('files');


        if($files != null)
        {
          foreach ($files as $file)
          {
            $path = Storage::putFile('file', $file);
            $fileDB = new \App\File();
            $fileDB->path = $path;
            $fileDB->name = $file->getClientOriginalName();
            $fileDB->save();

            $task->files()->attach($fileDB->id);
          }
        }

        $task->save();

        return redirect('/categories/'. $task->category_id)->with('success', 'Task updated!');
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

        foreach ($files as $value)
        {
            $fileDB = \App\File::find($value->id);
            Storage::delete($fileDB->path);

            $fileDB->delete();
        }

        $categoryID = $task->category_id;

        $task->delete();

        return redirect('/categories/'. $categoryID)->with('success', 'Task deleted!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $task_id
     * @param  int  $file_id
     * @return \Illuminate\Http\Response
     */
    public function deleteFile($task_id, $file_id)
    {
        $fileDB = \App\File::find($file_id);
        Storage::delete($fileDB->path);

        $fileDB->delete();

        return redirect('/tasks/'. $task_id . '/edit');
    }

    /**
     * Download the specified resource to storage.
     *
     * @param  int  $category_id
     * @param  int  $task_id
     * @param  int  $file_id
     * @return \Illuminate\Http\Response
     */
    public function download($category_id , $task_id , $file_id)
    {
        $fileDB = \App\File::find($file_id);

        return response()->download(storage_path('app/'.$fileDB->path), $fileDB->name);
    }
}
