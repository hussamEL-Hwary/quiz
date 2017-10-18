<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Helper;
use Auth;
use App\Quiz;
use App\Category;
use App\Question;
use App\Tfanswer;
use App\Multianswer;


class QuizController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:teacher')->except('allQuizzes','showOne');
    }

    public function getQuizzesByCategory(&$id)
    {
      return Quiz::select(['name','id','teacher_id'])->where('category_id',$id)->orderBy('name')->get();
    }

    /**
    *get all quizzes in a specific category
    *@param category id
    *@return quiz
    */
    public function allQuizzes($id)
    {
      $quizzes=$this->getQuizzesByCategory($id);
      return view('pages.quiz.quizzes',compact('quizzes'));
    }

    public function showOne(Quiz $quiz)
    {
      return view('pages.quiz.show',compact('quiz'));
    }
    public function show()
    {
      $categories=$this->getAllCategories();
      return view('pages.teacher.createquiz',compact('categories'));
    }

    public function getAllCategories()
    {
      return Category::get(['name']);
    }

    public function showQuestionsForm()
    {
      $data = session()->get('data');
      if(!$data)
      abort(404);
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

    public function getCategoryIdByName($name)
    {
      return Category::wherename($name)->firstOrFail();
    }

    public function validateQuestions(&$data,&$questions)
    {

      for ($i=1; $i <=$data['count']; $i++) {
           $qNumber='question'.$i;
           $qType='type'.$i;
           $tf='tf'.$i;
           $ans1='answer1'.$i;
           $ans2='answer2'.$i;
           $ans3='answer3'.$i;
           $ans4='answer4'.$i;
           $correctNum='correctNum'.$i;
         $this->validate(request(),[
         $qNumber =>'required|string|min:1|max:250',
         $qType   =>'required',
         ]);

         if($questions[$qType]=='tf')
         {
           $this->validate(request(),[
             $tf =>'required',
           ]);


         }
         else if($questions[$qType]=='multi')
         {
           $this->validate(request(),[
           $ans1 =>'required|min:1|max:30',
           $ans2 =>'required|min:1|max:30',
           $ans3 =>'required|min:1|max:30',
           $ans4 =>'required|min:1|max:30',
           $correctNum =>'required|integer|min:1|max:4',
             ]);

         }

       }


    }

    public function store(Request $request)
    {
      $data = session()->get('data');
      $questions=$request->all();
      $this->validateQuestions($data,$questions);
      //create new quiz in db
      $categoryId=$this->getCategoryIdByName($data['categoryName'])->id;
      $teacherId=Auth::guard('teacher')->user()->id;
      $currentQuiz=Quiz::create([
        'name'          =>$data['name'],
        'qcount'        =>$data['count'],
        'category_id'   =>$categoryId,
        'teacher_id'    =>$teacherId,
      ]);

      //add questions in their tables
      for ($i=1; $i <=$data['count']; $i++) {
        $qNumber='question'.$i;
        $qType='type'.$i;
        $tf='tf'.$i;
        $ans1='answer1'.$i;
        $ans2='answer2'.$i;
        $ans3='answer3'.$i;
        $ans4='answer4'.$i;
        $correctNum='correctNum'.$i;
        $currentQuestion=Question::create([
          'quiz_id'     =>$currentQuiz->id,
          'question'    =>$questions[$qNumber],
          'answer_type' =>$questions[$qType],
        ]);

        if($questions[$qType]=='tf')
        {
          Tfanswer::create([
            'quiz_id'      =>$currentQuiz->id,
            'question_id'  =>$currentQuestion->id,
            'answer'       =>$questions[$tf],
          ]);
        }
        else if($questions[$qType]=='multi')
        {
          Multianswer::create([
            'quiz_id'         =>$currentQuiz->id,
            'question_id'     =>$currentQuestion->id,
            'answer1'         =>$questions[$ans1],
            'answer2'         =>$questions[$ans2],
            'answer3'         =>$questions[$ans3],
            'answer4'         =>$questions[$ans4],
            'correct_answer'  =>$questions[$correctNum],
          ]);
        }
      }
      session()->forget('data');
      session()->flash('message','your quiz has been created');
    return redirect()->route('teacher.dashboard');
    }
}
