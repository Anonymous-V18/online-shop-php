<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Ward;

class LocationController extends Controller
{
    public function districts(Request $request)
    {
        $pid = (int) $request->query('province_id');
        if (!$pid) return response()->json([]);
        return District::query()
            ->where('province_id', $pid)
            ->orderBy('name')
            ->get(['id','name']);
    }

    public function wards(Request $request)
    {
        $did = (int) $request->query('district_id');
        if (!$did) return response()->json([]);
        return Ward::query()
            ->where('district_id', $did)
            ->orderBy('name')
            ->get(['id','name']);
    }
}
