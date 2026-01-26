<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-3xl font-black bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent tracking-tight mb-2">
            Set New Password
        </h2>
        <p class="text-slate-600 font-medium">Enter your new password</p>
    </div>

    <!-- Alert Container -->
    <div id="alertContainer" class="hidden mb-4">
        <div id="alertMessage" class="p-4 rounded-md text-sm font-medium"></div>
    </div>

    <!-- Reset Password Form -->
    <form id="resetPasswordForm" class="space-y-6">
        @csrf
        
        <!-- Email (hidden) -->
        <input type="hidden" id="email" name="email" value="{{ request('email') }}">
        
        <!-- New Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
            <div class="mt-1">
                <input id="password" name="password" type="password" required
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    placeholder="Enter your new password">
            </div>
            <div id="password_error" class="hidden mt-1 text-sm text-red-600"></div>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
            <div class="mt-1">
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm"
                    placeholder="Confirm your new password">
            </div>
            <div id="password_confirmation_error" class="hidden mt-1 text-sm text-red-600"></div>
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" id="submitBtn"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                <span id="submitBtnText">Reset Password</span>
                <svg id="submitBtnLoading" class="hidden animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </div>
    </form>

    <!-- Success Modal -->
    <div id="successModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3 text-center">
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h3 class="text-lg leading-6 font-medium text-gray-900">Password Reset!</h3>
                <div class="mt-2 px-7 py-3">
                    <p class="text-sm text-gray-500">Your password has been reset successfully. You can now login with your new password.</p>
                </div>
                <div class="items-center px-4 py-3">
                    <button id="goToLoginBtn" class="px-4 py-2 bg-emerald-600 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                        Go to Login
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-gray-900">
            ← Back to Login
        </a>
    </div>

    <script>
        const form = document.getElementById('resetPasswordForm');
        const submitBtn = document.getElementById('submitBtn');
        const submitBtnText = document.getElementById('submitBtnText');
        const submitBtnLoading = document.getElementById('submitBtnLoading');
        const alertContainer = document.getElementById('alertContainer');
        const alertMessage = document.getElementById('alertMessage');
        const successModal = document.getElementById('successModal');
        const goToLoginBtn = document.getElementById('goToLoginBtn');

        // Password validation
        function validatePassword(value) {
            if (!value) {
                return { valid: false, message: 'Password is required.' };
            }
            if (value.length < 8) {
                return { valid: false, message: 'Password must be at least 8 characters.' };
            }
            return { valid: true };
        }

        function validatePasswordConfirmation(value) {
            const password = document.getElementById('password').value;
            if (!value) {
                return { valid: false, message: 'Password confirmation is required.' };
            }
            if (value !== password) {
                return { valid: false, message: 'Password and confirm password must match.' };
            }
            return { valid: true };
        }

        // Real-time validation
        function validateField(fieldId, errorId, validationFn) {
            const field = document.getElementById(fieldId);
            const error = document.getElementById(errorId);
            
            field.addEventListener('blur', function() {
                const result = validationFn(this.value);
                if (!result.valid) {
                    error.textContent = result.message;
                    error.classList.remove('hidden');
                    field.classList.add('border-red-500');
                } else {
                    error.classList.add('hidden');
                    field.classList.remove('border-red-500');
                }
            });

            field.addEventListener('input', function() {
                if (this.value.length > 0) {
                    const result = validationFn(this.value);
                    if (!result.valid) {
                        error.textContent = result.message;
                        error.classList.remove('hidden');
                        field.classList.add('border-red-500');
                    } else {
                        error.classList.add('hidden');
                        field.classList.remove('border-red-500');
                    }
                }
            });
        }

        // Setup validation
        validateField('password', 'password_error', validatePassword);
        validateField('password_confirmation', 'password_confirmation_error', validatePasswordConfirmation);

        // Show alert
        function showAlert(message, type = 'error') {
            alertContainer.classList.remove('hidden');
            alertMessage.textContent = message;
            
            if (type === 'error') {
                alertMessage.className = 'p-4 rounded-md text-sm font-medium bg-red-50 border border-red-200 text-red-800';
            } else if (type === 'success') {
                alertMessage.className = 'p-4 rounded-md text-sm font-medium bg-green-50 border border-green-200 text-green-800';
            }
        }

        // Hide alert
        function hideAlert() {
            alertContainer.classList.add('hidden');
        }

        // Form submission
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            hideAlert();

            // Validate all fields
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;
            
            const passwordValidation = validatePassword(password);
            if (!passwordValidation.valid) {
                showAlert(passwordValidation.message, 'error');
                return;
            }

            const confirmationValidation = validatePasswordConfirmation(passwordConfirmation);
            if (!confirmationValidation.valid) {
                showAlert(confirmationValidation.message, 'error');
                return;
            }

            // Show loading state
            submitBtn.disabled = true;
            submitBtnText.classList.add('hidden');
            submitBtnLoading.classList.remove('hidden');

            try {
                const formData = new FormData(form);

                const response = await fetch('/otp/reset-password', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    // Show success modal
                    successModal.classList.remove('hidden');
                } else {
                    showAlert(data.message, 'error');
                }
            } catch (error) {
                console.error('Reset password error:', error);
                showAlert('Password reset failed. Please try again.', 'error');
            } finally {
                // Reset button state
                submitBtn.disabled = false;
                submitBtnText.classList.remove('hidden');
                submitBtnLoading.classList.add('hidden');
            }
        });

        // Go to login
        goToLoginBtn.onclick = function() {
            window.location.href = '/login';
        };

        // Focus first input
        document.getElementById('password').focus();
    </script>
</x-guest-layout>
