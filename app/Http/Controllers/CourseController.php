<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Learner;
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

    public function show(Course $course): View
    {
        $courseLearners = $course
            ->learners()
            ->pluck("learner_id")
            ->toArray();

        $learners = Learner::whereNotIn("id", $courseLearners)->get();

        return view("courses.show")
            ->with("course", $course)
            ->with("learners", $learners);
    }

    public function addLearner(
        Request $request,
        Course $course
    ): RedirectResponse {
        $course->learners()->attach($request->input("learner_id"));

        return redirect()->route("courses.show", $course);
    }
}