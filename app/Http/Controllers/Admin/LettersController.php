<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LettersController extends Controller
{
    public function index()
    {
        return view('admin.letters.index');
    }

    public function create()
    {
        return view('admin.letters.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.letters');
    }

    public function edit(int $id)
    {
        return view('admin.letters.edit', ['id' => $id]);
    }

    public function update(Request $request, int $id)
    {
        return redirect()->route('admin.letters');
    }

    public function destroy(int $id)
    {
        return redirect()->route('admin.letters');
    }
}
