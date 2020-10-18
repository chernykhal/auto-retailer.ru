<template>
    <jet-form-section @submitted="updateCustomer">
        <template #title>
            Изменить информацию покупателя
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

    props: ['customer'],

    data() {
        return {
            form: this.$inertia.form({
                '_method': 'PUT',
                inn: this.customer.inn,
                f_name: this.customer.f_name,
                l_name: this.customer.l_name,
                m_name: this.customer.m_name,
                adress: this.customer.adress,
                phone: this.customer.phone,
            }, {
                bag: 'updateCustomer',
                resetOnSuccess: false,
            }),

            photoPreview: null,
        }
    },
    methods: {
        updateCustomer() {
            this.form.put(route('customers.update', this.customer), {
                preserveScroll: true
            })
        },
    },
}
</script>
