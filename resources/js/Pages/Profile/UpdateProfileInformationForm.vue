<template>
    <jet-form-section @submitted="updateProfileInformation">
        <template #title>
            Информация пользователя
        </template>

        <template #description>
            Измените свои личные данные
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div class="col-span-6 sm:col-span-4" v-if="$page.jetstream.managesProfilePhotos">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            ref="photo"
                            @change="updatePhotoPreview">

                <jet-label for="photo" value="Photo" />

                <!-- Current Profile Photo -->
                <div class="mt-2" v-show="! photoPreview">
                    <img :src="user.profile_photo_url" alt="Current Profile Photo" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" v-show="photoPreview">
                    <span class="block rounded-full w-20 h-20"
                          :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <jet-secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewPhoto">
                    Select A New Photo
                </jet-secondary-button>

                <jet-secondary-button type="button" class="mt-2" @click.native.prevent="deletePhoto" v-if="user.profile_photo_path">
                    Remove Photo
                </jet-secondary-button>

                <jet-input-error :message="form.error('photo')" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="inn" value="{{ __('ИНН') }}" />
                <x-jet-input id="inn" class="block mt-1 w-full" type="number" name="inn" v-mode="form.inn" :value="old('inn')" autocomplete="none" />
                <jet-input-error :message="form.error('inn')" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="f_name" value="Имя" />
                <jet-input id="f_name" type="text" class="mt-1 block w-full" v-model="form.name" />
                <jet-input-error :message="form.error('f_name')" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="l_name" value="Фамилия" />
                <jet-input id="l_name" type="text" class="mt-1 block w-full" v-model="form.l_name" />
                <jet-input-error :message="form.error('l_name')" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="m_name" value="Отчество" />
                <jet-input id="m_name" type="text" class="mt-1 block w-full" v-model="form.m_name" />
                <jet-input-error :message="form.error('m_name')" class="mt-2" />
            </div>
            <div class="col-span-6 sm:col-span-4">
                <jet-label for="phone" value="Телефон" />
                <jet-input id="phone" type="text" class="mt-1 block w-full" v-model="form.phone" />
                <jet-input-error :message="form.error('phone')" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
    import JetButton from './../../Jetstream/Button'
    import JetFormSection from './../../Jetstream/FormSection'
    import JetInput from './../../Jetstream/Input'
    import JetInputError from './../../Jetstream/InputError'
    import JetLabel from './../../Jetstream/Label'
    import JetActionMessage from './../../Jetstream/ActionMessage'
    import JetSecondaryButton from './../../Jetstream/SecondaryButton'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
        },

        props: ['user'],

        data() {
            return {
                form: this.$inertia.form({
                    '_method': 'PUT',
                    name: this.user.name,
                    email: this.user.email,
                    photo: null,
                }, {
                    bag: 'updateProfileInformation',
                    resetOnSuccess: false,
                }),

                photoPreview: null,
            }
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }

                this.form.post(route('user-profile-information.update'), {
                    preserveScroll: true
                });
            },

            selectNewPhoto() {
                this.$refs.photo.click();
            },

            updatePhotoPreview() {
                const reader = new FileReader();

                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };

                reader.readAsDataURL(this.$refs.photo.files[0]);
            },

            deletePhoto() {
                this.$inertia.delete(route('current-user-photo.destroy'), {
                    preserveScroll: true,
                }).then(() => {
                    this.photoPreview = null
                });
            },
        },
    }
</script>
