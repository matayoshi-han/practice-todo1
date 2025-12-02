<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Category;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //todo一覧の表示
        $todos = Todo::with('category')->paginate(5);
        $categories = Category::all();

        return view('index', compact('categories', 'todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        //todoの新規作成
        $todo = $request->only(['category_id', 'content']);
        Todo::create($todo);
        return redirect('/todos');
        with('success', 'Todoを作成しました');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //todoの更新
        $todo = $request->only(['category_id', 'content']);
        $todo = Todo::find($request->id)->update($todo);

        return redirect('/todos')->with('success', 'Todoを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //todoの削除
        Todo::find($request->id)->delete();
        return redirect('/todos')->with('success', 'Todoを削除しました');
    }

    public function search(Request $request)
    {
        //todoの検索
        $query = Todo::with('category')
            ->CategorySearch($request->category_id)
            ->KeywordSearch($request->keyword);

        $todos = $query->paginate(5);

        $todos->appends($request->only(['category_id', 'keyword']));

        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }
}
