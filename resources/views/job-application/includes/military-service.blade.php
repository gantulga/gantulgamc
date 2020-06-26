<f-radio-field name="military_service" :options="options.yesno" label="4.1. Цэргийн алба хаасан эсэх" v-model="values.military_service" :errors="errors"></f-radio-field>

<f-table v-if="values.military_service=='yes'" name="military_services" v-model="values.military_services" :errors="errors"
    >
    <template v-slot:header>
        <th class="border p-2 w-32">Цэргийн үүрэгтний үнэмлэхийн дугаар</th>
        <th class="border p-2">Цэргийн алба хаасан байдал</th>
        <th class="border p-2">Тайлбар</th>
    </template>
    <template v-slot="{row, i}">
        <f-text-field :name="'military_services['+i+'][certificate_number]'" v-model="row.certificate_number" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'military_services['+i+'][service]'" v-model="row.service" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'military_services['+i+'][description]'" v-model="row.description" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
    </template>
</f-table>

