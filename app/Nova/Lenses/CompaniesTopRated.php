<?php

namespace App\Nova\Lenses;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Http\Requests\LensRequest;

use Nikaia\Rating\Rating;

class CompaniesTopRated extends Lens
{
    /**
     * Get the displayable name of the lens.
     *
     * @return string
     */
    public function name()
    {
        return 'Өндөр үнэлгээтэй компаниуд';
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
        return $request->withOrdering($request->withFilters(
            $query->select([
                'companies.id',
                'companies.name',
                \DB::raw('avg(company_reviews.rating) as rating'),
            ])
            ->leftJoin('company_reviews', 'companies.id', '=', 'company_reviews.company_id')
            ->orderBy('rating', 'desc')
            ->groupBy('companies.id', 'companies.name')

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
            ID::make('ID', 'id'), //->sortable(),
            Text::make('Нэр', 'name'), //->sortable(),
            Rating::make('Rating') //->sortable()
                ->min(0)->max(5)->increment(0.5)
                ->withStyles([
                    'star-size' => 15,
                ]),
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
     * Get the URI key for the lens.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'companies-top-rated';
    }
}
