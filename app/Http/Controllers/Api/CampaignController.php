<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::with(['user'])->where('status', 'active')->get();

        return response([
            'status' => 'done',
            'campaigns' => $campaigns
        ]);
    }
}
