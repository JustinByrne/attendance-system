<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Learner extends Model
{
    protected $fillable = ["name"];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }

    public function attendance(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            "attendance_learner",
            "course_id",
            "learner_id"
        )->withPivot("attendance_date", "attended");
    }
}
