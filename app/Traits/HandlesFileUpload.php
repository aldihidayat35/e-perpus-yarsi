<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

trait HandlesFileUpload
{
    /**
     * Store uploaded file using move() instead of store() to avoid
     * getRealPath() returning false on Windows with Apache Alias.
     *
     * @param  UploadedFile  $file
     * @param  string  $folder  Subfolder name (e.g. 'covers', 'ebooks', 'avatars')
     * @param  string  $disk    'public' or 'local'
     * @return string  Relative path (e.g. 'covers/abc123.png')
     */
    protected function uploadFile(UploadedFile $file, string $folder, string $disk = 'public'): string
    {
        $name = Str::random(40) . '.' . $file->getClientOriginalExtension();

        if ($disk === 'public') {
            $destinationPath = storage_path('app/public/' . $folder);
        } else {
            $destinationPath = storage_path('app/private/' . $folder);
        }

        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file->move($destinationPath, $name);

        return $folder . '/' . $name;
    }
}
