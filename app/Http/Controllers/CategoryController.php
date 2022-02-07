<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Helpers\Message;
use Auth;

class CategoryController extends Controller
{
    use Message;
    protected $view = 'category.';
    protected $route = 'category.index';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income = Category::where(function($query) {
            $query->where('user_id', Auth::user()->id)
                ->orWhereNull('user_id');
        })->isNotDeleted()->where('type', 1)->orderBy('type')->get();

        $expense = Category::where(function($query) {
            $query->where('user_id', Auth::user()->id)
                ->orWhereNull('user_id');
        })->isNotDeleted()->where('type', 2)->orderBy('type')->get();
        return view($this->view.'index', compact('income', 'expense'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Category;
        return view($this->view.'form', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Category();
        $data->name = $request->name;
        $data->user_id = Auth::user()->id;
        $data->type = $request->type;
        $data->save();

        return redirect()->route($this->route)->with('success', $this->SUCCESS_ADD);
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
        $model = Category::find($id);
        return view($this->view.'form', compact('model'));
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
        $data = Category::find($id);
        $data->name = $request->name;
        $data->user_id = Auth::user()->id;
        $data->type = $request->type;
        $data->save();

        return redirect()->route($this->route)->with('success', $this->SUCCESS_UPDATE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Category::find($id);
        $model->status = -1;
        $model->save();

        return redirect()->route($this->route)->with('success', $this->SUCCESS_DELETE);
    }
}
