<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
class CategoryController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:teacher');
  }

/**
*@return create category view
*/
  public function index()
  {
    return view('pages.teacher.createcategory');
  }

  /**
  *create new unique category for quizes
  *and save in database
  *@return teacher dashboard
  */
  public function store()
  {
    $this->validate(request(),[
      'categoryname' => 'required'
    ]);

      $cateName=strtolower(trim(request('categoryname')));
      $testCate=Category::where('name','=',$cateName)->first();
      $categorydes=request('description');
      //if there is no category create new one
      if($testCate==null){

           $newcategory=Category::create([
            'teacher_id'  => auth('teacher')->id(),
            'name'        => request('categoryname'),
            'description' => $categorydes
          ]);

      $newcategory->description=$categorydes;
      $newcategory->save();
      session()->flash('message','categoty successfully created');
      return redirect(route('teacher.dashboard'));

    }
    else {

      session()->flash('message','duplicate category name');
      return redirect()->back();

    }

  }

}