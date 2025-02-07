<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAdminVendorProfileController extends Controller
{
    /**
     * Get vendor profile of authenticated user.
     */
    public function index()
    {
        $profile = Vendor::where('user_id', Auth::id())->first();

        if (!$profile) {
            return response()->json(['message' => 'Vendor profile not found'], 404);
        }

        return response()->json($profile);
    }

    /**
     * Update vendor profile.
     */
    public function update(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'max: 20'],
            'email' => ['required', 'email', 'max: 200'],
            'address' => ['required'],
            'description' => ['required'],
            'fb_link' => ['nullable', 'url'],
            'tw_link' => ['nullable', 'url'],
            'insta_link' => ['nullable', 'url'],
        ]);

        $vendor = Vendor::where('user_id', Auth::id())->first();

        if (!$vendor) {
            return response()->json(['message' => 'Vendor profile not found'], 404);
        }

        $vendor->update($request->only(['phone', 'email', 'address', 'description', 'fb_link', 'tw_link', 'insta_link']));

        return response()->json(['message' => 'Vendor profile updated successfully', 'data' => $vendor]);
    }
}
