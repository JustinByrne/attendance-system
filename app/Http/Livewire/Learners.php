<?php

namespace App\Http\Livewire;

use App\Models\Learner;
use Livewire\Component;

class Learners extends Component
{
    public function render()
    {
        $learners = Learner::with("courses")->get();

        return view("livewire.learners")->with("learners", $learners);
    }
}
