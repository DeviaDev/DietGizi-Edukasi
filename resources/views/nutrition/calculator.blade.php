@extends('nutrition.layouts.appnut')

@section('title', 'Cek Status Gizi')

@push('styles')
    <style>
        /* ===================================
   NUTRITION CALCULATOR STYLES
   =================================== */

/* ===================================
   NUTRITION CALCULATOR - USER FRIENDLY STYLES
   Updated with better readability and visual hierarchy
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
   BASE STYLES
   =================================== */

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: var(--text-dark);
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
   ALERTS
   =================================== */

.alert {
    padding: 1rem 1.25rem;
    border-radius: var(--radius-md);
    margin-bottom: 1rem;
    border-left: 4px solid;
}

.alert strong {
    display: block;
    margin-bottom: 0.5rem;
}

.alert ul {
    margin: 0.5rem 0 0 1.5rem;
}

.alert li {
    margin: 0.25rem 0;
}

.alert-info {
    background: #dbeafe;
    border-color: #3b82f6;
    color: #1e40af;
}

.alert-warning {
    background: #fef3c7;
    border-color: #f59e0b;
    color: #92400e;
}

.alert-success {
    background: #d1fae5;
    border-color: #10b981;
    color: #065f46;
}

.alert-danger {
    background: #fee2e2;
    border-color: #ef4444;
    color: #991b1b;
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

.summary-highlight {
    background: linear-gradient(135deg, #f0fdf4 0%, #ecfdf5 100%);
    border: 2px solid var(--primary-color);
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

.card-title-result .icon {
    font-size: 1.5rem;
}

.card-subtitle {
    color: var(--text-muted);
    font-size: 0.9375rem;
    margin-bottom: 1.5rem;
    font-style: italic;
}

.results-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

/* ===================================
   SUMMARY BOX
   =================================== */

.summary-box {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    padding: 1.5rem;
    border-radius: var(--radius-lg);
    margin: 1rem 0;
}

.summary-box h3 {
    color: #065f46;
    margin-bottom: 1rem;
    font-size: 1.25rem;
}

.summary-box p {
    margin: 0.5rem 0;
    line-height: 1.8;
}

.summary-box strong {
    color: var(--text-dark);
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

.badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: var(--radius-sm);
    font-size: 0.875rem;
    font-weight: 600;
}

.status-normal, .badge-success {
    background: #d1fae5;
    color: #065f46;
}

.status-warning, .badge-warning {
    background: #fef3c7;
    color: #92400e;
}

.status-danger, .badge-danger {
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
   NUTRITION GRID
   =================================== */

.nutrition-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin: 1rem 0;
}

.nutrition-card, .nutrition-item {
    background: #f9fafb;
    padding: 1rem;
    border-radius: var(--radius-md);
    text-align: center;
    border-left: 4px solid var(--primary-color);
}

.nutrition-card strong, .nutrition-item strong {
    display: block;
    color: var(--text-muted);
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}

.nutrition-card .value, .nutrition-item span {
    font-size: 1.5rem;
    font-weight: bold;
    color: var(--primary-color);
    display: block;
}

.nutrition-card .subtext {
    font-size: 0.75rem;
    color: #9ca3af;
    margin-top: 0.25rem;
}

/* ===================================
   MEAL PLAN STYLES
   =================================== */

.meal-plan-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 1.5rem;
    margin: 1.5rem 0;
}

.meal-card {
    background: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
    border: 2px solid #fef3c7;
}

.meal-card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-3px);
}

.meal-card-header {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    padding: 1.25rem;
    text-align: center;
}

.meal-icon-large {
    font-size: 2.5rem;
    display: block;
    margin-bottom: 0.5rem;
}

.meal-card-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #78350f;
    margin: 0;
}

.meal-nutrition-summary {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.5rem;
    padding: 1rem;
    background: #fffbeb;
    border-bottom: 2px solid #fef3c7;
}

.nutrition-badge {
    text-align: center;
    padding: 0.5rem;
}

.badge-label {
    display: block;
    font-size: 0.75rem;
    color: #92400e;
    font-weight: 600;
    text-transform: uppercase;
    margin-bottom: 0.25rem;
}

.badge-value {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: #b45309;
    line-height: 1;
}

.badge-unit {
    display: block;
    font-size: 0.75rem;
    color: #92400e;
    margin-top: 0.25rem;
}

.meal-items-list {
    padding: 1.25rem;
}

.meal-item-group {
    margin-bottom: 1.25rem;
}

.meal-item-group:last-child {
    margin-bottom: 0;
}

.meal-item-category {
    font-size: 0.875rem;
    font-weight: 700;
    color: #059669;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.75rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #d1fae5;
}

.meal-items {
    list-style: none;
    padding: 0;
    margin: 0;
}

.meal-item {
    display: grid;
    grid-template-columns: 2fr 1.5fr 2fr;
    gap: 0.75rem;
    padding: 0.625rem 0;
    border-bottom: 1px solid #f3f4f6;
    font-size: 0.875rem;
}

.meal-item:last-child {
    border-bottom: none;
}

.item-name {
    font-weight: 600;
    color: #1f2937;
}

.item-portion {
    color: #6b7280;
    text-align: center;
    font-weight: 500;
}

.item-note {
    color: #9ca3af;
    font-size: 0.8125rem;
    font-style: italic;
}

/* Tips Grid */
.tips-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.tip-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.75rem;
    background: white;
    border-radius: var(--radius-md);
    border-left: 3px solid #3b82f6;
}

.tip-icon {
    font-size: 1.5rem;
    flex-shrink: 0;
}

.tip-text {
    flex: 1;
    color: #1f2937;
    font-size: 0.9375rem;
    line-height: 1.5;
}

/* Exchange Guide */
.exchange-guide {
    margin-top: 1rem;
    display: grid;
    gap: 0.75rem;
}

.exchange-item {
    background: white;
    padding: 1rem;
    border-radius: var(--radius-md);
    border-left: 3px solid #3b82f6;
}

.exchange-item strong {
    display: block;
    color: #1e40af;
    margin-bottom: 0.5rem;
    font-size: 0.9375rem;
}

.exchange-item p {
    margin: 0;
    color: #374151;
    font-size: 0.875rem;
    line-height: 1.6;
}

.meal-section {
    background: #fefce8;
    padding: 1.5rem;
    border-radius: var(--radius-lg);
    margin: 1.5rem 0;
    border-left: 5px solid #eab308;
}

.meal-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.meal-icon {
    font-size: 2rem;
}

.meal-title {
    font-size: 1.3rem;
    font-weight: bold;
    color: #854d0e;
}

.meal-target {
    background: white;
    padding: 0.75rem 1rem;
    border-radius: var(--radius-md);
    margin: 1rem 0;
    font-size: 0.9rem;
    border: 1px solid #fde047;
}

.meal-target strong {
    color: #854d0e;
}

/* ===================================
   TABLES
   =================================== */

.data-table, table {
    width: 100%;
    border-collapse: collapse;
    margin: 1rem 0;
}

.data-table th,
.data-table td,
table th,
table td {
    padding: 0.75rem 1rem;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.data-table th,
table th {
    background: var(--primary-color);
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
}

.data-table td,
table td {
    font-size: 0.9375rem;
    color: var(--text-dark);
}

.data-table tr:last-child td,
table tr:last-child td {
    border-bottom: none;
}

.data-table tr:hover,
table tr:hover {
    background: var(--bg-gray);
}

/* ===================================
   RECOMMENDATIONS
   =================================== */

.recommendations-grid {
    display: grid;
    gap: 1.5rem;
    margin-top: 1rem;
}

.recommendation-card {
    background: white;
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow-sm);
    border: 2px solid #f0fdf4;
    transition: all 0.3s ease;
}

.recommendation-card:hover {
    box-shadow: var(--shadow-md);
    border-color: var(--primary-light);
}

.recommendation-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.25rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0fdf4;
}

.rec-icon {
    font-size: 2rem;
    flex-shrink: 0;
}

.rec-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary-dark);
    margin: 0;
    flex: 1;
}

.rec-condition {
    background: #fef3c7;
    padding: 0.75rem 1rem;
    border-radius: var(--radius-md);
    margin-bottom: 1rem;
    border-left: 3px solid #f59e0b;
}

.condition-label {
    font-weight: 600;
    color: #92400e;
    margin-right: 0.5rem;
}

.condition-value {
    color: #78350f;
}

.rec-details {
    background: #f0fdf4;
    padding: 1rem;
    border-radius: var(--radius-md);
    margin-bottom: 1rem;
}

.detail-item {
    display: flex;
    padding: 0.5rem 0;
    border-bottom: 1px solid #d1fae5;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-key {
    font-weight: 600;
    color: var(--text-dark);
    min-width: 140px;
}

.detail-value {
    color: var(--primary-color);
    font-weight: 600;
}

.rec-sources {
    background: #fffbeb;
    padding: 1rem;
    border-radius: var(--radius-md);
    margin-bottom: 1rem;
    border-left: 3px solid #f59e0b;
}

.sources-title {
    font-weight: 700;
    color: #92400e;
    margin-bottom: 0.75rem;
    font-size: 1rem;
}

.source-item {
    padding: 0.5rem 0;
    font-size: 0.9375rem;
    line-height: 1.6;
}

.source-item strong {
    color: #78350f;
    display: inline-block;
    min-width: 120px;
}

.source-item span {
    color: #451a03;
}

.rec-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.rec-item {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    padding: 0.75rem;
    margin-bottom: 0.5rem;
    background: #f9fafb;
    border-radius: var(--radius-md);
    transition: all 0.2s;
}

.rec-item:hover {
    background: #f0fdf4;
    transform: translateX(3px);
}

.rec-check {
    color: var(--success-color);
    font-weight: 700;
    font-size: 1.125rem;
    flex-shrink: 0;
}

.rec-text {
    color: var(--text-dark);
    line-height: 1.6;
    font-size: 0.9375rem;
}

.recommendation-section {
    margin-bottom: 2rem;
}

.recommendation-category {
    background: var(--primary-light);
    padding: 1.25rem 1.5rem;
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

/* ===================================
   TIPS BOX
   =================================== */

.tips-box {
    background: #e0e7ff;
    padding: 1.5rem;
    border-radius: var(--radius-lg);
    margin: 2rem 0;
    border-left: 4px solid var(--secondary-color);
}

.tips-box h3 {
    color: #1e40af;
    margin-bottom: 1rem;
}

.tips-box ul {
    margin-left: 1.5rem;
    margin-top: 0.5rem;
}

.tips-box li {
    margin: 0.5rem 0;
    line-height: 1.6;
}

/* ===================================
   GLOSSARY
   =================================== */

.glossary-content {
    display: grid;
    gap: 1rem;
}

.glossary-item {
    padding: 1rem;
    background: var(--bg-gray);
    border-radius: var(--radius-md);
    border-left: 3px solid var(--secondary-color);
}

.glossary-item strong {
    color: var(--primary-dark);
    font-size: 1rem;
    display: block;
    margin-bottom: 0.5rem;
}

.glossary-item p {
    color: var(--text-dark);
    font-size: 0.9375rem;
    line-height: 1.6;
    margin: 0;
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
   RESULTS FOOTER
   =================================== */

.results-footer {
    margin-top: 2rem;
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
    
    .meal-plan-grid {
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
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

    .nutrition-grid {
        grid-template-columns: 1fr;
    }
    
    .meal-plan-grid {
        grid-template-columns: 1fr;
    }
    
    .meal-nutrition-summary {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .meal-item {
        grid-template-columns: 1fr;
        gap: 0.25rem;
    }
    
    .item-portion {
        text-align: left;
    }
    
    .tips-grid {
        grid-template-columns: 1fr;
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

    .meal-title {
        font-size: 1.1rem;
    }
    
    .meal-card-title {
        font-size: 1.1rem;
    }
    
    .meal-nutrition-summary {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .badge-value {
        font-size: 1.25rem;
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

    .nutrition-calculator-wrapper {
        background: white;
    }

    .results-section {
        box-shadow: none;
    }

    .results-card {
        page-break-inside: avoid;
        box-shadow: none;
        border: 1px solid #ddd;
    }

    .calculator-card {
        display: none;
    }
}

    </style>
@endpush

@section('content')
<div class="nutrition-calculator-wrapper">
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1 class="hero-title">Kalkulator Status Gizi & Antropometri</h1>
            <p class="hero-subtitle">
                Analisis komprehensif status gizi berdasarkan IMT, LILA, ULNA, dan berbagai metode antropometri standar medis
            </p>
        </div>
    </div>

    <!-- Educational Info Cards -->
    <div class="container">
        <div class="info-cards-grid">
            <div class="info-card" id="imtInfo">
                <div class="info-icon">📊</div>
                <h3>IMT</h3>
                <p>Indeks Massa Tubuh untuk klasifikasi status gizi</p>
                <button class="btn-learn" onclick="showEducation('imt')">Pelajari</button>
            </div>
            <div class="info-card" id="lilaInfo">
                <div class="info-icon">📏</div>
                <h3>LILA</h3>
                <p>Lingkar Lengan Atas untuk deteksi malnutrisi</p>
                <button class="btn-learn" onclick="showEducation('lila')">Pelajari</button>
            </div>
            <div class="info-card" id="ulnaInfo">
                <div class="info-icon">📐</div>
                <h3>ULNA</h3>
                <p>Panjang tulang ulna untuk estimasi tinggi badan</p>
                <button class="btn-learn" onclick="showEducation('ulna')">Pelajari</button>
            </div>
            <div class="info-card" id="antropometriInfo">
                <div class="info-icon">🔬</div>
                <h3>Antropometri</h3>
                <p>Pengukuran dimensi dan komposisi tubuh</p>
                <button class="btn-learn" onclick="showEducation('antropometri')">Pelajari</button>
            </div>
        </div>
    </div>

    <!-- Main Calculator Form -->
    <div class="container">
        <div class="calculator-card">
            <div class="card-header-main">
                <h2>📋 Data Pengukuran</h2>
                <p>Masukkan data pengukuran Anda untuk analisis status gizi</p>
            </div>

            <form id="nutritionForm">
                @csrf
                
                <!-- Data Dasar -->
                <div class="form-section">
                    <div class="section-title-bar">
                        <span class="section-icon">👤</span>
                        <h3>Data Dasar</h3>
                    </div>
                    
                    <div class="form-grid-3">
                        <div class="form-group">
                            <label class="form-label">
                                Tinggi Badan (cm) <span class="required">*</span>
                            </label>
                            <input type="number" name="tinggi" class="form-input" placeholder="170" required step="0.1" min="50" max="250">
                            <small class="input-hint">Tinggi badan dalam satuan centimeter</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Berat Badan (kg) <span class="required">*</span>
                            </label>
                            <input type="number" name="berat" class="form-input" placeholder="65" required step="0.1" min="10" max="300">
                            <small class="input-hint">Berat badan aktual saat ini</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Umur (tahun) <span class="required">*</span>
                            </label>
                            <input type="number" name="umur" class="form-input" placeholder="25" required min="0" max="150">
                            <small class="input-hint">Umur dalam tahun</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Jenis Kelamin <span class="required">*</span>
                            </label>
                            <select name="jenisKelamin" class="form-select" required>
                                <option value="">Pilih jenis kelamin</option>
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Pengukuran Antropometri -->
                <div class="form-section">
                    <div class="section-title-bar">
                        <span class="section-icon">📏</span>
                        <h3>Pengukuran Antropometri</h3>
                        <small style="color: #6b7280; font-weight: 400;">(Opsional - untuk analisis lebih detail)</small>
                    </div>
                    
                    <div class="form-grid-3">
                        <div class="form-group">
                            <label class="form-label">
                                LILA - Lingkar Lengan Atas (cm)
                                <span class="info-tooltip" title="Diukur pada titik tengah lengan atas">ℹ️</span>
                            </label>
                            <input type="number" name="lila" class="form-input" placeholder="28.5" step="0.1" min="5" max="60">
                            <small class="input-hint">Untuk penilaian status gizi</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Panjang ULNA (cm)
                                <span class="info-tooltip" title="Dari ujung siku ke ujung pergelangan tangan">ℹ️</span>
                            </label>
                            <input type="number" name="ulna" class="form-input" placeholder="26" step="0.1" min="10" max="50">
                            <small class="input-hint">Untuk estimasi tinggi badan</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">
                                Tinggi Lutut (cm)
                                <span class="info-tooltip" title="Untuk pasien yang tidak bisa berdiri">ℹ️</span>
                            </label>
                            <input type="number" name="tinggiLutut" class="form-input" placeholder="52" step="0.1" min="30" max="80">
                            <small class="input-hint">Alternatif pengukuran tinggi</small>
                        </div>

                        <div class="form-group" id="lingkarBetisGroup" style="display: none;">
                            <label class="form-label">
                                Lingkar Betis (cm)
                                <span class="info-tooltip" title="Khusus untuk lansia ≥60 tahun">ℹ️</span>
                            </label>
                            <input type="number" name="lingkarBetis" class="form-input" placeholder="33" step="0.1" min="10" max="60">
                            <small class="input-hint">Indikator massa otot lansia</small>
                        </div>
                    </div>
                </div>

                <!-- Kondisi Khusus -->
                <div class="form-section">
                    <div class="section-title-bar">
                        <span class="section-icon">🏥</span>
                        <h3>Kondisi Khusus</h3>
                    </div>
                    
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Amputasi (jika ada)</label>
                            <select name="amputasi" class="form-select">
                                <option value="">Tidak ada amputasi</option>
                                <option value="tangan">Tangan</option>
                                <option value="lengan_bawah">Lengan Bawah</option>
                                <option value="lengan_atas">Lengan Atas</option>
                                <option value="seluruh_lengan">Seluruh Lengan</option>
                                <option value="kaki">Kaki</option>
                                <option value="tungkai_bawah">Tungkai Bawah</option>
                                <option value="tungkai_atas">Tungkai Atas</option>
                                <option value="seluruh_tungkai">Seluruh Tungkai</option>
                            </select>
                            <small class="input-hint">Untuk koreksi berat badan</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Penyakit/Kondisi Medis</label>
                            <input type="text" name="penyakit" class="form-input" placeholder="Contoh: Diabetes, Hipertensi">
                            <small class="input-hint">Untuk rekomendasi diet spesifik</small>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <svg class="btn-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 11l3 3L22 4"></path>
                            <path d="M21 12v7a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h11"></path>
                        </svg>
                        Analisis Status Gizi
                    </button>
                    <button type="button" class="btn-reset" onclick="resetForm()">
                        <svg class="btn-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M3 12a9 9 0 019-9 9.75 9.75 0 016.74 2.74L21 8"></path>
                            <path d="M21 3v5h-5"></path>
                            <path d="M21 12a9 9 0 01-9 9 9.75 9.75 0 01-6.74-2.74L3 16"></path>
                            <path d="M3 21v-5h5"></path>
                        </svg>
                        Reset
                    </button>
                </div>
            </form>
        </div>

        <!-- Results Section -->
        <div id="resultsSection" class="results-section" style="display: none;">
            <!-- Status Gizi Overview -->
            <div class="results-card">
                <div class="results-header">
                    <h2>📊 Hasil Analisis Status Gizi</h2>
                </div>
                <div id="statusGiziOverview"></div>
            </div>

            <!-- IMT & Status Gizi Detail -->
            <div class="results-grid">
                <div class="results-card">
                    <h3 class="card-title-result">IMT & Klasifikasi</h3>
                    <div id="imtResults"></div>
                </div>
                
                <div class="results-card">
                    <h3 class="card-title-result">Status Gizi Berdasarkan Metode</h3>
                    <div id="nutritionStatus"></div>
                </div>
            </div>

            <!-- Berat Badan Ideal & Antropometri -->
            <div class="results-card">
                <h3 class="card-title-result">💪 Analisis Berat Badan & Komposisi Tubuh</h3>
                <div id="weightAnalysis"></div>
            </div>

            <!-- Estimasi dari Pengukuran -->
            <div id="estimationResults" class="results-card">
                <h3 class="card-title-result">🔍 Estimasi dari Pengukuran Alternatif</h3>
                <div id="estimationContent"></div>
            </div>

            <!-- Rekomendasi -->
            <div class="results-card recommendations-card">
                <h3 class="card-title-result">📋 Rekomendasi & Tindak Lanjut</h3>
                <div id="recommendationsContent"></div>
            </div>

            <!-- Action Buttons -->
            <div class="results-actions">
                <button class="btn-action btn-print" onclick="window.print()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"></path>
                        <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>
                    Cetak Hasil
                </button>
                <button class="btn-action btn-new" onclick="resetForm()">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                    Analisis Baru
                </button>
                <a href="{{ route('nutrition.recommendations') }}" class="btn-action btn-recommendations">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    Lihat Panduan Lengkap
                </a>
            </div>
        </div>
    </div>

    <!-- Educational Modal -->
    <div id="educationModal" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeEducation()">&times;</span>
            <div id="educationContent"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    {{-- <script src="{{ asset('js/nutrition-calculator.js') }}"></script> --}}
    <script src="{{ asset('js/nutrition-calculator-friendly.js') }}"></script>
@endpush

