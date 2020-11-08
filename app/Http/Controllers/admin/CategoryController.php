<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Session;
use Validator;

class CategoryController extends Controller
{
    public function index($id=0)
    {
      $categories = Category::whereStatus(1)->whereParentId($id)->get();
      return view('admin.category.index',compact('categories'));
    }

    public function categoryCreate(Request $request)
    {
      if($request->isMethod('post') ){
        $validator = $request->validate(
           [
              "name"=>"required|max:255",
              "description"=>"required|max:255",
            ]
      );

        $category = new Category;
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        
        if ($category->save()) {
          Session::flash('Success','Category Successfully created');
        }else{
          Session::flash('Error','Something went worng.');
        }
        return redirect()->route('admin.categories');
      }
      return view('admin.category.create');
    }

    public function categoryEdit($id='')
    {
      $category = Category::find($id);
      return view('admin.category.edit',compact('category'));
    }

    public function categoryUpdate(Request $request)
    {
      $validator = $request->validate(
           [
              "id"=>"required",
              "name"=>"required|max:255",
              "description"=>"required|max:255",
            ]
      );
        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->active = $request->status;
        
        if ($category->update()) {
          Session::flash('Success-toastr','Category Successfully updated');
        }else{
          Session::flash('Error','Something went worng.');
        }
        return redirect()->back();
    }


     public function categoryDelete($id)
    {
      $category = category::find($id);
      if($category->delete()){
           Session::flash('Success', 'Successfully deleted.');
        }else{
           Session::flash('Error', 'Something went worng. Please try again.');
        }

      return redirect()->back();
    }
}
