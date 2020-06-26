<p class="my-3">1.12. Зайлшгүй шаардлагатай үед холбоо барих хүн:</p>
<f-text-field class="md:w-2/3" name="emergency_contact[name]" label="Нэр" v-model="values.emergency_contact.name" :errors="errors"></f-text-field>
<f-text-field class="md:w-2/3" name="emergency_contact[relation]" label="Хэн болох" v-model="values.emergency_contact.relation"  :errors="errors"></f-text-field>
<f-field-wrapper class="md:w-2/3 -mb-4" label="Утасны дугаар" :horizontal="true">
    <div class="flex">
        <f-text-field class="w-1/2 mr-1" name="emergency_contact[phone]" :horizontal="false" placeholder="Утасны дугаар" v-model="values.emergency_contact.phone" :errors="errors"></f-text-field>
        <f-text-field class="w-1/2 ml-1" name="emergency_contact[phone1]" :horizontal="false" placeholder="Утасны дугаар 2" v-model="values.emergency_contact.phone1" :errors="errors"></f-text-field>
    </div>
</f-field-wrapper>

