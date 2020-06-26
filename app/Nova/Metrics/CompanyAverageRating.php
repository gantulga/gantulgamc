<?php

namespace App\Nova\Metrics;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Laravel\Nova\Http\Requests\MetricRequest;
use Laravel\Nova\Metrics\Value;

use Qz\RatingCard\RatingCard;

class CompanyAverageRating extends RatingCard
{

    public $name = 'Компаний дундаж рейтинг';

    /**
     * Calculate the value of the metric.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company $company
     * @return mixed
     */
    public function calculate(Request $request, $company=null)
    {
        $query = \App\CompanyReview::class;

        if($company){
            $query = $company->reviews()->getQuery();
            //dd($query->count());
            $result = $query->select(
                DB::raw("avg(rating) as aggRating"),
                DB::raw("count(*) as aggCount")
            )->first();
        }

        return $this->result($result->aggRating)
            ->suffix('(' . $result->aggCount . ' ratings)');
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        //return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'company-average-rating';
    }
}
