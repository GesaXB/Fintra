@extends('layouts.app')

@section('title', 'Register - Fintra')

@section('content')
<div class="min-h-screen">
    <div class="grid lg:grid-cols-2 min-h-screen">
        <!-- Left Side - Form -->
        <div class="flex items-center justify-center p-8 bg-white order-2 lg:order-1">
            <div class="w-full max-w-md">
                <div class="mb-8">
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                           <a href="{{ route('home') }}"><i class="fas fa-chart-line text-white text-sm"></i></a> 
                        </div>
                        <span class="text-xl font-bold text-gray-800"><a href="{{ route('home') }}">Fintra</a></span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Create Your Account</h1>
                    <p class="text-gray-600">Start your financial journey today</p>
                </div>

                <!-- Alert Messages Container -->
                <div id="alertContainer" class="mb-4"></div>

                <form id="registerForm" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" name="name" id="name" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition" 
                               placeholder="Your Name" 
                               required>
                        <div id="nameError" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition" 
                               placeholder="Your Email" 
                               required>
                        <div id="emailError" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" 
                                   class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition" 
                                   placeholder="Password (min. 8 characters)" 
                                   required>
                            <button type="button" id="togglePassword" 
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div id="passwordError" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation" 
                                   class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition" 
                                   placeholder="Confirm Password" 
                                   required>
                            <button type="button" id="toggleConfirmPassword" 
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div id="passwordConfirmationError" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>

                    <div class="text-xs text-gray-500">
                        I agree to the <a href="#" class="text-primary hover:text-secondary">Terms & Conditions</a>
                    </div>

                    <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl font-semibold hover:bg-secondary transition disabled:opacity-50" id="registerBtn">
                        <span id="registerBtnText">Create Account</span>
                        <i id="registerSpinner" class="fas fa-spinner fa-spin ml-2 hidden"></i>
                    </button>

                    <div class="text-center">
                        <span class="text-gray-600">Already have an account? </span>
                        <a href="{{ route('login') }}" class="text-primary hover:text-secondary font-semibold">Sign in</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side - Illustration -->
        <div class="bg-gradient-to-br from-light to-primary/20 flex items-center justify-center p-8 order-1 lg:order-2">
            <div class="text-center max-w-md">
                <div class="relative mb-8">
                    <div class="inline-block p-8 bg-white rounded-3xl shadow-xl">
                        <div class="text-center">
                            <div class="w-20 h-20 bg-gray-200 rounded-full mx-auto mb-4 flex items-center justify-center">
                                <i class="fas fa-user text-gray-400 text-3xl"></i>
                            </div>
                            <div class="space-y-2">
                                <div class="h-3 bg-gray-200 rounded w-16 mx-auto"></div>
                                <div class="h-2 bg-gray-200 rounded w-12 mx-auto"></div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-2 -right-2 w-8 h-8 bg-primary rounded-full flex items-center justify-center">
                        <i class="fas fa-check text-white text-sm"></i>
                    </div>
                </div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Manage Money</h2>
                <h3 class="text-2xl font-semibold text-gray-700">Achieve Goals</h3>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Clear previous errors
        function clearErrors() {
            const errorElements = ['nameError', 'emailError', 'passwordError', 'passwordConfirmationError'];
            errorElements.forEach(id => {
                const element = document.getElementById(id);
                element.textContent = '';
                element.classList.add('hidden');
            });
            
            // Remove error styling from inputs
            const inputs = ['name', 'email', 'password', 'password_confirmation'];
            inputs.forEach(id => {
                document.getElementById(id).classList.remove('border-red-300');
            });
            
            // Clear alert container
            document.getElementById('alertContainer').innerHTML = '';
        }

        // Show field-specific errors
        function showFieldErrors(errors) {
            Object.keys(errors).forEach(field => {
                const errorElement = document.getElementById(field + 'Error');
                const inputElement = document.getElementById(field);
                
                if (errorElement && inputElement) {
                    errorElement.textContent = errors[field][0]; // Show first error
                    errorElement.classList.remove('hidden');
                    inputElement.classList.add('border-red-300');
                }
            });
        }

        // Show general alert
        function showAlert(message, type = 'error') {
            const alertContainer = document.getElementById('alertContainer');
            const alertClass = type === 'success' ? 'bg-green-100 text-green-700 border-green-200' : 'bg-red-100 text-red-700 border-red-200';
            
            alertContainer.innerHTML = `
                <div class="p-3 rounded-lg ${alertClass} border">
                    ${message}
                </div>
            `;
        }

        // Password toggle functions
        function setupPasswordToggle(toggleId, inputId) {
            document.getElementById(toggleId).addEventListener('click', function() {
                const input = document.getElementById(inputId);
                const icon = this.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.className = 'fas fa-eye-slash';
                } else {
                    input.type = 'password';
                    icon.className = 'fas fa-eye';
                }
            });
        }

        setupPasswordToggle('togglePassword', 'password');
        setupPasswordToggle('toggleConfirmPassword', 'password_confirmation');

        // Client-side validation
        function validateForm() {
            clearErrors();
            let isValid = true;

            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            // Name validation
            if (!name) {
                showFieldErrors({ name: ['Name is required'] });
                isValid = false;
            }

            // Email validation
            if (!email) {
                showFieldErrors({ email: ['Email is required'] });
                isValid = false;
            } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                showFieldErrors({ email: ['Please enter a valid email address'] });
                isValid = false;
            }

            // Password validation
            if (!password) {
                showFieldErrors({ password: ['Password is required'] });
                isValid = false;
            } else if (password.length < 8) {
                showFieldErrors({ password: ['Password must be at least 8 characters'] });
                isValid = false;
            }

            // Password confirmation validation
            if (!passwordConfirmation) {
                showFieldErrors({ password_confirmation: ['Password confirmation is required'] });
                isValid = false;
            } else if (password !== passwordConfirmation) {
                showFieldErrors({ password_confirmation: ['Passwords do not match'] });
                isValid = false;
            }

            return isValid;
        }

        // Form submit handler
        const form = document.getElementById('registerForm');
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Client-side validation
            if (!validateForm()) {
                return;
            }

            const formData = {
                name: document.getElementById('name').value.trim(),
                email: document.getElementById('email').value.trim(),
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value
            };

            const registerBtn = document.getElementById('registerBtn');
            const registerBtnText = document.getElementById('registerBtnText');
            const registerSpinner = document.getElementById('registerSpinner');

            // Show loading state
            registerBtn.disabled = true;
            registerBtnText.textContent = 'Creating account...';
            registerSpinner.classList.remove('hidden');
            clearErrors();

            try {
                const response = await fetch('/api/register', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify(formData)
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    showAlert('Account created successfully! Redirecting to login...', 'success');
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 2000);
                } else {
                    // Handle validation errors
                    if (data.errors) {
                        showFieldErrors(data.errors);
                    } else {
                        showAlert(data.message || 'Registration failed. Please try again.');
                    }
                }

            } catch (error) {
                console.error('Registration error:', error);
                showAlert('Network error. Please check your connection and try again.');
            } finally {
                // Reset loading state
                registerBtn.disabled = false;
                registerBtnText.textContent = 'Create Account';
                registerSpinner.classList.add('hidden');
            }
        });

        // Real-time password confirmation validation
        document.getElementById('password_confirmation').addEventListener('input', function() {
            const password = document.getElementById('password').value;
            const confirmation = this.value;
            const errorElement = document.getElementById('passwordConfirmationError');
            
            if (confirmation && password !== confirmation) {
                errorElement.textContent = 'Passwords do not match';
                errorElement.classList.remove('hidden');
                this.classList.add('border-red-300');
            } else if (confirmation && password === confirmation) {
                errorElement.classList.add('hidden');
                this.classList.remove('border-red-300');
            }
        });
    });
</script>
@endpush