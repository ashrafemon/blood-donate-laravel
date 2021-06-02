<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BloodGroup;

class BloodGroupController extends Controller
{
    public function index()
    {
        $blood_groups = BloodGroup::all();
        return view('pages.admin.blood_groups.index', compact('blood_groups'));
    }

    public function create()
    {
        return view('pages.admin.blood_groups.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|unique:blood_groups'
        ]);

        BloodGroup::create($data);

        return redirect()->back()->with('message', 'Successfully added');
    }

    public function edit(BloodGroup $blood_group)
    {
        return view('pages.admin.blood_groups.edit', compact('blood_group'));
    }

    public function update(BloodGroup $blood_group)
    {
        $data = request()->validate([
            'name' => 'required|unique:blood_groups'
        ]);

        $blood_group->name = request('name');
        $blood_group->update();

        return redirect()->route('blood_groups.index')->with('message', 'Successfully updated');
    }

    public function destroy(BloodGroup $blood_group)
    {
        $blood_group->delete();
        return redirect()->route('blood_groups.index')->with('message', 'Successfully deleted');
    }
}
