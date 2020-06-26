<f-table name="rewards" v-model="values.rewards" :errors="errors"
    label="(Төрийн дээд шагнал, Засгийн газрын шагнал болон салбарын бусад шагналыг бичнэ)"
    >
    <template v-slot:header>
        <th class="border p-2">Шагнагдсан огноо</th>
        <th class="border p-2">Шагналын нэр</th>
        <th class="border p-2">Шийдвэрийн нэр, огноо, дугаар</th>
        <th class="border p-2">Шагнуулсан үндэслэл</th>
    </template>
    <template v-slot="{row, i}">
        <f-datetime-field :name="'rewards['+i+'][date]'" v-model="row.date" :label="false"
            :errors="errors" :show-errors="false" :show-help-text="false"></f-datetime-field>
        <f-text-field :name="'rewards['+i+'][title]'" v-model="row.title" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'rewards['+i+'][details]'" v-model="row.details" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'rewards['+i+'][reason]'" v-model="row.reason" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
    </template>
</f-table>

