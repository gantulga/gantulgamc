<f-table name="specialization_courses" v-model="values.specialization_courses" :errors="errors"
    label="3.1. Мэргэшлийн бэлтгэл (Мэргэжлээрээ болон бусад чиглэлээр нарийн мэргэшүүлэх багц сургалтад хамрагдсан байдлыг бичнэ)"
    >
    <template v-slot:header>
        <th class="border p-2">Хаана, дотоод, гадаадын ямар байгууллагад</th>
        <th class="border p-2">Эхэлсэн дууссан он, сар, өдөр</th>
        <th class="border p-2">Хугацаа /хоногоор/</th>
        <th class="border p-2">Ямар чиглэлээр</th>
        <th class="border p-2">Үнэмлэх, гэрчилгээний дугаар</th>
    </template>
    <template v-slot="{row, i}">
        <f-text-field :name="'specialization_courses['+i+'][place]'" v-model="row.place" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-datetime-field :name="'specialization_courses['+i+'][date]'" v-model="row.date" :label="false"
            :errors="errors" :show-errors="false" :show-help-text="false"></f-datetime-field>
        <f-text-field type="number" :name="'specialization_courses['+i+'][duration]'" v-model="row.duration" :label="false"
            :errors="errors" :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'specialization_courses['+i+'][direction]'" v-model="row.direction" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
        <f-text-field :name="'specialization_courses['+i+'][certificate_number]'" v-model="row.certificate_number" :label="false" :errors="errors"
            :show-errors="false" :show-help-text="false"></f-text-field>
    </template>
</f-table>

