<template>
    <div>
        <div class="mt-3 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="bg-white sm:p-6">
                    <div class="sm:px-20 bg-white">
                        <form @submit.prevent="$emit('submitted')" class="w-full">
                            <slot name="form"></slot>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import JetLabel from "./Label";
import JetInput from "./Input";
import JetButton from "./Button";

export default {
    components: {JetButton, JetInput, JetLabel},
}

</script>

<style scoped>

</style>
