<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In – Springway Workspace</title>
    <link rel="icon" href="/images/logo.jpg" type="image/jpeg">

    <!-- Fonts & Icons -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --navy-deep:  #04091f;
            --navy:       #0d2b8e;
            --blue:       #1a73e8;
            --sky:        #00aaff;
            --sky-glow:   rgba(0, 170, 255, 0.4);
            --gradient:   linear-gradient(135deg, #0d2b8e 0%, #1a73e8 50%, #00aaff 100%);
            --glass-bg:   rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.12);
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--navy-deep);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow-x: hidden;
        }

        /* Ambient animated backgrounds */
        .ambient-glow {
            position: fixed;
            border-radius: 50%;
            filter: blur(100px);
            pointer-events: none;
            opacity: 0.35;
            z-index: 0;
            animation: orbFloat 10s ease-in-out infinite alternate;
        }
        .glow-1 {
            width: 500px; height: 500px;
            background: #0d2b8e;
            top: -120px; left: -100px;
        }
        .glow-2 {
            width: 420px; height: 420px;
            background: #00aaff;
            bottom: -100px; right: -100px;
            animation-duration: 8s;
            animation-delay: -3s;
        }
        .glow-3 {
            width: 320px; height: 320px;
            background: #1a73e8;
            top: 45%; left: 60%;
            animation-duration: 12s;
            animation-delay: -5s;
        }
        @keyframes orbFloat {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -30px) scale(1.08); }
            100% { transform: translate(-20px, 20px) scale(0.95); }
        }

        /* Tech grid lines */
        .tech-grid {
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
            z-index: 0;
        }

        /* Login Card */
        .login-container {
            width: 100%;
            max-width: 440px;
            position: relative;
            z-index: 10;
        }

        .login-card {
            background: rgba(10, 20, 52, 0.72);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 42px 36px;
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.5), 0 0 40px rgba(0, 170, 255, 0.08);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--gradient);
        }

        /* Brand header */
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .logo-wrap {
            width: 78px;
            height: 78px;
            margin: 0 auto 16px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .logo-glow-ring {
            position: absolute;
            inset: -4px;
            border-radius: 50%;
            background: var(--gradient);
            opacity: 0.6;
            filter: blur(8px);
            animation: ringPulse 3s ease-in-out infinite;
        }
        @keyframes ringPulse {
            0%, 100% { opacity: 0.4; transform: scale(0.98); }
            50% { opacity: 0.8; transform: scale(1.04); }
        }
        .logo-img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #ffffff;
            padding: 8px;
            position: relative;
            z-index: 2;
            object-fit: contain;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
        }
        .brand-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.45rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: #ffffff;
            margin-bottom: 4px;
        }
        .brand-title .brand-s { color: #ffffff; }
        .brand-title .brand-w {
            background: linear-gradient(90deg, #00aaff, #7dd3fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .brand-subtitle {
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.6);
            letter-spacing: 0.3px;
        }

        /* Form elements */
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            font-size: 0.82rem;
            font-weight: 600;
            color: rgba(255, 255, 255, 0.85);
            margin-bottom: 8px;
            letter-spacing: 0.2px;
        }
        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-icon {
            position: absolute;
            left: 16px;
            color: rgba(255, 255, 255, 0.4);
            font-size: 0.95rem;
            transition: color 0.3s ease;
            pointer-events: none;
        }
        .form-input {
            width: 100%;
            background: rgba(255, 255, 255, 0.06);
            border: 1.5px solid rgba(255, 255, 255, 0.15);
            border-radius: 14px;
            padding: 14px 44px 14px 44px;
            color: #ffffff;
            font-family: inherit;
            font-size: 0.92rem;
            outline: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .form-input::placeholder {
            color: rgba(255, 255, 255, 0.35);
        }
        .form-input:focus {
            background: rgba(0, 170, 255, 0.08);
            border-color: var(--sky);
            box-shadow: 0 0 20px rgba(0, 170, 255, 0.25);
        }
        .form-input:focus + .input-icon,
        .input-wrap:focus-within .input-icon {
            color: var(--sky);
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.4);
            cursor: pointer;
            padding: 6px;
            font-size: 0.95rem;
            transition: color 0.25s ease;
        }
        .toggle-password:hover {
            color: #ffffff;
        }

        /* Checkbox & Options */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            font-size: 0.82rem;
        }
        .remember-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            user-select: none;
            color: rgba(255, 255, 255, 0.75);
        }
        .remember-wrap input[type="checkbox"] {
            accent-color: var(--sky);
            width: 16px;
            height: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Submit Button */
        .btn-login {
            width: 100%;
            background: var(--gradient);
            color: #ffffff;
            font-family: inherit;
            font-weight: 700;
            font-size: 0.96rem;
            padding: 15px;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 8px 24px rgba(26, 115, 232, 0.35);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(0, 170, 255, 0.45);
        }
        .btn-login:active {
            transform: translateY(0);
        }

        /* Back to website */
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 24px;
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.6);
            text-decoration: none;
            transition: color 0.25s ease;
        }
        .back-link:hover {
            color: var(--sky);
        }

        /* Alerts */
        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.84rem;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-danger {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #fca5a5;
        }
        .alert-info {
            background: rgba(0, 170, 255, 0.12);
            border: 1px solid rgba(0, 170, 255, 0.35);
            color: #7dd3fc;
        }

        @media (max-width: 480px) {
            body { padding: 16px; }
            .login-card { padding: 32px 22px; border-radius: 20px; }
            .brand-title { font-size: 1.3rem; }
            .demo-chips { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="ambient-glow glow-1"></div>
<div class="ambient-glow glow-2"></div>
<div class="ambient-glow glow-3"></div>
<div class="tech-grid"></div>

<div class="login-container">
    <div class="login-card">
        <!-- Brand Header -->
        <div class="login-header">
            <div class="logo-wrap">
                <div class="logo-glow-ring"></div>
                <img src="/images/logo.jpg" alt="Springway Logo" class="logo-img">
            </div>
            <h1 class="brand-title"><span class="brand-s">SPRING</span><span class="brand-w">WAY</span></h1>
            <p class="brand-subtitle">Education Workspace &bull; Portal Login</p>
        </div>

        <!-- Alert messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        @if (session('info'))
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                <span>{{ session('info') }}</span>
            </div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login.post') }}" method="POST" id="loginForm">
            @csrf

            <!-- Email -->
            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <div class="input-wrap">
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-input"
                        placeholder="your.email@springwaybd.com"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                    >
                    <i class="fas fa-envelope input-icon"></i>
                </div>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrap">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-input"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                    <i class="fas fa-lock input-icon"></i>
                    <button type="button" class="toggle-password" id="togglePassword" aria-label="Toggle password visibility">
                        <i class="far fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>

            <!-- Options -->
            <div class="form-options">
                <label class="remember-wrap" for="remember">
                    <input type="checkbox" name="remember" id="remember" value="1" {{ old('remember') ? 'checked' : '' }}>
                    <span>Remember me</span>
                </label>
                <span style="color: rgba(255,255,255,0.4); font-size: 0.78rem;">Role-based access</span>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-login" id="submitBtn">
                <span>Sign In to Dashboard</span>
                <i class="fas fa-arrow-right"></i>
            </button>
        </form>

        <!-- Back to Website -->
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-long-arrow-alt-left"></i>
            <span>Return to Springway Website</span>
        </a>
    </div>
</div>

<script>
// Show/Hide Password Toggle
const togglePassword = document.getElementById('togglePassword');
const passwordInput = document.getElementById('password');
const toggleIcon = document.getElementById('toggleIcon');

if (togglePassword && passwordInput && toggleIcon) {
    togglePassword.addEventListener('click', () => {
        const isPassword = passwordInput.getAttribute('type') === 'password';
        passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
        toggleIcon.classList.toggle('fa-eye', !isPassword);
        toggleIcon.classList.toggle('fa-eye-slash', isPassword);
    });
}

// Remember Me Persistence
const rememberCheckbox = document.getElementById('remember');
const emailInput = document.getElementById('email');
const loginForm = document.getElementById('loginForm');

try {
    const savedEmail = localStorage.getItem('springway_remember_email');
    if (savedEmail && emailInput && !emailInput.value) {
        emailInput.value = savedEmail;
        if (rememberCheckbox) {
            rememberCheckbox.checked = true;
        }
    }
} catch (e) {
    // LocalStorage fallback
}

if (loginForm && emailInput && rememberCheckbox) {
    loginForm.addEventListener('submit', () => {
        try {
            if (rememberCheckbox.checked) {
                localStorage.setItem('springway_remember_email', emailInput.value.trim());
            } else {
                localStorage.removeItem('springway_remember_email');
            }
        } catch (e) {}
    });
}
</script>
</body>
</html>

