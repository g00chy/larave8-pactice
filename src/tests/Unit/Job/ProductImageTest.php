<?php

namespace Tests\Unit\Job;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Jobs\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductImageTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testGet()
    {
        $job = new ProductImage('https://cdn.qiita.com/assets/qiita-rectangle-71910ff07b744f263e4a2657e2ffd123.png');
        $job->handle();
    }
}
