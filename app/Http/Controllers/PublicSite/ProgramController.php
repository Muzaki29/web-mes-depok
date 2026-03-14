<?php

namespace App\Http\Controllers\PublicSite;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index(Request $request)
    {
        $query = Program::where('status', 'active');

        if ($request->has('q')) {
            $search = $request->q;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $programs = $query->latest()->get();
        return view('public.programs', compact('programs'));
    }

    public function show($slug)
    {
        $program = Program::where('slug', $slug)->where('status', 'active')->firstOrFail();
        $otherPrograms = Program::where('status', 'active')->where('id', '<>', $program->id)->limit(3)->get();
        return view('public.program', compact('program', 'otherPrograms'));
    }
}
