<f-table name="education_doctorate" v-model="values.education_doctorate" :errors="errors"
    label="2.2. Боловсролын болон шинжлэх ухааны докторын зэрэг"
    >
    <template v-slot:header>
        <th class="border p-2">Зэрэг</th>
        <th class="border p-2">Хамгаалсан сэдэв</th>
        <th class="border p-2">Хамгаалсан газар</th>
        <th class="border p-2">Он, сар</th>
        <th class="border p-2">Гэрчилгээ, дипломын дугаар</th>
    </template>
    <template v-slot="{row, i}">
        <f-text-field :name="'education_doctorate['+i+'][degree]'" v-model="row.degree" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'education_doctorate['+i+'][dissertation]'" v-model="row.dissertation" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'education_doctorate['+i+'][place]'" v-model="row.place" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-datetime-field :name="'education_doctorate['+i+'][date]'" v-model="row.date" :label="false"
            :errors="errors" :show-errors="false" :show-help-text="false"></f-datetime-field>
        <f-text-field :name="'education_doctorate['+i+'][diploma_number]'" v-model="row.diploma_number" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
    </template>
</f-table>

