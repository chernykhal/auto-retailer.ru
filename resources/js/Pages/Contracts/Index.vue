<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Контракты
            </h2>
        </template>
        <div class="max-w-7xl mx-auto lg:px-8">
            <jet-search-section @submitted="search">
                <template #form>
                    <div class="flex items-center py-2">
                        <inertia-link :href="route('contracts.create')" title="Создать" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 bg-white ">
                            <svg class="w-5 h-5" viewBox="0 0 90 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M45 7.5C37.5832 7.5 30.333 9.69934 24.1661 13.8199C17.9993 17.9404 13.1928 23.7971 10.3545 30.6494C7.51625 37.5016 6.77362 45.0416 8.22057 52.3159C9.66751 59.5902 13.239 66.272 18.4835 71.5165C23.728 76.761 30.4098 80.3325 37.6841 81.7795C44.9584 83.2264 52.4984 82.4838 59.3506 79.6455C66.2029 76.8072 72.0596 72.0007 76.1801 65.8339C80.3007 59.667 82.5 52.4168 82.5 45C82.5 40.0754 81.5301 35.1991 79.6455 30.6494C77.7609 26.0997 74.9987 21.9657 71.5165 18.4835C68.0343 15.0013 63.9004 12.2391 59.3506 10.3545C54.8009 8.46997 49.9246 7.5 45 7.5V7.5ZM45 75C39.0666 75 33.2664 73.2405 28.3329 69.9441C23.3994 66.6476 19.5543 61.9623 17.2836 56.4805C15.013 50.9987 14.4189 44.9667 15.5765 39.1473C16.734 33.3279 19.5912 27.9824 23.7868 23.7868C27.9824 19.5912 33.3279 16.734 39.1473 15.5764C44.9667 14.4189 50.9987 15.013 56.4805 17.2836C61.9623 19.5542 66.6477 23.3994 69.9441 28.3329C73.2405 33.2664 75 39.0666 75 45C75 52.9565 71.8393 60.5871 66.2132 66.2132C60.5871 71.8393 52.9565 75 45 75V75Z" fill="#52FF00"/>
                                <path d="M56.25 41.25H48.75V33.75C48.75 32.7554 48.3549 31.8016 47.6516 31.0984C46.9484 30.3951 45.9946 30 45 30C44.0054 30 43.0516 30.3951 42.3484 31.0984C41.6451 31.8016 41.25 32.7554 41.25 33.75V41.25H33.75C32.7554 41.25 31.8016 41.6451 31.0984 42.3484C30.3951 43.0516 30 44.0054 30 45C30 45.9946 30.3951 46.9484 31.0984 47.6516C31.8016 48.3549 32.7554 48.75 33.75 48.75H41.25V56.25C41.25 57.2446 41.6451 58.1984 42.3484 58.9016C43.0516 59.6049 44.0054 60 45 60C45.9946 60 46.9484 59.6049 47.6516 58.9016C48.3549 58.1984 48.75 57.2446 48.75 56.25V48.75H56.25C57.2446 48.75 58.1984 48.3549 58.9016 47.6516C59.6049 46.9484 60 45.9946 60 45C60 44.0054 59.6049 43.0516 58.9016 42.3484C58.1984 41.6451 57.2446 41.25 56.25 41.25Z" fill="#52FF00"/>
                            </svg>

                        </inertia-link>
                        <input id="search" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Поиск" aria-label="Поиск" v-model="form.search"/>
                        <jet-button class="flex-shrink-0 bg-indigo-700 hover:bg-indigo-700 border-indigo-500 hover:border-indigo-700 text-sm border-4 text-white py-1 px-2 rounded" type="search">
                            Искать
                        </jet-button>

                        <inertia-link class="flex-shrink-0 border-transparent border-4 text-teal-500 hover:text-teal-800 text-sm py-1 px-2 rounded" :href="route('contracts.index')" title="Сбросить">
                            <svg class="w-5 h-5" viewBox="0 0 97 97" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M52.1351 48.4854L79.4309 21.163C79.9125 20.679 80.1826 20.024 80.1822 19.3413C80.1817 18.6586 79.9107 18.0039 79.4285 17.5206C78.4634 16.5603 76.7634 16.5555 75.7886 17.5255L48.5001 44.8479L21.2018 17.5182C20.2318 16.5603 18.5319 16.5652 17.5668 17.523C17.3272 17.7616 17.1376 18.0456 17.0089 18.3582C16.8803 18.6709 16.8152 19.0061 16.8174 19.3442C16.8174 20.0329 17.0842 20.678 17.5668 21.1557L44.8626 48.483L17.5692 75.8128C17.0875 76.2974 16.8178 76.9534 16.8192 77.6367C16.8206 78.3199 17.0929 78.9748 17.5765 79.4575C18.0445 79.9207 18.7065 80.1875 19.3904 80.1875H19.4049C20.0912 80.185 20.7532 79.9159 21.2115 79.4478L48.5001 52.1254L75.7983 79.4551C76.2809 79.9353 76.9259 80.202 77.6098 80.202C77.9479 80.203 78.2829 80.1371 78.5955 80.0081C78.9081 79.8791 79.1921 79.6897 79.4312 79.4506C79.6703 79.2114 79.8598 78.9274 79.9888 78.6148C80.1178 78.3022 80.1836 77.9672 80.1827 77.6291C80.1827 76.9428 79.9159 76.2953 79.4309 75.8176L52.1351 48.4854Z" fill="black" fill-opacity="0.5"/>
                            </svg>
                        </inertia-link>
                    </div>
                </template>
            </jet-search-section>
        </div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <jet-contracts-table :contracts="$page.contracts"/>
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
import JetContractsTable from "../../Pages/Contracts/ContractsTable";
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
        JetContractsTable,
    },
    props: {
        contracts: Array,
    },
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
            this.$inertia.visit(route('contracts.index'), {
                data: {
                    search: this.form.search,
                },
            });
        },
    },
}
</script>
