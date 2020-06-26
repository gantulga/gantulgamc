<?php

namespace App\Nova\Metrics;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;
use Tightenco\NovaGoogleAnalytics\PageViewsMetric;

class GAPageViews extends PageViewsMetric
{
    public $name = 'Хуудасны хандалт';
}
