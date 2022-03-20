<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    public function learners(): BelongsToMany
    {
        return $this->belongsToMany(Learner::class);
    }
}
