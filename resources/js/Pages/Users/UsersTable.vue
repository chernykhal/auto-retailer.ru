<template>
    <div>
        <div class="md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="p-6 sm:px-20 bg-white">
                        <div class="table w-full">
                            <div class="table-row-group">
                                <div v-for="user in users" :key="user.id" class="table-row">
                                    <div class="table-cell px-4 py-2 " title="№">{{ user.id }}</div>
                                    <div class="table-cell px-4 py-2 " title="Имя">{{ user.f_name }}</div>
                                    <div class="table-cell px-4 py-2 " title="Фамилия">{{ user.l_name }}</div>
                                    <div class="table-cell px-4 py-2 " title="Отчество">{{ user.m_name }}</div>
                                    <div class="table-cell px-4 py-2 " title="ИНН">{{ user.inn }}</div>
                                    <div class="table-cell px-4 py-2 " title="Адрес">{{ user.adress }}</div>
                                    <div class="table-cell px-4 py-2 " title="Телефон">{{ user.phone }}</div>
                                    <div class="table-cell px-4 py-2 text-right">
                                        <inertia-link :href="route('users.edit', user)" title="Редактировать"
                                                      class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 bg-white ">
                                            <svg class="w-5 h-5" viewBox="0 0 84 84" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M79.0301 19.4133L65.3335 5.64661C64.4284 4.74609 63.2036 4.24057 61.9268 4.24057C60.65 4.24057 59.4252 4.74609 58.5201 5.64661L9.96347 54.1333L5.53013 73.2666C5.3772 73.966 5.38244 74.6908 5.54548 75.3879C5.70851 76.0851 6.02523 76.737 6.47248 77.2961C6.91973 77.8551 7.48623 78.3072 8.13058 78.6193C8.77493 78.9314 9.48086 79.0956 10.1968 79.0999C10.5304 79.1336 10.8665 79.1336 11.2001 79.0999L30.5435 74.6666L79.0301 26.2266C79.9306 25.3215 80.4362 24.0967 80.4362 22.8199C80.4362 21.5432 79.9306 20.3184 79.0301 19.4133V19.4133ZM28.2101 70.4666L10.0801 74.2699L14.2101 56.4899L50.5401 20.2999L64.5401 34.2999L28.2101 70.4666ZM67.6668 30.9166L53.6668 16.9166L61.7868 8.84327L75.5535 22.8433L67.6668 30.9166Z"
                                                    fill="#6C84FF"/>
                                            </svg>
                                        </inertia-link>
                                        <inertia-link :href="route('users.work-days', user)" title="Учет смен"
                                                      class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150 bg-white ">
                                            <svg class="w-5 h-5 text-gray-400" viewBox="0 0 105 105" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M71.2295 46.8957C71.5351 47.2005 71.7775 47.5626 71.9429 47.9612C72.1083 48.3599 72.1935 48.7872 72.1935 49.2188C72.1935 49.6504 72.1083 50.0778 71.9429 50.4764C71.7775 50.8751 71.5351 51.2371 71.2295 51.5419L51.542 71.2294C51.2372 71.535 50.8751 71.7774 50.4765 71.9429C50.0778 72.1083 49.6505 72.1934 49.2189 72.1934C48.7873 72.1934 48.3599 72.1083 47.9613 71.9429C47.5626 71.7774 47.2005 71.535 46.8957 71.2294L37.052 61.3857C36.7469 61.0806 36.5049 60.7184 36.3398 60.3198C36.1747 59.9212 36.0897 59.494 36.0897 59.0626C36.0897 58.6311 36.1747 58.2039 36.3398 57.8053C36.5049 57.4067 36.7469 57.0445 37.052 56.7394C37.6681 56.1233 38.5038 55.7772 39.3751 55.7772C39.8066 55.7772 40.2338 55.8621 40.6324 56.0273C41.031 56.1924 41.3932 56.4344 41.6982 56.7394L49.2189 64.2666L66.5832 46.8957C66.888 46.5901 67.2501 46.3477 67.6488 46.1823C68.0474 46.0168 68.4748 45.9317 68.9064 45.9317C69.338 45.9317 69.7653 46.0168 70.164 46.1823C70.5626 46.3477 70.9247 46.5901 71.2295 46.8957V46.8957Z" fill="#6C84FF"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6.5625 26.25V91.875C6.5625 93.6155 7.2539 95.2847 8.48461 96.5154C9.71532 97.7461 11.3845 98.4375 13.125 98.4375H91.875C93.6155 98.4375 95.2847 97.7461 96.5154 96.5154C97.7461 95.2847 98.4375 93.6155 98.4375 91.875V26.25H6.5625ZM13.125 6.5625C9.64403 6.5625 6.30564 7.94531 3.84422 10.4067C1.38281 12.8681 0 16.2065 0 19.6875L0 91.875C0 95.356 1.38281 98.6944 3.84422 101.156C6.30564 103.617 9.64403 105 13.125 105H91.875C95.356 105 98.6944 103.617 101.156 101.156C103.617 98.6944 105 95.356 105 91.875V19.6875C105 16.2065 103.617 12.8681 101.156 10.4067C98.6944 7.94531 95.356 6.5625 91.875 6.5625H13.125Z" fill="#6C84FF"/>
                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M22.9688 0C23.839 0 24.6736 0.345702 25.2889 0.961056C25.9043 1.57641 26.25 2.41101 26.25 3.28125V6.5625C26.25 7.43274 25.9043 8.26734 25.2889 8.88269C24.6736 9.49805 23.839 9.84375 22.9688 9.84375C22.0985 9.84375 21.2639 9.49805 20.6486 8.88269C20.0332 8.26734 19.6875 7.43274 19.6875 6.5625V3.28125C19.6875 2.41101 20.0332 1.57641 20.6486 0.961056C21.2639 0.345702 22.0985 0 22.9688 0V0ZM82.0312 0C82.9015 0 83.7361 0.345702 84.3514 0.961056C84.9668 1.57641 85.3125 2.41101 85.3125 3.28125V6.5625C85.3125 7.43274 84.9668 8.26734 84.3514 8.88269C83.7361 9.49805 82.9015 9.84375 82.0312 9.84375C81.161 9.84375 80.3264 9.49805 79.7111 8.88269C79.0957 8.26734 78.75 7.43274 78.75 6.5625V3.28125C78.75 2.41101 79.0957 1.57641 79.7111 0.961056C80.3264 0.345702 81.161 0 82.0312 0V0Z" fill="#6C84FF"/>
                                            </svg>
                                        </inertia-link>
                                        <jet-secondary-button @click.native="confirmUserDeletion(user)"
                                                              title="Удалить" class="bg-white ">
                                            <svg class="w-5 h-5" viewBox="0 0 89 89" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M31.2891 15.9922H30.5938C30.9762 15.9922 31.2891 15.6793 31.2891 15.2969V15.9922H57.7109V15.2969C57.7109 15.6793 58.0238 15.9922 58.4062 15.9922H57.7109V22.25H63.9688V15.2969C63.9688 12.2288 61.4743 9.73438 58.4062 9.73438H30.5938C27.5257 9.73438 25.0312 12.2288 25.0312 15.2969V22.25H31.2891V15.9922ZM75.0938 22.25H13.9062C12.3679 22.25 11.125 23.4929 11.125 25.0312V27.8125C11.125 28.1949 11.4379 28.5078 11.8203 28.5078H17.0699L19.2167 73.9639C19.3558 76.9276 21.8067 79.2656 24.7705 79.2656H64.2295C67.202 79.2656 69.6442 76.9363 69.7833 73.9639L71.9301 28.5078H77.1797C77.5621 28.5078 77.875 28.1949 77.875 27.8125V25.0312C77.875 23.4929 76.6321 22.25 75.0938 22.25ZM63.5603 73.0078H25.4397L23.3364 28.5078H65.6636L63.5603 73.0078Z"
                                                    fill="#FF5454"/>
                                            </svg>
                                        </jet-secondary-button>
                                        <jet-dialog-modal :show="confirmingUserDeletion"
                                                          @close="confirmingUserDeletion = false">
                                            <template #title>
                                                Удаление сотрудника
                                            </template>

                                            <template #content>
                                                Введите пароль, чтобы удалить сотрудника

                                                <div class="mt-4">
                                                    <jet-input type="password" class="mt-1 block w-3/4"
                                                               placeholder="Пароль"
                                                               ref="password"
                                                               v-model="deleteForm.password"
                                                               @keyup.enter.native="deleteUser"/>

                                                    <jet-input-error :message="deleteForm.error('password')"
                                                                     class="mt-2"/>
                                                </div>
                                            </template>

                                            <template #footer>
                                                <jet-secondary-button
                                                    @click.native="confirmingUserDeletion = false">
                                                    Отмена
                                                </jet-secondary-button>

                                                <jet-danger-button class="ml-2" @click.native="deleteUser"
                                                                   :class="{ 'opacity-25': deleteForm.processing }"
                                                                   :disabled="deleteForm.processing">
                                                    Удалить
                                                </jet-danger-button>
                                            </template>
                                        </jet-dialog-modal>
                                    </div>
                                </div>
<!--                                <jet-pagination :links="users.links"></jet-pagination>-->
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
    props: ['users'],
    data() {
        return {
            confirmingUserDeletion: false,
            deleting: false,
            deleteForm: this.$inertia.form({
                '_method': 'DELETE',
                password: '',
            }, {
                bag: 'deleteUser'
            }),
        }
    },
    methods: {
        confirmUserDeletion(user) {
            this.deleteForm.password = '';
            this.user = user;

            this.confirmingUserDeletion = true;

            setTimeout(() => {
                this.$refs.password.focus()
            }, 250)
        },
        deleteUser() {
            this.deleteForm.post(route('users.destroy', this.user), {
                preserveScroll: true
            }).then(response => {
                if (!this.deleteForm.hasErrors()) {
                    this.confirmingUserDeletion = false;
                }
            })
        },
    },
}
</script>
