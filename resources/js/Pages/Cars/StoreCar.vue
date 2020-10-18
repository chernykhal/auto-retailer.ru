<template>
    <jet-form-section @submitted="createCar">
        <template #title>
            Добавьте новую модель автомобиля
        </template>
        <template #description>
            Добавьте новую модель автомобиля в базу
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="registration_number" value="Регистрационный номер"/>
                <jet-input id="registration_number" type="number" class="mt-1 block w-full" v-model="form.registration_number"/>
                <jet-input-error :message="form.error('registration_number')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="brand" value="Марка"/>
                <jet-input id="brand" type="text" class="mt-1 block w-full" v-model="form.brand"/>
                <jet-input-error :message="form.error('brand')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="model" value="Модель"/>
                <jet-input id="model" type="text" class="mt-1 block w-full" v-model="form.model"/>
                <jet-input-error :message="form.error('model')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="year" value="Год выпуска"/>
                <jet-input id="year" type="number" class="mt-1 block w-full" v-model="form.year"/>
                <jet-input-error :message="form.error('year')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="price" value="Цена"/>
                <jet-input id="price" type="number" class="mt-1 block w-full" v-model="form.price"/>
                <jet-input-error :message="form.error('price')" class="mt-2"/>
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

    data() {
        return {
            form: this.$inertia.form({
                '_method': 'POST',
                registration_number: null,
                brand: null,
                model: null,
                year: null,
                price: null,
            }, {
                bag: 'storeCar',
                resetOnSuccess: false,
            }),
        }
    },
    methods: {
        createCar() {
            this.form.post(route('cars.store'), {
                preserveScroll: true
            })
        },
    },
}
</script>
