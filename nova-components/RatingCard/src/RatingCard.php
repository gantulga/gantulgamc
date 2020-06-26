<?php

namespace Qz\RatingCard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Laravel\Nova\Card;
use Laravel\Nova\Metrics\Metric;

class RatingCard extends Metric
{
    /**
     * The width of the card (1/3, 1/2, or full).
     *
     * @var string
     */
    public $width = '1/3';

    /**
     * @var int
     */
    public $max;

    /**
     * @var float
     */
    public $increment;

    /**
     * @var string
     */
    public $column = 'rating';

    /**
     * @var string|Builder
     */
    public $model;

    public function withMax(int $max)
    {
        $this->max = $max;
        return $this->withMeta(['max' => $max]);
    }

    public function withIncrement(float $increment)
    {
        $this->increment = $increment;
        return $this->withMeta(['increment' => $increment]);
    }

    /**
     * Get the component name for the element.
     *
     * @return string
     */
    public function component()
    {
        return 'rating-card';
    }

    public function uriKey()
    {
        return 'rating-average';
    }

    /**
     * Return a rating result showing the segments of an average aggregate.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder|string  $model
     * @param  string|null  $column
     * @param  string  $groupBy
     * @return \Qz\RatingCard\RatingResult
     */
    protected function average($request, $model, $column)
    {
        return $this->aggregate($request, $model, 'avg', $column);
    }


    /**
     * Return a rating result showing a aggregate over time.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Database\Eloquent\Builder|string  $model
     * @param  string  $function
     * @param  string  $column
     * @param  string  $groupBy
     * @return \Qz\RatingCard\RatingResult
     */
    protected function aggregate($request, $model, $function, $column)
    {
        $query = $model instanceof Builder ? $model : (new $model)->newQuery();

        $wrappedColumn = $query->getQuery()->getGrammar()->wrap(
            $column = $column ?? $query->getModel()->getQualifiedKeyName()
        );

        $result = $query->select(
            DB::raw("{$function}({$wrappedColumn}) as aggregate")
        )->first();

        return $this->result($result->aggregate);
    }

    /**
     * Create a new rating metric result.
     *
     * @param  mixed  $value
     * @return \Qz\RatingCard\RatingResult
     */
    public function result($value)
    {
        return new RatingResult($value);
    }
}
