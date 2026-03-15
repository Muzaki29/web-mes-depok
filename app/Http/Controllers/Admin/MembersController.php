<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function index()
    {
        return view('admin.members.index');
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.members');
    }

    public function edit(int $id)
    {
        return view('admin.members.edit', ['id' => $id]);
    }

    public function update(Request $request, int $id)
    {
        return redirect()->route('admin.members');
    }

    public function destroy(int $id)
    {
        return redirect()->route('admin.members');
    }
}
