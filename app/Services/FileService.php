<?php

namespace App\Services;

use App\Models\File as FileModel;
use Illuminate\Http\File as FileHttp;
use Illuminate\Support\Facades\File as FileFacades;
use Illuminate\Support\Facades\Storage;

class FileService
{

    public string $path;
    public string $disk;
    public string $type; // BASE64 | FILE

    public function __construct(string $path, string $disk = 'public', string $type = 'BASE64')
    {
        $this->path = $path;
        $this->disk = $disk;
        $this->type = $type;
    }
    
    /**
     * downloadBase64
     *
     * @param  mixed $file
     * @param  mixed $data 
     * @return FileModel
     */
    public function downloadBase64(string $file, array $data) : FileModel
    {
        $base64 = $file;
        $base64 = preg_replace('/data:.*;base64,/', '', $base64);

        $decodedData = base64_decode($base64);

        $tempFile = tmpfile();
        fwrite($tempFile, $decodedData);
        $tempFilePath = stream_get_meta_data($tempFile)['uri'];
        $file = new FileHttp($tempFilePath);

        $filePath = Storage::disk($this->disk)->putFile($this->path, $file);

        $fileDB = new FileModel();
        $fileDB->real_name = $data['real_name'];

        $fileDB->name = last(explode('/', $filePath));
        $fileDB->path = $filePath;

        $fileDB->ext = FileFacades::extension($filePath);
        $fileDB->mime = $data['mime'];

        $fileDB->save();

        return $fileDB;
    }
}
