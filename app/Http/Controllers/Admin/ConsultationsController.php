<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultationsController extends Controller
{
    public function index()
    {
        return view('admin.consultations.index');
    }

    public function create()
    {
        return view('admin.consultations.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.consultations');
    }

    public function edit(int $id)
    {
        return view('admin.consultations.edit', ['id' => $id]);
    }

    public function update(Request $request, int $id)
    {
        return redirect()->route('admin.consultations');
    }

    public function destroy(int $id)
    {
        return redirect()->route('admin.consultations');
    }
}
