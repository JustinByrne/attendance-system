<?php

namespace App\Exports;

use App\Models\Course;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromView;

class RegisterExport implements FromView
{
    public $course;

    public function __construct($course)
    {
        $this->course = Course::findorFail($course);
    }

    public function view(): View
    {
        $this->course->load([
            'learners.attendances' => function ($query) {
                $query->where('course_id', $this->course->id);
            },
            'learners.attendances.attendanceStatus',
        ]);

        $dates = CarbonPeriod::create(
            $this->course->start_date,
            $this->course->end_date,
        );

        return view('courses.table', [
            'course' => $this->course,
            'dates' => $dates,
        ]);
    }
}
