<?php

namespace App\Http\Controllers;

use App\Models\Learner;
use Illuminate\View\View;
use App\Http\Requests\LearnerRequest;
use Illuminate\Http\RedirectResponse;

class LearnerController extends Controller
{
    public function index(): View
    {
        $learners = Learner::all();

        return view("learners.index")->with("learners", $learners);
    }

    public function store(LearnerRequest $request): RedirectResponse
    {
        learner::create($request->validated());

        return redirect()->route("learners.index");
    }
}
