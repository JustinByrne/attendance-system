<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    public function attendanceStatus(): BelongsTo
    {
        return $this->belongsTo(AttendanceStatus::class);
    }
}
