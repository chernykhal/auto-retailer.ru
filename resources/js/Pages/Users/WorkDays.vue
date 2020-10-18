<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Сотрудники
            </h2>
        </template>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <jet-form-section @submitted="updateUsersWorkDays">
                <template #title>
                    Изменить учет смен сотрудника
                </template>
                <template #form>
                        <div class="col-6">
                            <label class="md:w-2/3 block" for="1">
                                <input value="1" id="1"
                                       name="1" class="mr-2 leading-tight inline" type="checkbox" v-model="form[1]">
                                <span class="text-sm inline">1</span>
                            </label>
                            <label class="md:w-2/3 block" for="2">
                                <input value="2" id="2"
                                       name="2" class="mr-2 leading-tight" type="checkbox" v-model="form[2]">
                                <span class="text-sm">2</span>
                            </label>
                            <label class="md:w-2/3 block" for="3">
                                <input value="3" id="3"
                                       name="3" class="mr-2 leading-tight" type="checkbox" v-model="form[3]">
                                <span class="text-sm">3</span>
                            </label>
                            <label class="md:w-2/3 block" for="4">
                                <input value="4" id="4"
                                       name="4" class="mr-2 leading-tight" type="checkbox" v-model="form[4]">
                                <span class="text-sm">4</span>
                            </label>
                            <label class="md:w-2/3 block" for="5">
                                <input value="5" id="5"
                                       name="5" class="mr-2 leading-tight" type="checkbox" v-model="form[5]">
                                <span class="text-sm">5</span>
                            </label>
                        </div>
                        <div class="col-6">
                            <label class="md:w-2/3 block" for="6">
                                <input value="6" id="6"
                                       name="6" class="mr-2 leading-tight" type="checkbox" v-model="form[6]">
                                <span class="text-sm">6</span>
                            </label>
                            <label class="md:w-2/3 block" for="7">
                                <input value="7" id="7"
                                       name="7" class="mr-2 leading-tight" type="checkbox" v-model="form[7]">
                                <span class="text-sm">7</span>
                            </label>
                            <label class="md:w-2/3 block" for="8">
                                <input value="8" id="8"
                                       name="8" class="mr-2 leading-tight" type="checkbox" v-model="form[8]">
                                <span class="text-sm">8</span>
                            </label>
                            <label class="md:w-2/3 block" for="9">
                                <input value="9" id="9"
                                       name="9" class="mr-2 leading-tight" type="checkbox" v-model="form[9]">
                                <span class="text-sm">9</span>
                            </label>
                            <label class="md:w-2/3 block" for="10">
                                <input value="10" id="10"
                                       name="10" class="mr-2 leading-tight" type="checkbox" v-model="form[10]">
                                <span class="text-sm">10</span>
                            </label>
                        </div>
                    <div class="col-6">
                        <label class="md:w-2/3 block" for="11">
                            <input value="11" id="11"
                                   name="11" class="mr-2 leading-tight" type="checkbox" v-model="form[11]">
                            <span class="text-sm">11</span>
                        </label>
                        <label class="md:w-2/3 block" for="12">
                            <input value="12" id="12"
                                   name="12" class="mr-2 leading-tight" type="checkbox" v-model="form[12]">
                            <span class="text-sm">12</span>
                        </label>
                        <label class="md:w-2/3 block" for="13">
                            <input value="13" id="13"
                                   name="13" class="mr-2 leading-tight" type="checkbox" v-model="form[13]">
                            <span class="text-sm">13</span>
                        </label>
                        <label class="md:w-2/3 block" for="14">
                            <input value="14" id="14"
                                   name="14" class="mr-2 leading-tight" type="checkbox" v-model="form[14]">
                            <span class="text-sm">14</span>
                        </label>
                        <label class="md:w-2/3 block" for="15">
                            <input value="15" id="15"
                                   name="15" class="mr-2 leading-tight" type="checkbox" v-model="form[15]">
                            <span class="text-sm">15</span>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="md:w-2/3 block" for="16">
                            <input value="16" id="16"
                                   name="16" class="mr-2 leading-tight" type="checkbox" v-model="form[16]">
                            <span class="text-sm">16</span>
                        </label>
                        <label class="md:w-2/3 block" for="17">
                            <input value="17" id="17"
                                   name="17" class="mr-2 leading-tight" type="checkbox" v-model="form[17]">
                            <span class="text-sm">17</span>
                        </label>
                        <label class="md:w-2/3 block" for="18">
                            <input value="18" id="18"
                                   name="18" class="mr-2 leading-tight" type="checkbox" v-model="form[18]">
                            <span class="text-sm">18</span>
                        </label>
                        <label class="md:w-2/3 block" for="19">
                            <input value="19" id="19"
                                   name="19" class="mr-2 leading-tight" type="checkbox" v-model="form[19]">
                            <span class="text-sm">19</span>
                        </label>
                        <label class="md:w-2/3 block" for="20">
                            <input value="20" id="20"
                                   name="20" class="mr-2 leading-tight" type="checkbox" v-model="form[20]">
                            <span class="text-sm">20</span>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="md:w-2/3 block" for="21">
                            <input value="21" id="21"
                                   name="21" class="mr-2 leading-tight" type="checkbox" v-model="form[21]">
                            <span class="text-sm">21</span>
                        </label>
                        <label class="md:w-2/3 block" for="22">
                            <input value="22" id="22"
                                   name="22" class="mr-2 leading-tight" type="checkbox" v-model="form[22]">
                            <span class="text-sm">22</span>
                        </label>
                        <label class="md:w-2/3 block" for="23">
                            <input value="23" id="23"
                                   name="23" class="mr-2 leading-tight" type="checkbox" v-model="form[23]">
                            <span class="text-sm">23</span>
                        </label>
                        <label class="md:w-2/3 block" for="24">
                            <input value="24" id="24"
                                   name="24" class="mr-2 leading-tight" type="checkbox" v-model="form[24]">
                            <span class="text-sm">24</span>
                        </label>
                        <label class="md:w-2/3 block" for="25">
                            <input value="25" id="25"
                                   name="25" class="mr-2 leading-tight" type="checkbox" v-model="form[25]">
                            <span class="text-sm">25</span>
                        </label>
                    </div>
                    <div class="col-6">
                        <label class="md:w-2/3 block" for="26">
                            <input value="26" id="26"
                                   name="26" class="mr-2 leading-tight" type="checkbox" v-model="form[26]">
                            <span class="text-sm">26</span>
                        </label>
                        <label class="md:w-2/3 block" for="27">
                            <input value="27" id="27"
                                   name="27" class="mr-2 leading-tight" type="checkbox" v-model="form[27]">
                            <span class="text-sm">27</span>
                        </label>
                        <label class="md:w-2/3 block" for="28">
                            <input value="28" id="28"
                                   name="28" class="mr-2 leading-tight" type="checkbox" v-model="form[28]">
                            <span class="text-sm">28</span>
                        </label>
                        <label class="md:w-2/3 block" for="29">
                            <input value="29" id="29"
                                   name="29" class="mr-2 leading-tight" type="checkbox" v-model="form[29]">
                            <span class="text-sm">29</span>
                        </label>
                        <label class="md:w-2/3 block" for="30">
                            <input value="30" id="30"
                                   name="30" class="mr-2 leading-tight" type="checkbox" v-model="form[30]">
                            <span class="text-sm">30</span>
                        </label>
                    </div>
                </template>

                <template #actions>
                    <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                        Сохранено.
                    </jet-action-message>

                    <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Сохранить
                    </jet-button>
                </template>
            </jet-form-section>
        </div>
    </app-layout>
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
import AppLayout from "../../Layouts/AppLayout";

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
        AppLayout,
    },

    props: ['user', 'workDays'],

    data() {
        return {
            form: this.$inertia.form({
                1: this.workDays["1"],
                2: this.workDays["2"],
                3: this.workDays["3"],
                4: this.workDays["4"],
                5: this.workDays["5"],
                6: this.workDays["6"],
                7: this.workDays["7"],
                8: this.workDays["8"],
                9: this.workDays["9"],
                10: this.workDays["10"],
                11: this.workDays["11"],
                12: this.workDays["12"],
                13: this.workDays["13"],
                14: this.workDays["14"],
                15: this.workDays["15"],
                16: this.workDays["16"],
                17: this.workDays["17"],
                18: this.workDays["18"],
                19: this.workDays["19"],
                20: this.workDays["20"],
                21: this.workDays["21"],
                22: this.workDays["22"],
                23: this.workDays["23"],
                24: this.workDays["24"],
                25: this.workDays["25"],
                26: this.workDays["26"],
                27: this.workDays["27"],
                28: this.workDays["28"],
                29: this.workDays["29"],
                30: this.workDays["30"],
            }, {
                bag: 'updateUser',
                resetOnSuccess: false,
            }),

            photoPreview: null,
        }
    },
    methods: {
        updateUsersWorkDays() {
            this.form.put(route('users.work-days-store', this.user), {
                preserveScroll: true
            })
        },
    },
}
</script>
