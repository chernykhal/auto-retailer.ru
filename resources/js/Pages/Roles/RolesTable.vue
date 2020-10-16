<template>
    <div>
        <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
            <div class="col-span-6 sm:col-span-1">
                <jet-label for="search" value="Поиск" />
                <jet-input id="search" type="text" class="mt-1 block w-full"  />
            </div>
        </div>
        <div v-for="role in roles" :key="role.id">
            <div>{{ role.name }}</div>
            <div>{{ role.id }}</div>
        </div>
    </div>

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
                '_method': 'GET',
                search: this.search,
            }, {
                bag: 'search',
                resetOnSuccess: false,
            }),

            photoPreview: null,
        }
    },
    props: {
        roles: Array,
    },
    methods: {},
}
</script>
