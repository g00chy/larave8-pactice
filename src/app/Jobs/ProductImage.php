<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\File as FileModel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Stream\Stream;


// https://qiita.com/naoki0531/items/f9b8545b77c643a3fa44

class ProductImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;

    /**
     * Create a new job instance.
     *
     * @param string $url
     * @param string $fileName
     */
    public function __construct(string $url)
    {
        // 画像URL
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new GuzzleClient([]);
        $res = $client->request('GET', $this->url);

        $path = Storage::disk('s3')->put('myprefix' . DIRECTORY_SEPARATOR . Str::uuid(), $res->getBody(), 'public');
        $file = FileModel::create(['path' => $path]);

        Log::info('キュー実行完了');
    }
}