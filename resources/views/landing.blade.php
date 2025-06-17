<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Retribusi Persampahan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Loading Animation CSS -->
    <link href="{{ asset('css/loading-animation.css') }}" rel="stylesheet" type="text/css" />
    <style>
    /* Loading Override */
    #loading-overlay {
        background: rgba(255, 255, 255, 0.95);
    }
    .loader {
        width: 80px;
        height: 80px;
        position: relative;
        margin-bottom: 20px;
    }
    .loader:before, .loader:after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        border: 4px solid #3498db;
        border-radius: 50%;
        opacity: 0;
        animation: loader 2s infinite ease-in-out;
    }
    .loader:after {
        animation-delay: -1s;
    }
    @keyframes loader {
        0%, 100% {
            transform: scale(0);
            opacity: 0;
        }
        50% {
            transform: scale(1);
            opacity: 1;
        }
    }
    .loading-text {
        color: #3498db;
        font-size: 1.2rem;
        margin-top: 15px;
    }
    </style>
    <style>
        :root {
            --primary-color: #008B8B; /* Teal */
            --secondary-color: #20B2AA; /* Light Sea Green */
            --accent-color: #00CED1; /* Dark Turquoise */
            --light-color: #E0FFFF; /* Light Cyan */
            --dark-color: #006666; /* Dark Teal */
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }
        
        /* Parallax dan Hero Section Styles */
        .parallax-container {
            height: 100vh;
            overflow: hidden;
            position: relative;
            width: 100%;
        }
        
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 120%;
            left: 0;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: -1;
        }
        
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), 
                        url('https://images.unsplash.com/photo-1604187351574-c75ca79f5807?ixlib=rb-1.2.1&auto=format&fit=crop&w=2100&q=100');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 7rem 0;
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .search-box {
            background-color: rgba(255, 255, 255, 0.9);
            background-image: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.7) 100%);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .mini-search-box {
            padding: 1.5rem 1.25rem 1rem;
            width: 100%;
            margin: 0 auto;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 139, 139, 0.15);
            border: 1px solid rgba(0, 139, 139, 0.2);
            background-image: linear-gradient(135deg, rgba(224, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%);
            position: relative;
            padding-top: 50px;
        }
        
        @media (max-width: 768px) {
            .mini-search-box {
                margin: 0 auto;
            }
        }
        
        .text-teal {
            color: var(--primary-color);
        }
        
        .logo-container {
            position: absolute;
            overflow: visible;
            display: flex;
            justify-content: center;
            align-items: center;
            top: -60px;
            left: 0;
            right: 0;
            margin: 0 auto;
            z-index: 10;
        }
        
        .center-in-box {
            position: relative;
            top: auto;
            margin: 10px auto 20px;
            height: 120px;
        }
        
        .logo-circle {
            position: relative;
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, rgba(0, 206, 209, 0.1) 0%, rgba(224, 255, 255, 0.3) 100%);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 5px 15px rgba(0, 139, 139, 0.2);
            border: 1px solid rgba(0, 139, 139, 0.15);
            margin-bottom: -20px;
        }
        
        .logo-animation {
            width: 350px;
            height: auto;
            filter: drop-shadow(0 4px 8px rgba(0, 139, 139, 0.4));
            animation: pulse-glow 2s infinite alternate, logo-spin 10s infinite ease-in-out;
            transform-origin: center;
            margin: 5px auto 20px;
            position: relative;
            z-index: 5;
        }
        
        @keyframes pulse-glow {
            0% {
                filter: drop-shadow(0 2px 3px rgba(0, 139, 139, 0.2));
                transform: scale(1);
            }
            100% {
                filter: drop-shadow(0 4px 6px rgba(0, 139, 139, 0.4));
                transform: scale(1.05);
            }
        }
        
        @keyframes logo-spin {
            0% {
                transform: rotate(0deg) scale(1);
            }
            25% {
                transform: rotate(5deg) scale(1.03);
            }
            50% {
                transform: rotate(0deg) scale(1);
            }
            75% {
                transform: rotate(-5deg) scale(1.03);
            }
            100% {
                transform: rotate(0deg) scale(1);
            }
        }
        
        .search-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCI+CjxyZWN0IHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0ibm9uZSI+PC9yZWN0Pgo8cGF0aCBkPSJNMCAxMEwxMCAwWk0xMiA4TDggMTJaTS0yIDJMMiAtMloiIHN0cm9rZT0iIzJFOEI1NyIgc3Ryb2tlLXdpZHRoPSIwLjUiIHN0cm9rZS1vcGFjaXR5PSIwLjA3Ij48L3BhdGg+Cjwvc3ZnPg==');
            opacity: 0.5;
            z-index: -1;
        }
        
        /* Elemen dekoratif untuk form pencarian */
        .search-feature-container {
            position: relative;
            padding: 0.5rem;
            z-index: 1;
        }
        
        /* Floating elements animation */
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 0;
        }
        
        .float-element {
            position: absolute;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            color: var(--primary-color);
            background-color: rgba(255, 255, 255, 0.6);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            opacity: 0.5;
            z-index: 1;
            font-size: 0.8rem;
        }
        
        .elem-1 {
            top: -10px;
            right: 15%;
            animation: float-1 9s ease-in-out infinite;
        }
        
        .elem-2 {
            bottom: 20px;
            left: 15%;
            animation: float-2 11s ease-in-out infinite;
        }
        
        .elem-3 {
            top: 40%;
            right: 5%;
            animation: float-3 8s ease-in-out infinite;
        }
        
        .elem-4 {
            top: 20%;
            left: 8%;
            animation: float-4 10s ease-in-out infinite;
        }
        
        @keyframes float-1 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(-10px, 10px) rotate(5deg); }
            50% { transform: translate(5px, -15px) rotate(-5deg); }
            75% { transform: translate(10px, 5px) rotate(3deg); }
        }
        
        @keyframes float-2 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(10px, -5px) rotate(-3deg); }
            50% { transform: translate(-5px, 10px) rotate(5deg); }
            75% { transform: translate(-10px, -10px) rotate(-2deg); }
        }
        
        @keyframes float-3 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(-5px, -8px) rotate(-5deg); }
            50% { transform: translate(10px, 5px) rotate(3deg); }
            75% { transform: translate(-8px, 10px) rotate(-3deg); }
        }
        
        @keyframes float-4 {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            25% { transform: translate(8px, 8px) rotate(3deg); }
            50% { transform: translate(-8px, -5px) rotate(-4deg); }
            75% { transform: translate(5px, -8px) rotate(2deg); }
        }
        
        .search-decoration-circle {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(46, 139, 87, 0.1) 0%, rgba(102, 205, 170, 0.05) 100%);
            border: 1px solid rgba(60, 179, 113, 0.2);
            z-index: 1;
        }
        
        .mini-circle {
            transform: scale(0.7);
        }
        
        .teal-glow {
            background: linear-gradient(135deg, rgba(0, 139, 139, 0.1) 0%, rgba(32, 178, 170, 0.05) 100%);
            border: 1px solid rgba(0, 206, 209, 0.2);
            box-shadow: 0 0 10px rgba(0, 139, 139, 0.1);
        }
        
        .circle-1 {
            width: 60px;
            height: 60px;
            top: -8px;
            right: -15px;
        }
        
        .circle-2 {
            width: 35px;
            height: 35px;
            bottom: 20px;
            right: 30px;
        }
        
        .circle-3 {
            width: 45px;
            height: 45px;
            bottom: 8px;
            left: -10px;
        }
        
        .stats-section {
            background-color: #f9f9f9;
            padding: 80px 0;
            position: relative;
            overflow: hidden;
            color: white;
        }
        
            .stats-section .parallax-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 139, 139, 0.7)), url('https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80');
            background-position: center;
            background-size: cover;
            background-attachment: fixed;
            z-index: -1;
        }
        
        .shimmer-effect {
            position: relative;
            overflow: hidden;
        }
        
        .shimmer-effect::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 206, 209, 0.2), transparent);
            animation: shimmer 3s infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        .circle-1 {
            width: 70px;
            height: 70px;
            top: -20px;
            left: -20px;
        }
        
        .circle-2 {
            width: 40px;
            height: 40px;
            bottom: 15px;
            right: 15px;
            opacity: 0.1;
            background: linear-gradient(135deg, var(--primary-color) 0%, rgba(102, 205, 170, 0.6) 100%);
        }
        
        .circle-3 {
            width: 25px;
            height: 25px;
            top: 50%;
            right: -5px;
            opacity: 0.07;
            background: linear-gradient(135deg, var(--accent-color) 0%, var(--primary-color) 100%);
        }
        
        .search-decoration-line {
            position: absolute;
            background: linear-gradient(90deg, rgba(0, 139, 139, 0.1), rgba(32, 178, 170, 0.05));
            height: 1px;
            z-index: 1;
        }
        
        .line-1 {
            width: 80px;
            transform: rotate(45deg);
            top: 30px;
            right: -20px;
        }
        
        .line-2 {
            width: 60px;
            transform: rotate(-30deg);
            bottom: 30px;
            left: 5px;
        }
        
        /* Efek 3D dan Ilustrasi */
        .search-3d-container {
            position: relative;
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            perspective: 1000px;
        }
        
        .search-illustration {
            width: 100%;
            height: 100%;
            position: relative;
            transform-style: preserve-3d;
            animation: floating-3d 6s ease-in-out infinite;
        }
        
        @keyframes floating-3d {
            0%, 100% { transform: translateY(0) rotateY(0); }
            25% { transform: translateY(-10px) rotateY(15deg); }
            50% { transform: translateY(5px) rotateY(-10deg); }
            75% { transform: translateY(-5px) rotateY(5deg); }
        }
        
        .illustration-3d {
            position: relative;
            width: 100%;
            height: 100%;
            transform-style: preserve-3d;
        }
        
        .search-icon-3d {
            position: absolute;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            z-index: 2;
            transform: translateZ(15px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }
        
        .search-glow {
            position: absolute;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(60, 179, 113, 0.6) 0%, rgba(255, 255, 255, 0) 70%);
            z-index: 1;
            transform: translateZ(8px);
            filter: blur(8px);
            animation: glow-pulse 3s ease-in-out infinite alternate;
        }
        
        @keyframes glow-pulse {
            0% { opacity: 0.7; transform: translateZ(10px) scale(0.9); }
            100% { opacity: 1; transform: translateZ(10px) scale(1.1); }
        }
        
        .search-shadow {
            position: absolute;
            width: 50px;
            height: 15px;
            background: radial-gradient(ellipse, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0) 70%);
            border-radius: 50%;
            bottom: -20px;
            left: 10px;
            filter: blur(4px);
            transform: rotateX(90deg);
            z-index: 0;
            animation: shadow-pulse 3s ease-in-out infinite alternate;
        }
        
        @keyframes shadow-pulse {
            0% { transform: rotateX(90deg) scaleX(0.9) scaleY(0.9); opacity: 0.3; }
            100% { transform: rotateX(90deg) scaleX(1.1) scaleY(0.8); opacity: 0.5; }
        }
        
        /* Form input yang lebih menarik */
        .npwr-input-wrapper {
            position: relative;
            z-index: 2;
        }
        
        .search-prefix {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 6px 0 0 6px;
            padding: 0.25rem 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 40px;
            font-size: 1rem;
        }
        
        .mini-logo {
            width: 24px;
            height: 24px;
            object-fit: contain;
            filter: brightness(0) invert(1);
        }
        
        .teal-bg {
            background-color: var(--primary-color);
        }
        
        .btn-teal {
            background-color: var(--primary-color);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }
        
        .btn-teal:hover {
            background-color: var(--accent-color);
            color: white;
        }
        
        .custom-input {
            border: 1px solid rgba(0, 139, 139, 0.2);
            border-left: none;
            border-right: none;
            padding-left: 10px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.9);
            height: 40px;
        }
        
        .custom-input:focus {
            box-shadow: 0 0 0 2px rgba(0, 139, 139, 0.2);
            border-color: var(--primary-color);
            background-color: white;
            outline: none;
        }
        
        .search-button {
            border-radius: 0 6px 6px 0;
            background: var(--primary-color);
            border: none;
            transition: all 0.3s ease;
            padding: 0.25rem 0.75rem;
            font-size: 1rem;
            height: 40px;
        }
        
        .search-button:hover {
            background: var(--accent-color);
            transform: translateX(2px);
        }
        
        .input-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--dark-color);
            position: relative;
            padding-left: 15px;
            transform: translateY(5px);
            opacity: 0;
            animation: slide-in 0.5s forwards;
            animation-delay: 0.2s;
        }
        
        .mini-label {
            font-size: 0.75rem;
            margin-bottom: 3px;
            padding-left: 10px;
            color: var(--primary-color);
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .input-label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            background-color: var(--primary-color);
            border-radius: 2px;
        }
        
        @keyframes slide-in {
            0% { transform: translateY(10px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }
        
        .format-container {
            animation: fade-in 0.5s forwards;
            animation-delay: 0.4s;
            opacity: 0;
        }
        
        @keyframes fade-in {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        
        .format-badge {
            display: inline-block;
            background-color: rgba(46, 139, 87, 0.1);
            border-radius: 20px;
            padding: 3px 10px;
            border: 1px dashed rgba(46, 139, 87, 0.3);
            font-size: 0.8rem;
        }
        
        .format-label {
            color: rgba(0, 0, 0, 0.6);
            font-size: 0.85rem;
            margin-right: 5px;
        }
        
        .format-example {
            color: var(--primary-color);
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .mini-format {
            font-size: 0.7rem;
            color: var(--dark-color);
            opacity: 0.7;
            margin-top: 3px;
        }
        
        .mini-format .format-example {
            font-size: 0.7rem;
            border-bottom: 1px dotted var(--primary-color);
        }
        
        .keyboard-hint {
            font-size: 0.8rem;
            color: rgba(0, 0, 0, 0.5);
            animation: blink 3s infinite;
        }
        
        @keyframes blink {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }
        
        /* Indikator pencarian aktif */
        .search-indicator {
            position: absolute;
            bottom: 5px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            opacity: 0;
            height: 10px;
            transition: opacity 0.3s ease;
        }
        
        .npwr-input-wrapper:focus-within + .format-container + .search-indicator {
            opacity: 1;
        }
        
        .indicator-dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background-color: var(--primary-color);
            opacity: 0.5;
        }
        
        .dot1 { animation: dot-pulse 1.5s infinite 0s; }
        .dot2 { animation: dot-pulse 1.5s infinite 0.2s; }
        .dot3 { animation: dot-pulse 1.5s infinite 0.4s; }
        
        @keyframes dot-pulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.5); opacity: 1; }
        }
        
        .search-box h2 {
            color: var(--dark-color);
            margin-bottom: 1.5rem;
        }
        
        .feature-card {
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .feature-card::before {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(46, 139, 87, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            z-index: -1;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            border-color: rgba(46, 139, 87, 0.2);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }
        
        .feature-icon::after {
            content: '';
            position: absolute;
            width: 40px;
            height: 40px;
            background: radial-gradient(circle, rgba(46, 139, 87, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            top: -5px;
            left: -5px;
            z-index: -1;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--dark-color);
            border-color: var(--dark-color);
        }
        
        .parallax-section {
            position: relative;
            padding: 6rem 0;
            overflow: hidden;
            color: white;
            z-index: 1;
        }
        
        .parallax-bg {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 100%;
            left: 0;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: -1;
        }
        
        .stats-section {
            padding: 5rem 0;
            position: relative;
            overflow: hidden;
            color: white;
            z-index: 1;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            background-image: linear-gradient(135deg, rgba(255, 255, 255, 0.4) 0%, rgba(255, 255, 255, 0.01) 100%);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .glass-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1IiBoZWlnaHQ9IjUiPgo8cmVjdCB3aWR0aD0iNSIgaGVpZ2h0PSI1IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMDUiPjwvcmVjdD4KPHBhdGggZD0iTTAgNUw1IDBaTTYgNEw0IDZaTS0xIDFMMSAtMVoiIHN0cm9rZT0iIzIxOTY1MyIgc3Ryb2tlLXdpZHRoPSIwLjI1IiBzdHJva2Utb3BhY2l0eT0iMC4wNSI+PC9wYXRoPgo8L3N2Zz4=');
            opacity: 0.3;
            z-index: -1;
        }
        
        .glass-effect:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            background-image: linear-gradient(135deg, rgba(255, 255, 255, 0.5) 0%, rgba(255, 255, 255, 0.1) 100%);
        }
        
        .stat-item {
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .stat-item::before {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(46, 139, 87, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            top: -75px;
            right: -75px;
            z-index: 0;
        }
        
        .stat-item::after {
            content: '';
            position: absolute;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, rgba(46, 139, 87, 0.08) 0%, rgba(255, 255, 255, 0) 70%);
            border-radius: 50%;
            bottom: -60px;
            left: -60px;
            z-index: 0;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--dark-color);
            position: relative;
            z-index: 1;
            text-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        
        .stat-label {
            color: var(--dark-color);
            font-weight: 500;
            position: relative;
            z-index: 1;
        }
        
        footer {
            color: white;
            padding: 3rem 0 1.5rem;
        }
        
        .footer-links a {
            color: var(--light-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .footer-links a:hover {
            color: var(--primary-color);
            text-decoration: none;
            padding-left: 5px;
        }
        
        .social-icon-circle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .social-icon-circle:hover {
            transform: translateY(-5px);
            background-color: var(--primary-color);
            color: white;
        }
        
        .icon-box {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary-color);
            color: white;
        }
        
        .contact-item {
            transition: all 0.3s ease;
        }
        
        .contact-item:hover {
            transform: translateX(5px);
        }
        
        .animated-icon {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        
        .result-box {
            display: none;
            background-color: white;
            background-image: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%);
            border-radius: 15px;
            padding: 1.5rem;
            margin-top: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(46, 139, 87, 0.1);
        }
        
        .result-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+CjxyZWN0IHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgZmlsbD0ibm9uZSI+PC9yZWN0Pgo8Y2lyY2xlIGN4PSIxIiBjeT0iMSIgcj0iMC41IiBmaWxsPSIjMkU4QjU3IiBmaWxsLW9wYWNpdHk9IjAuMDUiPjwvY2lyY2xlPgo8Y2lyY2xlIGN4PSIxMSIgY3k9IjExIiByPSIwLjUiIGZpbGw9IiMyRThCNTciIGZpbGwtb3BhY2l0eT0iMC4wNSI+PC9jaXJjbGU+Cjwvc3ZnPg==');
            opacity: 0.5;
            z-index: -1;
        }
        
        .npwr-info {
            border-left: 4px solid var(--primary-color);
            padding-left: 1rem;
        }
        
        .payment-history {
            max-height: 300px;
            overflow-y: auto;
        }
        
        .login-link {
            position: absolute;
            top: 20px;
            right: 20px;
        }
    </style>
</head>
<body>
<!-- Loading Overlay -->
<div id="loading-overlay" class="loading-overlay">
    <div class="loader"></div>
    <div class="loading-text">Memuat Aplikasi...</div>
</div>
    <!-- Hero Section with Search -->
    <section class="hero-section">
        <div class="container">
            <!-- <a href="{{ route('login') }}" class="btn btn-outline-light login-link">Login Admin</a> -->
            
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 mb-4">Retribusi Kebersihan</h1>
                    <p class="lead mb-4">Menjaga kebersihan lingkungan dengan pengelolaan sampah yang teratur dan transparan. Cek tagihan retribusi kebersihan Anda dengan mudah.</p>
                </div>
                <div class="col-lg-6">
                    <div class="search-box mini-search-box">
                        <h5 class="text-center mb-3 mt-2 text-teal">Cek Tagihan Retribusi Kebersihan</h5>
                        <div class="logo-container center-in-box">
                            <img src="{{ asset('assets/images/Simlurah Color.svg') }}" alt="Simlurah Logo" class="logo-animation">
                        </div>
                        <div class="search-feature-container position-relative">
                            <!-- Elemen dekoratif untuk fitur pencarian -->
                            <div class="floating-elements">
                                <div class="floating-circle" style="top: 15px; right: 15px; width: 25px; height: 25px; background-color: rgba(0, 139, 139, 0.15); animation-duration: 5s;"></div>
                                <div class="floating-circle" style="bottom: 30px; left: 20px; width: 35px; height: 35px; background-color: rgba(32, 178, 170, 0.12); animation-duration: 7s;"></div>
                                <div class="floating-circle" style="top: 40px; left: 30px; width: 15px; height: 15px; background-color: rgba(0, 206, 209, 0.1); animation-duration: 4s;"></div>
                                <div class="floating-icon" style="top: 12px; left: 25px;">
                                    <i class="fas fa-leaf" style="color: rgba(0, 139, 139, 0.3); font-size: 12px;"></i>
                                </div>
                                <div class="floating-icon" style="bottom: 20px; right: 25px;">
                                    <i class="fas fa-recycle" style="color: rgba(32, 178, 170, 0.4); font-size: 14px;"></i>
                                </div>
                            </div>
                            <!-- Elemen dekoratif lingkaran search dihilangkan -->
                            
                            <!-- Ilustrasi 3D dan ikon pencarian dihilangkan -->
                            
                            <form id="npwrSearchForm" class="position-relative">
                                <label for="npwrInput" class="input-label mini-label">Nomor Pokok Wajib Retribusi (NPWR )</label>
                                <div class="npwr-input-wrapper mb-1">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text search-prefix teal-bg"><i class="fas fa-search"></i></span>
                                        <input type="text" class="form-control custom-input" id="npwrInput" placeholder="Masukkan NPWR" required>
                                        <button class="btn btn-teal search-button" type="submit">
                                            <i class="fas fa-arrow-right btn-icon"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="text-center format-container">
                                    <div class="mini-format">
                                        <span class="format-example">NPWR-71.A.01.01.01.001</span>
                                    </div>
                                </div>
                            </form>
                            
                            <!-- Indikator pencarian aktif -->
                            <div class="search-indicator">
                                <div class="indicator-dot dot1"></div>
                                <div class="indicator-dot dot2"></div>
                                <div class="indicator-dot dot3"></div>
                            </div>
                        </div>
                        
                        <!-- Search Results (initially hidden) -->
                        <div id="searchResults" class="result-box">
                            <div class="npwr-info mb-4 text-dark">
                                <h4 id="wrName">Nama Wajib Retribusi</h4>
                                <p id="wrAddress" class="mb-1">Alamat lengkap wajib retribusi akan ditampilkan di sini</p>
                                <!-- <p id="wrCategory" class="mb-1">Kategori: <span class="badge bg-primary">Rumah Tangga</span></p> -->
                                <p id="wrNpwr" class="mb-0">NPWR: <strong>NPWR-12345678</strong></p>
                            </div>
                            
                            <h5 class="mt-4 mb-3">Riwayat Tagihan</h5>
                            <div class="payment-history">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Periode</th>
                                            <th>Tagihan</th>
                                            <th>Terbayar</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="paymentHistoryBody">
                                        <!-- Will be populated by JavaScript -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Features Section dengan Parallax -->
    <section class="parallax-section py-5">
        <div class="parallax-bg" style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('https://images.unsplash.com/photo-1621451537084-482c73073a0f?ixlib=rb-1.2.1&auto=format&fit=crop&w=2100&q=100');"></div>
        <div class="container position-relative">
            <h2 class="text-center mb-5 text-white">Fitur Layanan Retribusi Kebersihan</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card p-4 glass-effect">
                        <div class="text-center text-muted">
                            <div class="feature-icon animated-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h4 class="text-dark">Cek Tagihan Online</h4>
                            <p>Periksa tagihan retribusi sampah Anda kapan saja dan dimana saja dengan sistem online yang mudah.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 glass-effect">
                        <div class="text-center text-muted">
                            <div class="feature-icon animated-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <h4 class="text-dark">Pembayaran Transparan</h4>
                            <p>Riwayat pembayaran yang jelas dan transparan untuk memudahkan Anda memantau kewajiban retribusi.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card p-4 glass-effect">
                        <div class="text-center text-muted">
                            <div class="feature-icon animated-icon">
                                <i class="fas fa-recycle"></i>
                            </div>
                            <h4 class="text-dark">Dukung Lingkungan Bersih</h4>
                            <p>Pembayaran retribusi secara tepat waktu membantu menjaga kebersihan dan kelestarian lingkungan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Stats Section dengan Parallax -->
    <section class="stats-section position-relative">
        <div class="parallax-bg"></div>
        <div class="container position-relative">
            <h2 class="text-center mb-5">Dampak Positif Retribusi Kebersihan</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="stat-item glass-effect p-4">
                        <div class="stat-number" data-count="25000">0</div>
                        <div class="stat-label text-dark">Jumlah Wajib Retribusi</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item glass-effect p-4">
                        <div class="stat-number" data-count="98">0</div>
                        <div class="stat-label text-dark">Persentase Pembayaran Tepat Waktu</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-item glass-effect p-4">
                        <div class="stat-number" data-count="15">0</div>
                        <div class="stat-label text-dark">Kecamatan Terlayani</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer dengan Parallax -->
    <footer class="parallax-section py-5">
        <div class="parallax-bg" style="background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.8)), url('https://images.unsplash.com/photo-1503596476-1c12a8ba09a9?ixlib=rb-1.2.1&auto=format&fit=crop&w=2100&q=100');"></div>
        <div class="container position-relative">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="footer-logo mb-3">
                        <i class="fas fa-leaf fa-3x text-primary"></i>
                        <h4 class="d-inline-block ms-2 mb-0">Retribusi Kebersihan</h4>
                    </div>
                    <p>Melayani masyarakat dengan pengelolaan sampah yang berkualitas dan pelayanan retribusi yang transparan.</p>
                    <div class="social-icons mt-3">
                        <a href="#" class="me-2 social-icon-circle"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-2 social-icon-circle"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="me-2 social-icon-circle"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="me-2 social-icon-circle"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <h5 class="border-start border-primary ps-3 mb-4">Links</h5>
                    <ul class="list-unstyled footer-links">
                        <li class="mb-2"><a href="#"><i class="fas fa-chevron-right me-2 small"></i>Beranda</a></li>
                        <li class="mb-2"><a href="#"><i class="fas fa-chevron-right me-2 small"></i>Tentang Kami</a></li>
                        <li class="mb-2"><a href="#"><i class="fas fa-chevron-right me-2 small"></i>Layanan</a></li>
                        <li class="mb-2"><a href="#"><i class="fas fa-chevron-right me-2 small"></i>Kontak</a></li>
                    </ul>
                </div>
                <div class="col-md-5 mb-4">
                    <h5 class="border-start border-primary ps-3 mb-4">Hubungi Kami</h5>
                    <div class="d-flex mb-3 contact-item">
                        <div class="icon-box me-3">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <p class="mb-0">Jl. Persampahan No. 123, Kota</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3 contact-item">
                        <div class="icon-box me-3">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <p class="mb-0">(021) 1234-5678</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3 contact-item">
                        <div class="icon-box me-3">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <p class="mb-0">info@retribusisampah.go.id</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-4" style="border-color: rgba(255,255,255,0.1);">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-md-0">&copy; {{ date('Y') }} SIMLURAH - Aplikasi Retribusi Kebersihan. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="mb-0">Didukung oleh <a href="#" class="text-primary">Pemerintah Kota Makassar</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            // NPWR Search Form Submission
            $('#npwrSearchForm').on('submit', function(e) {
                e.preventDefault();
                
                const npwr = $('#npwrInput').val().trim();
                if (!npwr) return;
                
                // Show loading
                $('#searchResults').hide();
                
                // Simulate API call with setTimeout
                setTimeout(function() {
                    // This would be replaced with actual AJAX call to your backend
                    fetchNpwrData(npwr);
                }, 1000);
            });
            
            // Function to fetch NPWR data from API
            function fetchNpwrData(npwr) {
                // Make AJAX call to the search-npwr endpoint
                $.ajax({
                    url: '/search-npwr',
                    type: 'POST',
                    data: { npwr: npwr, _token: '{{ csrf_token() }}' },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            const data = response.data;
                            // Update the UI with the real data
                            updateResultsUI(data);
                        } else {
                            // Show error message
                            $('#searchResults').hide();
                            alert(response.message || 'NPWR tidak ditemukan');
                        }
                    },
                    error: function() {
                        $('#searchResults').hide();
                        alert('Terjadi kesalahan saat mencari data. Silahkan coba lagi.');
                    }
                });
            }
            
            // Update the UI with data from API
            function updateResultsUI(data) {
                $('#wrName').text(data.name);
                $('#wrAddress').text(data.address);
                $('#wrNpwr').html('NPWR: <strong>' + data.npwr + '</strong>');
                
                // Populate the payment history table
                const tableBody = $('#paymentHistoryBody');
                tableBody.empty();
                
                data.bills.forEach(function(bill) {
                    let statusClass = '';
                    if (bill.status === 'Lunas') {
                        statusClass = 'bg-success';
                    } else if (bill.status === 'Belum Lunas') {
                        statusClass = 'bg-danger';
                    } else {
                        statusClass = 'bg-warning';
                    }
                    
                    tableBody.append(`
                        <tr>
                            <td>${bill.period}</td>
                            <td>${bill.amount}</td>
                            <td>${bill.paid}</td>
                            <td><span class="badge ${statusClass}">${bill.status}</span></td>
                        </tr>
                    `);
                });
                
                // Show the results
                $('#searchResults').fadeIn();
            }
            
            // Animate counting for statistics
            function animateCounter() {
                $('.stat-number').each(function() {
                    const $this = $(this);
                    const countTo = parseInt($this.attr('data-count'));
                    
                    $({ countNum: 0 }).animate({
                        countNum: countTo
                    }, {
                        duration: 2000,
                        easing: 'swing',
                        step: function() {
                            $this.text(Math.floor(this.countNum));
                        },
                        complete: function() {
                            $this.text(this.countNum);
                            // Add percentage sign for the middle stat
                            if ($this.next().text().includes('Persentase')) {
                                $this.text(this.countNum + '%');
                            }
                        }
                    });
                });
            }
            
            // Check if element is in viewport
            function isScrolledIntoView(elem) {
                const docViewTop = $(window).scrollTop();
                const docViewBottom = docViewTop + $(window).height();
                const elemTop = $(elem).offset().top;
                const elemBottom = elemTop + $(elem).height();
                return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
            }
            
            // Trigger counter animation when stats section comes into view
            let counterTriggered = false;
            $(window).on('scroll', function() {
                if (!counterTriggered && isScrolledIntoView($('.stats-section'))) {
                    counterTriggered = true;
                    animateCounter();
                }
            });
            
            // Initial check in case stats are already in view
            if (isScrolledIntoView($('.stats-section'))) {
                animateCounter();
                counterTriggered = true;
            }
        });
    </script>
    
    <!-- Loading Script -->
    <script src="{{ asset('js/loading.js') }}"></script>
    
    <script>
    // Tampilkan loading overlay saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const loadingOverlay = document.getElementById('loading-overlay');
        if (loadingOverlay) {
            loadingOverlay.classList.add('visible');
        }
        
        // Sembunyikan loading overlay setelah semuanya selesai dimuat
        window.addEventListener('load', function() {
            if (typeof LoadingOverlay !== 'undefined') {
                LoadingOverlay.hide();
            } else if (loadingOverlay) {
                loadingOverlay.classList.remove('visible');
                loadingOverlay.style.display = 'none';
            }
        });
        
        // Fallback: sembunyikan loading setelah 5 detik
        setTimeout(function() {
            if (loadingOverlay) {
                loadingOverlay.classList.remove('visible');
                loadingOverlay.style.display = 'none';
            }
        }, 5000);
    });
    </script>
</body>
</html>
