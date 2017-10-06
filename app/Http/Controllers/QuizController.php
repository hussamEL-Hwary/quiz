<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Helper;
use Auth;
use App\Quiz;

class QuizController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:teacher');
    }
    public function show()
    {
      return view('pages.teacher.createquiz');
    }

    public function showQuestionsForm()
    {
      $data = session()->get('data');

      return view('pages.teacher.questions',compact('data'));
    }
    public function quizValidator(array $data)
    {
      return Validator::make($data,[
        'name' => 'required|unique:quizs|min:3|max:20',
        'count'    => 'required|integer|min:1|max:20',
        'categoryName' => 'required',
      ]);
    }

    public function checkRequirments(Request $request)
    {
       $data=$request->all();
      $validator=$this->quizValidator($data);
      if($validator->fails())
      {
        return redirect()->back()->withInput($request->only('name','count','categoryName'))->withErrors($validator);
      }
      /**
      *set session
      */
      session(['data'=>$data]);
      return redirect()->route('teacher.creat.questions');
    }


    public function store(Request $request)
    {
        $data = session()->get('data');
        session()->forget('data');
        return dd($data);
      return redirect()->back()->withInput();
      $questions=$request->all();
      $questionSize=9;
      $umberOfQuestions=sizeof($request->all())/$questionSize;
      for ($i=1; $i <=$umberOfQuestions; $i++) {
        return $questions['type'.$i];
      }

    }
}
