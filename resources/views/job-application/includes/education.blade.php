<f-table name="education" v-model="values.education" :errors="errors"
    label="2.1. Боловсрол (бүрэн дунд боловсрол, дипломын дээд боловсрол, бакалавр, магистрын зэргийг оролцуулан)"
    help-text="(*Сургуулийн нэрийг бүтэн бичнэ)"
    >
    <template v-slot:header>
        <th class="border p-2">Сургуулийн нэр*</th>
        <th class="border p-2">Элссэн он, сар</th>
        <th class="border p-2">Төгссөн он, сар</th>
        <th class="border p-2">Эзэмшсэн мэргэжил, зэрэг</th>
        <th class="border p-2">Гэрчилгээ, дипломын дугаар</th>
    </template>
    <template v-slot="{row, i}">
        <f-text-field :name="'education['+i+'][school]'" v-model="row.school" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-datetime-field :name="'education['+i+'][enrollddate]'" v-model="row.enrollddate" :label="false"
            :errors="errors" :show-errors="false" :show-help-text="false"></f-datetime-field>
        <f-datetime-field :name="'education['+i+'][graduatedate]'" v-model="row.graduatedate" :label="false"
            :errors="errors" :show-errors="false" :show-help-text="false"></f-datetime-field>
        <f-text-field :name="'education['+i+'][proffession_degree]'" v-model="row.proffession_degree" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'education['+i+'][diploma_number]'" v-model="row.diploma_number" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
    </template>
</f-table>

