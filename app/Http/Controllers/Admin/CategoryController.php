<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:admin.categories.index|admin.categories.create|admin.categories.edit|admin.categories.destroy', ['only' => ['index','store']]);
        $this->middleware('permission:admin.categories.index', ['only' => ['index']]);
        $this->middleware('permission:admin.categories.create', ['only' => ['create','store']]);
        $this->middleware('permission:admin.categories.edit', ['only' => ['edit','update']]);
        $this->middleware('permission:admin.categories.destroy', ['only' => ['destroy']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = 
        [
            'name'             => 'required|string',
        ];

        $names = 
        [
            'name'             =>'Name',
        ];

        $data = $this->validate($request , $rules , [] , $names);

        $data['created_by'] = Auth::id();
        
        Category::create($data);


        return redirect()->route('admin.categories.index')
                ->with('success','Category created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit',compact('category')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $category = Category::find($id);

        $rules = 
        [
            'name'             => 'required|string',
        ];

        $names = 
        [
            'name'             =>'Name',
        ];

        $data = $this->validate($request , $rules , [] , $names);
        
        $category->update($data);


        return redirect()->route('admin.categories.index')
                ->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('admin.categories.index')
                ->with('success','Category deleted successfully');
    }
}
