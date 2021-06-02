<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Badge;

class BadgeController extends Controller
{
    public function index()
    {
        $badges = Badge::all();

        return response([
            'status' => 'done',
            'badges' => $badges
        ]);
    }
}
