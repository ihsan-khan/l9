<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Actions\UploadFile;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.index');
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'title' => ['required', 'string'],
            'image' => ['nullable', 'image']
        ]);

        $data['title'] = $request->get('title');

        $blog = new Blog;

        if ($request->file('image')) {
            // $this->settings->deleteImage('data->hero_image');

            $imageName = (new UploadFile)
                ->setFile($request->file('image'))
                ->setUploadPath($blog->uploadFolder())
                ->execute();

            $data['image'] = $imageName;
        }
      
        $blog->create($data);

        return redirect()->back();
    }

}
