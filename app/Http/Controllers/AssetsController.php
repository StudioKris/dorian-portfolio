<?php

namespace App\Http\Controllers;

use App\Asset;
use Flow\Config;
use Illuminate\Http\Request;

use App\Http\Requests;

class AssetsController extends Controller
{
    
    public function getAssetsIndex()
    {
        $assets = Asset::orderBy('id', 'desc')->get();

        return response()->success(compact('assets'));
    }

    public function getAssetsShow($id)
    {
        $asset = Asset::find($id);

        return response()->success($asset);
    }

    public function putAssetsShow(Request $request, $id)
    {
        $asset = Asset::find($id);
        $asset->name = $request->input('data.name');
        if ($request->has('data.description')) {
            $asset->description = $request->input('data.description');
        }
        $asset->save();

        return response()->success(compact('asset'));
    }

    public function postAssets(Request $request)
    {
        $config = new \Flow\Config();
        $config->setTempDir('./chunks_temp_folder');
        $file = new \Flow\File($config);
        $flowRequest = new \Flow\Request();

        if ($request->isMethod('get')) {
            if ($file->checkChunk() == false) {
                return response('', 204);
            }
        } else {
            if ($file->validateChunk()) {
                $file->saveChunk();
            } else {
                // error, invalid chunk upload request, retry
                return response()->error('Invalid chunk', 400);
            }
        }
        if ($file->validateFile()) {
            $name = $flowRequest->getFileName();

            if ($request->has('name')) {
                $name = $request->input('name');
            }

            $asset = new Asset;

            $asset->name = $name;
            $asset->description = $request->input('description');
            $asset->save();

            $finalPath = 'assets/img/'.$asset->id;

            if ($file->save($finalPath)) {
                $asset->path = $finalPath;
                $asset->save();

                \Flow\Uploader::pruneChunks('./chunks_temp_folder');

                return response()->success(compact('asset'));
            } else {
                $asset->delete();
                //return response()->error(500);
            }
        } else {
            // This is not a final chunk, continue to upload
        }
        return response()->success('success');
    }

    public function deleteAssets($id)
    {
        $asset = Asset::find($id);

        unlink($asset->path);

        $asset->delete();
        
        return response()->success('success');
    }
}
