<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;


class CourseController extends Controller
{

    public function __construct(){
        $this->middleware('auth');

        // $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();

        // if(auth()->user()->role == 'student')
        // {
            return view('courses.index',['courses'=>$courses,'enrolled'=>'']);

        // }else{

        //     return view('courses.index',['courses'=>$courses,'enrolled'=>'']);
        // }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(Gate::allows("isTeacher"))
        {
            return view('courses.create');
        }else
        {
            return view('unothorized');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>"required",
            'description'=>"required",
            'duration'=>"required",
        ]);

        $input = $request->all();
        $input['user_id'] = auth()->user()->id;

        if(Gate::allows("isTeacher"))
        {
            Course::create($input);
            $userCourses = auth()->user()->courses;
            return view('users.showCourses',['userCourses'=>$userCourses,'update'=>'Course Added Successfully']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {

        return view('courses.show',['course'=>$course]);

        // dd($course->student);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        if ($course->user->id == Auth::user()->id) {
            return view('courses.edit', ['course'=>$course]);
        }else{

            return view('unothorized');
           }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
    //    if($course->user->id == Auth::user()->id)
    //    {

    //    }else{
    //     return view('unothorized');
    //    }
    $user = Auth::user();
    if($user->can("update", $course)){
        $course->update($request->all());
        $userCourses = $user->courses;
        return view('users.showCourses', ['userCourses' => $userCourses, 'update' => 'Course updated Successfully!']);
    }

}
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        $user = Auth::user();
        if($user->can("delete", $course)){
            $course->delete();
            Session::flash('message', 'Course has been deleted successfully!');
            return back();
        }else{
            return view('unothorized');
        }


    }
}
