<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Category;
use App\Helpers\Message;
use Auth;
use DB;

class TransactionController extends Controller
{
    use Message;
    protected $view = 'transaction.';
    protected $route = 'transaction.index';

    public function index()
    {
        $models = Transaction::where('user_id', Auth::user()->id)
                    ->select('*', DB::raw('DATE(created_at) as date'))
                    ->orderBy('created_at', 'desc')
                    ->get()
                    ->groupBy('date');
        return view($this->view.'index', compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Transaction();
        $category = Category::where(function($query) {
            $query->where('user_id', Auth::user()->id)
                ->orWhereNull('user_id');
        })->isNotDeleted()->orderBy('type')->get();
        return view($this->view.'form', compact('model', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Transaction();
        $model->user_id = Auth::user()->id;
        $model->value = $request->value;
        $model->category_id = $request->category_id;

        $category = Category::find($model->category_id);
        $model->type = $category->type;
        $model->save();

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
        $model = Transaction::find($id);
        $category = Category::where(function($query) {
            $query->where('user_id', Auth::user()->id)
                ->orWhereNull('user_id');
        })->isNotDeleted()->orderBy('type')->get();
        return view($this->view.'form', compact('model', 'category'));
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
        $model = Transaction::find($id);
        $model->user_id = Auth::user()->id;
        $model->value = $request->value;
        $model->category_id = $request->category_id;

        $category = Category::find($model->category_id);
        $model->type = $category->type;
        $model->save();

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
        $model = Transaction::find($id);
        $model->delete();

        return redirect()->route($this->route)->with('success', $this->SUCCESS_DELETE);
    }
}
