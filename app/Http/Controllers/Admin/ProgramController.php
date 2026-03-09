<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::latest()->paginate(10);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        $data['slug'] = Str::slug($data['title']).'-'.Str::random(6);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('programs', 'public');
        }

        Program::create($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil dibuat');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($program->thumbnail && Storage::disk('public')->exists($program->thumbnail)) {
                Storage::disk('public')->delete($program->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('programs', 'public');
        }

        $program->update($data);

        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil diperbarui');
    }

    public function destroy(Program $program)
    {
        if ($program->thumbnail && Storage::disk('public')->exists($program->thumbnail)) {
            Storage::disk('public')->delete($program->thumbnail);
        }
        $program->delete();
        return redirect()->route('admin.programs.index')->with('success', 'Program berhasil dihapus');
    }
}
