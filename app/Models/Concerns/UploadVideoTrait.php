<?php

namespace App\Models\Concerns;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use App\Models\ProductVideo;

trait UploadVideoTrait
{
    /**
     * رفع فيديو وحفظه في قاعدة البيانات
     */
    public function uploadVideo(UploadedFile $video, $folder = 'product/videos', $saveToDatabase = true)
    {
        $destinationPath = public_path("uploads/{$folder}");

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        $extension = strtolower($video->getClientOriginalExtension());
        $allowedExtensions = ['mp4', 'mov', 'avi', 'webm', 'mkv'];
        if (!in_array($extension, $allowedExtensions)) {
            throw new \Exception("صيغة الفيديو غير مدعومة: {$extension}");
        }

        $fileName = uniqid('vid_') . '.' . $extension;
        $video->move($destinationPath, $fileName);

        $videoPath = "uploads/{$folder}/{$fileName}";

        if ($saveToDatabase) {
            return $this->saveVideoToDatabase($videoPath, $video->getClientOriginalName());
        }

        return $videoPath;
    }

    /**
     * حفظ بيانات الفيديو في قاعدة البيانات
     */
    public function saveVideoToDatabase($videoPath, $videoName = null)
    {
        if (!$this->id) {
            throw new \Exception('المنتج يجب أن يُحفَظ أولًا قبل ربط الفيديو به.');
        }

        return ProductVideo::create([
            'product_id' => $this->id,
            'video_path' => $videoPath,
            'video_name' => $videoName ?? basename($videoPath),
        ]);
    }

    /**
     * رفع فيديو بدون حفظ في قاعدة البيانات
     */
    public function uploadVideoOnly(UploadedFile $video, $folder = 'product/videos')
    {
        return $this->uploadVideo($video, $folder, false);
    }
}
