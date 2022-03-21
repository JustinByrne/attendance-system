<?php

namespace App\Http\Controllers;

use App\Models\Learner;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class LearnerController extends Controller
{
    public function index(): View
    {
        $learners = Learner::all();

        return view("learners.index")->with("learners", $learners);
    }

    public function store(Request $request): RedirectResponse
    {
        learner::create([
            "name" => $request->input("name"),
        ]);

        return redirect()->route("learners.index");
    }
}
