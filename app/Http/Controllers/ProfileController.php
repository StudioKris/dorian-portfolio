<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller
{
    public function getProfileShow($id)
    {
        $profile = Profile::find(1);

        return response()->success($profile);
    }

    public function putProfileShow(Request $request)
    {
        $profile = Profile::find(1);
        $profile->name = $request->input('data.name');
        if ($request->has('data.description')) {
            $profile->description = $request->input('data.description');
        }
        $profile->save();

        return response()->success(compact('profile'));
    }

    public function postIcon(Request $request)
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
            $profile = Profile::find(1);

            $finalPath = 'assets/profile/1';

            if ($file->save($finalPath)) {
                $profile->icon = $finalPath;
                $profile->save();

                \Flow\Uploader::pruneChunks('./chunks_temp_folder');

                return response()->success(compact('profile'));
            } else {
                return response()->error(500);
            }
        } else {
            // This is not a final chunk, continue to upload
        }
        return response()->success('success');
    }
}
