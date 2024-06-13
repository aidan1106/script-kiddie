<x-guest-layout>
    <form id="register-form" method="POST" action="{{ route('register') }}" novalidate>
        @csrf

        <!-- Name -->
        <div class="field-container">
            <x-input-label for="name" :value="__('Naam')" />
            <div class="relative">
                <x-text-input id="name" class="block mt-1 w-full pr-10" type="text" name="name" :value="old('name')" autofocus autocomplete="name" required />
                <i class="fa fa-exclamation error-icon hidden absolute top-1/2 transform -translate-y-1/2 right-2" id="name-error-icon" aria-hidden="true"></i>
            </div>
            <p id="name-error" class="hidden text-red-600 mt-2">Vul een naam in.</p>
            @error('name')
            <div class="text-red-600 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mt-4 field-container">
            <x-input-label for="email" :value="__('Email')" />
            <div class="relative">
                <x-text-input id="email" class="block mt-1 w-full pr-10" type="email" name="email" :value="old('email')" autocomplete="email" placeholder="voorbeeld@voorbeeld.com" required />
                <i class="fa fa-exclamation error-icon hidden absolute top-1/2 transform -translate-y-1/2 right-2" id="email-error-icon" aria-hidden="true"></i>
            </div>
            <p id="email-error" class="hidden text-red-600 mt-2"></p>
            @error('email')
            <div class="text-red-600 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4 field-container">
            <x-input-label for="password" :value="__('Wachtwoord')" />
            <div class="relative">
                <x-text-input id="password" class="block mt-1 w-full pr-10" type="password" name="password" autocomplete="new-password" required />
                <i class="fa fa-exclamation error-icon hidden absolute top-1/2 transform -translate-y-1/2 right-2" id="password-error-icon" aria-hidden="true"></i>
            </div>
            <p id="password-error" class="hidden text-red-600 mt-2">Vul een wachtwoord in.</p>

            <div id="password-requirements" class="mt-2 text-sm text-red-600 dark:text-red-600 hidden">
                <p id="length">{{ __('Minimaal 10 tekens') }}</p>
                <p id="uppercase">{{ __('Minstens één hoofdletter') }}</p>
                <p id="lowercase">{{ __('Minstens één kleine letter') }}</p>
                <p id="digit">{{ __('Minstens één cijfer') }}</p>
                <p id="special">{{ __('Minstens één speciaal teken') }}</p>
            </div>
            <div id="password-strength" class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                <p id="strength"></p>
                <div class="strength-meter">
                    <div id="strength-meter-fill" class="strength-meter-fill"></div>
                </div>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 field-container">
            <x-input-label for="password_confirmation" :value="__('Bevestig wachtwoord')" />
            <div class="relative">
                <x-text-input id="password_confirmation" class="block mt-1 w-full pr-10" type="password" name="password_confirmation" autocomplete="new-password" required />
                <i class="fa fa-exclamation error-icon hidden absolute top-1/2 transform -translate-y-1/2 right-2" id="password-confirmation-error-icon" aria-hidden="true"></i>
            </div>
            <p id="password-confirmation-error" class="hidden text-red-600 mt-2">Bevestig uw wachtwoord.</p>
            @error('password_confirmation')
            <div class="text-red-500 mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4" id="register-button">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Script voor formuliervalidatie -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('register-form');
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const passwordConfirmationInput = document.getElementById('password_confirmation');

            const nameError = document.getElementById('name-error');
            const emailError = document.getElementById('email-error');
            const passwordError = document.getElementById('password-error');
            const passwordConfirmationError = document.getElementById('password-confirmation-error');

            const nameErrorIcon = document.getElementById('name-error-icon');
            const emailErrorIcon = document.getElementById('email-error-icon');
            const passwordErrorIcon = document.getElementById('password-error-icon');
            const passwordConfirmationErrorIcon = document.getElementById('password-confirmation-error-icon');

            const lengthRequirement = document.getElementById('length');
            const uppercaseRequirement = document.getElementById('uppercase');
            const lowercaseRequirement = document.getElementById('lowercase');
            const digitRequirement = document.getElementById('digit');
            const specialRequirement = document.getElementById('special');
            const passwordStrength = document.getElementById('strength');
            const strengthMeterFill = document.getElementById('strength-meter-fill');
            const passwordRequirements = document.getElementById('password-requirements');

            function showError(input, errorElement, errorIcon, message) {
                input.classList.add('border-red-500');
                errorElement.textContent = message;
                errorElement.classList.remove('hidden');
                errorIcon.classList.add('text-red-500');
                errorIcon.classList.remove('hidden');
            }

            function hideError(input, errorElement, errorIcon) {
                input.classList.remove('border-red-500');
                errorElement.classList.add('hidden');
                errorIcon.classList.add('hidden');
            }

            form.addEventListener('submit', function (event) {
                let isValid = true;

                if (!nameInput.value.trim()) {
                    showError(nameInput, nameError, nameErrorIcon, 'Vul een naam in.');
                    isValid = false;
                } else {
                    hideError(nameInput, nameError, nameErrorIcon);
                }

                if (!emailInput.value.trim()) {
                    showError(emailInput, emailError, emailErrorIcon, 'Vul een e-mailadres in.');
                    isValid = false;
                } else if (!/@/.test(emailInput.value)) {
                    showError(emailInput, emailError, emailErrorIcon, 'Een e-mailadres moet een enkele @ bevatten.');
                    isValid = false;
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value)) {
                    showError(emailInput, emailError, emailErrorIcon, 'Het domeingedeelte van het e-mailadres is ongeldig (het gedeelte na de @: ).');
                    isValid = false;
                } else {
                    hideError(emailInput, emailError, emailErrorIcon);
                }

                if (!passwordInput.value.trim()) {
                    showError(passwordInput, passwordError, passwordErrorIcon, 'Vul een wachtwoord in.');
                    isValid = false;
                } else {
                    // Specific password validation
                    const passwordValue = passwordInput.value;
                    let passwordValid = true;
                    if (passwordValue.length < 10) {
                        showError(passwordInput, passwordError, passwordErrorIcon, 'Wachtwoord voldoet niet aan alle eisen.');
                        passwordValid = false;
                    } else if (!/[A-Z]/.test(passwordValue)) {
                        showError(passwordInput, passwordError, passwordErrorIcon, 'Wachtwoord voldoet niet aan alle eisen.');
                        passwordValid = false;
                    } else if (!/[a-z]/.test(passwordValue)) {
                        showError(passwordInput, passwordError, passwordErrorIcon, 'Wachtwoord voldoet niet aan alle eisen.');
                        passwordValid = false;
                    } else if (!/\d/.test(passwordValue)) {
                        showError(passwordInput, passwordError, passwordErrorIcon, 'Wachtwoord voldoet niet aan alle eisen.');
                        passwordValid =
                            passwordValid = false;
                    } else if (!/[!@#$%^&*(),.?":{}|<>]/.test(passwordValue)) {
                        showError(passwordInput, passwordError, passwordErrorIcon, 'Wachtwoord voldoet niet aan alle eisen.');
                        passwordValid = false;
                    } else {
                        hideError(passwordInput, passwordError, passwordErrorIcon);
                    }

                    if (!passwordValid) {
                        isValid = false;
                    }
                }

                if (!passwordConfirmationInput.value.trim()) {
                    showError(passwordConfirmationInput, passwordConfirmationError, passwordConfirmationErrorIcon, 'Bevestig uw wachtwoord.');
                    isValid = false;
                } else if (passwordInput.value !== passwordConfirmationInput.value) {
                    showError(passwordConfirmationInput, passwordConfirmationError, passwordConfirmationErrorIcon, 'Wachtwoorden komen niet overeen.');
                    isValid = false;
                } else {
                    hideError(passwordConfirmationInput, passwordConfirmationError, passwordConfirmationErrorIcon);
                }

                if (!isValid) {
                    event.preventDefault();
                }
            });

            passwordInput.addEventListener('focus', function () {
                passwordRequirements.classList.remove('hidden');
            });

            passwordInput.addEventListener('blur', function () {
                if (!passwordInput.value) {
                    passwordRequirements.classList.add('hidden');
                }
            });

            passwordInput.addEventListener('input', function () {
                const value = passwordInput.value;
                let metRequirements = 0;

                // Length requirement
                if (value.length >= 10) {
                    lengthRequirement.classList.add('hidden');
                    metRequirements++;
                } else {
                    lengthRequirement.classList.remove('hidden');
                }

                // Uppercase letter requirement
                if (/[A-Z]/.test(value)) {
                    uppercaseRequirement.classList.add('hidden');
                    metRequirements++;
                } else {
                    uppercaseRequirement.classList.remove('hidden');
                }

                // Lowercase letter requirement
                if (/[a-z]/.test(value)) {
                    lowercaseRequirement.classList.add('hidden');
                    metRequirements++;
                } else {
                    lowercaseRequirement.classList.remove('hidden');
                }

                // Digit requirement
                if (/\d/.test(value)) {
                    digitRequirement.classList.add('hidden');
                    metRequirements++;
                } else {
                    digitRequirement.classList.remove('hidden');
                }

                // Special character requirement
                if (/[!@#$%^&*(),.?":{}|<>]/.test(value)) {
                    specialRequirement.classList.add('hidden');
                    metRequirements++;
                } else {
                    specialRequirement.classList.remove('hidden');
                }

                // Update password strength meter
                let strength = 'Zwak wachtwoord';
                let strengthClass = 'strength-weak';
                if (metRequirements >= 4) {
                    strength = 'Sterk wachtwoord';
                    strengthClass = 'strength-strong';
                } else if (metRequirements >= 2) {
                    strength = 'Gemiddeld wachtwoord';
                    strengthClass = 'strength-medium';
                }

                passwordStrength.textContent = strength;
                strengthMeterFill.className = `strength-meter-fill ${strengthClass}`;
            });
        });
    </script>
    <style>
        .field-container {
            position: relative;
        }

        .field-container input.border-red-500 {
            border-color: red;
        }

        .error-icon {
            position: absolute;
            right: 5px;
            top: 50%;
            transform: translateY(-50%);
            color: red;
        }

        .hidden {
            display: none;
        }

        .strength-meter {
            width: 100%;
            height: 5px;
            background-color: #e0e0e0;
            margin-top: 5px;
        }

        .strength-meter-fill {
            height: 100%;
        }

        .strength-weak {
            width: 33%;
            background-color: red;
        }

        .strength-medium {
            width: 66%;
            background-color: orange;
        }

        .strength-strong {
            width: 100%;
            background-color: green;
        }
    </style>
</x-guest-layout>

