<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index()
    {
        return view('admin.events.index');
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.events');
    }

    public function edit(int $id)
    {
        return view('admin.events.edit', ['id' => $id]);
    }

    public function update(Request $request, int $id)
    {
        return redirect()->route('admin.events');
    }

    public function destroy(int $id)
    {
        return redirect()->route('admin.events');
    }
}
