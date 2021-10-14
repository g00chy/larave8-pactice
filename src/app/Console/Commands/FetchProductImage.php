<?php

namespace App\Console\Commands;

use App\Jobs\ProductImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

// https://qiita.com/naoki0531/items/f9b8545b77c643a3fa44

class FetchProductImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:fetch_product_image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('コマンド実行開始');

        // 非同期実行を明確化するために1分遅延させる
        ProductImage::dispatch('https://cdn.qiita.com/assets/qiita-rectangle-71910ff07b744f263e4a2657e2ffd123.png', 'Qiita.png')
            ->delay(now()->addMinutes(1));

        Log::info('コマンド実行完了');
    }
}
