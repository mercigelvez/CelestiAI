// resources/js/form-validation.js

document.addEventListener('DOMContentLoaded', function() {
    const registerForm = document.querySelector('form[action*="register"]');

    if (!registerForm) return;

    // Custom validation messages with mystical theme
    const validationMessages = {
        name: {
            required: "Your mystical identity must be revealed",
            maxLength: "Your cosmic identifier exceeds the celestial limit of 255 characters",
            format: "Your mystical name may only contain stellar letters, numerals, and cosmic underscores"
        },
        email: {
            required: "Your ethereal email address is essential for cosmic communication",
            format: "This email does not resonate with the universal pattern",
            maxLength: "Your astral address exceeds the celestial limit"
        },
        password: {
            required: "A mystic seal is required to protect your cosmic journey",
            minLength: "Your arcane seal requires at least 8 symbols of power",
            strength: "Your arcane seal must contain celestial symbols (uppercase), earthly symbols (lowercase), numerical runes, and magical characters"
        },
        password_confirmation: {
            required: "Please confirm your mystic seal",
            match: "Your arcane seals must align in cosmic harmony"
        },
        zodiac_sign: {
            required: "Your zodiac alignment is essential for cosmic guidance",
            invalid: "Please select a valid celestial sign"
        },
        birth_date: {
            format: "Your cosmic birthdate must follow the earthly calendar format",
            age: "You must have completed at least 13 revolutions around the sun"
        }
    };

    // Error display function
    function showError(inputElement, message) {
        // Remove any existing error message
        const existingError = inputElement.parentNode.querySelector('.validation-error');
        if (existingError) {
            existingError.remove();
        }

        // Create and add new error message
        const errorElement = document.createElement('p');
        errorElement.className = 'validation-error text-pink-500 text-xs mt-2 italic flex items-center opacity-0';

        // Add star symbols with spans
        const startSymbol = document.createElement('span');
        startSymbol.className = 'inline-block mr-1';
        startSymbol.textContent = '✧';

        const endSymbol = document.createElement('span');
        endSymbol.className = 'inline-block ml-1';
        endSymbol.textContent = '✧';

        // Add message
        const messageSpan = document.createElement('span');
        messageSpan.textContent = message;

        // Append components
        errorElement.appendChild(startSymbol);
        errorElement.appendChild(messageSpan);
        errorElement.appendChild(endSymbol);

        // Insert after the input
        inputElement.parentNode.insertBefore(errorElement, inputElement.nextSibling);

        // Add error styles to input - using Tailwind classes
        inputElement.classList.remove('border-purple-700', 'focus:ring-purple-500', 'focus:border-purple-500');
        inputElement.classList.add('border-pink-500', 'focus:ring-pink-500', 'focus:border-pink-500');

        // Animate the error message appearance
        setTimeout(() => {
            errorElement.classList.remove('opacity-0');
            errorElement.classList.add('opacity-100', 'transition-opacity', 'duration-300');
        }, 10);

        // Add subtle shake animation to input
        inputElement.classList.add('animate-shake');
        setTimeout(() => {
            inputElement.classList.remove('animate-shake');
        }, 500);
    }

    // Clear error function
    function clearError(inputElement) {
        const existingError = inputElement.parentNode.querySelector('.validation-error');
        if (existingError) {
            existingError.classList.add('opacity-0');
            setTimeout(() => {
                existingError.remove();
            }, 300);
        }
        inputElement.classList.remove('border-pink-500', 'focus:ring-pink-500', 'focus:border-pink-500');
        inputElement.classList.add('border-purple-700', 'focus:ring-purple-500', 'focus:border-purple-500');
    }

    // Validate function for each input
    function validateInput(input) {
        const field = input.id;
        const value = input.value.trim();

        // Clear any existing errors first
        clearError(input);

        switch(field) {
            case 'name':
                if (!value) {
                    showError(input, validationMessages.name.required);
                    return false;
                }
                if (value.length > 255) {
                    showError(input, validationMessages.name.maxLength);
                    return false;
                }
                if (!/^[a-zA-Z0-9_]+$/.test(value)) {
                    showError(input, validationMessages.name.format);
                    return false;
                }
                break;

            case 'email':
                if (!value) {
                    showError(input, validationMessages.email.required);
                    return false;
                }
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                    showError(input, validationMessages.email.format);
                    return false;
                }
                if (value.length > 255) {
                    showError(input, validationMessages.email.maxLength);
                    return false;
                }
                break;

            case 'password':
                if (!value) {
                    showError(input, validationMessages.password.required);
                    return false;
                }
                if (value.length < 8) {
                    showError(input, validationMessages.password.minLength);
                    return false;
                }
                if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value)) {
                    showError(input, validationMessages.password.strength);
                    return false;
                }
                // Also check confirmation if password is valid
                const confirmInput = document.getElementById('password_confirmation');
                if (confirmInput.value && confirmInput.value !== value) {
                    showError(confirmInput, validationMessages.password_confirmation.match);
                    return false;
                }

                // Update password strength indicator if exists
                updatePasswordStrength(value);
                break;

            case 'password_confirmation':
                if (!value) {
                    showError(input, validationMessages.password_confirmation.required);
                    return false;
                }
                const passwordInput = document.getElementById('password');
                if (passwordInput.value && value !== passwordInput.value) {
                    showError(input, validationMessages.password_confirmation.match);
                    return false;
                }
                break;

            case 'zodiac_sign':
                if (!value) {
                    showError(input, validationMessages.zodiac_sign.required);
                    return false;
                }
                const validSigns = [
                    'Aries', 'Taurus', 'Gemini', 'Cancer', 'Leo', 'Virgo',
                    'Libra', 'Scorpio', 'Sagittarius', 'Capricorn', 'Aquarius', 'Pisces'
                ];
                if (!validSigns.includes(value)) {
                    showError(input, validationMessages.zodiac_sign.invalid);
                    return false;
                }
                break;

            case 'birth_date':
                if (value) {
                    const birthDate = new Date(value);
                    if (isNaN(birthDate.getTime())) {
                        showError(input, validationMessages.birth_date.format);
                        return false;
                    }

                    // Check if user is at least 13 years old
                    const today = new Date();
                    const minAge = new Date(today);
                    minAge.setFullYear(today.getFullYear() - 13);

                    if (birthDate > minAge) {
                        showError(input, validationMessages.birth_date.age);
                        return false;
                    }
                }
                break;
        }

        return true;
    }

    // Password strength indicator
    function createPasswordStrengthIndicator() {
        const passwordInput = document.getElementById('password');
        if (!passwordInput) return;

        // Create strength indicator container
        const strengthContainer = document.createElement('div');
        strengthContainer.className = 'password-strength-container mt-2 h-1 bg-purple-900 bg-opacity-30 rounded overflow-hidden';

        // Create strength bar
        const strengthBar = document.createElement('div');
        strengthBar.className = 'password-strength-bar h-full w-0 bg-gradient-to-r from-pink-500 to-purple-500 transition-all duration-300';

        // Add to container
        strengthContainer.appendChild(strengthBar);

        // Insert after password input
        const errorElement = passwordInput.parentNode.querySelector('.validation-error');
        if (errorElement) {
            passwordInput.parentNode.insertBefore(strengthContainer, errorElement);
        } else {
            passwordInput.parentNode.appendChild(strengthContainer);
        }
    }

    // Update password strength indicator
    function updatePasswordStrength(password) {
        const strengthBar = document.querySelector('.password-strength-bar');
        if (!strengthBar) return;

        let strength = 0;

        // Calculate password strength
        if (password.length >= 8) strength += 20;
        if (password.length >= 12) strength += 10;
        if (/[A-Z]/.test(password)) strength += 20;
        if (/[a-z]/.test(password)) strength += 15;
        if (/\d/.test(password)) strength += 15;
        if (/[@$!%*?&]/.test(password)) strength += 20;

        // Set strength bar width
        strengthBar.style.width = strength + '%';

        // Update color based on strength
        if (strength < 40) {
            strengthBar.className = 'password-strength-bar h-full bg-pink-500 transition-all duration-300';
        } else if (strength < 70) {
            strengthBar.className = 'password-strength-bar h-full bg-yellow-500 transition-all duration-300';
        } else {
            strengthBar.className = 'password-strength-bar h-full bg-green-500 transition-all duration-300';
        }
    }

    // Add validation to form submission
    registerForm.addEventListener('submit', function(e) {
        let isValid = true;

        // Validate all inputs
        const inputs = registerForm.querySelectorAll('input:not([type="hidden"]), select');
        inputs.forEach(input => {
            if (!validateInput(input)) {
                isValid = false;
            }
        });

        if (!isValid) {
            e.preventDefault(); // Prevent form submission

            // Scroll to first error with smooth animation
            const firstError = registerForm.querySelector('.validation-error');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }

            // Add ethereal flash effect to indicate form issues
            const formContainer = registerForm.closest('.bg-black');
            if (formContainer) {
                formContainer.classList.add('ring', 'ring-pink-500', 'ring-opacity-50');
                setTimeout(() => {
                    formContainer.classList.remove('ring', 'ring-pink-500', 'ring-opacity-50');
                }, 1000);
            }
        }
    });

    // Add live validation on blur
    const inputs = registerForm.querySelectorAll('input:not([type="hidden"]), select');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            validateInput(this);
        });

        // Clear errors when focused
        input.addEventListener('focus', function() {
            clearError(this);
        });
    });

    // Add keyup validation for password strength with delay
    const passwordInput = document.getElementById('password');
    if (passwordInput) {
        // Create password strength indicator
        createPasswordStrengthIndicator();

        let typingTimer;
        passwordInput.addEventListener('keyup', function() {
            clearTimeout(typingTimer);
            updatePasswordStrength(this.value);
            typingTimer = setTimeout(() => validateInput(this), 500);
        });
    }

    // Add Tailwind animation utility classes
    if (!document.getElementById('tailwind-animations')) {
        const styleElement = document.createElement('style');
        styleElement.id = 'tailwind-animations';
        styleElement.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                20%, 60% { transform: translateX(-5px); }
                40%, 80% { transform: translateX(5px); }
            }

            .animate-shake {
                animation: shake 0.5s ease-in-out;
            }

            @keyframes twinkle {
                0% { opacity: 0.4; transform: scale(0.8); }
                100% { opacity: 1; transform: scale(1.1); }
            }

            .animate-twinkle {
                animation: twinkle 1.5s infinite alternate;
            }
        `;
        document.head.appendChild(styleElement);
    }
});
