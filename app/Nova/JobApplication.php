<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Panel;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

class JobApplication extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\JobApplication';

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Хүний нөөц';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'firstname';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'regnum', 'firstname', 'lastname', 'email', 'phone'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make(__('Job'), 'job', Job::class)->exceptOnForms(),
            DateTime::make(__('Created At'), 'created_at')->exceptOnForms()->sortable(),
            new Panel(__('Personal information'), [
                Avatar::make(__('Photo'), 'photo'),
                Text::make(__('Registration number'), 'regnum')->sortable(),
                Text::make(__('First name'), 'firstname')->sortable(),
                Text::make(__('Last name'), 'lastname')->sortable(),
                Text::make(__('Birth date'), 'attributes->birthdate')->hideFromIndex(),
                Text::make(__('Nationality'), 'attributes->nationality')->hideFromIndex(),
                Text::make(__('Family Name'), 'attributes->familyname')->hideFromIndex(),
                Text::make(__('Gender'), 'attributes->gender')->hideFromIndex(),
                Text::make(__('Etnicity'), 'attributes->etnicity')->hideFromIndex(),
            ]),
            new Panel(__('Birth place'), [
                Text::make(__('Aimag'), 'attributes->birthplace->aimag')->hideFromIndex(),
                Text::make(__('Sum'), 'attributes->birthplace->sum')->hideFromIndex(),
                Text::make(__('Birth place'), 'attributes->birthplace->place')->hideFromIndex(),
            ]),
            new Panel(__('Permanent address'), [
                Text::make(__('Aimag'), 'attributes->address->aimag')->hideFromIndex(),
                Text::make(__('Sum'), 'attributes->address->sum')->hideFromIndex(),
                Text::make(__('Bagh'), 'attributes->address->bagh')->hideFromIndex(),
                Text::make(__('Address'), 'attributes->address->address')->hideFromIndex(),
                Text::make(__('Housing conditions'), 'attributes->address->housingconditions')->hideFromIndex(),
                Text::make(__('Phone'), 'phone')->sortable(),
                Text::make(__('Phone') . ' 2', 'attributes->address->phone1')->hideFromIndex(),
                Text::make(__('Email'), 'email')->sortable(),
            ]),
            new Panel(__('Emergency contact'), [
                Text::make(__('Name'), 'attributes->emergency_contact->name')->hideFromIndex(),
                Text::make(__('Relation'), 'attributes->emergency_contact->relation')->hideFromIndex(),
                Text::make(__('Phone'), 'attributes->emergency_contact->phone')->hideFromIndex(),
                Text::make(__('Phone') . ' 2', 'attributes->emergency_contact->phone1')->hideFromIndex(),
            ]),

            $this->getTableField(__('Family members information'), 'familymembers', [
                'relation' => 'Юу болох',
                'name' => 'Нэр',
                'birthdate' => 'Төрсөн огноо',
                'birthplace' => 'Төрсөн газар',
                'job' => 'Одоо эрхэлж буй ажил',
            ]),
            $this->getTableField(__('Relatives information'), 'relatives', [
                'relation' => 'Юу болох',
                'name' => 'Нэр',
                'birthdate' => 'Төрсөн огноо',
                'birthplace' => 'Төрсөн газар',
                'job' => 'Одоо эрхэлж буй ажил',
            ]),
            $this->getTableField(__('Education information'), 'education', [
                'school' => 'Сугргууль',
                'enrolldate' => 'Элссэн огноо',
                'graduatedate' => 'Төгссөн огноо',
                'proffession_degree' => 'Эзэмшсэн мэргэжил, зэрэг',
                'diploma_number' => 'Гэрчилгээ, дипломын дугаар',
            ]),
            $this->getTableField(__('Education doctorate'), 'education_doctorate', [
                'degree' => 'Зэрэг',
                'dissertation' => 'Хамгаалсан сэдэв',
                'place' => 'Хамгаалсан газар',
                'date' => 'Огноо',
                'diploma_number' => 'Гэрчилгээ, дипломын дугаар',
            ]),
            $this->getTableField(__('Specialization information'), 'specialization_courses', [
                'place' => 'Хаана, дотоод, гадаадын ямар байгууллагад',
                'date' => 'Эхэлсэн дууссан он, сар, өдөр',
                'duration' => 'Хугацаа /хоногоор/',
                'direction' => 'Ямар чиглэлээр',
                'certificate_number' => 'Үнэмлэх, гэрчилгээний дугаар',
            ]),
            $this->getTableField(__('Academic degrees'), 'academic_degrees', [
                'title' => 'Цол',
                'institution' => 'Цол олгосон байгууллага',
                'date' => 'Огноо',
                'certificate_number' => 'Гэрчилгээ, дипломын дугаар',
            ]),
            $this->getTableField(__('Rewards information'), 'rewards', [
                'date' => 'Шагнагдсан огноо',
                'title' => 'Шагналын нэр',
                'details' => 'Шийдвэрийн нэр, огноо, дугаар',
                'reason' => 'Шагнуулсан үндэслэл',
            ]),
            $this->getTableField(__('Military service'), 'military_services', [
                'certificate_number' => 'Цэргийн үүрэгтний үнэмлэхийн дугаар',
                'service' => 'Цэргийн алба хаасан байдал',
                'description' => 'Тайлбар',
            ]),
            $this->getTableField(__('Work experiences'), 'work_experiences', [
                'employer' => 'Ажилласан байгууллагын нэр',
                'department' => 'Газар, хэлтэс, алба',
                'position' => 'Эрхэлсэн албан тушаал',
                'start_date' => 'Ажилд орсон он, сар (тушаалын дугаар)',
                'leave_date' => 'Ажлаас гарсан он, сар (тушаалын дугаар)',
            ]),
            $this->getTableField(__('Works Publications'), 'works_publications', [
                'name' => 'Бүтээлийн нэр',
                'type' => 'Бүтээлийн төрөл',
                'date' => 'Бүтээл гаргасан огноо',
                'description' => 'Тайлбар',
            ]),

        ];
    }

    /*
    **
    * Get the displayble label of the resource.
    *
    * @return string
    */
    public static function label()
    {
        return 'Анкетууд';
    }

    /**
     * Get the displayble singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return 'Анкет';
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

    private function getItemsAsTableCallback()
    {
        return function ($items) {
            return $this->arrayToHtmlTable($items);
        };
    }

    private function getTableField($label, $attribute, $headers)
    {
        return new Panel($label, [
            Heading::make(
                $this->arrayToHtmlTable($this->attributes[$attribute] ?? [], $headers)
            )->asHtml(),
        ]);
    }

    private function arrayToHtmlTable($data = array(), $headers)
    {
        //return json_encode($data);
        $rows = array();

        foreach ($headers as $key => $header) {
            $cells[] = "<th class=\"border-r\">{$header}</th>";
        }
        $rows[] = "<tr>" . implode('', $cells) . "</tr>";

        foreach ($data as $row) {
            $cells = array();
            foreach ($headers as $key => $header) {
                $cells[] = '<td class="border-r">' . (isset($row[$key]) ? $row[$key] : '') . "</td>";
            }
            $rows[] = "<tr>" . implode('', $cells) . "</tr>";
        }

        return '<div class="bg-white -my-8 -mx-6"><table class="table w-full">' . implode('', $rows) . '</table>';
    }
}
