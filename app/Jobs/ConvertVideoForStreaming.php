<?php

namespace App\Jobs;

use FFMpeg\FFMpeg;
use App\Video;
use Carbon\Carbon;
use FFMpeg\Coordinate\Dimension;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\File;
use MicrosoftAzure\Storage\Common\Internal\StorageServiceSettings;
use Illuminate\Support\Facades\Storage;
use Matthewbdaly\LaravelAzureStorage\AzureBlobStorageAdapter;
use MicrosoftAzure\Storage\Blob\BlobRestProxy;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $video;

    /**
     * Create a new job instance.
     *
     * @param Video $video
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // create a video format...
        $lowBitrateFormat = new X264('libmp3lame', 'libx264');
        $converted_name = $this->video->original_name;

        $ffmpeg = FFMpeg::create(array(
            'ffmpeg.binaries'  => 'd:\home\site\public\bin\ffmpeg.exe',
            'ffprobe.binaries' => 'd:\home\site\public\bin\ffprobe.exe',
            'timeout'          => 3600, // The timeout for the underlying process
            'ffmpeg.threads'   => 12   // The number of threads that FFMpeg should use
        ));

        $disk = Storage::disk('azure');

        $video = $ffmpeg->open($this->video->path . $converted_name);
        $video->save($lowBitrateFormat, $this->video->path . 'video_' . $converted_name);

        $folder = 'videos';
        $disk->put($folder, $this->video->path . 'video_' . $converted_name);

        File::delete($this->video->path . 'video_' . $converted_name);
        File::delete($this->video->path . $converted_name);
    }

    private function getCleanFileName($filename)
    {
        return preg_replace('/\\.[^.\\s]{3,4}$/', '', $filename) . '.mp4';
    }
}
