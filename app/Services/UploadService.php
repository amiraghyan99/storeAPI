<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadService
{

    public $model;

    protected $directory;
    protected $modelDir = 'uploads';

    public function __construct(Model $model)
    {
        $this->model = $model;

        $this->directory = "public/{$this->modelDir}/{$this->model->getTable()}/{$this->model->getKey()}";
    }


    public function store(UploadedFile $image)
    {
        $path = $image->store($this->directory);
        $this->model->images()->create(['path' => $path]);
    }

    public function storeMany(array $images)
    {
        foreach ($images as $image) {
            $this->store($image);
        }
    }

    public function delete($image)
    {
        if(Storage::exists($this->directory)){
            dd('qw');

        }

    }

}
