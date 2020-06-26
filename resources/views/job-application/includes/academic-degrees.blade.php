<f-table name="academic_degrees" v-model="values.academic_degrees" :errors="errors"
    label="3.2. Эрдмийн цол (дэд профессор, профессор, академийн гишүүний цолыг оролцуулна)"
    >
    <template v-slot:header>
        <th class="border p-2">Цол</th>
        <th class="border p-2">Цол олгосон байгууллага</th>
        <th class="border p-2">Огноо</th>
        <th class="border p-2">Гэрчилгээ, дипломын дугаар</th>
    </template>
    <template v-slot="{row, i}">
        <f-text-field :name="'academic_degrees['+i+'][title]'" v-model="row.title" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'academic_degrees['+i+'][institution]'" v-model="row.institution" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-datetime-field :name="'academic_degrees['+i+'][date]'" v-model="row.date" :label="false"
            :errors="errors" :show-errors="false" :show-help-text="false"></f-datetime-field>
        <f-text-field :name="'academic_degrees['+i+'][certificate_number]'" v-model="row.certificate_number" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
    </template>
</f-table>

