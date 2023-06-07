<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

// Retrieve the authenticated user
$user = Auth::user();
class EnrollmentController extends Controller
{
    public function create(Course $course)
    {
        $breadcrumb = "Enroll in $course->name course";

        return view('enrollment.enroll', compact('course', 'breadcrumb'));
    }

    public function store(Request $request, Course $course)
    {
        if(auth()->guest())
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            auth()->login($user);
        }
        
        $course->enrollments()->create(['user_id' => auth()->user()->id]);

        return redirect()->route('enroll.myCourses');
    }

    public function handleLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
        
            if ($user->roles->contains('title', 'Admin')) {
                return redirect()->route('admin.home');
            } elseif ($user->roles->contains('title', 'Institution')) {
                return redirect()->route('institution.home');
            } else {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('home');
        }
}

    public function myCourses()
    {
        $breadcrumb = "My Courses";

        $userEnrollments = auth()->user()
            ->enrollments()
            ->with('course.institution')
            ->orderBy('id', 'desc')
            ->paginate(6);

        return view('enrollment.courses', compact(['breadcrumb', 'userEnrollments']));
    }
}
