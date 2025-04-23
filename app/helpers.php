<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Torann\GeoIP\Facades\GeoIP;
use App\Entities\ActivityLog;

if (!function_exists('save_chart_image')) {

    /**
     * Save base64 image to storage and return link to it
     * @param string $base64String
     * @return string
     */
    function save_chart_image(string $base64String)
    {
        $base64String = str_replace('data:image/png;base64,', '', $base64String);
        $base64String = str_replace(' ', '+', $base64String);
        $imageName = uniqid() . '.' . 'png';

        Storage::disk('local')->exists('public/report-charts') or Storage::disk('local')->makeDirectory('public/report-charts');

        Storage::disk('local')->put('public/report-charts' . '/' . $imageName, base64_decode($base64String));

        return asset('storage/report-charts/' . $imageName);
    }
}

if (!function_exists('logActivity')) {
    function logActivity($action, $affectedIds = null, $data = null)
    {
        $ip = Request::ip();
        $location = GeoIP::getLocation($ip);

        ActivityLog::create([
            'user_id'      => Auth::id(),
            'session_id'   => session()->getId(),
            'method'       => Request::method(),
            'action'       => $action,
            'url'          => Request::fullUrl(),
            'affected_ids' => is_array($affectedIds) ? implode(',', $affectedIds) : $affectedIds,
            'ip_address'   => $ip,
            'location'     => $location->toArray(),
            'data'         => $data,
        ]);
    }
}
