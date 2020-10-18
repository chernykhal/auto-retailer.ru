<template>
    <jet-form-section @submitted="createContract">
        <template #title>
            Создайте новый контракт
        </template>
        <template #description>
            Добавьте новый контракт в базу данных
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="car_id" value="Автомобиль"/>
                <div class="relative">
                    <select name="car_id"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="car_id" v-model="form.car_id">
                        <option v-for="(car, index) in carsList" :key="car" :value="index">{{ car }}</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
                <jet-input-error :message="form.error('car_id')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                    <jet-label for="date" value="Дата контракта"/>
                    <jet-input id="date" type="date" class="mt-1 block w-full" v-model="form.date"/>
                <jet-input-error :message="form.error('date')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="customer_id" value="Покупатель"/>
                <div class="relative">
                    <select name="customer_id"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="customer_id" v-model="form.customer_id">
                        <option v-for="(customer, index) in customersList" :key="customer" :value="index">{{ customer }}</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                </div>
                <jet-input-error :message="form.error('customer_id')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="user_id" value="Сотрудник"/>
                <div class="relative">
                    <select name="user_id"
                            class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                            id="user_id" v-model="form.user_id">
                        <option v-for="(user, index) in usersList" :key="user" :value="index">{{ user }}</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                        </svg>
                    </div>
                    <jet-input-error :message="form.error('user_id')" class="mt-2"/>
                </div>
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Создано.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Создать
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
    props: ['carsList', 'usersList', 'customersList'],

    data() {
        return {
            form: this.$inertia.form({
                '_method': 'POST',
                car_id: null,
                date: null,
                customer_id: null,
                user_id: null,
            }, {
                bag: 'storeContract',
                resetOnSuccess: false,
            }),
        }
    },
    methods: {
        createContract() {
            this.form.post(route('contracts.store'), {
                preserveScroll: true
            })
        },
    },
}
</script>
