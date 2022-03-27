<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Learner;
use Carbon\CarbonPeriod;
use Illuminate\View\View;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\AttendanceStatus;
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
            "learners.attendances.attendanceStatus",
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

    public function register(Course $course): View
    {
        $course->load(["learners"]);
        $statuses = AttendanceStatus::orderBy("code")->get();

        return view("courses.register")
            ->with("course", $course)
            ->with("statuses", $statuses);
    }

    public function storeRegister(
        Request $request,
        Course $course
    ): RedirectResponse {
        $attendance = [];

        foreach ($request->attendance as $learner => $status) {
            $attendance[] = [
                "learner_id" => $learner,
                "course_id" => $course->id,
                "attendance_date" => $request->attendance_date,
                "attendance_status_id" => $status,
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }

        Attendance::insert($attendance);

        return redirect()->route("courses.show", $course);
    }
}
