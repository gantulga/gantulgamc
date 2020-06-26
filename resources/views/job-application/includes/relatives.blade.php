<f-table name="relatives" v-model="values.relatives" :errors="errors"
    label="1.10. Садан төрлийн байдал: (Таны эцэг, эх, төрсөн ах, эгч дүү, өрх тусгаарласан хүүхэд болон таны эхнэр /нөхөр/-ийн эцэг, эхийг оруулна)">
    <template v-slot:header>
        <th class="border p-2">Таны юу болох</th>
        <th class="border p-2">Садан төрлийн хүний эцэг /эх/-ийн болон өөрийн нэр</th>
        <th class="border p-2">Төрсөн огноо</th>
        <th class="border p-2">Төрсөн аймаг, хот, сум, дүүрэг</th>
        <th class="border p-2">Одоо эрхэлж буй ажил</th>
    </template>
    <template v-slot="{row, i}">
        <f-select-field :name="'relatives['+i+'][relation]'" :options="options.relatives" placeholder="Сонгох"
            v-model="row.relation" :errors="errors" :show-errors="false" :show-help-text="false"></f-select-field>
        <f-text-field :name="'relatives['+i+'][name]'" v-model="row.name" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-datetime-field :name="'relatives['+i+'][birthdate]'" v-model="row.birthdate" :label="false"
            :errors="errors" :show-errors="false" :show-help-text="false"></f-datetime-field>
        <f-text-field :name="'relatives['+i+'][birthplace]'" v-model="row.birthplace" :label="false"
            :errors="errors" :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'relatives['+i+'][job]'" v-model="row.job" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
    </template>
</f-table>
