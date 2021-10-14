<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\File as FileModel;
use App\Jobs\ProductImage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = FileModel::orderBy('id', 'desc')->get();
        $data = $list;
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //s3アップロード開始
        $image = $request->file('file');
        // バケットの`myprefix`フォルダへアップロード
        $file = FileModel::create(['path' => $path]);

        return response()->json(['data' => [
            'id' => $file->id,
            'path' => $path
        ]]);
    }

    public function getUrl(Request $request)
    {
        $url = $request->get('url');
        ProductImage::dispatch($url);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //s3アップロード開始
        $image = $request->file('file');
        // バケットの`myprefix`フォルダへアップロード
        $path = Storage::disk('s3')->putFile('myprefix', $image, 'public');
        $file = FileModel::create(['path' => $path]);

        return response()->json(['data' => [
            'id' => $file->id,
            'path' => $path
        ]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $file = FileModel::find($id);
        $result = Storage::disk('s3')->getAdapter()->getClient()->getObject(['Bucket' => 'my-bucket', 'Key' => $file->path]);

        header("Content-Type: {$file->extension}");
        $filename = 'file';
        header("Content-Disposition: attachment; filename={$filename}");
        print($result['Body']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file = FileModel::find($id);
        $s3_delete = Storage::disk('s3')->delete($file->path);
        $file->delete();
    }
}
