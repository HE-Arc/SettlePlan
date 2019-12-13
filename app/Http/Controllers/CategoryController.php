<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\UserUser;

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
        $categorys = Category::all()->where('user_id', auth()->user()->id);
        return view('category.index', ['categorys' => $categorys, 'userName' => auth()->user()->name, 'newCat' => 1]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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

        return redirect('/category')->with('success', 'Category saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        DB::enableQueryLog();

        $temp = UserUser::where([['user_id',  auth()->user()->id], ['user_id1', $user_id]])->
        orWhere([['user_id', $user_id], ['user_id1',  auth()->user()->id]])->get();

        if(count($temp) == 1)
        {
            $friend = User::find($user_id);
            $categorys = Category::all()->where('user_id', $user_id);

            return view('category.index', ['categorys' => $categorys , 'userName' => $friend->name , 'newCat' => 0]);
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
            $categorys = Category::all()->where('user_id', $user_id);

            return view('category.index', ['categorys' => $categorys , 'userName' => $friend->name , 'newCat' => 0]);
        }
    }

    public function showUserCategory($user_id, $category_id)
    {
        $temp = UserUser::where([['user_id',  auth()->user()->id], ['user_id1', $user_id]])->
        orWhere([['user_id', $user_id], ['user_id1',  auth()->user()->id]])->get();

        if(count($temp) == 1)
        {
            $friend = User::find($user_id);
            $categoryName = Category::all()->where(['id', $category_id]);
            $tasks = Category::all()->where(['category_id', $category_id]);

            //return view('task.index', ['categorys' => $categorys , 'userName' => $friend->name , 'newCat' => 0]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
