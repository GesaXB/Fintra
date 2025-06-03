@extends('layouts.app')

@section('title', 'Login - Fintra')

@section('content')
<div class="min-h-screen">
    <div class="grid lg:grid-cols-2 min-h-screen">
        <!-- Left Side - Illustration -->
        <div class="bg-gradient-to-br from-light to-primary/20 flex items-center justify-center p-8">
            <div class="text-center max-w-md">
                <div class="relative mb-8">
                    <div class="inline-block p-8 bg-white rounded-3xl shadow-xl">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center">
                               <img src="{{ asset("Images/LoginImageAset.png") }}" alt="">
                            </div>
                            <div class="text-left">
                                <div class="h-3 bg-gray-200 rounded w-20 mb-2"></div>
                                <div class="h-2 bg-gray-200 rounded w-16"></div>
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

        <!-- Right Side - Login Form -->
        <div class="flex items-center justify-center p-8 bg-white">
            <div class="w-full max-w-md">
                <div class="mb-8">
                    <div class="flex items-center space-x-2 mb-6">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center">
                            <a href="{{ route('home') }}"><i class="fas fa-chart-line text-white text-sm"></i></a>
                        </div>
                        <span class="text-xl font-bold text-gray-800"><a href="{{ route('home') }}">Fintra</a></span>
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome Back</h1>
                    <p class="text-gray-600">Please sign in to your account</p>
                </div>

                <form id="loginForm" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email" 
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition" 
                               placeholder="Enter your email" required>
                        <div id="emailError" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" 
                                   class="w-full px-4 py-3 pr-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary transition" 
                                   placeholder="Enter your password" required>
                            <button type="button" id="togglePassword" 
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div id="passwordError" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" id="remember" class="rounded border-gray-300 text-primary focus:ring-primary/20">
                            <span class="ml-2 text-sm text-gray-600">Remember me</span>
                        </label>
                        <a href="#" class="text-sm text-primary hover:text-secondary">Forgot password?</a>
                    </div>

                    <button type="submit" class="w-full bg-primary text-white py-3 rounded-xl font-semibold hover:bg-secondary transition disabled:opacity-50" id="loginBtn">
                        <span id="loginBtnText">Sign In</span>
                        <i id="loginSpinner" class="fas fa-spinner fa-spin ml-2 hidden"></i>
                    </button>

                    <div class="text-center">
                        <span class="text-gray-600">Don't have an account? </span>
                        <a href="{{ route('register') }}" class="text-primary hover:text-secondary font-semibold">Sign up</a>
                    </div>
                </form>

                <div id="loginAlert" class="mt-4 hidden p-3 rounded-lg"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const togglePasswordBtn = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.getElementById('loginBtn');
    const loginBtnText = document.getElementById('loginBtnText');
    const loginSpinner = document.getElementById('loginSpinner');
    const alertBox = document.getElementById('loginAlert');
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');

    // Clear previous errors
    function clearErrors() {
        alertBox.classList.add('hidden');
        emailError.classList.add('hidden');
        passwordError.classList.add('hidden');
        emailInput.classList.remove('border-red-300');
        passwordInput.classList.remove('border-red-300');
    }

    // Show error message
    function showError(message, type = 'error') {
        alertBox.textContent = message;
        alertBox.className = `mt-4 p-3 rounded-lg ${type === 'error' ? 'bg-red-100 text-red-700 border border-red-200' : 'bg-green-100 text-green-700 border border-green-200'}`;
        alertBox.classList.remove('hidden');
    }

    // Show field-specific errors
    function showFieldErrors(errors) {
        if (errors.email) {
            emailError.textContent = Array.isArray(errors.email) ? errors.email[0] : errors.email;
            emailError.classList.remove('hidden');
            emailInput.classList.add('border-red-300');
        }
        if (errors.password) {
            passwordError.textContent = Array.isArray(errors.password) ? errors.password[0] : errors.password;
            passwordError.classList.remove('hidden');
            passwordInput.classList.add('border-red-300');
        }
    }

    // Toggle password visibility
    togglePasswordBtn.addEventListener('click', function () {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            this.querySelector('i').className = 'fas fa-eye-slash';
        } else {
            passwordInput.type = 'password';
            this.querySelector('i').className = 'fas fa-eye';
        }
    });

    // Handle login
loginForm.addEventListener('submit', async function (e) {
    e.preventDefault();
    
    clearErrors();
    
    // Disable button and show loading state
    loginBtn.disabled = true;
    loginBtnText.textContent = 'Signing in...';
    loginSpinner.classList.remove('hidden');

    const email = emailInput.value.trim();
    const password = passwordInput.value;
    const remember = document.getElementById('remember').checked;

    try {
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') 
            || document.querySelector('input[name="_token"]')?.value;

        const response = await fetch('/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ email, password, remember }),
            credentials: 'same-origin'
        });

        const data = await response.json();
        console.log('Login response:', data);

        if (response.ok && data.success) {
            showError('Login successful! Redirecting...', 'success');
            
            // Store token if provided
            if (data.token) {
                localStorage.setItem('auth_token', data.token);
                // Set cookie for session authentication
                document.cookie = `auth_token=${data.token}; path=/; max-age=86400; SameSite=Strict`;
            }
            
            // Force redirect immediately without setTimeout
            console.log('Redirecting to dashboard...');
            
            // Try multiple redirect methods
            if (data.redirect_url) {
                console.log('Using redirect_url from response:', data.redirect_url);
                window.location.replace(data.redirect_url);
            } else {
                console.log('Using default dashboard URL');
                window.location.href ='/dashboard';
            }
            
            // Fallback redirect after a brief delay
            setTimeout(() => {
                if (window.location.pathname !== '/dashboard') {
                    console.log('Fallback redirect executing...');
                    window.location.href = '/dashboard';
                }
            }, 500);
            
        } else {
            // Handle validation errors
            if (data.errors) {
                showFieldErrors(data.errors);
            } else {
                showError(data.message || 'Login failed. Please try again.');
            }
        }

    } catch (error) {
        console.error('Login error:', error);
        showError('Network error. Please check your connection and try again.');
        
        // Fallback to traditional form submission
        console.log('Attempting traditional form submission as fallback...');
        fallbackToTraditionalForm(email, password, remember, csrfToken);
        
    } finally {
        // Only reset button state if we're not redirecting
        setTimeout(() => {
            if (window.location.pathname === '/login') {
                loginBtn.disabled = false;
                loginBtnText.textContent = 'Sign In';
                loginSpinner.classList.add('hidden');
            }
        }, 100);
    }
});

// Fallback function for traditional form submission
function fallbackToTraditionalForm(email, password, remember, csrfToken) {
    console.log('Creating traditional form for fallback submission');
    
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '/login';
    form.style.display = 'none';
    
    // Add CSRF token
    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken || '';
    form.appendChild(csrfInput);
    
    // Add email
    const emailInputForm = document.createElement('input');
    emailInputForm.type = 'email';
    emailInputForm.name = 'email';
    emailInputForm.value = email;
    form.appendChild(emailInputForm);
    
    // Add password
    const passwordInputForm = document.createElement('input');
    passwordInputForm.type = 'password';
    passwordInputForm.name = 'password';
    passwordInputForm.value = password;
    form.appendChild(passwordInputForm);
    
    // Add remember checkbox if checked
    if (remember) {
        const rememberInput = document.createElement('input');
        rememberInput.type = 'hidden';
        rememberInput.name = 'remember';
        rememberInput.value = '1';
        form.appendChild(rememberInput);
    }
    
    document.body.appendChild(form);
    form.submit();
}
});
</script>
@endpush