<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SertificateResource;
use App\Models\File;
use App\Models\Sertificate;
use App\Services\FileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SertificateApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $objects = Sertificate::paginate(20);

        return response([
            'data' => $objects->items(),
            'count' => Sertificate::count()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ], 422);
        }

        $sertificate = new Sertificate;
        $sertificate->fill($request->all());
        $sertificate->position = preg_replace("/[^\d.]/", "", $sertificate->position);

        $sertificate->save();

        $fileService = new FileService('/sertificates/' . $sertificate->id);

        if (isset($request->preview)) {
            $downloadFile = $request->preview[0];

            if (isset($downloadFile['base64'])) {

                $fileDB = $fileService->downloadBase64(
                    $downloadFile['base64'],
                    [
                        'real_name' => $downloadFile['real_name'],
                        'mime' => $downloadFile['mime'],
                    ]
                );

                $sertificate->preview()->associate($fileDB->id);
            }
        }

        if (isset($request->file)) {
            $downloadFile = $request->file[0];

            if (isset($downloadFile['base64'])) {

                $fileDB = $fileService->downloadBase64(
                    $downloadFile['base64'],
                    [
                        'real_name' => $downloadFile['real_name'],
                        'mime' => $downloadFile['mime'],
                    ]
                );

                $sertificate->file()->associate($fileDB->id);
            }
        }

        $sertificate->save();

        return response([
            'data' => $sertificate
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Sertificate $sertificate)
    {
        return response([
            'data' => new SertificateResource($sertificate)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sertificate $sertificate)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return response([
                'errors' => $validator->errors()
            ], 422);
        }

        $sertificate->fill($request->all());
        $sertificate->position = isset($sertificate->position) ? preg_replace("/[^\d.]/", "", $sertificate->position) : 0;

        $fileService = new FileService('/sertificates/' . $sertificate->id);

        if (isset($request->preview)) {
            $downloadFile = $request->preview;

            if (isset($downloadFile['base64'])) {
                $preview = $sertificate->preview()->first();

                if ($preview) {
                    Storage::disk('public')->delete($preview->path);

                    $sertificate->preview()->disassociate();
                    $sertificate->preview()->delete();
                }



                $fileDB = $fileService->downloadBase64(
                    $downloadFile['base64'],
                    [
                        'real_name' => $downloadFile['real_name'],
                        'mime' => $downloadFile['mime'],
                    ]
                );

                $sertificate->preview()->associate($fileDB->id);
            }
        }

        if (isset($request->file)) {
            $downloadFile = $request->file;

            if (isset($downloadFile['base64'])) {
                $file = $sertificate->file()->first();

                if ($file) {
                    Storage::disk('public')->delete($file->path);

                    $sertificate->file()->disassociate();
                    $sertificate->file()->delete();
                }

                $fileDB = $fileService->downloadBase64(
                    $downloadFile['base64'],
                    [
                        'real_name' => $downloadFile['real_name'],
                        'mime' => $downloadFile['mime'],
                    ]
                );

                $sertificate->file()->associate($fileDB->id);
            }
        }

        $sertificate->save();

        return response([
            'data' => new SertificateResource($sertificate)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sertificate $sertificate)
    {
        $preview = $sertificate->preview()->first();

        if ($preview) {
            Storage::disk('public')->delete($preview->path);

            $sertificate->preview()->disassociate();
            $sertificate->preview()->delete();
        }

        $file = $sertificate->file()->first();

        if ($file) {
            Storage::disk('public')->delete($file->path);

            $sertificate->file()->disassociate();
            $sertificate->file()->delete();
        }

        $sertificate->delete();

        return response([
            'message' => 'Сертификат успешно удален'
        ]);
    }
}
