<?php

namespace App\Nova\Lenses;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Http\Requests\LensRequest;

class CommentsSpam extends Lens
{
     /**
     * Get the displayable name of the lens.
     *
     * @return string
     */
    public function name()
    {
        return 'Спам комментууд';
    }

    /**
     * Get the query builder / paginator for the lens.
     *
     * @param  \Laravel\Nova\Http\Requests\LensRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        if (! $request->orderBy || ! $request->orderByDirection) {
            $query->latest();
        }

        return $request->withOrdering($request->withFilters(
            $query->spam()
        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make(__('Name'), function () {
                return $this->user->name ?? $this->name;
            })
            ->exceptOnForms(),

            Text::make(__('Comment'), 'text')
                ->exceptOnForms(),

            BelongsTo::make(__('Post'), 'post', \App\Nova\Post::class)
                ->searchable(),

            Select::make(__('Status'), 'status')
                ->options(\App\CommentStatus::statuses())
                ->displayUsingLabels(),
        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the lens.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [new \App\Nova\Actions\CommentNotSpam];
    }

    /**
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'comments-spam';
    }



}
