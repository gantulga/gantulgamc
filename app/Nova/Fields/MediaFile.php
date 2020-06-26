<?php

namespace App\Nova\Fields;

use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Http\Request;
use App\Media;

class MediaFile extends File
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'media-file-field';

    /**
     * Indicates if the element should be shown on the index view.
     *
     * @var bool
     */
    public $showOnIndex = true;

    /**
     * The file storage path.
     *
     * @var string
     */
    public $storagePath = '/media';

    /**
     * Set if multiple file upload is allowed.
     *
     * @param  boolean  $multiple
     * @return $this
     */
    public function multiple($multiple = true)
    {
        return $this->withMeta(['multiple' => $multiple]);
    }

    private function isMultiple()
    {
        return $this->meta['multiple'] ?? false;
    }

    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     * @return mixed
     */
    protected function fillAttribute(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if (!is_null($files = $request->file($requestAttribute.':$'))) {
            foreach($files as $file){
                if(!$file->isValid()){
                    return;
                }
            }
        }

        $this->store(function(Request $request, $model) use($requestAttribute, $files){

            if($this->isMultiple()){
                foreach($files ?? [] as $file){
                    $result = $this->storeFileAndGetResult($file, $model);
                    Media::create($result);
                }
            }

            return $this->storeFileAndGetResult($request->{$requestAttribute}, $model);
        });

        return parent::fillAttribute($request, $requestAttribute, $model, $attribute);
    }

    private function storeFileAndGetResult($file, $model) {
        return [
            'file' => $file->store($this->storagePath, $this->disk),
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mime_type' => $file->getMimeType(),
        ];
    }

}
