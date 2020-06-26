<f-table name="work_experiences" v-model="values.work_experiences" :errors="errors"
    label="6.1. Ажилласан байдал"
    help-text="(*Байгууллагын нэрийг бүтнээр бичнэ)."
    >
    <template v-slot:header>
        <th class="border p-2">Ажилласан байгууллагын нэр*</th>
        <th class="border p-2">Газар, хэлтэс, алба</th>
        <th class="border p-2">Эрхэлсэн албан тушаал</th>
        <th class="border p-2">Ажилд орсон он, сар (тушаалын дугаар)</th>
        <th class="border p-2">Ажлаас гарсан он, сар (тушаалын дугаар)</th>
    </template>
    <template v-slot="{row, i}">
        <f-text-field :name="'work_experiences['+i+'][employer]'" v-model="row.employer" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'work_experiences['+i+'][department]'" v-model="row.department" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'work_experiences['+i+'][position]'" v-model="row.position" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'work_experiences['+i+'][start_date]'" v-model="row.start_date" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'work_experiences['+i+'][leave_date]'" v-model="row.leave_date" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
    </template>
</f-table>

<f-text-field class="md:w-1/3" :horizontal="false" type="number" :name="'work_experience_for_government'" v-model="values.work_experience_for_government" label="6.2. Нийт улсад ажилласан жил" :errors="errors"></f-text-field>


