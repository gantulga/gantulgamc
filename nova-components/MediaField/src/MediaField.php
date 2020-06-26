<?php

namespace Erdenetmc\MediaField;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Contracts\Deletable as DeletableContract;
use Laravel\Nova\Fields\Deletable;

class MediaField extends Field implements DeletableContract
{
    use Deletable;

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'media-field';

    /**
     * Indicates if the element should be shown on the index view.
     *
     * @var bool
     */
    public $showOnIndex = false;

    /**
     * Create a new field.
     *
     * @param  string  $name
     * @param  string|null  $attribute
     * @param  string|null  $resource
     * @return void
     */
    public function __construct($name, $attribute = null, $resource = null)
    {
        parent::__construct($name, $attribute);
        $this->deleteCallback = function($request, $mediable){
            $this->removeMedia($request, $mediable);
        };
    }

    /**
     * Default delete callback
     *
     * @param  NovaRequest $request
     * @param  \Illuminate\Database\Eloquent\Model  $mediable
     * @return \Illuminate\Database\Eloquent\Collection
     *
     */
    protected function removeMedia(NovaRequest $request, $mediable)
    {
        return $mediable->{$this->attribute}()->detach($request->relatedResourceId) ? true : false;
    }

    /**
     * Set the mime type to filter media.
     *
     * @param  string  $mimeType
     * @return $this
     */
    public function mimeType($mimeType)
    {
        return $this->withMeta(['mimeType' => $mimeType]);
    }

    /**
     * Set if field accepts multiple value.
     *
     * @param  boolean  $multi
     * @return $this
     */
    public function multi($multi = true)
    {
        return $this->withMeta(['multi' => $multi]);
    }


    /**
     * Hydrate the given attribute on the model based on the incoming request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  string  $requestAttribute
     * @param  object  $model
     * @param  string  $attribute
     * @return void
     */
    protected function fillAttributeFromRequest(NovaRequest $request, $requestAttribute, $model, $attribute)
    {
        if (! $request[$requestAttribute]) {
            return;
        }

        if(!($this->meta['multi'] ?? false) && count($request[$requestAttribute]) > 1) {
            abort(500, 'Multiple values are not allowed for media field');
        }

        $mediaIds = $request->get($requestAttribute,[]);
        $mediaIds = collect($mediaIds)->reduce(function($carry, $item) use($attribute){
            $carry[$item] = ['collection'=>$attribute];
            return $carry;
        }, []);

        $model->saved(function($model) use ($attribute, $mediaIds){
            $model->{$attribute}()->sync($mediaIds);
        });
    }

    /**
     * Resolve the given attribute from the given resource.
     *
     * @param  mixed  $resource
     * @param  string  $attribute
     * @return mixed
     */
    protected function resolveAttribute($resource, $attribute)
    {
        $media = $resource->{$attribute};

        return $media ?? null;
    }

    /**
     * Get additional meta information to merge with the element payload.
     *
     * @return array
     */
    public function meta()
    {
        return array_merge([
            'diskPath' => \Storage::disk('public')->url('/'),
        ], $this->meta);
    }

    /**
    * Configure storage disk path.
    *
    * @param  string  $path
    * @return $this
    */
   public function diskPath($path)
   {
       return $this->withMeta(['diskPath' => $path]);
   }
}
