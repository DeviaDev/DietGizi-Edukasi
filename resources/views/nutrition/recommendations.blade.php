@extends('nutrition.layouts.appnut')

@section('title', 'Panduan & Rekomendasi Gizi')


@push('styles')
    <style>
        /* ===================================
   NUTRITION CALCULATOR STYLES
   =================================== */

:root {
    --primary-color: #059669;
    --primary-dark: #047857;
    --primary-light: #d1fae5;
    --secondary-color: #3b82f6;
    --accent-color: #f59e0b;
    --danger-color: #ef4444;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    
    --text-dark: #1f2937;
    --text-muted: #6b7280;
    --text-light: #9ca3af;
    
    --border-color: #e5e7eb;
    --bg-gray: #f9fafb;
    --bg-white: #ffffff;
    
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    
    --radius-sm: 6px;
    --radius-md: 8px;
    --radius-lg: 12px;
    --radius-xl: 16px;
}

/* ===================================
   LAYOUT & CONTAINER
   =================================== */

.nutrition-calculator-wrapper {
    min-height: 100vh;
    background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
    padding-bottom: 4rem;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* ===================================
   HERO SECTION
   =================================== */

.hero-section {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: white;
    padding: 3rem 0;
    margin-bottom: 2rem;
    box-shadow: var(--shadow-lg);
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0 0 1rem 0;
    text-align: center;
    line-height: 1.2;
}

.hero-subtitle {
    font-size: 1.125rem;
    text-align: center;
    opacity: 0.95;
    max-width: 800px;
    margin: 0 auto;
    line-height: 1.6;
}

/* ===================================
   INFO CARDS
   =================================== */

.info-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.info-card {
    background: white;
    padding: 2rem;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    text-align: center;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.info-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
    border-color: var(--primary-light);
}

.info-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.info-card h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--text-dark);
    margin: 0 0 0.5rem 0;
}

.info-card p {
    color: var(--text-muted);
    font-size: 0.9375rem;
    margin-bottom: 1rem;
    line-height: 1.5;
}

.btn-learn {
    background: var(--primary-light);
    color: var(--primary-dark);
    border: none;
    padding: 0.625rem 1.25rem;
    border-radius: var(--radius-md);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    font-size: 0.875rem;
}

.btn-learn:hover {
    background: var(--primary-color);
    color: white;
    transform: scale(1.05);
}

/* ===================================
   CALCULATOR CARD
   =================================== */

.calculator-card {
    background: white;
    border-radius: var(--radius-xl);
    padding: 2.5rem;
    box-shadow: var(--shadow-lg);
    margin-bottom: 2rem;
}

.card-header-main {
    margin-bottom: 2rem;
    text-align: center;
    padding-bottom: 1.5rem;
    border-bottom: 2px solid var(--border-color);
}

.card-header-main h2 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0 0 0.5rem 0;
}

.card-header-main p {
    color: var(--text-muted);
    font-size: 1rem;
    margin: 0;
}

/* ===================================
   FORM SECTIONS
   =================================== */

.form-section {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: var(--bg-gray);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border-color);
}

.section-title-bar {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid var(--border-color);
}

.section-icon {
    font-size: 1.5rem;
}

.section-title-bar h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--text-dark);
    margin: 0;
}

/* ===================================
   FORM GRIDS
   =================================== */

.form-grid-2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.25rem;
}

.form-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.25rem;
}

/* ===================================
   FORM ELEMENTS
   =================================== */

.form-group {
    display: flex;
    flex-direction: column;
}

.form-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.required {
    color: var(--danger-color);
}

.info-tooltip {
    cursor: help;
    font-size: 0.875rem;
    color: var(--secondary-color);
}

.form-input,
.form-select {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 2px solid var(--border-color);
    border-radius: var(--radius-md);
    font-size: 0.9375rem;
    transition: all 0.2s;
    background: white;
    color: var(--text-dark);
}

.form-input:focus,
.form-select:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.1);
}

.form-input::placeholder {
    color: var(--text-light);
}

.form-select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3E%3Cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3E%3C/svg%3E");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.25rem;
    padding-right: 2.5rem;
}

.input-hint {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin-top: 0.375rem;
    font-style: italic;
}

/* ===================================
   FORM ACTIONS
   =================================== */

.form-actions {
    display: flex;
    gap: 1rem;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px solid var(--border-color);
}

.btn-submit,
.btn-reset {
    flex: 1;
    padding: 1rem 1.5rem;
    border: none;
    border-radius: var(--radius-md);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.btn-submit {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
    color: white;
    box-shadow: var(--shadow-md);
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-submit:active {
    transform: translateY(0);
}

.btn-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.btn-reset {
    background: white;
    color: var(--text-dark);
    border: 2px solid var(--border-color);
}

.btn-reset:hover {
    background: var(--bg-gray);
    border-color: var(--text-muted);
}

.btn-icon {
    flex-shrink: 0;
}

/* ===================================
   RESULTS SECTION
   =================================== */

.results-section {
    animation: fadeInUp 0.5s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.results-card {
    background: white;
    border-radius: var(--radius-xl);
    padding: 2rem;
    box-shadow: var(--shadow-md);
    margin-bottom: 1.5rem;
}

.results-header {
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--border-color);
}

.results-header h2 {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.card-title-result {
    font-size: 1.375rem;
    font-weight: 600;
    color: var(--text-dark);
    margin: 0 0 1.5rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.results-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

/* ===================================
   STATUS BADGES & METRICS
   =================================== */

.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    font-weight: 600;
    margin: 0.25rem;
}

.status-normal {
    background: #d1fae5;
    color: #065f46;
}

.status-warning {
    background: #fef3c7;
    color: #92400e;
}

.status-danger {
    background: #fee2e2;
    color: #991b1b;
}

.metric-box {
    background: var(--bg-gray);
    padding: 1.5rem;
    border-radius: var(--radius-lg);
    margin-bottom: 1rem;
    border-left: 4px solid var(--primary-color);
}

.metric-label {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--text-muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.5rem;
}

.metric-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.metric-description {
    font-size: 0.875rem;
    color: var(--text-muted);
    line-height: 1.5;
}

/* ===================================
   TABLES
   =================================== */

.data-table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
}

.data-table th,
.data-table td {
    padding: 0.75rem 1rem;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.data-table th {
    background: var(--bg-gray);
    font-weight: 600;
    color: var(--text-dark);
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.data-table td {
    font-size: 0.9375rem;
    color: var(--text-dark);
}

.data-table tr:last-child td {
    border-bottom: none;
}

.data-table tr:hover {
    background: var(--bg-gray);
}

/* ===================================
   RECOMMENDATIONS
   =================================== */

.recommendation-section {
    margin-bottom: 2rem;
}

.recommendation-category {
    background: var(--primary-light);
    padding: 1rem 1.5rem;
    border-radius: var(--radius-md);
    margin-bottom: 1rem;
    border-left: 4px solid var(--primary-color);
}

.recommendation-category h4 {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--primary-dark);
    margin: 0 0 1rem 0;
}

.recommendation-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.recommendation-list li {
    padding: 0.75rem 0;
    padding-left: 2rem;
    position: relative;
    line-height: 1.6;
    color: var(--text-dark);
}

.recommendation-list li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: var(--primary-color);
    font-weight: 700;
    font-size: 1.125rem;
}

.nutrition-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.nutrition-item {
    background: var(--bg-gray);
    padding: 1rem;
    border-radius: var(--radius-md);
    text-align: center;
}

.nutrition-item strong {
    display: block;
    font-size: 0.875rem;
    color: var(--text-muted);
    margin-bottom: 0.5rem;
}

.nutrition-item span {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary-color);
}

/* ===================================
   RESULTS ACTIONS
   =================================== */

.results-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    margin-top: 2rem;
}

.btn-action {
    flex: 1;
    min-width: 200px;
    padding: 0.875rem 1.5rem;
    border-radius: var(--radius-md);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.9375rem;
    text-decoration: none;
}

.btn-print {
    background: white;
    color: var(--text-dark);
    border: 2px solid var(--border-color);
}

.btn-print:hover {
    background: var(--bg-gray);
    border-color: var(--text-muted);
}

.btn-new {
    background: var(--secondary-color);
    color: white;
    border: none;
}

.btn-new:hover {
    background: #2563eb;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-recommendations {
    background: linear-gradient(135deg, var(--accent-color) 0%, #d97706 100%);
    color: white;
    border: none;
}

.btn-recommendations:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

/* ===================================
   MODAL
   =================================== */

.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    animation: fadeIn 0.3s;
}

.modal.show {
    display: flex;
    align-items: center;
    justify-content: center;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.modal-content {
    background: white;
    border-radius: var(--radius-xl);
    padding: 2rem;
    max-width: 700px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    box-shadow: var(--shadow-xl);
    animation: slideUp 0.3s;
}

@keyframes slideUp {
    from {
        transform: translateY(50px);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

.close-modal {
    position: absolute;
    top: 1rem;
    right: 1rem;
    font-size: 2rem;
    font-weight: 300;
    color: var(--text-muted);
    cursor: pointer;
    transition: color 0.2s;
    line-height: 1;
}

.close-modal:hover {
    color: var(--text-dark);
}

#educationContent h3 {
    font-size: 1.5rem;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

#educationContent h4 {
    font-size: 1.125rem;
    color: var(--primary-dark);
    margin: 1.5rem 0 0.75rem 0;
}

#educationContent p {
    line-height: 1.7;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

#educationContent ul {
    padding-left: 1.5rem;
    margin-bottom: 1rem;
}

#educationContent li {
    margin-bottom: 0.5rem;
    line-height: 1.6;
    color: var(--text-dark);
}

/* ===================================
   LOADING STATE
   =================================== */

.loading-spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    to {
        transform: rotate(360deg);
    }
}

/* ===================================
   RESPONSIVE DESIGN
   =================================== */

@media (max-width: 1024px) {
    .form-grid-3 {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }

    .hero-subtitle {
        font-size: 1rem;
    }

    .info-cards-grid {
        grid-template-columns: 1fr;
    }

    .form-grid-2,
    .form-grid-3 {
        grid-template-columns: 1fr;
    }

    .calculator-card {
        padding: 1.5rem;
    }

    .form-section {
        padding: 1rem;
    }

    .form-actions {
        flex-direction: column;
    }

    .results-grid {
        grid-template-columns: 1fr;
    }

    .results-actions {
        flex-direction: column;
    }

    .btn-action {
        min-width: 100%;
    }

    .modal-content {
        width: 95%;
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 1.5rem;
    }

    .hero-section {
        padding: 2rem 0;
    }

    .card-header-main h2 {
        font-size: 1.5rem;
    }

    .metric-value {
        font-size: 1.5rem;
    }
}

/* ===================================
   PRINT STYLES
   =================================== */

@media print {
    .hero-section,
    .info-cards-grid,
    .form-actions,
    .results-actions,
    .btn-learn {
        display: none;
    }

    .results-section {
        box-shadow: none;
    }

    .results-card {
        page-break-inside: avoid;
        box-shadow: none;
        border: 1px solid #ddd;
    }
}



        .guide-section {
            background: white;
            border-radius: var(--radius-xl);
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
        }

        .guide-section h2 {
            color: var(--primary-dark);
            font-size: 1.75rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .guide-section h3 {
            color: var(--text-dark);
            font-size: 1.375rem;
            margin: 1.5rem 0 1rem 0;
        }

        .guide-section h4 {
            color: var(--text-dark);
            font-size: 1.125rem;
            margin: 1rem 0 0.5rem 0;
        }

        .condition-card {
            background: var(--bg-gray);
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--primary-color);
        }

        .condition-card.warning {
            border-left-color: var(--warning-color);
            background: #fef3c7;
        }

        .condition-card.danger {
            border-left-color: var(--danger-color);
            background: #fee2e2;
        }

        .food-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }

        .food-card {
            background: white;
            padding: 1.25rem;
            border-radius: var(--radius-md);
            border: 2px solid var(--border-color);
            transition: all 0.2s;
        }

        .food-card:hover {
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        .food-card h5 {
            color: var(--primary-dark);
            font-size: 1rem;
            margin: 0 0 0.75rem 0;
        }

        .food-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .food-list li {
            padding: 0.375rem 0;
            padding-left: 1.25rem;
            position: relative;
            font-size: 0.9375rem;
            color: var(--text-dark);
        }

        .food-list li::before {
            content: "•";
            position: absolute;
            left: 0;
            color: var(--primary-color);
            font-weight: 700;
        }

        .alert-box {
            background: #fef3c7;
            border: 2px solid #f59e0b;
            border-radius: var(--radius-md);
            padding: 1rem 1.25rem;
            margin: 1.5rem 0;
            display: flex;
            gap: 0.75rem;
        }

        .alert-icon {
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .alert-content h4 {
            margin: 0 0 0.5rem 0;
            color: #92400e;
            font-size: 1rem;
        }

        .alert-content p {
            margin: 0;
            color: #78350f;
            font-size: 0.9375rem;
            line-height: 1.6;
        }

        .quick-nav {
            background: var(--primary-light);
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            margin-bottom: 2rem;
        }

        .quick-nav h3 {
            margin: 0 0 1rem 0;
            color: var(--primary-dark);
        }

        .quick-nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .quick-nav-link {
            background: white;
            color: var(--primary-dark);
            padding: 0.625rem 1.25rem;
            border-radius: var(--radius-md);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            font-size: 0.9375rem;
        }

        .quick-nav-link:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-sm);
        }

        @media (max-width: 768px) {
            .food-grid {
                grid-template-columns: 1fr;
            }
            
            .quick-nav-links {
                flex-direction: column;
            }
        }



        /* ===================================
   SCROLL TO TOP BUTTON
=================================== */

#scrollToTopBtn {
    position: fixed;
    bottom: 90px; /* aman kalau nanti ada floating nav */
    right: 24px;
    width: 52px;
    height: 52px;
    border-radius: 50%;
    border: none;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: white;
    font-size: 1.4rem;
    cursor: pointer;
    box-shadow: var(--shadow-lg);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 999;
}

#scrollToTopBtn:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
}

#scrollToTopBtn.show {
    opacity: 1;
    visibility: visible;
}

/* Mobile adjustment */
@media (max-width: 480px) {
    #scrollToTopBtn {
        width: 46px;
        height: 46px;
        font-size: 1.2rem;
        bottom: 80px;
        right: 16px;
    }
}

    </style>
@endpush

@section('content')
<div class="nutrition-calculator-wrapper">
    <div class="hero-section">
        <div class="container">
            <h1 class="hero-title">Panduan Lengkap Gizi & Nutrisi</h1>
            <p class="hero-subtitle">
                Rekomendasi diet, panduan makanan, dan tips kesehatan berdasarkan kondisi tubuh Anda
            </p>
        </div>
    </div>

    <div class="container">
        <!-- Quick Navigation -->
        <div class="quick-nav">
            <h3>📑 Navigasi Cepat</h3>
            <div class="quick-nav-links">
                <a href="#gizi-kurang" class="quick-nav-link">Gizi Kurang</a>
                <a href="#gizi-lebih" class="quick-nav-link">Gizi Lebih/Obesitas</a>
                <a href="#diabetes" class="quick-nav-link">Diabetes</a>
                <a href="#hipertensi" class="quick-nav-link">Hipertensi</a>
                <a href="#kolesterol" class="quick-nav-link">Kolesterol Tinggi</a>
                <a href="#lansia" class="quick-nav-link">Lansia</a>
                <a href="#anak" class="quick-nav-link">Anak & Remaja</a>
                <a href="#ibu-hamil" class="quick-nav-link">Ibu Hamil</a>
            </div>
        </div>

        <!-- Gizi Kurang -->
        <div class="guide-section" id="gizi-kurang">
            <h2>🍽️ Panduan untuk Gizi Kurang / Berat Badan Rendah</h2>
            
            <div class="condition-card danger">
                <h3 style="margin-top: 0;">Tanda-tanda Gizi Kurang:</h3>
                <ul>
                    <li>IMT < 18.5 (dewasa) atau persentil berat badan < 5% (anak)</li>
                    <li>LILA < 23 cm (pria) atau < 22 cm (wanita)</li>
                    <li>Penurunan berat badan tidak disengaja > 5% dalam 1 bulan</li>
                    <li>Kelelahan berlebihan, lemah, mudah sakit</li>
                    <li>Rambut rontok, kulit kering, kuku rapuh</li>
                </ul>
            </div>

            <h3>Strategi Peningkatan Berat Badan Sehat:</h3>
            
            <div class="condition-card">
                <h4>1. Tingkatkan Asupan Kalori (500-750 kkal/hari)</h4>
                <ul class="recommendation-list">
                    <li>Makan 5-6 kali sehari dengan porsi lebih kecil</li>
                    <li>Pilih makanan padat nutrisi dan kalori tinggi</li>
                    <li>Tambahkan cemilan sehat di antara waktu makan</li>
                    <li>Minum kalori tambahan (smoothie, jus buah, susu)</li>
                </ul>
            </div>

            <h4>Makanan yang Direkomendasikan:</h4>
            <div class="food-grid">
                <div class="food-card">
                    <h5>🥩 Protein Tinggi</h5>
                    <ul class="food-list">
                        <li>Daging sapi, ayam, ikan</li>
                        <li>Telur (2-3 butir/hari)</li>
                        <li>Kacang-kacangan dan biji-bijian</li>
                        <li>Tahu, tempe</li>
                        <li>Susu, yogurt, keju</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🍚 Karbohidrat Kompleks</h5>
                    <ul class="food-list">
                        <li>Nasi, roti gandum</li>
                        <li>Kentang, ubi, singkong</li>
                        <li>Pasta, mie</li>
                        <li>Oatmeal</li>
                        <li>Quinoa, barley</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🥑 Lemak Sehat</h5>
                    <ul class="food-list">
                        <li>Alpukat</li>
                        <li>Kacang almond, walnut</li>
                        <li>Minyak zaitun</li>
                        <li>Ikan salmon, tuna</li>
                        <li>Selai kacang</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🥛 Minuman Tinggi Kalori</h5>
                    <ul class="food-list">
                        <li>Susu full cream</li>
                        <li>Smoothie buah dengan yogurt</li>
                        <li>Jus buah segar</li>
                        <li>Milkshake</li>
                        <li>Protein shake</li>
                    </ul>
                </div>
            </div>

            <div class="alert-box">
                <span class="alert-icon">⚠️</span>
                <div class="alert-content">
                    <h4>Perhatian Penting:</h4>
                    <p>Jika berat badan terus turun meski sudah menambah asupan, segera konsultasi ke dokter. Bisa jadi ada masalah kesehatan yang mendasari seperti gangguan tiroid, diabetes, atau malabsorpsi.</p>
                </div>
            </div>
        </div>

        <!-- Gizi Lebih / Obesitas -->
        <div class="guide-section" id="gizi-lebih">
            <h2>⚖️ Panduan untuk Gizi Lebih / Obesitas</h2>

            <div class="condition-card warning">
                <h3 style="margin-top: 0;">Klasifikasi Kelebihan Berat Badan:</h3>
                <ul>
                    <li>Overweight: IMT 25.0 - 29.9</li>
                    <li>Obesitas Kelas I: IMT 30.0 - 34.9</li>
                    <li>Obesitas Kelas II: IMT 35.0 - 39.9</li>
                    <li>Obesitas Kelas III (Morbid): IMT ≥ 40.0</li>
                </ul>
            </div>

            <h3>Strategi Penurunan Berat Badan Sehat:</h3>

            <div class="condition-card">
                <h4>1. Defisit Kalori Terkontrol (500-750 kkal/hari)</h4>
                <ul class="recommendation-list">
                    <li>Target penurunan 0.5-1 kg per minggu (aman dan sustainable)</li>
                    <li>Hitung kebutuhan kalori harian, kurangi 500-750 kkal</li>
                    <li>Fokus pada kualitas makanan, bukan hanya kuantitas</li>
                    <li>Tetap makan 3x sehari, hindari melewatkan makan</li>
                </ul>
            </div>

            <div class="condition-card">
                <h4>2. Pola Makan Sehat</h4>
                <ul class="recommendation-list">
                    <li>Isi 1/2 piring dengan sayuran</li>
                    <li>1/4 piring protein tanpa lemak</li>
                    <li>1/4 piring karbohidrat kompleks</li>
                    <li>Minum 8-10 gelas air putih per hari</li>
                    <li>Batasi gula tambahan < 25g/hari</li>
                </ul>
            </div>

            <h4>Makanan yang Direkomendasikan:</h4>
            <div class="food-grid">
                <div class="food-card">
                    <h5>🥗 Sayuran (Unlimited)</h5>
                    <ul class="food-list">
                        <li>Bayam, kangkung, sawi</li>
                        <li>Brokoli, kembang kol</li>
                        <li>Wortel, tomat, timun</li>
                        <li>Kacang panjang, buncis</li>
                        <li>Jamur berbagai jenis</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🍎 Buah-buahan</h5>
                    <ul class="food-list">
                        <li>Apel, pir (2-3 porsi/hari)</li>
                        <li>Jeruk, pepaya</li>
                        <li>Melon, semangka</li>
                        <li>Stroberi, blueberry</li>
                        <li>Hindari jus (makan buah utuh)</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🍗 Protein Rendah Lemak</h5>
                    <ul class="food-list">
                        <li>Dada ayam tanpa kulit</li>
                        <li>Ikan (panggang/kukus)</li>
                        <li>Putih telur</li>
                        <li>Tahu, tempe</li>
                        <li>Kacang-kacangan (porsi kecil)</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🌾 Karbohidrat Kompleks</h5>
                    <ul class="food-list">
                        <li>Nasi merah (1/2-3/4 cup)</li>
                        <li>Roti gandum utuh</li>
                        <li>Oatmeal</li>
                        <li>Kentang rebus</li>
                        <li>Ubi, jagung</li>
                    </ul>
                </div>
            </div>

            <h4>Makanan yang Harus Dihindari/Dibatasi:</h4>
            <div class="condition-card danger">
                <ul class="recommendation-list">
                    <li>❌ Gorengan dan makanan berlemak tinggi</li>
                    <li>❌ Minuman manis (soda, teh manis, jus kemasan)</li>
                    <li>❌ Fast food dan junk food</li>
                    <li>❌ Kue, pastry, donat</li>
                    <li>❌ Es krim, permen, coklat</li>
                    <li>❌ Makanan olahan tinggi natrium</li>
                    <li>❌ Alkohol</li>
                </ul>
            </div>

            <div class="condition-card">
                <h4>3. Aktivitas Fisik</h4>
                <ul class="recommendation-list">
                    <li>Minimal 150 menit/minggu aktivitas aerobik sedang</li>
                    <li>Atau 75 menit/minggu aktivitas berat</li>
                    <li>Contoh: jalan cepat, jogging, bersepeda, berenang</li>
                    <li>Tambahkan strength training 2-3x/minggu</li>
                    <li>Tingkatkan aktivitas harian (naik tangga, parkir jauh)</li>
                </ul>
            </div>
        </div>

        <!-- Diabetes -->
        <div class="guide-section" id="diabetes">
            <h2>🩸 Panduan untuk Diabetes Mellitus</h2>

            <div class="condition-card warning">
                <h3 style="margin-top: 0;">Prinsip Diet Diabetes:</h3>
                <ul>
                    <li>Kontrol asupan karbohidrat (konsisten setiap makan)</li>
                    <li>Pilih karbohidrat kompleks dengan indeks glikemik rendah</li>
                    <li>Makan dalam porsi kecil tapi sering</li>
                    <li>Tinggi serat (25-30 gram/hari)</li>
                    <li>Batasi gula sederhana dan makanan olahan</li>
                </ul>
            </div>

            <h3>Panduan Karbohidrat:</h3>
            <div class="food-grid">
                <div class="food-card">
                    <h5>✅ Karbohidrat yang Dianjurkan</h5>
                    <ul class="food-list">
                        <li>Nasi merah, beras hitam</li>
                        <li>Roti gandum utuh</li>
                        <li>Oatmeal</li>
                        <li>Ubi, kentang rebus</li>
                        <li>Quinoa, barley</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>❌ Karbohidrat yang Dihindari</h5>
                    <ul class="food-list">
                        <li>Nasi putih</li>
                        <li>Roti putih</li>
                        <li>Mie instan</li>
                        <li>Kue, pastry</li>
                        <li>Sereal manis</li>
                    </ul>
                </div>
            </div>

            <div class="condition-card">
                <h4>Porsi Makan (Metode Piring):</h4>
                <ul class="recommendation-list">
                    <li>1/2 piring: Sayuran non-starchy</li>
                    <li>1/4 piring: Protein tanpa lemak</li>
                    <li>1/4 piring: Karbohidrat kompleks</li>
                    <li>Tambahkan buah kecil atau produk susu rendah lemak</li>
                </ul>
            </div>

            <h4>Makanan Penurun Gula Darah:</h4>
            <div class="food-grid">
                <div class="food-card">
                    <h5>🥬 Sayuran Hijau</h5>
                    <ul class="food-list">
                        <li>Bayam, kangkung</li>
                        <li>Brokoli, kembang kol</li>
                        <li>Kacang panjang</li>
                        <li>Pare (paling efektif)</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🥜 Kacang-kacangan</h5>
                    <ul class="food-list">
                        <li>Kacang almond</li>
                        <li>Kacang merah</li>
                        <li>Kacang hijau</li>
                        <li>Edamame</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🐟 Protein Berkualitas</h5>
                    <ul class="food-list">
                        <li>Ikan (salmon, tuna)</li>
                        <li>Dada ayam</li>
                        <li>Telur</li>
                        <li>Tahu, tempe</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🌿 Rempah & Bumbu</h5>
                    <ul class="food-list">
                        <li>Kayu manis</li>
                        <li>Kunyit</li>
                        <li>Jahe</li>
                        <li>Bawang putih</li>
                    </ul>
                </div>
            </div>

            <div class="alert-box">
                <span class="alert-icon">⚠️</span>
                <div class="alert-content">
                    <h4>Penting untuk Diabetes:</h4>
                    <p>Monitor gula darah secara rutin. Konsultasikan perubahan diet dengan dokter atau ahli gizi, terutama jika menggunakan insulin atau obat diabetes. Jangan skip makan untuk menghindari hipoglikemia.</p>
                </div>
            </div>
        </div>

        <!-- Hipertensi -->
        <div class="guide-section" id="hipertensi">
            <h2>❤️ Panduan untuk Hipertensi (Darah Tinggi)</h2>

            <div class="condition-card warning">
                <h3 style="margin-top: 0;">Prinsip Diet DASH (Dietary Approaches to Stop Hypertension):</h3>
                <ul>
                    <li>Batasi natrium < 2300 mg/hari (ideal < 1500 mg/hari)</li>
                    <li>Tinggi kalium, kalsium, magnesium</li>
                    <li>Tinggi serat dan rendah lemak jenuh</li>
                    <li>Hindari makanan olahan dan kalengan</li>
                    <li>Batasi alkohol dan kafein</li>
                </ul>
            </div>

            <h4>Makanan Penurun Tekanan Darah:</h4>
            <div class="food-grid">
                <div class="food-card">
                    <h5>🍌 Tinggi Kalium</h5>
                    <ul class="food-list">
                        <li>Pisang (400mg kalium)</li>
                        <li>Kentang, ubi</li>
                        <li>Bayam, kangkung</li>
                        <li>Alpukat</li>
                        <li>Tomat</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🥛 Tinggi Kalsium</h5>
                    <ul class="food-list">
                        <li>Susu rendah lemak</li>
                        <li>Yogurt</li>
                        <li>Keju rendah sodium</li>
                        <li>Tahu</li>
                        <li>Kale, brokoli</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🌰 Tinggi Magnesium</h5>
                    <ul class="food-list">
                        <li>Kacang almond</li>
                        <li>Bayam</li>
                        <li>Kacang hitam</li>
                        <li>Biji labu</li>
                        <li>Dark chocolate (85%)</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🫐 Antioksidan Tinggi</h5>
                    <ul class="food-list">
                        <li>Blueberry</li>
                        <li>Stroberi</li>
                        <li>Bit merah</li>
                        <li>Delima</li>
                        <li>Teh hijau</li>
                    </ul>
                </div>
            </div>

            <h4>Makanan yang Harus Dihindari:</h4>
            <div class="condition-card danger">
                <ul class="recommendation-list">
                    <li>❌ Garam berlebihan (bumbu penyedap, kecap asin)</li>
                    <li>❌ Makanan kalengan dan olahan</li>
                    <li>❌ Fast food dan junk food</li>
                    <li>❌ Daging olahan (sosis, ham, bacon)</li>
                    <li>❌ Acar, asinan</li>
                    <li>❌ Snack asin (keripik, kacang asin)</li>
                    <li>❌ Alkohol berlebihan</li>
                    <li>❌ Kafein berlebihan</li>
                </ul>
            </div>

            <div class="condition-card">
                <h4>Tips Mengurangi Natrium:</h4>
                <ul class="recommendation-list">
                    <li>Masak sendiri, hindari makanan siap saji</li>
                    <li>Ganti garam dengan rempah dan bumbu alami</li>
                    <li>Baca label nutrisi, pilih produk rendah sodium</li>
                    <li>Bilas makanan kalengan sebelum dimasak</li>
                    <li>Gunakan perasan lemon/jeruk nipis untuk rasa</li>
                </ul>
            </div>
        </div>

        <!-- Kolesterol -->
        <div class="guide-section" id="kolesterol">
            <h2>🧬 Panduan untuk Kolesterol Tinggi</h2>

            <div class="condition-card warning">
                <h3 style="margin-top: 0;">Target Kolesterol:</h3>
                <ul>
                    <li>Kolesterol Total: < 200 mg/dL</li>
                    <li>LDL (kolesterol jahat): < 100 mg/dL</li>
                    <li>HDL (kolesterol baik): > 60 mg/dL</li>
                    <li>Trigliserida: < 150 mg/dL</li>
                </ul>
            </div>

            <h3>Prinsip Diet untuk Menurunkan Kolesterol:</h3>
            <div class="condition-card">
                <ul class="recommendation-list">
                    <li>Batasi lemak jenuh < 7% dari total kalori</li>
                    <li>Hindari trans fat sepenuhnya</li>
                    <li>Tingkatkan serat larut (10-25 gram/hari)</li>
                    <li>Konsumsi omega-3 (ikan 2x/minggu)</li>
                    <li>Batasi kolesterol makanan < 200 mg/hari</li>
                </ul>
            </div>

            <h4>Makanan Penurun Kolesterol:</h4>
            <div class="food-grid">
                <div class="food-card">
                    <h5>🥣 Serat Larut Tinggi</h5>
                    <ul class="food-list">
                        <li>Oatmeal, oat bran</li>
                        <li>Kacang merah, hitam</li>
                        <li>Apel, pir (dengan kulit)</li>
                        <li>Barley</li>
                        <li>Psyllium husk</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🐟 Omega-3 Tinggi</h5>
                    <ul class="food-list">
                        <li>Salmon</li>
                        <li>Tuna, makarel</li>
                        <li>Sarden</li>
                        <li>Ikan teri</li>
                        <li>Biji chia, flaxseed</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🌰 Kacang & Biji</h5>
                    <ul class="food-list">
                        <li>Almond (23 butir/hari)</li>
                        <li>Walnut</li>
                        <li>Pistachio</li>
                        <li>Biji labu</li>
                        <li>Kacang tanah</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🥑 Lemak Sehat</h5>
                    <ul class="food-list">
                        <li>Alpukat</li>
                        <li>Minyak zaitun extra virgin</li>
                        <li>Minyak kanola</li>
                        <li>Minyak wijen</li>
                    </ul>
                </div>
            </div>

            <h4>Makanan yang Harus Dihindari:</h4>
            <div class="condition-card danger">
                <ul class="recommendation-list">
                    <li>❌ Daging berlemak (sapi, kambing)</li>
                    <li>❌ Kulit ayam</li>
                    <li>❌ Jeroan (hati, otak, usus)</li>
                    <li>❌ Kuning telur berlebihan (max 2-3/minggu)</li>
                    <li>❌ Produk susu full fat</li>
                    <li>❌ Mentega, margarin</li>
                    <li>❌ Gorengan</li>
                    <li>❌ Fast food, junk food</li>
                    <li>❌ Kue, pastry, biskuit</li>
                </ul>
            </div>
        </div>

        <!-- Lansia -->
        <div class="guide-section" id="lansia">
            <h2>👴 Panduan Gizi untuk Lansia (≥60 tahun)</h2>

            <div class="condition-card">
                <h3 style="margin-top: 0;">Kebutuhan Khusus Lansia:</h3>
                <ul>
                    <li>Protein lebih tinggi (1.0-1.2 g/kg BB) untuk mencegah sarcopenia</li>
                    <li>Kalsium & Vitamin D untuk kesehatan tulang</li>
                    <li>Vitamin B12 (sering defisit pada lansia)</li>
                    <li>Serat tinggi untuk pencernaan</li>
                    <li>Hidrasi adekuat (sering kurang haus)</li>
                </ul>
            </div>

            <h4>Makanan yang Direkomendasikan:</h4>
            <div class="food-grid">
                <div class="food-card">
                    <h5>🥩 Protein Berkualitas</h5>
                    <ul class="food-list">
                        <li>Daging tanpa lemak</li>
                        <li>Ikan (mudah dicerna)</li>
                        <li>Telur</li>
                        <li>Tahu, tempe</li>
                        <li>Susu, yogurt</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🦴 Tinggi Kalsium</h5>
                    <ul class="food-list">
                        <li>Susu rendah lemak</li>
                        <li>Yogurt</li>
                        <li>Keju</li>
                        <li>Ikan teri, sarden</li>
                        <li>Tahu, kale</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🌞 Sumber Vitamin D</h5>
                    <ul class="food-list">
                        <li>Ikan berlemak</li>
                        <li>Telur (kuning)</li>
                        <li>Susu fortifikasi</li>
                        <li>Jamur shiitake</li>
                        <li>Suplemen jika perlu</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🧠 Brain Food</h5>
                    <ul class="food-list">
                        <li>Ikan salmon (omega-3)</li>
                        <li>Blueberry (antioksidan)</li>
                        <li>Walnut</li>
                        <li>Dark chocolate</li>
                        <li>Kunyit</li>
                    </ul>
                </div>
            </div>

            <div class="condition-card">
                <h4>Tips Praktis untuk Lansia:</h4>
                <ul class="recommendation-list">
                    <li>Potong makanan kecil-kecil untuk mudah dikunyah</li>
                    <li>Masak hingga lunak untuk yang sulit menelan</li>
                    <li>Makan porsi kecil tapi sering (5-6x/hari)</li>
                    <li>Minum air 6-8 gelas/hari (jangan tunggu haus)</li>
                    <li>Hindari makanan keras atau lengket jika ada masalah gigi</li>
                    <li>Aktivitas fisik ringan (jalan pagi, senam lansia)</li>
                </ul>
            </div>

            <div class="alert-box">
                <span class="alert-icon">💊</span>
                <div class="alert-content">
                    <h4>Perhatian Obat-obatan:</h4>
                    <p>Banyak lansia mengonsumsi obat rutin. Beberapa makanan dapat berinteraksi dengan obat. Konsultasikan diet Anda dengan dokter, terutama jika mengonsumsi warfarin, statin, atau obat darah tinggi.</p>
                </div>
            </div>
        </div>

        <!-- Anak & Remaja -->
        <div class="guide-section" id="anak">
            <h2>👶 Panduan Gizi untuk Anak & Remaja</h2>

            <div class="condition-card">
                <h3 style="margin-top: 0;">Prinsip Gizi Seimbang Anak:</h3>
                <ul>
                    <li>Variasi makanan dari semua kelompok</li>
                    <li>Protein untuk pertumbuhan</li>
                    <li>Kalsium untuk tulang dan gigi</li>
                    <li>Zat besi untuk mencegah anemia</li>
                    <li>Batasi gula, garam, dan lemak jenuh</li>
                </ul>
            </div>

            <h4>Makanan untuk Pertumbuhan Optimal:</h4>
            <div class="food-grid">
                <div class="food-card">
                    <h5>🥛 Susu & Produk Turunan</h5>
                    <ul class="food-list">
                        <li>Susu (2-3 gelas/hari)</li>
                        <li>Yogurt</li>
                        <li>Keju</li>
                        <li>Kefir</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🍖 Protein Pertumbuhan</h5>
                    <ul class="food-list">
                        <li>Daging, ayam, ikan</li>
                        <li>Telur</li>
                        <li>Kacang-kacangan</li>
                        <li>Tahu, tempe</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🥦 Sayuran (3-5 porsi/hari)</h5>
                    <ul class="food-list">
                        <li>Brokoli, wortel</li>
                        <li>Bayam, kale</li>
                        <li>Tomat, paprika</li>
                        <li>Kacang polong</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🍊 Buah (2-4 porsi/hari)</h5>
                    <ul class="food-list">
                        <li>Jeruk, apel, pisang</li>
                        <li>Pepaya, mangga</li>
                        <li>Stroberi, blueberry</li>
                        <li>Melon, semangka</li>
                    </ul>
                </div>
            </div>

            <h4>Batasi/Hindari:</h4>
            <div class="condition-card danger">
                <ul class="recommendation-list">
                    <li>❌ Minuman bersoda dan manis</li>
                    <li>❌ Fast food dan junk food</li>
                    <li>❌ Permen, coklat berlebihan</li>
                    <li>❌ Snack tinggi garam</li>
                    <li>❌ Gorengan berlebihan</li>
                    <li>⚠️ Screen time saat makan (fokus pada makanan)</li>
                </ul>
            </div>

            <div class="condition-card">
                <h4>Tips Mendorong Kebiasaan Makan Sehat:</h4>
                <ul class="recommendation-list">
                    <li>Jadilah role model (orang tua makan sehat)</li>
                    <li>Libatkan anak dalam memilih dan menyiapkan makanan</li>
                    <li>Buat makanan sehat terlihat menarik</li>
                    <li>Makan bersama keluarga</li>
                    <li>Puji ketika anak mencoba makanan baru</li>
                    <li>Jangan gunakan makanan sebagai reward/punishment</li>
                </ul>
            </div>
        </div>

        <!-- Ibu Hamil -->
        <div class="guide-section" id="ibu-hamil">
            <h2>🤰 Panduan Gizi untuk Ibu Hamil</h2>

            <div class="condition-card warning">
                <h3 style="margin-top: 0;">Kebutuhan Tambahan Saat Hamil:</h3>
                <ul>
                    <li>Trimester 1: +0-150 kkal/hari</li>
                    <li>Trimester 2: +350 kkal/hari</li>
                    <li>Trimester 3: +450 kkal/hari</li>
                    <li>Asam folat: 400-800 mcg/hari</li>
                    <li>Zat besi: 27 mg/hari</li>
                    <li>Kalsium: 1000-1300 mg/hari</li>
                    <li>Protein: tambahan 25 gram/hari</li>
                </ul>
            </div>

            <h4>Nutrisi Penting untuk Ibu Hamil:</h4>
            <div class="food-grid">
                <div class="food-card">
                    <h5>🥬 Asam Folat</h5>
                    <ul class="food-list">
                        <li>Bayam, kale</li>
                        <li>Brokoli, asparagus</li>
                        <li>Kacang-kacangan</li>
                        <li>Jeruk, alpukat</li>
                        <li>Suplemen jika perlu</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🥩 Zat Besi</h5>
                    <ul class="food-list">
                        <li>Daging merah</li>
                        <li>Hati ayam (tidak berlebihan)</li>
                        <li>Bayam</li>
                        <li>Kacang-kacangan</li>
                        <li>Suplemen Fe jika anemia</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🥛 Kalsium</h5>
                    <ul class="food-list">
                        <li>Susu</li>
                        <li>Yogurt</li>
                        <li>Keju</li>
                        <li>Ikan teri</li>
                        <li>Tahu, tempe</li>
                    </ul>
                </div>

                <div class="food-card">
                    <h5>🐟 Omega-3 (DHA)</h5>
                    <ul class="food-list">
                        <li>Salmon (2x/minggu)</li>
                        <li>Sarden</li>
                        <li>Telur omega-3</li>
                        <li>Biji chia</li>
                        <li>Suplemen minyak ikan</li>
                    </ul>
                </div>
            </div>

            <h4>Makanan yang Harus Dihindari:</h4>
            <div class="condition-card danger">
                <ul class="recommendation-list">
                    <li>❌ Ikan tinggi merkuri (tuna besar, hiu, makarel raja)</li>
                    <li>❌ Daging/telur mentah atau setengah matang</li>
                    <li>❌ Susu dan keju unpasteurized</li>
                    <li>❌ Alkohol (sama sekali)</li>
                    <li>❌ Kafein berlebihan (max 200mg/hari)</li>
                    <li>❌ Hati berlebihan (vitamin A tinggi)</li>
                    <li>❌ Makanan laut mentah (sushi mentah)</li>
                </ul>
            </div>

            <div class="alert-box">
                <span class="alert-icon">⚠️</span>
                <div class="alert-content">
                    <h4>Morning Sickness:</h4>
                    <p>Jika mengalami mual muntah, makan porsi kecil tapi sering, hindari makanan berminyak dan berbau menyengat, konsumsi jahe, dan makan biskuit kering sebelum bangun tidur. Jika muntah berlebihan, segera konsultasi dokter.</p>
                </div>
            </div>
        </div>

        <!-- Back to Calculator -->
        {{-- <div style="text-align: center; margin-top: 3rem;">
            <a href="{{ route('nutrition.calculator') }}" class="btn-action btn-new" style="display: inline-flex;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M15 18l-6-6 6-6"></path>
                </svg>
                Kembali ke Kalkulator
            </a>
        </div> --}}

        <!-- Scroll To Top Button -->
<button id="scrollToTopBtn" title="Kembali ke atas">
    ⬆
</button>

    </div>
</div>

@endsection

@push('scripts')
<script>
    const scrollToTopBtn = document.getElementById('scrollToTopBtn');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 400) {
            scrollToTopBtn.classList.add('show');
        } else {
            scrollToTopBtn.classList.remove('show');
        }
    });

    scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
</script>
@endpush
