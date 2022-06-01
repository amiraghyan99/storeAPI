<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageService
{

    /**
     * @var Model
     */
    public $model;

    /**
     * @var string
     */
    protected $directory;

    /**
     * @var string
     */
    protected $modelDir = 'images';

    /**
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;

        $this->directory = "public/{$this->modelDir}/{$this->model->getTable()}/{$this->model->getKey()}";
    }

    /**
     * Store one image of model
     *
     * @param UploadedFile $image
     * @return void
     */
    public function store(UploadedFile $image): void
    {
        $path = $image->store($this->directory);
        $this->model->images()->create(['path' => $path]);
    }

    /**
     * Store many images of model
     * @param array $images
     * @return void
     */
    public function storeMany(array $images): void
    {
        foreach ($images as $image) {
            $this->store($image);
        }
    }

    /**
     * Updating all images of model
     *
     * @param array $images
     * @return void
     */
    public function update(array $images): void
    {
        $this->deleteAll();
        $this->storeMany($images);
    }

    /**
     * Deleting all images of model
     *
     * @return void
     */
    public function deleteAll(): void
    {
        if (Storage::exists($this->directory)) {
            Storage::deleteDirectory($this->directory);
        }
        $this->model->images()->delete();

    }

}
