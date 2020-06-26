<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;

use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\TabsOnEdit;

class Company extends Resource
{
    use TabsOnEdit;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Company';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Худалдан авалт';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'name_eng', 'reg_num', 'tax_num', 'vat_num'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $disk = 'public';

        $mainFields = [
            ID::make()->sortable(),

            Text::make('Нэр', 'name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Англи нэр', 'name_eng')
                ->sortable()
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Textarea::make('Үндсэн үйл ажиллагааны чиглэл', 'activities')
                ->alwaysShow()
                ->rules('required'),

            Select::make('Аль улсад бүртгэлтэй', 'country')
                ->options(\App\Company::countries())
                ->hideFromIndex()
                ->rules('required')
                ->displayUsingLabels(),

            Select::make('Харьяалал', 'props->hariyalal')
                ->options(\App\Company::hariyalal())
                ->hideFromIndex()
                ->displayUsingLabels(),

            Text::make('УБДугаар', 'reg_num')
                ->sortable()
                ->rules('required', 'max:10'),

            Textarea::make('Албан есны хаяг байршил', 'address')
                ->alwaysShow(),

            Text::make('Байгуулагдсан он', 'est_year')
                ->sortable()
                ->hideFromIndex()
                ->rules('required', 'max:4'),

            Text::make('Татвар төлөгчийн дугаар', 'tax_num')
                ->sortable()
                ->rules('required')
                ->hideFromIndex(),

            Image::make('Татвар төлөгчийн гэрчилгээ', 'props->tax_certificate')
                ->prunable()
                ->rules('file', 'mimes:jpeg,bmp,png,pdf,doc,docx')
                ->creationRules('required')
                ->help('file: .pdf,.doc,.jpg')
                ->hideFromIndex()
                ->store(function (Request $request, $model) use ($disk) {
                    $model->storeFile('props->tax_certificate', $request, $disk);
                })
                ->thumbnail(function () use ($disk) {
                    return fileThumbnailUrl($this->props['tax_certificate'], $disk);
                })
                ->preview(function () use ($disk) {
                    return fileThumbnailUrl($this->props['tax_certificate'], $disk);
                }),


            Text::make('НӨАТ төлөгчийн дугаар', 'vat_num')
                ->sortable()
                ->hideFromIndex(),

            Text::make('Хамтран ажиллах чиглэл', 'props->cooperation_direction')
                ->sortable()
                ->hideFromIndex()
                ->rules('required'),

            Select::make('Үйл ажиллагааны ангилал', 'activity_category')
                ->options(\App\Company::activityCategories())
                ->hideFromIndex()
                ->displayUsingLabels(),

            Select::make('Өмчлөлийн хэлбэр', 'ownership_form')
                ->options(\App\Company::ownershipForms())
                ->hideFromIndex()
                ->displayUsingLabels(),

            Image::make('Аудитийн жилийн эцсийн тайлан', 'props->audit_report')
                ->prunable()
                ->rules('file', 'mimes:jpeg,bmp,png,pdf,doc,docx')
                ->help('file: .pdf,.doc,.jpg')
                ->hideFromIndex()
                ->store(function (Request $request, $model) use ($disk) {
                    $model->storeFile('props->audit_report', $request, $disk);
                })
                ->thumbnail(function () use ($disk) {
                    return fileThumbnailUrl($this->props['audit_report'] ?? null, $disk);
                })
                ->preview(function () use ($disk) {
                    return fileThumbnailUrl($this->props['audit_report'] ?? null, $disk);
                }),

            Number::make('Ажилчдын тоо', 'employee_count')
                ->sortable()
                ->hideFromIndex(),

            Text::make('Албан есны дилер дистрибьютер', 'props->dealer_distributer')
                ->sortable()
                ->hideFromIndex(),

            Textarea::make('Гол томоохон харилцагчид', 'customers')
                ->alwaysShow(),

            DateTime::make('Бүртгэгдсэн огноо', 'created_at')
                ->sortable()
                ->exceptOnForms(),

            ];

        return [

            (new Tabs('Компаний дэлгэрэнгүй', [
                'Үндсэн мэдээлэл' => $mainFields,
                'Захирлын мэдээлэл' => [
                    Image::make('Зураг', 'props->dir_image')
                        ->prunable()
                        ->rules('image')
                        ->creationRules('required')
                        ->hideFromIndex()
                        ->store(function (Request $request, $model) use ($disk) {
                            $model->storeFile('props->dir_image', $request, $disk);
                        }),

                    Text::make('Нэр', 'dir_name')
                        ->hideFromIndex()
                        ->rules('required', 'max:255'),

                    Text::make('Албан тушаал', 'dir_pos')
                        ->hideFromIndex()
                        ->rules('max:255'),

                    Text::make('Гар утасны дугаар', 'dir_mobile')
                        ->hideFromIndex()
                        ->rules('required', 'max:255'),

                    Text::make('Email', 'dir_email')
                        ->hideFromIndex()
                        ->rules('required', 'email', 'max:255'),

                    Text::make('Fax', 'dir_fax')
                        ->hideFromIndex()
                        ->rules('max:255'),
                    ],

                'Харилцах хүний мэдээлэл' => [
                    Image::make('Зураг', 'props->contact_image')
                        ->prunable()
                        ->rules('image')
                        ->creationRules('required')
                        ->hideFromIndex()
                        ->store(function (Request $request, $model) use ($disk) {
                            $model->storeFile('props->contact_image', $request, $disk);
                        }),

                    Text::make('Нэр', 'contact_name')
                        ->hideFromIndex()
                        ->rules('required', 'max:255'),

                    Text::make('Албан тушаал', 'contact_pos')
                        ->hideFromIndex()
                        ->rules('max:255'),

                    Text::make('Гар утасны дугаар', 'contact_mobile')
                        ->hideFromIndex()
                        ->rules('required', 'max:255'),

                    Text::make('Email', 'contact_email')
                        ->hideFromIndex()
                        ->rules('required', 'email', 'max:255'),

                    Text::make('Fax', 'contact_fax')
                        ->hideFromIndex()
                        ->rules('max:255'),
                ],

                'Relations' => [

                ]
            ]))->withToolbar()->defaultSearch(true),

            HasMany::make('Үнэлгээнүүд', 'reviews', CompanyReview::class),


        ];
    }

    /**
     * Get the displayble label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return 'Компаниуд';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Компани'; //__('Post');
    }


    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            new Metrics\NewCompanies,
            new Metrics\CompaniesPerDay,
            new Metrics\CompaniesPerOwnershipForm,
            (new Metrics\CompanyAverageRating)->withIncrement(0.1)->onlyOnDetail(),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Filters\CompanyActivityCategory,
            new Filters\CompanyOwnershipForm,
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [
            new Lenses\CompaniesTopRated,
        ];
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


}
