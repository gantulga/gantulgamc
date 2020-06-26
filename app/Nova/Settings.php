<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\File;
use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;

class Settings extends Resource
{
    use TabsOnEdit;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Settings';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'key';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'key',
    ];

    /**
     * Indicates if the resource should be globally searchable.
     *
     * @var bool
     */
    public static $globallySearchable = false;

    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $ga_link = '<a href="https://github.com/spatie/laravel-analytics/blob/master/README.md#how-to-obtain-the-credentials-to-communicate-with-google-analytics">https://github.com/spatie/laravel-analytics/blob/master/README.md</a> энд бичигдсэний дагуу Google Analaytics-ийн тохиргоог хийж';

        return [
            (new Tabs('Settings',[
                'Үндсэн тохиргоо'=>[
                    Text::make('Сайтын нэр', 'value->app->name')
                        ->rules('required'),
                    Text::make('Сайтын нэр - en', 'translation->props->locales->en->value->app->name')
                        ->hideFromIndex(),

                    Heading::make('Холбоо барих мэдээлэл'),
                    Textarea::make('Хаяг', 'value->contact->address')
                        ->alwaysShow(),
                    Textarea::make('Хаяг - en', 'translation->props->locales->en->value->contact->address')
                        ->hideFromIndex(),
                    Text::make('Утас', 'value->contact->phone'),
                    Text::make('Email', 'value->contact->email'),

                    Heading::make('Олон нийтийн сүлжээ'),
                    Text::make('Facebook', 'value->contact->facebook'),
                    Text::make('Twitter', 'value->contact->twitter'),
                    Text::make('LinkedIn', 'value->contact->linkedin'),
                ],
                'Google Analytics'=>[
                    Code::make('Google analytics script', 'value->google_analytics->script')
                        ->language('javascript'),

                    File::make('Service account credentials', 'value->google_analytics->service_account_credentials')
                        ->disk('local')
                        ->path('analytics')
                        //->rules('file', 'mimetypes:application/json')
                        ->storeAs(function (Request $request) {
                            //dd($request->{'value->google_analytics_service_account_credentials'});
                            return 'service-account-credentials.json';
                        })
                        ->help($ga_link.' service-account-credentials.json файлыг энд хуулна'),

                    Text::make('Analytics view id', 'value->google_analytics->view_id')
                        ->help('Дээрхи тохиргоог хийгээд ANALYTICS_VIEW_ID -ийг энд оруулна'),
                ],
                'Email-ийн тохиргоо'=> [
                    Heading::make('Системээс илгээгдэх мэйлүүдийн ерөнхий мэдээлэл'),
                    Text::make('Илгээгч мэйл хаяг', 'value->mail->from->address')
                        ->rules('nullable','email')
                        ->help('Системээс илгээгдэх мэйлүүдийг энэ мэйл хаягаас явуулна')
                        ->resolveUsing(function($email){
                            return $email ?? config('mail.from.address');
                        }),
                    Text::make('Илгээгчийн нэр', 'value->mail->from->name')
                        ->help('Системээс илгээгдэх мэйлүүдийг энэ хүний нэрийн өмнөөс явуулна')
                        ->resolveUsing(function($name){
                            return $name ?? config('mail.from.name');
                        }),

                    Heading::make('SMTP серверийн тохиргоо'),
                    Text::make('SMTP host', 'value->mail->host')
                        ->resolveUsing(function($host){
                            return $host ?? config('mail.host');
                        }),
                    Text::make('SMTP port', 'value->mail->port')
                        ->resolveUsing(function($port){
                            return $port ?? config('mail.port');
                        }),
                    Text::make('SMTP username', 'value->mail->username')
                        ->resolveUsing(function($username){
                            return $username ?? config('mail.username');
                        }),
                    Text::make('SMTP password', 'value->mail->password')
                        ->resolveUsing(function($pass){
                            return $pass ?? config('mail.password');
                        }),
                ]

            ]))->withToolbar()->defaultSearch(true)
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Тохиргоо';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Тохиргоо';
    }
}
