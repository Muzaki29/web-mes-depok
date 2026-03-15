<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    public function index()
    {
        return view('admin.partners.index');
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.partners');
    }

    public function edit(int $id)
    {
        return view('admin.partners.edit', ['id' => $id]);
    }

    public function update(Request $request, int $id)
    {
        return redirect()->route('admin.partners');
    }

    public function destroy(int $id)
    {
        return redirect()->route('admin.partners');
    }
}
