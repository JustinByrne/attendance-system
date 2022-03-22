<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::all();

        return view("courses.index")->with("courses", $courses);
    }

    public function store(Request $request): RedirectResponse
    {
        Course::create([
            "name" => $request->input("name"),
            "start_date" => $request->input("start_date"),
            "end_date" => $request->input("end_date"),
        ]);

        return redirect()->route("courses.index");
    }
}
