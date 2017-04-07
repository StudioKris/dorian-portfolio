<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoriesController extends Controller
{
    public function getCategoriesIndex()
    {
        $categories = Category::orderBy('position', 'asc')->get();

        return response()->success(compact('categories'));
    }

    public function getCategoriesShow($id)
    {
        $category = Category::find($id);

        $category['assets'] = $category->assets;

        return response()->success($category);
    }

    public function putCategoriesShow(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->input('data.name');
        if ($request->has('data.description')) {
            $category->description = $request->input('data.description');
        }
        if ($request->has('data.position')) {
            if ($request->input('data.position') == '-') {
                $category->position -= 1;
            } elseif ($request->input('data.position') == '+') {
                $category->position += 1;
            } else {
                $category->position = $request->input('data.position');
            }
        }

        $category->assets()->detach();
        if ($request->has('data.assets')) {
            $position = 0;
            foreach ($request->input('data.assets') as $value) {
                $category->assets()->attach([$value['id'] => ['position' => $position]]);
                $position++;
            }
        }
        

        $category->save();

        return response()->success(compact('category'));
    }

    public function postCategories(Request $request)
    {
        $category = new Category;
        $category->name = $request->input('name');
        if ($request->has('description')) {
            $category->description = $request->input('description');
        }
        if ($request->has('position')) {
            $category->position = $request->input('position');
        }
        
        $category->save();

        return response()->success(compact('category'));
    }

    public function deleteCategories($id)
    {
        $category = Category::find($id);

        unlink($category->icon);
        
        $category->delete();

        return response()->success('success');
    }

    public function postIcon(Request $request, $id)
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
            $category = Category::find($id);

            $finalPath = 'assets/categories/'.$category->id;

            if ($file->save($finalPath)) {
                $category->icon = $finalPath;
                $category->save();

                \Flow\Uploader::pruneChunks('./chunks_temp_folder');

                return response()->success(compact('category'));
            } else {
                return response()->error(500);
            }
        } else {
            // This is not a final chunk, continue to upload
        }
        return response()->success('success');
    }
}
