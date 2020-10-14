<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mt-4">
                <x-jet-label for="inn" value="{{ __('ИНН') }}" />
                <x-jet-input id="inn" class="block mt-1 w-full" type="number" name="inn" :value="old('inn')" required autofocus autocomplete="none" />
            </div>
            <div class="mt-4">
                <x-jet-label for="f_name" value="{{ __('Имя') }}" />
                <x-jet-input id="f_name" class="block mt-1 w-full" type="text" name="f_name" :value="old('f_name')" required autofocus autocomplete="off" />
            </div>
            <div class="mt-4">
                <x-jet-label for="l_name" value="{{ __('Фамилия') }}" />
                <x-jet-input id="l_name" class="block mt-1 w-full" type="text" name="l_name" :value="old('l_name')" required autofocus autocomplete="none" />
            </div>
            <div class="mt-4">
                <x-jet-label for="m_name" value="{{ __('Отчество') }}" />
                <x-jet-input id="m_name" class="block mt-1 w-full" type="text" name="m_name" :value="old('m_name')" required autofocus autocomplete="none" />
            </div>

            <div class="mt-4">
                <x-jet-label for="phone" value="{{ __('Телефон') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="phone" name="phone" :value="old('phone')" required autocomplete="none" />
            </div>
            <div class="mt-4">
                <x-jet-label for="employ_date" value="{{ __('Дата поступления на работу') }}" />
                <x-jet-input id="employ_date" class="block mt-1 w-full" type="date" name="employ_date" :value="old('employ_date')" autocomplete="none" />
            </div>
            <div class="mt-4">
                <x-jet-label for="employ_document_date" value="{{ __('Дата приказа') }}" />
                <x-jet-input id="employ_document_date" class="block mt-1 w-full" type="date" name="employ_document_date" :value="old('employ_document_date')" autocomplete="none" />
            </div>
            <div class="mt-4">
                <x-jet-label for="employ_document_number" value="{{ __('Номер приказа') }}" />
                <x-jet-input id="employ_document_number" class="block mt-1 w-full" type="number" name="employ_document_number" :value="old('employ_document_number')" autocomplete="none" />
            </div>
            <div class="mt-4">
                <x-jet-label for="department_id" value="{{ __('Код подразделения') }}" />
                <x-jet-input id="department_id" class="block mt-1 w-full" type="number" name="department_id" :value="old('department_id')" autocomplete="none" />
            </div>
            <div class="mt-4">
                <x-jet-label for="salary" value="{{ __('Оклад, руб') }}" />
                <x-jet-input id="salary" class="block mt-1 w-full" type="number" name="salary" :value="old('salary')" autocomplete="none" />
            </div>
            <div class="mt-4">
                <x-jet-label for="adress" value="{{ __('Адрес') }}" />
                <x-jet-input id="adress" class="block mt-1 w-full" type="text" name="adress" :value="old('adress')" autocomplete="none" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Пароль') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Подтвердите пароль') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    {{ __('Зарегистрировать') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
