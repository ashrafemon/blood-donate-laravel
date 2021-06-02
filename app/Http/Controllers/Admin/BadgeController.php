<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Badge;

class BadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::all();
        return view('pages.admin.badges.index', compact('badges'));
    }

    public function create()
    {
        return view('pages.admin.badges.create');
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required',
            'avatar' => 'required|image'
        ]);

        $badge = new Badge();
        $badge->name = request('name');

        if (request()->has('avatar')) {
            $file = request()->file('avatar');

            $upload_url = cloudinary()->upload($file->getRealPath(), [
                'folder' => 'donate-blood/images/badges/',
                'public_id' => strtolower(request('name')) . '-' . uniqid(),
                'overwrite' => true,
                'resource_type' => 'image'
            ])->getSecurePath();

            $badge->avatar = $upload_url;
        }

        $badge->save();

        return redirect()->back()->with('message', 'Successfully added');
    }

    public function edit(Badge $badge)
    {
        return view('pages.admin.badges.edit', compact('badge'));
    }

    public function update(Badge $badge)
    {
        $badge->name = request('name') ?? $badge->name;

        if (request()->has('avatar')) {
            $file = request()->file('avatar');

            $upload_url = cloudinary()->upload($file->getRealPath(), [
                'folder' => 'donate-blood/images/badges/',
                'public_id' => strtolower(request('name')) . '-' . uniqid(),
                'overwrite' => true,
                'resource_type' => 'image'
            ])->getSecurePath();

            $badge->avatar = $upload_url;
        }

        $badge->update();

        redirect()->route('badges.index')->with('message', 'Successfully updated');
    }

    public function destroy(Badge $badge)
    {
        $badge->delete();
        return redirect()->route('badges.index')->with('message', 'Successfully deleted');
    }
}
