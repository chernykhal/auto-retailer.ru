<template>
    <div>
        <div class="md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="p-6 sm:px-20 bg-white">
                        <div class="table w-full">
                            <div class="table-row-group">
                                <div v-for="car in cars" :key="car.id" class="table-row">
                                    <div class="table-cell px-4 py-2 " title="№">{{ car.id }}</div>
                                    <div class="table-cell px-4 py-2 " title="Регистрационный номер">{{ car.registration_number }}</div>
                                    <div class="table-cell px-4 py-2 " title="Марка">{{ car.brand }}</div>
                                    <div class="table-cell px-4 py-2 " title="Модель">{{ car.model }}</div>
                                    <div class="table-cell px-4 py-2 " title="Год выпуска">{{ car.year }}</div>
                                    <div class="table-cell px-4 py-2 " title="Цена">{{ car.price }}</div>
                                    <div class="table-cell px-4 py-2 text-right">
                                        <inertia-link :href="route('cars.edit', car)" title="Редактировать"
                                                      class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 bg-white ">
                                            <svg class="w-5 h-5" viewBox="0 0 84 84" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M79.0301 19.4133L65.3335 5.64661C64.4284 4.74609 63.2036 4.24057 61.9268 4.24057C60.65 4.24057 59.4252 4.74609 58.5201 5.64661L9.96347 54.1333L5.53013 73.2666C5.3772 73.966 5.38244 74.6908 5.54548 75.3879C5.70851 76.0851 6.02523 76.737 6.47248 77.2961C6.91973 77.8551 7.48623 78.3072 8.13058 78.6193C8.77493 78.9314 9.48086 79.0956 10.1968 79.0999C10.5304 79.1336 10.8665 79.1336 11.2001 79.0999L30.5435 74.6666L79.0301 26.2266C79.9306 25.3215 80.4362 24.0967 80.4362 22.8199C80.4362 21.5432 79.9306 20.3184 79.0301 19.4133V19.4133ZM28.2101 70.4666L10.0801 74.2699L14.2101 56.4899L50.5401 20.2999L64.5401 34.2999L28.2101 70.4666ZM67.6668 30.9166L53.6668 16.9166L61.7868 8.84327L75.5535 22.8433L67.6668 30.9166Z"
                                                    fill="#6C84FF"/>
                                            </svg>
                                        </inertia-link>
                                        <jet-secondary-button @click.native="confirmCarDeletion(car)"
                                                              title="Удалить" class="bg-white ">
                                            <svg class="w-5 h-5" viewBox="0 0 89 89" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M31.2891 15.9922H30.5938C30.9762 15.9922 31.2891 15.6793 31.2891 15.2969V15.9922H57.7109V15.2969C57.7109 15.6793 58.0238 15.9922 58.4062 15.9922H57.7109V22.25H63.9688V15.2969C63.9688 12.2288 61.4743 9.73438 58.4062 9.73438H30.5938C27.5257 9.73438 25.0312 12.2288 25.0312 15.2969V22.25H31.2891V15.9922ZM75.0938 22.25H13.9062C12.3679 22.25 11.125 23.4929 11.125 25.0312V27.8125C11.125 28.1949 11.4379 28.5078 11.8203 28.5078H17.0699L19.2167 73.9639C19.3558 76.9276 21.8067 79.2656 24.7705 79.2656H64.2295C67.202 79.2656 69.6442 76.9363 69.7833 73.9639L71.9301 28.5078H77.1797C77.5621 28.5078 77.875 28.1949 77.875 27.8125V25.0312C77.875 23.4929 76.6321 22.25 75.0938 22.25ZM63.5603 73.0078H25.4397L23.3364 28.5078H65.6636L63.5603 73.0078Z"
                                                    fill="#FF5454"/>
                                            </svg>
                                        </jet-secondary-button>
                                        <jet-dialog-modal :show="confirmingCarDeletion"
                                                          @close="confirmingCarDeletion = false">
                                            <template #title>
                                                Удаление покупателя
                                            </template>

                                            <template #content>
                                                Введите пароль, чтобы удалить покупателя

                                                <div class="mt-4">
                                                    <jet-input type="password" class="mt-1 block w-3/4"
                                                               placeholder="Пароль"
                                                               ref="password"
                                                               v-model="deleteForm.password"
                                                               @keyup.enter.native="deleteCar"/>

                                                    <jet-input-error :message="deleteForm.error('password')"
                                                                     class="mt-2"/>
                                                </div>
                                            </template>

                                            <template #footer>
                                                <jet-secondary-button
                                                    @click.native="confirmingCarDeletion = false">
                                                    Отмена
                                                </jet-secondary-button>

                                                <jet-danger-button class="ml-2" @click.native="deleteCar"
                                                                   :class="{ 'opacity-25': deleteForm.processing }"
                                                                   :disabled="deleteForm.processing">
                                                    Удалить
                                                </jet-danger-button>
                                            </template>
                                        </jet-dialog-modal>
                                    </div>
                                </div>
                                <!--                                <jet-pagination :links="cars.links"></jet-pagination>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
import JetSearchSection from "../../Jetstream/SearchSection";
import JetDialogModal from "../../Jetstream/DialogModal";
import JetDangerButton from "../../Jetstream/DangerButton";
// import JetPagination from "../../Jetstream/Pagination";

export default {
    components: {
        JetSearchSection,
        JetDialogModal,
        JetDangerButton,
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        JetSecondaryButton,
        JetPhoneInput,
        // JetPagination
    },
    props: ['cars'],
    data() {
        return {
            confirmingCarDeletion: false,
            deleting: false,
            deleteForm: this.$inertia.form({
                '_method': 'DELETE',
                password: '',
            }, {
                bag: 'deleteCar'
            }),
        }
    },
    methods: {
        confirmCarDeletion(car) {
            this.deleteForm.password = '';
            this.car = car;

            this.confirmingCarDeletion = true;

            setTimeout(() => {
                this.$refs.password.focus()
            }, 250)
        },
        deleteCar() {
            this.deleteForm.post(route('cars.destroy', this.car), {
                preserveScroll: true
            }).then(response => {
                if (!this.deleteForm.hasErrors()) {
                    this.confirmingCarDeletion = false;
                }
            })
        },
    },
}
</script>
