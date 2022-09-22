<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\backend\CategoryRequest;
use App\Models\Category;
use Datatables;
use Illuminate\Validation\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('backend.categories.index',['data'=>'index','type'=>'category']);

        // $categories = Category::paginate();
        // $page = $request->get('page');
        // return view('backend.categories.index')->with([
        //     'categories' => $categories,
        //     'page' => $page
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create',['data'=>'create','type'=>'category']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        
        if ($request->get('button_action') == "insert") {
            // dd($request->all());
            $category = new Category([
                'name' => $request->get('categoryName'),
                'description' => $request->get('category-description'),
                'keyword' => $request->get('category_keyword')
            ]);
            $category->save();
            return response()->json([
                'status' => 'Thêm thành công !',
            ]);
        } else if ($request->get('button_action') == "update") {
            $category = Category::find($request->get('edit_category_id'));
            $category->name = $request->get('categoryName');
            $category->description = $request->get('category-description');
            $category->keyword = $request->get('category_keyword');
            $category->save();
            return response()->json([
                'status' => 'Cập nhật thành công !',
            ]);
        }
    }
    /** 
     * Fetch data to update
     * 
     */
    public function fetchData(
        Request $rq
    ) {
        $id = $rq->get('id');
        $category = Category::find($id);
        return response()->json([
            'id' => $id,
            'name' => $category->name,
            'description' => $category->description,
            'keyword' => $category->keyword
        ]);
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

    public function multiDestroy(Request $request)
    {
        $IDS = $request->id;
        Category::whereIn('id', $IDS)->delete();
        return response()->json([
            'return' => 'Xoá thành công ' . count($IDS) . ' bản ghi !',
        ]);
        // $rs = Category::whereIn('id',$IDS)->delete();
        // if($rs->delete()){
        //     echo "deleted";
        // }
    }

    public function destroyACategory(Request $request)
    {
        return response()->json([
            'status' => Category::destroy($request->id),
        ]);
    }

    public function list()
    {
        //$categogies = Category::all();
        $categogies = Category::query();
        return Datatables::of($categogies)
            ->make(true);

        // return response()->json([
        //     'CategoryPaginate' => $categogies,
        // ]);
        // $categogies = Category::paginate();
        // return response()->json([
        //     'CategoryPaginate'=>$categogies,
        // ]);
    }
    // public function list(){
    //     $categogies = Category::select('id', 'name','description','keyword');
    //     return Datatables::of($categogies)->make(true);
    //     // return response()->json([
    //     //     'CategoryPaginate'=>$categogies,
    //     // ]);
    // }
}
