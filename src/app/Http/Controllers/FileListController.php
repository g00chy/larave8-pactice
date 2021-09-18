<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class FileListController extends Controller
{
    public function index(Request $request) {
        $storage = Collection::wrap(Storage::allFiles('public'));
        $storage = $storage->map(function($item, $key) {
            $replaced = Str::replace('public', 'storage', $item);
            return $replaced;
        });
        return view('filelist.index', [ 'storage' => $storage]);
    }
}
