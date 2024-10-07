<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class AssetController extends Controller
{
    public function cache($req_file_name)
    {
        $file_name = public_path($req_file_name);
        $filePath = Storage::drive('public')->get($req_file_name);

        $cache_days = 1;
        $one_day_secs = 86400;
        if (request()->cache_days && request()->cache_days > 1) {
            $cache_days = request()->cache_days;
        }
        $cache_seconds = round($one_day_secs * $cache_days);
        $headers = [
            'Content-Type' => 'webp',
            'Cache-Control' => 'public, max-age=' . $cache_seconds,
            'Expires' => gmdate('D, d M Y H:i:s \G\M\T', time() + $cache_seconds),
            'Last-Modified' => gmdate('D, d M Y H:i:s \G\M\T'),
        ];

        $img_canvas = Image::canvas(100, 100, '#fff');
        if (!file_exists($file_name)) {
            $image = Image::make(public_path('dummy.png'))->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img_canvas->insert($image, 'center');
            return response()->make($img_canvas->encode('webp'), 200, $headers);
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file_name);
        $lastModified = filemtime($file_name);
        finfo_close($finfo);

        if (strpos($file_name, '.css')) {
            $mimeType = "text/css; charset=UTF-8";
        } else if (strpos($file_name, '.js')) {
            $mimeType = "application/javascript";
        } else if (strpos($file_name, '.ico')) {
            $mimeType = "image/vnd.microsoft.icon";
        } else if (strpos($file_name, '.svg')) {
            $mimeType = "image/svg+xml";
        }
        // dd($image_name, $mimeType, strpos($image_name, '.css'));

        $header['Last-Modified'] = gmdate('D, d M Y H:i:s \G\M\T', $lastModified);
        $header['Content-Type'] = $mimeType;

        return response()->make($filePath, 200, $headers);
    }

    public function cache_resize($req_file_name, Request $request)
    {

        $lastModified = Carbon::now()->toDateTimeString();
        $cache_days = 1;
        $one_day_secs = 86400;
        if ($request->cache_days && $request->cache_days > 1) {
            $cache_days = $request->cache_days;
        }
        $cache_seconds = round($one_day_secs * $cache_days);
        $headers = [
            'Content-Type' => "image/webp",
            'Cache-Control' => 'public, max-age=' . $cache_seconds,
            'Expires' => gmdate('D, d M Y H:i:s \G\M\T', time() + $cache_seconds),
            'Last-Modified' => $lastModified,
        ];

        $width = null;
        $height = null;
        if ($request->has('width')) {
            $width = $request->width;
        }
        if ($request->has('height')) {
            $height = $request->height;
        }

        $file_name = public_path($req_file_name);

        $img_canvas = Image::canvas($width + 5, $height + 5, '#fff');

        /** not exist return default image */
        if (!file_exists($file_name)) {
            $image = Image::make(public_path('dummy.png'))->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img_canvas->insert($image, 'center');
            return response()->make($img_canvas->encode('webp'), 200, $headers);
        }


        $img_canvas = Image::canvas($width + 5, $height + 5, '#fff');
        $image = Image::make($file_name)
        ->resize($width, $height);

        $img_canvas->insert($image, 'center');

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $lastModified = filemtime($file_name);
        finfo_close($finfo);
        $headers['Last-Modified'] = $lastModified;

        // return $image->response('png');

        return response()->make($img_canvas->encode('webp'), 200, $headers);
    }
}
