<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class TeacherController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:teacher');
    }

    public function index()
    {
      return view('pages.teacher.home');
    }
}
