<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Services\UploadImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use PharIo\Manifest\ElementCollectionException;


class UploadImageController extends Controller
{
    protected $uploadImageService;

    public function __construct(UploadImageService $uploadImageService)
    {
        $this->uploadImageService = $uploadImageService;
    }

    public function index(){
        return view('welcome');
    }

    public function save(Request $request)
    {
        return $this->uploadImageService->save($request);
    }

    public function organizePictures($picture_id, $target_name, $account_id)
    {
        return $this->uploadImageService->organizePictures($picture_id, $target_name, $account_id);
    }

}
