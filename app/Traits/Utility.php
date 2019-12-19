<?php


namespace App\Traits;


use Illuminate\Support\Facades\Storage;

class Utility
{
    public static function base64FileUpload($file, $path = 'reg')
    {
        $response = ['status' => false, 'file_info' => null, 'msg' => null];

        $pos  = strpos($file, ';');
        $type = explode('/', substr($file, 0, $pos))[1];

        $file = preg_replace('#^data:image/\w+;base64,#i', '',$file);
        $fileData    = base64_decode($file);
        $fileName    = uniqid('jn'). ".{$type}";
        $year        = date('Y');
        $path        = "public/{$year}/{$path}";
        Storage::disk('local')->makeDirectory($path, 0777, true);
        $uploadFullPath = "{$path}/{$fileName}";
        $status         = Storage::disk('local')->put($uploadFullPath, $fileData);

        if ($status) {
            $response['status']    = true;
            $response['msg']       = "File Upload Success!";
            $path                  = str_replace('public', 'storage', $path);
            $uploadFullPath        = str_replace('public', 'storage', $uploadFullPath);

            $response['fileInfo'] = [
                'fileName' => $fileName,
                'path'     => $path,
                'fullPath' => $uploadFullPath
            ];
        } else {
            $response['msg'] = "Failed to upload file - {$file['title']}";
        }

        return $response;
    }
}