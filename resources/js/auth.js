// Auth JavaScript - Login & Register Forms

document.addEventListener('DOMContentLoaded', function() {
    
    // Auto-dismiss alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
    
    // Password visibility toggle (if needed in future)
    const passwordToggles = document.querySelectorAll('.password-toggle');
    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    });
    
    // Form validation enhancement
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.btn-submit');
            
            // Disable button to prevent double submission
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            
            // Re-enable after 3 seconds in case of error
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = submitBtn.dataset.originalText || 'Submit';
            }, 3000);
        });
        
        // Store original button text
        const submitBtn = form.querySelector('.btn-submit');
        if (submitBtn) {
            submitBtn.dataset.originalText = submitBtn.innerHTML;
        }
    });
    
    // Input focus animation
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });
    
    // Password strength indicator (for register page)
    const passwordInput = document.querySelector('input[name="password"]');
    if (passwordInput && window.location.pathname.includes('register')) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            const strength = calculatePasswordStrength(password);
            updatePasswordStrengthIndicator(strength);
        });
    }
    
    // Help icon functionality
    const helpIcon = document.querySelector('.help-icon');
    if (helpIcon) {
        helpIcon.addEventListener('click', function() {
            alert('Butuh bantuan? Hubungi support@dietgizi.com');
        });
    }
});

// Calculate password strength
function calculatePasswordStrength(password) {
    let strength = 0;
    
    if (password.length >= 8) strength++;
    if (password.length >= 12) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^a-zA-Z0-9]/.test(password)) strength++;
    
    return strength;
}

// Update password strength indicator
function updatePasswordStrengthIndicator(strength) {
    const indicator = document.getElementById('password-strength');
    if (!indicator) return;
    
    const levels = ['Sangat Lemah', 'Lemah', 'Sedang', 'Kuat', 'Sangat Kuat'];
    const colors = ['#dc3545', '#fd7e14', '#ffc107', '#28a745', '#20c997'];
    
    const level = Math.min(Math.floor(strength / 1.5), 4);
    
    indicator.textContent = levels[level];
    indicator.style.color = colors[level];
}

// Email validation
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

// Form field validation on blur
document.querySelectorAll('input[type="email"]').forEach(input => {
    input.addEventListener('blur', function() {
        if (this.value && !validateEmail(this.value)) {
            this.classList.add('is-invalid');
            showFieldError(this, 'Email tidak valid');
        } else {
            this.classList.remove('is-invalid');
            hideFieldError(this);
        }
    });
});

// Password confirmation validation
const passwordConfirm = document.querySelector('input[name="password_confirmation"]');
if (passwordConfirm) {
    passwordConfirm.addEventListener('input', function() {
        const password = document.querySelector('input[name="password"]').value;
        if (this.value && this.value !== password) {
            this.classList.add('is-invalid');
            showFieldError(this, 'Password tidak cocok');
        } else {
            this.classList.remove('is-invalid');
            hideFieldError(this);
        }
    });
}

// Show field error
function showFieldError(field, message) {
    let errorDiv = field.parentElement.querySelector('.field-error');
    if (!errorDiv) {
        errorDiv = document.createElement('div');
        errorDiv.className = 'field-error';
        errorDiv.style.color = '#dc3545';
        errorDiv.style.fontSize = '0.85rem';
        errorDiv.style.marginTop = '0.25rem';
        field.parentElement.appendChild(errorDiv);
    }
    errorDiv.textContent = message;
}

// Hide field error
function hideFieldError(field) {
    const errorDiv = field.parentElement.querySelector('.field-error');
    if (errorDiv) {
        errorDiv.remove();
    }
}
