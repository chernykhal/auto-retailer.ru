<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Сотрудники
            </h2>
        </template>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <jet-update-user :user="$page.user">
            </jet-update-user>
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
import JetUsersTable from "./UsersTable";
import AppLayout from "../../Layouts/AppLayout";
import ResponsiveNavLink from "../../Jetstream/ResponsiveNavLink";
import JetUpdateUser from "./UpdateUser";

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
        JetUsersTable,
        JetUpdateUser,
    },
    props: ['user'],
}
</script>
