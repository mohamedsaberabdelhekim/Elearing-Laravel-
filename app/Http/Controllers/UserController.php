<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if ($user->id == Auth::user()->id) {
            return view('users.profile', ['user' => $user, 'update' => '']);
        } else {
            return view('unothorized');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($user->id == Auth::user()->id) {
            return view('users.edit', ['user' => $user]);
        } else {
            return view('unothorized');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // $request ->validate([

        //     'title'=>"required | min: 4 | max: 20" ,
        //     'body'=>"required",
        //     'rate'=>"required | numeric",
        // ]);

        // $user = Auth::user();
        if ($user->id == Auth::user()->id) {
            $user->update($request->all());

            return view('users.profile', ['user' => $user, 'update' => 'Profile Updated Successfully.']);
        };

        // dd($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id == Auth::user()->id) {
            $user->delete();
            return redirect('/home');
        }
    }

    public function getCourses(User $user)
    {

        if ($user->id == Auth::user()->id) {

            $userCourses = $user->courses;
            return view('users.showCourses', ['userCourses' => $userCourses, 'update' => '']);

        } else {
            return view('unothorized');
        }

    }

    public function enrolling($courseID)
    {

        // courses
        $courses = Course::all();

        $userID = Auth::user()->id;
        $student = User::find($userID);

        if (Gate::allows('isStudent')) {

            if (!$student->enrollments->contains($courseID)) {

                $student->enrollments()->attach($courseID);
                Session::flash('message', 'Enrolled Successfully');
                return back();
            } else {
                Session::flash('message', 'Enrolled Already');
                return back();

            }

        }

    }

    public function unenrolling($courseID)
    {
        // $courseID = Post::findorfail($postId);
        $userID = Auth::user()->id;
        $student = User::find($userID);
        $student->enrollments()->detach($courseID);
        Session::flash('message', 'un-enrolled Successfully');
        return back();

    }

    public function getEnrollments(User $user)
    {

        $userEnrollments = $user->enrollments;

        if ($user->id == Auth::user()->id) {
            return view('users.showEnrollments', ['userEnrollments' => $userEnrollments]);
        } else {
            return view('unothorized');
        }
    }

    public function getAvailableCourses(User $user)
    {
         $userId = $user->id;
        // $courses = Course::all();

        //   dump($courses);

        //   DB::table("courses")->select('*')->whereNotIn('id',function($query) {

        //     $query->select('course_id')->from('course_user');

        //  })->get();

        // -----------------------------

        // $courses = DB::table('courses')
        // ->select(
        //     'courses.id'
        // )
        // ->leftJoin('course_user','course_user.course_id','=','courses.id')
        // ->whereNull('course_user.course_id')
        // ->get();
        //----------------------------------
        // $courses = Course::where('id', 1)->first();

        $courses = DB::table('courses')
            ->select('*')
            ->whereNotExists(function ($query) use ($userId){
                $query->select(DB::raw(1))
                    ->from('course_user')
                    ->whereRaw('courses.id = course_user.course_id')
                    ->where('course_user.user_id', '=', $userId);
            })->get();

         return view('users.availableCourses',['courses'=>$courses]);

    }
}
