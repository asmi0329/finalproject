<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div class="text-center">
                <div class="mx-auto h-16 w-16 bg-gradient-to-r from-emerald-600 to-teal-600 rounded-full flex items-center justify-center mb-4">
                    <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19l18 0m-18 0l18 0M3 19h18m-18 0l18 0M3 19l18 0"></path>
                    </svg>
                </div>
                <h2 class="text-4xl font-extrabold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                    Verify Your Email
                </h2>
                <p class="mt-2 text-lg text-gray-600">
                    Enter the OTP code sent to your email
                </p>
            </div>

            <!-- Verification Form -->
            <div class="bg-white shadow-2xl rounded-2xl p-8 space-y-6 border border-emerald-100">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="p-4 rounded-lg bg-green-50 border border-green-200">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="text-sm text-green-800 font-medium">{{ session('success') }}</div>
                        </div>
                    </div>
                @endif

                <!-- Email Failed Notice -->
                @if (session('email_failed'))
                    <div class="p-4 rounded-lg bg-yellow-50 border border-yellow-200">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-yellow-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-1.667-3.432-1.667H8.5c-1.468 0-2.662.834-3.432 1.667L2.168 18.333c-.77.833-1.192 1.667-1.732 2.5v6c0 .833.462 1.667 1.192 2.5l6.432 6.432c.77.833 1.964 1.667 3.432 1.667h6.432c1.468 0 2.662-.834 3.432-1.667l6.432-6.432c.77-.833 1.192-1.667 1.732-2.5v-6c0-.833-.462-1.667-1.192-2.5z"></path>
                            </svg>
                            <div class="text-sm text-yellow-800">
                                <div class="font-medium">Email service temporarily unavailable.</div>
                                <div class="text-xs mt-1">Please configure Gmail SMTP to receive OTP codes by email.</div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Alert Container -->
                <div id="alertContainer" class="hidden">
                    <div id="alertMessage" class="p-4 rounded-lg text-sm font-medium"></div>
                </div>

                <form method="POST" action="{{ route('verify.otp') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Email Address
                        </label>
                        <div class="relative">
                            <input id="email" name="email" type="email" required
                                class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-lg transition-all duration-200"
                                placeholder="Enter your email"
                                value="{{ session('email') ?? old('email') }}">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('email')
                            <div class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- OTP -->
                    <div>
                        <label for="otp" class="block text-sm font-semibold text-gray-700 mb-2">
                            OTP Code
                        </label>
                        <div class="relative">
                            <input id="otp" name="otp" type="text" required maxlength="6"
                                class="block w-full px-4 py-3 border-2 border-gray-300 rounded-lg placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-lg text-center transition-all duration-200"
                                placeholder="Enter 6-digit OTP">
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('otp')
                            <div class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="w-full flex justify-center py-4 px-6 border border-transparent rounded-xl shadow-lg text-lg font-bold text-white bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transform transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Verify Email
                            </span>
                        </button>
                    </div>
                </form>

                <!-- Resend OTP -->
                <div class="text-center">
                    <button id="resendBtn" type="button"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-emerald-600 hover:text-emerald-700 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Resend OTP Code
                    </button>
                </div>

                <!-- Divider -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500 font-medium">or</span>
                    </div>
                </div>

                <!-- Back to Register -->
                <div class="text-center">
                    <a href="{{ route('simple.otp.register') }}" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-emerald-600 hover:text-emerald-700 hover:bg-emerald-50 rounded-lg transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Register
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Show alert function
        function showAlert(message, type = 'error') {
            const alertContainer = document.getElementById('alertContainer');
            const alertMessage = document.getElementById('alertMessage');
            
            alertContainer.classList.remove('hidden');
            alertMessage.textContent = message;
            
            if (type === 'error') {
                alertMessage.className = 'p-4 rounded-lg text-sm font-medium bg-red-50 border border-red-200 text-red-800';
            } else if (type === 'success') {
                alertMessage.className = 'p-4 rounded-lg text-sm font-medium bg-green-50 border border-green-200 text-green-800';
            }
        }

        // Hide alert function
        function hideAlert() {
            const alertContainer = document.getElementById('alertContainer');
            alertContainer.classList.add('hidden');
        }

        // Resend OTP functionality
        document.getElementById('resendBtn').addEventListener('click', function() {
            const email = document.getElementById('email').value;
            
            if (!email) {
                showAlert('Please enter your email address first', 'error');
                return;
            }

            // Show loading state
            this.disabled = true;
            this.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Sending...
            `;

            // Send request to resend OTP
            fetch('/resend-otp', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ email: email })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('New OTP code sent to your email!', 'success');
                } else {
                    showAlert(data.message || 'Failed to resend OTP', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Failed to resend OTP. Please try again.', 'error');
            })
            .finally(() => {
                // Reset button state
                this.disabled = false;
                this.innerHTML = `
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Resend OTP Code
                `;
            });
        });
    </script>
</x-guest-layout>
