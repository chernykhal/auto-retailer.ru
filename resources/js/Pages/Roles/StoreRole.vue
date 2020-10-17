<template>
    <jet-form-section @submitted="createRole">
        <template #title>
            Создайте новую должность
        </template>
        <template #description>
            Создайте новую должность в вашей компании
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Название"/>
                <jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name"/>
                <jet-input-error :message="form.error('name')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="display_name" value="Отображаемое название"/>
                <jet-input id="display_name" type="text" class="mt-1 block w-full" v-model="form.display_name"/>
                <jet-input-error :message="form.error('display_name')" class="mt-2"/>
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="name" value="Описание"/>
                <jet-input id="description" type="text" class="mt-1 block w-full" v-model="form.description"/>
                <jet-input-error :message="form.error('description')" class="mt-2"/>
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
                name: null,
                display_name: null,
                description: null,
            }, {
                bag: 'storeRole',
                resetOnSuccess: false,
            }),
        }
    },
    methods: {
        createRole() {
            this.form.post(route('roles.store'), {
                preserveScroll: true
            })
        },
    },
}
</script>
