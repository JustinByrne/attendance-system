<?php

namespace App\Http\Controllers;

use App\Http\Requests\LearnerRequest;
use App\Models\Learner;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LearnerController extends Controller
{
    public function index(): View
    {
        return view('learners.index');
    }

    public function store(LearnerRequest $request): RedirectResponse
    {
        learner::create($request->validated());

        return redirect()->route('learners.index');
    }
}
