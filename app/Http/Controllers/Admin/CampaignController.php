<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with(['user'])->get();
        return view('pages.admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('pages.admin.campaigns.create');
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
            'image' => 'required|image',
            'held_on' => 'required',
        ]);

        $campaign = new Campaign();
        $campaign->title = request('title');
        $campaign->held_on = request('held_on');
        $campaign->user_id = auth()->id();

        if (request()->has('image')) {
            $file = request()->file('image');

            $upload_url = cloudinary()->upload($file->getRealPath(), [
                'folder' => 'donate-blood/images/campaigns/',
                'public_id' => strtolower(request('title')) . '-' . uniqid(),
                'overwrite' => true,
                'resource_type' => 'image'
            ])->getSecurePath();

            $campaign->image = $upload_url;
        }

        $campaign->save();

        return redirect()->back()->with('message', 'Successfully added');
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return redirect()->route('campaigns.index')->with('message', 'Successfully deleted');
    }
}
