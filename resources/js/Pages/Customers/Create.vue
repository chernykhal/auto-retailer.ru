<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Покупатели
            </h2>
        </template>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <jet-store-customer>
            </jet-store-customer>
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
import JetCustomersTable from "../../Pages/Customers/CustomersTable";
import AppLayout from "../../Layouts/AppLayout";
import ResponsiveNavLink from "../../Jetstream/ResponsiveNavLink";
import JetUpdateCustomer from "./UpdateCustomer";
import JetStoreCustomer from "./StoreCustomer";

export default {
    components: {
        ResponsiveNavLink,
        JetSearchSection,
        AppLayout,
        JetActionMessage,
        JetButton,
        JetInput,
        JetLabel,
        JetSecondaryButton,
        JetCustomersTable,
        JetUpdateCustomer,
        JetStoreCustomer,
    },
}
</script>
