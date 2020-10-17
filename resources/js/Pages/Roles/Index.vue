<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Должности
            </h2>
        </template>
        <div class="max-w-7xl mx-auto lg:px-8">
            <jet-search-section @submitted="search">
                <template #form>
                    <div class="flex items-center py-2">
                        <input id="search" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Поиск" aria-label="Поиск" v-model="form.search"/>
                        <jet-button class="flex-shrink-0 bg-indigo-700 hover:bg-indigo-700 border-indigo-500 hover:border-indigo-700 text-sm border-4 text-white py-1 px-2 rounded" type="search">
                            Искать
                        </jet-button>

                        <inertia-link class="flex-shrink-0 border-transparent border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded" :href="route('roles.index')" title="Сбросить">
                            <svg class="w-5 h-5" viewBox="0 0 97 97" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M52.1351 48.4854L79.4309 21.163C79.9125 20.679 80.1826 20.024 80.1822 19.3413C80.1817 18.6586 79.9107 18.0039 79.4285 17.5206C78.4634 16.5603 76.7634 16.5555 75.7886 17.5255L48.5001 44.8479L21.2018 17.5182C20.2318 16.5603 18.5319 16.5652 17.5668 17.523C17.3272 17.7616 17.1376 18.0456 17.0089 18.3582C16.8803 18.6709 16.8152 19.0061 16.8174 19.3442C16.8174 20.0329 17.0842 20.678 17.5668 21.1557L44.8626 48.483L17.5692 75.8128C17.0875 76.2974 16.8178 76.9534 16.8192 77.6367C16.8206 78.3199 17.0929 78.9748 17.5765 79.4575C18.0445 79.9207 18.7065 80.1875 19.3904 80.1875H19.4049C20.0912 80.185 20.7532 79.9159 21.2115 79.4478L48.5001 52.1254L75.7983 79.4551C76.2809 79.9353 76.9259 80.202 77.6098 80.202C77.9479 80.203 78.2829 80.1371 78.5955 80.0081C78.9081 79.8791 79.1921 79.6897 79.4312 79.4506C79.6703 79.2114 79.8598 78.9274 79.9888 78.6148C80.1178 78.3022 80.1836 77.9672 80.1827 77.6291C80.1827 76.9428 79.9159 76.2953 79.4309 75.8176L52.1351 48.4854Z" fill="black" fill-opacity="0.5"/>
                            </svg>
                        </inertia-link>
                    </div>
                </template>
            </jet-search-section>
        </div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <jet-roles-table :roles="$page.roles"/>
        </div>
    </app-layout>
</template>

<script>
import JetButton from './../../Jetstream/Button'
import JetInput from './../../Jetstream/Input'
import JetLabel from './../../Jetstream/Label'
import JetActionMessage from './../../Jetstream/ActionMessage'
import JetSecondaryButton from './../../Jetstream/SecondaryButton'
import JetSearchSection from './../../Jetstream/SearchSection'
import JetRolesTable from "../../Pages/Roles/RolesTable";
import AppLayout from "../../Layouts/AppLayout";
import ResponsiveNavLink from "../../Jetstream/ResponsiveNavLink";
import JetDialogModal from "../../Jetstream/DialogModal";
import JetDangerButton from "../../Jetstream/DangerButton";
import JetInputError from "../../Jetstream/InputError";

export default {
    components: {
        ResponsiveNavLink,
        JetDialogModal,
        JetSearchSection,
        AppLayout,
        JetActionMessage,
        JetInputError,
        JetDangerButton,
        JetButton,
        JetInput,
        JetLabel,
        JetSecondaryButton,
        JetRolesTable,
    },
    props: ['roles'],
    data() {
        return {
            form: this.$inertia.form({
                '_method': 'GET',
                search: null,
            }, {
                bag: 'updateProfileInformation',
                resetOnSuccess: false,
            }),
        }
    },
    methods: {
        search() {
            this.$inertia.visit(route('roles.index'), {
                data: {
                    search: this.form.search,
                },
            });
        },
    },
}
</script>
