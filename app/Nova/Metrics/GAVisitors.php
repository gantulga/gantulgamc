<?php

namespace App\Nova\Metrics;

use Illuminate\Http\Request;
use Laravel\Nova\Metrics\Value;
use Tightenco\NovaGoogleAnalytics\VisitorsMetric;

class GAVisitors extends VisitorsMetric
{
    public $name = 'Хандагчид';
}
