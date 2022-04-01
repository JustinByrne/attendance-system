<?php

namespace App\Exports;

use App\Models\Course;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Database\Eloquent\Builder;

class RegisterExport implements FromView
{
    public $course;

    public function __construct($course)
    {
        $this->course = Course::find($course);
    }

    public function view(): View
    {
        $course = $this->course;

        $course->load([
            "learners.attendances" => function ($query) use ($course) {
                $query->where("course_id", $course->id);
            },
            "learners.attendances.attendanceStatus",
        ]);

        $dates = CarbonPeriod::create($course->start_date, $course->end_date);

        return view("courses.table", [
            "course" => $course,
            "dates" => $dates,
        ]);
    }
}
