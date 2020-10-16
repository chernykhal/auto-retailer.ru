<template>
    <input class="form-input rounded-md shadow-sm" v-mask="'+7(###) ###-####'" :value="value" @input="$emit('input', $event.target.value)" ref="input">
</template>

<script>
import {mask} from 'vue-the-mask'

export default {
    props: ['value','mask'],

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    },
    directives: {mask},
}
</script>

<style scoped>

</style>
