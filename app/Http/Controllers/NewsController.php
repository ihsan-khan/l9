<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Actions\UploadFile;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return view('news.index');
    }

    public function store(Request $request)
    {
       
        $request->validate([
            'title' => ['required', 'string'],
            'image' => ['nullable', 'image']
        ]);

        $data['title'] = $request->get('title');

        $news = new News;

        if ($request->file('image')) {
            // $this->settings->deleteImage('data->hero_image');

            $imageName = (new UploadFile)
                ->setFile($request->file('image'))
                ->setUploadPath($news->uploadFolder())
                ->execute();

            $data['image'] = $imageName;
        }
      
        $news->create($data);

        return redirect()->back();
    }

    public function update(Request $request, News $news)
    {
       
        $request->validate([
            'title' => ['required', 'string'],
            'image' => ['nullable', 'image']
        ]);

        $data['title'] = $request->get('title');

        if ($request->file('image')) {
            // $this->settings->deleteImage('data->hero_image');

            $imageName = (new UploadFile)
                ->setFile($request->file('image'))
                ->setUploadPath($news->uploadFolder())
                ->execute();

            $data['image'] = $imageName;
        }
      
        $news->create($data);

        return redirect()->back();
    }
}
