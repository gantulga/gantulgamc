<?php

namespace Erdenetmc\Wysiwyg;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class WysiwygField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'wysiwyg-field';

    /**
     * Indicates if the element should be shown on the index view.
     *
     * @var bool
     */
    public $showOnIndex = false;

    /**
     * Indicates if the element should be shown on the detail view.
     *
     * @var bool
     */
    public $showOnDetail = false;

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
        if ($request->exists($requestAttribute)) {
            // TODO: end browser-ees form-data yavuulj ene method-iig avch hayah.
            // yagad gevel end browserees JSON.stringify-gaar ali hediin encode hiigdsen string irj bgaa
            // ba model-iin $casts deer dahiad json encode hiigdeh tul 2 dahin encode-logdoj db ruu oroh bolno.
            // Tiimees end irj bgaa json string-iig decode-loj php array bolgovol 1 l udaa model-iin $casts deer encodlogdono
            $model->{$attribute} = json_decode($request[$requestAttribute]);
        }
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

    /**
    * Add custom view blocks.
    *
    * @param  array  $blocks
    * @return $this
    */
    public function customBlockViews($blocks)
    {
        return $this->withMeta(['customBlockViews' => $blocks]);
    }

    /**
    * Add form blocks.
    *
    * @param  array  $blocks
    * @return $this
    */
    public function forms($formNames)
    {
        return $this->withMeta(['forms' => $formNames]);
    }

   /**
    * Configure ckeditor4.
    *
    * @param  array  $config
    * @return $this
    */
    public function ckeditorConfig($config)
    {
        return $this->withMeta(['ckeditorConfig' => $config]);
    }
}
