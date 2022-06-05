<?php

namespace App\Http\Controllers;

use App\Exports\RegisterExport;
use App\Http\Requests\AddLearnerRequest;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Attendance;
use App\Models\AttendanceStatus;
use App\Models\Course;
use App\Models\Learner;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
{
    public function index(): View
    {
        $courses = Course::all();

        return view('courses.index')->with('courses', $courses);
    }

    public function store(CourseRequest $request): RedirectResponse
    {
        Course::create($request->validated());

        return redirect()->route('courses.index');
    }

    public function show(Course $course): View
    {
        $course->load([
            'learners.attendances' => function (Builder $query) use ($course) {
                $query->where('course_id', $course->id);
            },
            'learners.attendances.attendanceStatus',
        ]);

        $courseLearners = $course
            ->learners()
            ->pluck('learner_id')
            ->toArray();

        $learners = Learner::whereNotIn('id', $courseLearners)->get();

        $dates = CarbonPeriod::create($course->start_date, $course->end_date);

        return view('courses.show')
            ->with('course', $course)
            ->with('learners', $learners)
            ->with('dates', $dates);
    }

    public function addLearner(
        AddLearnerRequest $request,
        Course $course,
    ): RedirectResponse {
        $course->learners()->attach($request->validated());

        return redirect()->route('courses.show', $course);
    }

    public function register(Course $course): View
    {
        $course->load(['learners']);
        $statuses = AttendanceStatus::orderBy('code')->get();

        return view('courses.register')
            ->with('course', $course)
            ->with('statuses', $statuses);
    }

    public function downloadRegister($course)
    {
        return Excel::download(new RegisterExport($course), 'register.xlsx');
    }

    public function storeRegister(
        RegisterRequest $request,
        Course $course,
    ): RedirectResponse {
        $attendance = [];

        foreach ($request->attendance as $learner => $status) {
            $attendance[] = [
                'learner_id' => $learner,
                'course_id' => $course->id,
                'attendance_date' => $request->attendance_date,
                'attendance_status_id' => $status['status_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Attendance::insert($attendance);

        return redirect()->route('courses.show', $course);
    }
}
