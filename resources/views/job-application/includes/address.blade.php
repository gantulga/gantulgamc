<p class="my-3">1.11. Байнга оршин суугаа хаяг:</p>
<div class="md:flex">
    <f-select-field class="md:w-1/3 md:mr-1" name="address[aimag]" :horizontal="false" :options="options.aimguud" label="Аймаг/хот" v-model="values.address.aimag" :errors="errors"></f-select-field>
    <f-select-field class="md:w-1/3 md:ml-1 md:mr-1" name="address[sum]" :horizontal="false" :options="options.sumuud[values.address.aimag]||[]" label="Сум/дүүрэг" v-model="values.address.sum" :errors="errors"></f-select-field>
    <f-text-field class="md:w-1/3 md:ml-1" name="address[bagh]" :horizontal="false" label="Баг/хороо" v-model="values.address.bagh" :errors="errors"></f-text-field>
</div>
<f-text-field class="md:w-2/3" name="address[address]" :horizontal="true" label="Гэрийн хаяг" v-model="values.address.address" :errors="errors"></f-text-field>
<f-text-field class="md:w-2/3" name="address[housingconditions]" :horizontal="true" label="Орон сууцны нөхцөл" v-model="values.address.housingconditions"  :errors="errors"></f-text-field>
<f-field-wrapper class="md:w-2/3 -mb-4" label="Утасны дугаар" :horizontal="true">
    <div class="flex">
        <f-text-field class="w-1/2 mr-1" name="address[phone]" :horizontal="false" placeholder="Утасны дугаар" v-model="values.address.phone" :errors="errors"></f-text-field>
        <f-text-field class="w-1/2 ml-1" name="address[phone1]" :horizontal="false" placeholder="Утасны дугаар 2" v-model="values.address.phone1" :errors="errors"></f-text-field>
    </div>
</f-field-wrapper>
<f-text-field type="email" class="md:w-2/3  mb-8 md:mb-4" name="address[email]" :horizontal="true" label="Цахим хаяг" v-model="values.address.email" :errors="errors"></f-text-field>
