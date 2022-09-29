<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Get all categories
    public function index(Request $request){
        $categories = auth()->user()->categories()->paginate(10);
        
        if ($request->wantsJson()){
            return response()->json([
                'success' => true,
                'data' => $categories
            ]);
        }
        else {
            return view('template.categories.index', ['categories' => $categories, 'success' => true, 'message' => 'Successfully fetch all categories']);
        }
    }
    
    // Get detail category
    public function show(Request $request, $id){
        $category = auth()->user()->categories()->find($id);

        if(!$category){
            if ($request->wantsJson()){
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found '
                ], 400);
            }
            else{
                return view('template.categories.show', ['category' => $category, 'success' => false, 'message' => 'Category not found']);
            }
        }
        if ($request->wantsJson()){
            return response()->json([
                'success' => true,
                'data' => $category->toArray()
            ]);
        }
        else{
            return view('template.categories.show', ['category' => $category, 'success' => true, 'message' => 'Category found']);
        }

    }

    // Route to create category page view
    public function create(){
        return view('template.categories.create',);
    }

    // Route to edit category page view
    public function edit(Category $category)
    {
        return view('template.categories.edit',['category' => $category]);
    }

    // Create new category 
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);

        $category = new Category();
        $category->name = $request->name;

        if(auth()->user()->categories()->save($category)){
            if ($request->wantsJson()){
                return response()->json([
                    'success' => true,
                    'data' => $category->toArray()
                ]);
            }
            else{
                $request->session()->flash('message','New category has been added');
                return redirect()->to('categories');
            }
        }
        else{
            if ($request->wantsJson()){
                return response()->json([
                    'success' => false,
                    'message' => 'Category not added'
                ], 500);
            }
            else{
                $request->session()->flash('message','Category not added');
                return redirect()->to('categories');
            }
        }
    }
    
    // Update category
    public function update(Request $request, $id){
        $category = auth()->user()->categories()->find($id);
        if(!$category){
            if ($request->wantsJson()){
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found'
                ], 400);
            }
            else {
                $request->session()->flash('message','Category '.$id.' not found');
                return redirect()->to('categories');
            }
        }

        $updated = $category->fill($request->all())->save();

        if($updated){
            if ($request->wantsJson()){
                return response()->json([
                    'data' => $category,
                    'success' => true
                ]);
            }
            else {
                $request->session()->flash('message','Category '.$id.' updated');
                return redirect()->to('categories');
            }
        }
        else{
            if ($request->wantsJson()){
                return response()->json([
                    'success' => false,
                    'message' => 'Category could not be updated'
                ], 500);
            }
            else {
                $request->session()->flash('message','Category '.$id.' could not be updated');
                return redirect()->to('categories');
            }
        }
    }

    // Delete category
    public function destroy(Request $request, $id){
        $category = auth()->user()->categories()->find($id);

        if(!$category){
            if ($request->wantsJson()){
                return response()->json([
                    'success' => false,
                    'message' => 'Category not found'
                ], 400);
            }
            else {
                $request->session()->flash('message','Category '.$id.' not found');
                return redirect()->to('categories');
            }
        }

        if ($category->delete()){
            if ($request->wantsJson()){
                return response()->json([
                    'success' => true,
                    'message' => 'Category has been deleted'
                ]);
            }
            else {
                $request->session()->flash('message','Category '.$id.' has been deleted');
                return redirect()->to('categories');
            }
        }
        else {
            if ($request->wantsJson()){
                return response()->json([
                    'success' => false,
                    'message' => 'Category could not be deleted'
                ], 500);
            }
            else {
                $request->session()->flash('message','Category '.$id.' could not be deleted');
                return redirect()->to('categories');
            }
        }
    }
}
