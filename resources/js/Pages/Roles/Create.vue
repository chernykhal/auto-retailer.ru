<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Должности
            </h2>
        </template>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <jet-store-role>
            </jet-store-role>
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
import JetUpdateRole from "./UpdateRole";
import JetStoreRole from "./StoreRole";

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
        JetRolesTable,
        JetUpdateRole,
        JetStoreRole,
    },
}
</script>
