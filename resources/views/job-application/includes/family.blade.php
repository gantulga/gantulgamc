<f-table name="familymembers" v-model="values.familymembers" :errors="errors"
    label="1.9. Гэр бүлийн байдал: (зөвхөн гэр бүлийн бүртгэлд байгаа хүмүүсийг бичнэ)">
    <template v-slot:header>
        <th class="border p-2">Таны юу болох</th>
        <th class="border p-2">Гэр бүлийн гишүүний эцэг /эх/-ийн болон өөрийн нэр</th>
        <th class="border p-2">Төрсөн огноо</th>
        <th class="border p-2">Төрсөн аймаг, хот, сум, дүүрэг</th>
        <th class="border p-2">Одоо эрхэлж буй ажил</th>
    </template>
    <template v-slot="{row, i}">
        <f-select-field :name="'familymembers['+i+'][relation]'" :options="options.relatives" placeholder="Сонгох"
            v-model="row.relation" :errors="errors" :show-errors="false" :show-help-text="false"></f-select-field>
        <f-text-field :name="'familymembers['+i+'][name]'" v-model="row.name" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-datetime-field :name="'familymembers['+i+'][birthdate]'" v-model="row.birthdate" :label="false"
            :errors="errors" :show-errors="false" :show-help-text="false"></f-datetime-field>
        <f-text-field :name="'familymembers['+i+'][birthplace]'" v-model="row.birthplace" :label="false"
            :errors="errors" :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'familymembers['+i+'][job]'" v-model="row.job" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
    </template>
</f-table>
