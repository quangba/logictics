<?php

use Illuminate\Support\Facades\Storage;

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
