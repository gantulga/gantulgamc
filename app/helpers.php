<?php
use Illuminate\Support\Str;
use App\Settings;

if (! function_exists('fileThumbnailUrl')) {
    function fileThumbnailUrl($file, $disk='public', $mimeType=null)
    {
        if (!$file) {
            return;
        }

        if(!\Storage::disk($disk)->exists($file)){
            return;
        }

        $mime_type = $mimeType ?? \Storage::disk($disk)->mimeType($file);
        if (starts_with($mime_type, 'image/')) {
            return $file
                ? \Storage::disk($disk)->url($file)
                : asset;
        }
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $ext = Str::endsWith($ext, 'doc') ? $ext.'x' : $ext;
        $ext = Str::endsWith($ext, 'xls') ? $ext.'x' : $ext;
        $ext = Str::endsWith($ext, 'ppt') ? $ext.'x' : $ext;
        $ext = in_array($ext, ['docx', 'pptx']) ? $ext.'_win' : $ext;
        return 'https://cdn0.iconfinder.com/data/icons/FileTypesIcons/128/'.$ext.'.png';
    }
}


if (! function_exists('settings')) {
    function settings($key, $default=null)
    {
        return app('settings')->get($key, $default);
    }
}
