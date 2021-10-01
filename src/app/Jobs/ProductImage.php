<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

// https://qiita.com/naoki0531/items/f9b8545b77c643a3fa44

class ProductImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;

    private $fileName;

    /**
     * Create a new job instance.
     *
     * @param string $url
     * @param string $fileName
     */
    public function __construct(string $url, string $fileName)
    {
        // 画像URL
        $this->url = $url;

        // 画像名
        $this->fileName = $fileName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // storage直下へファイルを保存
        file_put_contents("./storage/$this->fileName", file_get_contents($this->url));
        Log::info('キュー実行完了');
    }
}
