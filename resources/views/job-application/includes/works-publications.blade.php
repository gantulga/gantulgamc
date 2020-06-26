<f-table name="works_publications" v-model="values.works_publications" :errors="errors"
    help-text="(“Тайлбар” хэсэгт гадаад хэлнээс орчуулсан болон хамтран зохиогчийн тухай тэмдэглэнэ.)"
    >
    <template v-slot:header>
        <th class="border p-2">Бүтээлийн нэр</th>
        <th class="border p-2">Бүтээлийн төрөл</th>
        <th class="border p-2">Бүтээл гаргасан огноо</th>
        <th class="border p-2">Тайлбар</th>
    </template>
    <template v-slot="{row, i}">
        <f-text-field :name="'works_publications['+i+'][name]'" v-model="row.name" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'works_publications['+i+'][type]'" v-model="row.type" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-datetime-field :name="'works_publications['+i+'][date]'" v-model="row.date" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-datetime-field>
        <f-text-field :name="'works_publications['+i+'][description]'" v-model="row.description" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
    </template>
</f-table>



