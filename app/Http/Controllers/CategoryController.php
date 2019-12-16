<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\UserUser;
use App\Task;

use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorys = Category::where('user_id', auth()->user()->id)->get();
        return view('categories.index', ['categorys' => $categorys, 'userName' => auth()->user()->name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
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
        ]);

        $category = new Category([
          'name' => $request->get('name'),
          'private' => (int)$request->has('private'),
          'user_id' =>  auth()->user()->id,
        ]);

        $category->save();

        return redirect('/categories')->with('success', 'Category saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($category_id)
    {
        $userId = auth()->user()->id;

        // check if the user own the category

        $category = Category::where('user_id', $userId)->where("id", $category_id)->get();


        if(count($category) == 1)
        {
            $tasks = Task::where("category_id", $category_id)->orderByRaw('end_at', 'DESC')->get();

            $user = auth()->user();

            $files = null;

            foreach ($tasks as $key => $value) {
                $filesTask = $value->files()->get();
                if(isset($filesTask[0]))
                {
                    $files[$value->id][0] = $filesTask[0]->id;
                    $files[$value->id][1] = $filesTask[0]->path;
                }
            }

            return view('categories.detail', ['tasks' => $tasks , 'user' => $user , 'newTask' => 1, 'category' => $category[0],  'files' => $files]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUser($user_id)
    {
        $temp = UserUser::where([['user_id',  auth()->user()->id], ['user_id1', $user_id]])->
        orWhere([['user_id', $user_id], ['user_id1',  auth()->user()->id]])->get();

        if(count($temp) == 1)
        {
            $friend = User::find($user_id);
            $categorys = Category::where('user_id', $user_id)->where('private', 0)->get();

            return view('categories.friend', ['categorys' => $categorys , 'user' => $friend]);
        }

    }

    public function showUserCategory($user_id, $category_id)
    {
        $temp = UserUser::where([['user_id',  auth()->user()->id], ['user_id1', $user_id]])->
        orWhere([['user_id', $user_id], ['user_id1',  auth()->user()->id]])->get();
        if(count($temp) == 1)
        {
            $friend = User::find($user_id);
            $categoryName = Category::where('id', $category_id)->where('private', 0)->get();
            $tasks = Task::where('category_id', $category_id)->get();
            $files = null;

            foreach ($tasks as $key => $value) {
                $filesTask = $value->files()->get();
                if(isset($filesTask[0]))
                {
                    $files[$value->id] = $filesTask[0]->path;
                }
            }


            return view('categories.detail', ['tasks' => $tasks ,'files' => $files,  'newTask' => 0, 'userName' => $friend->name, 'categoryName' => $categoryName[0]->name , 'user' => $friend]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::where('id', $id)->get();

        return view('categories.edit', ['category' => $category[0]]);
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
          'name'=>'required'
        ]);

        $category = Category::find($id);
        $category->name = $request->get('name');
        $category->private = (int)$request->has('private');

        $category->save();

        return redirect('/categories')->with('success', 'Category updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::where('id', $id)->where('user_id', auth()->user()->id);
        $category->delete();

        return redirect('/categories')->with('success', 'Category deleted !');
    }
}
