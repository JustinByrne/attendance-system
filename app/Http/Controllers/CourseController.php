<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Learner;
use Carbon\CarbonPeriod;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Database\Query\Builder;

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
        $course->load([
            "learners.attendances" => function (Builder $query) use ($course) {
                $query->where("course_id", $course->id);
            },
        ]);

        $courseLearners = $course
            ->learners()
            ->pluck("learner_id")
            ->toArray();

        $learners = Learner::whereNotIn("id", $courseLearners)->get();

        $dates = CarbonPeriod::create($course->start_date, $course->end_date);

        return view("courses.show")
            ->with("course", $course)
            ->with("learners", $learners)
            ->with("dates", $dates);
    }

    public function addLearner(
        Request $request,
        Course $course
    ): RedirectResponse {
        $course->learners()->attach($request->input("learner_id"));

        return redirect()->route("courses.show", $course);
    }
}
