<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DonorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        $donors = User::with(['profile'])
                        ->whereNotIn('id', [auth()->id()])
                        ->where('role', 'donor')
                        ->where('status', 'active')
                        ->take(5)
                        ->get();

        return response([
            'status' => 'done',
            'donors' => $donors
        ]);
    }
}
