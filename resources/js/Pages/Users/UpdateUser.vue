<template>
    <jet-form-section @submitted="updateUser">
        <template #title>
            Изменить информацию сотрудника компании
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="inn" value="ИНН"/>
                <jet-input id="inn" type="number" class="mt-1 block w-full" v-model="form.inn"/>
                <jet-input-error :message="form.error('inn')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="f_name" value="Имя"/>
                <jet-input id="f_name" type="text" class="mt-1 block w-full" v-model="form.f_name"/>
                <jet-input-error :message="form.error('f_name')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="l_name" value="Фамилия"/>
                <jet-input id="l_name" type="text" class="mt-1 block w-full" v-model="form.l_name"/>
                <jet-input-error :message="form.error('l_name')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="m_name" value="Отчество"/>
                <jet-input id="m_name" type="text" class="mt-1 block w-full" v-model="form.m_name"/>
                <jet-input-error :message="form.error('m_name')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="employ_date" value="Дата поступления на работу"/>
                <jet-input id="employ_date" type="date" class="mt-1 block w-full" v-model="form.employ_date"/>
                <jet-input-error :message="form.error('employ_date')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="employ_document_date" value="Дата приказа"/>
                <jet-input id="employ_document_date" type="date" class="mt-1 block w-full" v-model="form.employ_document_date"/>
                <jet-input-error :message="form.error('employ_document_date')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="employ_document_number" value="Номер приказа"/>
                <jet-input id="employ_document_number" type="number" class="mt-1 block w-full" v-model="form.employ_document_number"/>
                <jet-input-error :message="form.error('employ_document_number')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="department_id" value="Код подразделения"/>
                <jet-input id="department_id" type="number" class="mt-1 block w-full" v-model="form.department_id"/>
                <jet-input-error :message="form.error('department_id')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="salary" value="Оклад"/>
                <jet-input id="salary" type="number" class="mt-1 block w-full" v-model="form.salary"/>
                <jet-input-error :message="form.error('salary')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="adress" value="Адрес"/>
                <jet-input id="adress" type="text" class="mt-1 block w-full" v-model="form.adress"/>
                <jet-input-error :message="form.error('adress')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="phone" value="Телефон"/>
                <jet-phone-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone"/>
                <jet-input-error :message="form.error('phone')" class="mt-2"/>
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Сохранено.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Сохранить
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
import JetButton from './../../Jetstream/Button'
import JetFormSection from './../../Jetstream/FormSection'
import JetInput from './../../Jetstream/Input'
import JetPhoneInput from './../../Jetstream/PhoneInput'
import JetInputError from './../../Jetstream/InputError'
import JetLabel from './../../Jetstream/Label'
import JetActionMessage from './../../Jetstream/ActionMessage'
import JetSecondaryButton from './../../Jetstream/SecondaryButton'

export default {
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        JetPhoneInput,
    },

    props: ['user'],

    data() {
        return {
            form: this.$inertia.form({
                '_method': 'PUT',
                inn: this.user.inn,
                f_name: this.user.f_name,
                l_name: this.user.l_name,
                m_name: this.user.m_name,
                employ_date: this.user.employ_date,
                employ_document_date: this.user.employ_document_date,
                employ_document_number: this.user.employ_document_number,
                department_id: this.user.department_id,
                salary: this.user.salary,
                adress: this.user.adress,
                phone: this.user.phone,
            }, {
                bag: 'updateUser',
                resetOnSuccess: false,
            }),

            photoPreview: null,
        }
    },
    methods: {
        updateUser() {
            this.form.put(route('users.update', this.user), {
                preserveScroll: true
            })
        },
    },
}
</script>
