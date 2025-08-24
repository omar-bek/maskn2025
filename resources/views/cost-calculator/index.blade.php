@extends('layouts.app')

@section('content')
<style>
    .calculator-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .step-indicator {
        display: flex;
        justify-content: center;
        margin-bottom: 3rem;
        gap: 2rem;
    }

    .step-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 1rem 2rem;
        border-radius: 50px;
        background: #f8f9fa;
        color: #6c757d;
        font-weight: 500;
        position: relative;
    }

    .step-item.active {
        background: linear-gradient(135deg, #14b8a6, #f59e0b);
        color: white;
        box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
    }

    .step-item.completed {
        background: #10b981;
        color: white;
    }

    .step-number {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .step-content {
        display: none;
    }

    .step-content.active {
        display: block;
    }

    .location-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .area-section {
        grid-column: 1 / -1;
        margin-top: 2rem;
    }

    .dropdown-container {
        position: relative;
    }

    .dropdown-select {
        width: 100%;
        padding: 1rem 1.5rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        background: white;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .dropdown-select:focus {
        outline: none;
        border-color: #14b8a6;
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
    }

    .dropdown-options {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 2px solid #e5e7eb;
        border-top: none;
        border-radius: 0 0 12px 12px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 10;
        display: none;
    }

    .dropdown-option {
        padding: 0.75rem 1.5rem;
        cursor: pointer;
        transition: background 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .dropdown-option:hover {
        background: #f8f9fa;
    }

    .dropdown-option.selected {
        background: #e6fffa;
        color: #14b8a6;
    }

    .area-input {
        width: 100%;
        padding: 1rem 1.5rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .area-input:focus {
        outline: none;
        border-color: #14b8a6;
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
    }

    .style-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .style-card {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }

    .style-card:hover {
        border-color: #14b8a6;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .style-card.selected {
        border-color: #14b8a6;
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
    }

    .style-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .style-label {
        padding: 1rem;
        text-align: center;
        font-weight: 500;
        color: #374151;
    }

    .finishing-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .finishing-card {
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }

    .finishing-card:hover {
        border-color: #f59e0b;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .finishing-card.selected {
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }

    .finishing-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .finishing-label {
        padding: 1rem;
        text-align: center;
        font-weight: 500;
        color: #374151;
    }

    .details-form {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-label {
        font-weight: 500;
        color: #374151;
        font-size: 0.9rem;
    }

    .form-input {
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .form-input:focus {
        outline: none;
        border-color: #14b8a6;
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
    }

    .form-select {
        padding: 0.75rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 0.9rem;
        background: white;
        cursor: pointer;
    }

    .form-select:focus {
        outline: none;
        border-color: #14b8a6;
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
    }

    .notes-area {
        grid-column: 1 / -1;
        margin-top: 1rem;
    }

    .notes-textarea {
        width: 100%;
        min-height: 120px;
        padding: 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        font-size: 0.9rem;
        resize: vertical;
        transition: all 0.3s ease;
    }

    .notes-textarea:focus {
        outline: none;
        border-color: #14b8a6;
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
    }

    .navigation-buttons {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
    }

    .btn {
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .btn-secondary {
        background: #f8f9fa;
        color: #6c757d;
        border: 2px solid #e5e7eb;
    }

    .btn-secondary:hover {
        background: #e9ecef;
        color: #495057;
    }

    .btn-primary {
        background: linear-gradient(135deg, #14b8a6, #f59e0b);
        color: white;
        box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(20, 184, 166, 0.4);
    }

    .btn-calculate {
        background: linear-gradient(135deg, #14b8a6, #f59e0b);
        color: white;
        font-size: 1.1rem;
        padding: 1.25rem 3rem;
        box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
    }

    .btn-calculate:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(20, 184, 166, 0.4);
    }

    .result-card {
        display: none;
        background: linear-gradient(135deg, #14b8a6, #f59e0b);
        color: white;
        padding: 2rem;
        border-radius: 20px;
        text-align: center;
        margin-top: 2rem;
    }

    .result-amount {
        font-size: 3rem;
        font-weight: bold;
        margin-bottom: 1rem;
    }

    .result-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 2rem;
    }

    .result-item {
        background: rgba(255,255,255,0.1);
        padding: 1rem;
        border-radius: 12px;
        text-align: center;
    }

    .result-label {
        font-size: 0.9rem;
        opacity: 0.9;
        margin-bottom: 0.5rem;
    }

    .result-value {
        font-size: 1.2rem;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .calculator-container {
            padding: 1rem;
            margin: 0.5rem;
            border-radius: 15px;
        }

        .step-indicator {
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 2rem;
        }

        .step-item {
            padding: 0.8rem 1rem;
            font-size: 0.9rem;
        }

        .step-number {
            width: 25px;
            height: 25px;
            font-size: 0.8rem;
        }

        .location-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .dropdown-select,
        .area-input {
            padding: 0.8rem 1rem;
            font-size: 0.9rem;
        }

        .form-label {
            font-size: 0.9rem;
        }

        .style-grid,
        .finishing-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .style-card,
        .finishing-card {
            border-radius: 10px;
        }

        .style-image,
        .finishing-image {
            height: 180px;
        }

        .style-label,
        .finishing-label {
            padding: 0.8rem;
            font-size: 0.9rem;
        }

        .details-form {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .form-input,
        .form-select {
            padding: 0.7rem 0.8rem;
            font-size: 0.85rem;
        }

        .form-label {
            font-size: 0.85rem;
        }

        .notes-textarea {
            min-height: 100px;
            padding: 0.8rem;
            font-size: 0.85rem;
        }

        .navigation-buttons {
            flex-direction: column;
            gap: 0.75rem;
            margin-top: 2rem;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            font-size: 0.9rem;
        }

        .btn-calculate {
            padding: 1rem 2rem;
            font-size: 1rem;
        }

        .result-card {
            padding: 1.5rem;
            margin-top: 1.5rem;
        }

        .result-amount {
            font-size: 2.5rem;
        }

        .result-details {
            grid-template-columns: 1fr;
            gap: 0.75rem;
        }

        .result-item {
            padding: 0.8rem;
        }

        .result-label {
            font-size: 0.8rem;
        }

        .result-value {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 480px) {
        .calculator-container {
            padding: 0.5rem;
            margin: 0.1rem;
            border-radius: 12px;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            overflow-x: hidden !important;
        }

        /* Fix input overflow */
        .dropdown-select,
        .area-input,
        .form-input,
        .form-select,
        .notes-textarea {
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            padding: 0.6rem 0.7rem !important;
            font-size: 16px !important;
        }

        .step-indicator {
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .step-item {
            padding: 0.5rem 0.7rem;
            font-size: 0.8rem;
            border-radius: 20px;
        }

        .step-number {
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
        }

        .location-grid {
            gap: 1rem;
            width: 100% !important;
            max-width: 100% !important;
            overflow-x: hidden !important;
        }

        .dropdown-select,
        .area-input {
            padding: 0.6rem 0.7rem;
            font-size: 0.8rem;
            border-radius: 8px;
        }

        .form-label {
            font-size: 0.8rem;
            margin-bottom: 0.4rem;
        }

        .style-grid,
        .finishing-grid {
            gap: 0.8rem;
            width: 100% !important;
            max-width: 100% !important;
            overflow-x: hidden !important;
        }

        .style-card,
        .finishing-card {
            border-radius: 8px;
        }

        .style-image,
        .finishing-image {
            height: 140px;
        }

        .style-label,
        .finishing-label {
            padding: 0.5rem;
            font-size: 0.8rem;
        }

        .details-form {
            gap: 0.8rem;
            width: 100% !important;
            max-width: 100% !important;
            overflow-x: hidden !important;
        }

        .form-input,
        .form-select {
            padding: 0.5rem 0.6rem;
            font-size: 0.75rem;
            border-radius: 6px;
        }

        .form-label {
            font-size: 0.75rem;
        }

        .notes-textarea {
            min-height: 70px;
            padding: 0.5rem;
            font-size: 0.75rem;
            border-radius: 8px;
        }

        .navigation-buttons {
            gap: 0.5rem;
            margin-top: 1.5rem;
        }

        .btn {
            padding: 0.6rem 1rem;
            font-size: 0.8rem;
            border-radius: 8px;
        }

        .btn-calculate {
            padding: 0.7rem 1.2rem;
            font-size: 0.85rem;
        }

        .result-card {
            padding: 1rem;
            margin-top: 1rem;
            border-radius: 12px;
        }

        .result-amount {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        .result-details {
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .result-item {
            padding: 0.5rem;
            border-radius: 8px;
        }

        .result-label {
            font-size: 0.7rem;
            margin-bottom: 0.3rem;
        }

        .result-value {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 360px) {
        .calculator-container {
            padding: 0.4rem;
            margin: 0.05rem;
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            overflow-x: hidden !important;
        }

        /* Fix input overflow for very small screens */
        .dropdown-select,
        .area-input,
        .form-input,
        .form-select,
        .notes-textarea {
            width: 100% !important;
            max-width: 100% !important;
            box-sizing: border-box !important;
            padding: 0.5rem 0.6rem !important;
            font-size: 16px !important;
        }

        .step-item {
            padding: 0.4rem 0.6rem;
            font-size: 0.75rem;
        }

        .step-number {
            width: 18px;
            height: 18px;
            font-size: 0.65rem;
        }

        .dropdown-select,
        .area-input {
            padding: 0.5rem 0.6rem;
            font-size: 0.75rem;
        }

        .form-label {
            font-size: 0.75rem;
        }

        .style-image,
        .finishing-image {
            height: 120px;
        }

        .style-label,
        .finishing-label {
            padding: 0.4rem;
            font-size: 0.75rem;
        }

        .form-input,
        .form-select {
            padding: 0.4rem 0.5rem;
            font-size: 0.7rem;
        }

        .notes-textarea {
            min-height: 60px;
            padding: 0.4rem;
            font-size: 0.7rem;
        }

        .btn {
            padding: 0.5rem 0.8rem;
            font-size: 0.75rem;
        }

        .btn-calculate {
            padding: 0.6rem 1rem;
            font-size: 0.8rem;
        }

        .result-amount {
            font-size: 1.6rem;
        }

        .result-item {
            padding: 0.4rem;
        }

        .result-label {
            font-size: 0.65rem;
        }

        .result-value {
            font-size: 0.8rem;
        }
    }
</style>

<div class="calculator-container">
    <h1 class="text-3xl font-bold text-center mb-8 text-gray-900">قدر التكلفة التقديرية لمشروعك في ثلاث خطوات</h1>

    <!-- Step Indicator -->
    <div class="step-indicator">
        <div class="step-item active" id="step-1-indicator">
            <div class="step-number">1</div>
            <span>اختر المنطقة والحي</span>
        </div>
        <div class="step-item" id="step-2-indicator">
            <div class="step-number">2</div>
            <span>اختر الطراز والتشطيب</span>
        </div>
        <div class="step-item" id="step-3-indicator">
            <div class="step-number">3</div>
            <span>تفاصيل المشروع</span>
        </div>
    </div>

    <!-- Step 1: Location and Area -->
    <div class="step-content active" id="step-1">
        <div class="location-grid">
            <div class="dropdown-container">
                <label class="form-label">اختر المنطقة</label>
                <select class="dropdown-select" id="region-select">
                    <option value="">اختر المنطقة</option>
                    <option value="abudhabi">أبو ظبي</option>
                    <option value="dubai">دبي</option>
                    <option value="sharjah">الشارقة</option>
                    <option value="ajman">عجمان</option>
                    <option value="ummalquwain">أم القيوين</option>
                    <option value="rasalkhaimah">رأس الخيمة</option>
                    <option value="fujairah">الفجيرة</option>
                </select>
            </div>

            <div class="dropdown-container">
                <label class="form-label">اختر الحي</label>
                <select class="dropdown-select" id="neighborhood-select">
                    <option value="">اختر الحي</option>
                    <!-- سيتم تحديثها حسب المنطقة المختارة -->
                </select>
            </div>

            <div class="area-section">
                <label class="form-label">المساحة (متر مربع)</label>
                <input type="number" class="area-input" id="area-input" placeholder="أدخل مساحة المشروع" min="50" max="10000">
            </div>
        </div>

        <div class="navigation-buttons">
            <div></div>
            <button class="btn btn-primary" onclick="nextStep(2)">
                التالي
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Step 2: Style and Finishing -->
    <div class="step-content" id="step-2">
        <h3 class="text-xl font-bold mb-6 text-gray-900">اختر طراز التصميم</h3>
        <div class="style-grid">
            <div class="style-card" onclick="selectStyle(this, 'modern')">
                <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="طراز عصري" class="style-image">
                <div class="style-label">عصري</div>
            </div>
            <div class="style-card" onclick="selectStyle(this, 'classic')">
                <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="طراز كلاسيكي" class="style-image">
                <div class="style-label">كلاسيكي</div>
            </div>
            <div class="style-card" onclick="selectStyle(this, 'traditional')">
                <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="طراز تراثي" class="style-image">
                <div class="style-label">تراثي</div>
            </div>
        </div>

        <h3 class="text-xl font-bold mb-6 text-gray-900">اختر مستوى التشطيب</h3>
        <div class="finishing-grid">
            <div class="finishing-card" onclick="selectFinishing(this, 'low')">
                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="تشطيب منخفض" class="finishing-image">
                <div class="finishing-label">منخفض</div>
            </div>
            <div class="finishing-card" onclick="selectFinishing(this, 'medium')">
                <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="تشطيب متوسط" class="finishing-image">
                <div class="finishing-label">متوسط</div>
            </div>
            <div class="finishing-card" onclick="selectFinishing(this, 'high')">
                <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="تشطيب عالي" class="finishing-image">
                <div class="finishing-label">عالي</div>
            </div>
        </div>

        <div class="navigation-buttons">
            <button class="btn btn-secondary" onclick="prevStep(1)">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15a.5.5 0 0 1-.5-.5v-11.793l-3.146 3.147a.5.5 0 0 1-.708-.708l4-4a.5.5 0 0 1 .708 0l4 4a.5.5 0 0 1-.708.708L8.5 2.707V14.5a.5.5 0 0 1-.5.5z"/>
                </svg>
                السابق
            </button>
            <button class="btn btn-primary" onclick="nextStep(3)">
                التالي
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Step 3: Project Details -->
    <div class="step-content" id="step-3">
        <h3 class="text-xl font-bold mb-6 text-gray-900">تفاصيل المشروع</h3>
        <div class="details-form">
            <div class="form-group">
                <label class="form-label">عدد الطوابق</label>
                <input type="number" class="form-input" id="floors" placeholder="عدد الطوابق" min="1" max="10">
            </div>
            <div class="form-group">
                <label class="form-label">عدد المجالس</label>
                <input type="number" class="form-input" id="majlis" placeholder="عدد المجالس" min="1" max="10">
            </div>
            <div class="form-group">
                <label class="form-label">غرف النوم</label>
                <input type="number" class="form-input" id="bedrooms" placeholder="عدد غرف النوم" min="1" max="20">
            </div>
            <div class="form-group">
                <label class="form-label">غرف نوم الضيوف</label>
                <input type="number" class="form-input" id="guest-bedrooms" placeholder="عدد غرف الضيوف" min="0" max="10">
            </div>
            <div class="form-group">
                <label class="form-label">الحمامات</label>
                <input type="number" class="form-input" id="bathrooms" placeholder="عدد الحمامات" min="1" max="15">
            </div>
            <div class="form-group">
                <label class="form-label">مواقف السيارات</label>
                <input type="number" class="form-input" id="parking" placeholder="عدد المواقف" min="1" max="10">
            </div>
            <div class="form-group">
                <label class="form-label">غرف أخرى</label>
                <input type="number" class="form-input" id="other-rooms" placeholder="غرف أخرى" min="0" max="10">
            </div>
            <div class="form-group">
                <label class="form-label">مستوى التشطيب</label>
                <select class="form-select" id="finishing-level">
                    <option value="">اختر مستوى التشطيب</option>
                    <option value="low">منخفض</option>
                    <option value="medium">متوسط</option>
                    <option value="high">عالي</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">إضافات أخرى</label>
                <select class="form-select" id="additional-features">
                    <option value="">اختر الإضافات</option>
                    <option value="garden">حديقة</option>
                    <option value="pool">مسبح</option>
                    <option value="elevator">مصعد</option>
                    <option value="basement">قبو</option>
                </select>
            </div>
        </div>

        <div class="notes-area">
            <label class="form-label">ملاحظات إضافية</label>
            <textarea class="notes-textarea" id="notes" placeholder="أضف أي ملاحظات أو متطلبات خاصة للمشروع..."></textarea>
        </div>

        <div class="navigation-buttons">
            <button class="btn btn-secondary" onclick="prevStep(2)">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 15a.5.5 0 0 1-.5-.5v-11.793l-3.146 3.147a.5.5 0 0 1-.708-.708l4-4a.5.5 0 0 1 .708 0l4 4a.5.5 0 0 1-.708.708L8.5 2.707V14.5a.5.5 0 0 1-.5.5z"/>
                </svg>
                السابق
            </button>
            <button class="btn btn-calculate" onclick="calculateCost()">
                احسب التكلفة
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Results Card -->
    <div class="result-card" id="result-card">
        <div class="result-amount" id="estimated-cost">0 درهم</div>
        <p class="text-xl mb-4">التكلفة التقديرية للمشروع</p>

        <div class="result-details">
            <div class="result-item">
                <div class="result-label">المساحة</div>
                <div class="result-value" id="result-area">0 متر مربع</div>
            </div>
            <div class="result-item">
                <div class="result-label">المنطقة</div>
                <div class="result-value" id="result-region">-</div>
            </div>
            <div class="result-item">
                <div class="result-label">الطراز</div>
                <div class="result-value" id="result-style">-</div>
            </div>
            <div class="result-item">
                <div class="result-label">التشطيب</div>
                <div class="result-value" id="result-finishing">-</div>
            </div>
            <div class="result-item">
                <div class="result-label">السعر للمتر</div>
                <div class="result-value" id="result-price-per-sqm">0 درهم</div>
            </div>
        </div>

        <!-- Create Project Button -->
        <div class="mt-6 text-center">
            <button onclick="showCreateProjectForm()" class="bg-teal-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-teal-700 transition duration-200 text-lg">
                <i class="fas fa-plus ml-2"></i>
                إنشاء مشروع من هذه النتيجة
            </button>
        </div>
    </div>
</div>

<!-- Create Project Modal -->
<div id="createProjectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-screen overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-900">إنشاء مشروع جديد</h3>
                    <button onclick="closeCreateProjectForm()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <form id="createProjectForm" class="space-y-4">
                    @csrf

                    <div>
                        <label for="project_title" class="block text-sm font-medium text-gray-700 mb-2">عنوان المشروع *</label>
                        <input type="text" name="title" id="project_title" required
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                               placeholder="أدخل عنوان المشروع">
                    </div>

                    <div>
                        <label for="project_description" class="block text-sm font-medium text-gray-700 mb-2">وصف المشروع *</label>
                        <textarea name="description" id="project_description" rows="4" required
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                  placeholder="اكتب وصفاً مفصلاً للمشروع"></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="project_property_type" class="block text-sm font-medium text-gray-700 mb-2">نوع العقار *</label>
                            <select name="property_type" id="project_property_type" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                <option value="">اختر نوع العقار</option>
                                <option value="residential">سكني</option>
                                <option value="commercial">تجاري</option>
                                <option value="villa">فيلا</option>
                            </select>
                        </div>

                        <div>
                            <label for="project_style" class="block text-sm font-medium text-gray-700 mb-2">النمط *</label>
                            <select name="style" id="project_style" required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                                <option value="">اختر النمط</option>
                                <option value="modern">عصري</option>
                                <option value="classic">كلاسيكي</option>
                                <option value="traditional">تقليدي</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="project_area" class="block text-sm font-medium text-gray-700 mb-2">المساحة (متر مربع) *</label>
                            <input type="number" name="area" id="project_area" step="0.01" min="1" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                   placeholder="المساحة">
                        </div>

                        <div>
                            <label for="project_location" class="block text-sm font-medium text-gray-700 mb-2">الموقع *</label>
                            <input type="text" name="location" id="project_location" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                   placeholder="المدينة أو الإمارة">
                        </div>
                    </div>

                    <div>
                        <label for="project_neighborhood" class="block text-sm font-medium text-gray-700 mb-2">الحي</label>
                        <input type="text" name="neighborhood" id="project_neighborhood"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                               placeholder="الحي أو المنطقة (اختياري)">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="project_estimated_cost" class="block text-sm font-medium text-gray-700 mb-2">التكلفة المقدرة *</label>
                            <input type="number" name="estimated_cost" id="project_estimated_cost" step="0.01" min="0" required
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                   placeholder="التكلفة المقدرة">
                        </div>

                        <div>
                            <label for="project_budget_min" class="block text-sm font-medium text-gray-700 mb-2">الحد الأدنى للميزانية</label>
                            <input type="number" name="budget_min" id="project_budget_min" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                   placeholder="الحد الأدنى">
                        </div>

                        <div>
                            <label for="project_budget_max" class="block text-sm font-medium text-gray-700 mb-2">الحد الأقصى للميزانية</label>
                            <input type="number" name="budget_max" id="project_budget_max" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                   placeholder="الحد الأقصى">
                        </div>
                    </div>

                    <div class="flex space-x-3 space-x-reverse pt-4">
                        <button type="submit" class="flex-1 bg-teal-600 text-white py-3 px-6 rounded-lg font-medium hover:bg-teal-700 transition duration-200">
                            <i class="fas fa-save ml-2"></i>
                            إنشاء المشروع
                        </button>
                        <button type="button" onclick="closeCreateProjectForm()" class="flex-1 bg-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-400 transition duration-200">
                            إلغاء
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let currentStep = 1;
    let selectedRegion = '';
    let selectedNeighborhood = '';
    let selectedStyle = '';
    let selectedFinishing = '';

    // Neighborhoods data
    const neighborhoods = {
        'abudhabi': ['الخالدية', 'الكرامة', 'البطين', 'المركز التجاري', 'المنطقة السياحية', 'المنطقة السكنية'],
        'dubai': ['بر دبي', 'ديرة', 'جبل علي', 'المنطقة الحرة', 'المركز التجاري', 'المنطقة السياحية'],
        'sharjah': ['المنطقة الوسطى', 'المنطقة الشرقية', 'المنطقة الغربية', 'المركز التجاري'],
        'ajman': ['المنطقة الوسطى', 'المنطقة الشرقية', 'المنطقة الغربية'],
        'ummalquwain': ['المنطقة الوسطى', 'المنطقة الشرقية', 'المنطقة الغربية'],
        'rasalkhaimah': ['المنطقة الوسطى', 'المنطقة الشرقية', 'المنطقة الغربية'],
        'fujairah': ['المنطقة الوسطى', 'المنطقة الشرقية', 'المنطقة الغربية']
    };

    // Update neighborhoods when region changes
    document.getElementById('region-select').addEventListener('change', function() {
        const region = this.value;
        const neighborhoodSelect = document.getElementById('neighborhood-select');

        // Clear current options
        neighborhoodSelect.innerHTML = '<option value="">اختر الحي</option>';

        if (region && neighborhoods[region]) {
            neighborhoods[region].forEach(neighborhood => {
                const option = document.createElement('option');
                option.value = neighborhood;
                option.textContent = neighborhood;
                neighborhoodSelect.appendChild(option);
            });
        }

        selectedRegion = region;
    });

    document.getElementById('neighborhood-select').addEventListener('change', function() {
        selectedNeighborhood = this.value;
    });

    function nextStep(step) {
        // Validate current step
        if (currentStep === 1) {
            if (!selectedRegion || !selectedNeighborhood) {
                alert('يرجى اختيار المنطقة والحي');
                return;
            }
            const area = document.getElementById('area-input').value;
            if (!area || area < 50) {
                alert('يرجى إدخال مساحة صحيحة (الحد الأدنى 50 متر مربع)');
                return;
            }
        } else if (currentStep === 2) {
            if (!selectedStyle || !selectedFinishing) {
                alert('يرجى اختيار الطراز ومستوى التشطيب');
                return;
            }
        }

        // Hide current step
        document.getElementById(`step-${currentStep}`).classList.remove('active');
        document.getElementById(`step-${currentStep}-indicator`).classList.remove('active');

        // Show next step
        document.getElementById(`step-${step}`).classList.add('active');
        document.getElementById(`step-${step}-indicator`).classList.add('active');

        currentStep = step;
    }

    function prevStep(step) {
        // Hide current step
        document.getElementById(`step-${currentStep}`).classList.remove('active');
        document.getElementById(`step-${currentStep}-indicator`).classList.remove('active');

        // Show previous step
        document.getElementById(`step-${step}`).classList.add('active');
        document.getElementById(`step-${step}-indicator`).classList.add('active');

        currentStep = step;
    }

    function selectStyle(element, style) {
        // Remove selection from all cards
        document.querySelectorAll('.style-card').forEach(card => {
            card.classList.remove('selected');
        });

        // Select current card
        element.classList.add('selected');
        selectedStyle = style;
    }

    function selectFinishing(element, finishing) {
        // Remove selection from all cards
        document.querySelectorAll('.finishing-card').forEach(card => {
            card.classList.remove('selected');
        });

        // Select current card
        element.classList.add('selected');
        selectedFinishing = finishing;
    }

    function calculateCost() {
        const area = parseFloat(document.getElementById('area-input').value) || 0;
        const region = selectedRegion;
        const style = selectedStyle;
        const finishing = selectedFinishing;

        if (area === 0) {
            alert('يرجى إدخال المساحة');
            return;
        }

        // Base prices per square meter (in AED)
        const basePrices = {
            'abudhabi': { 'modern': 3500, 'classic': 3200, 'traditional': 3000 },
            'dubai': { 'modern': 4000, 'classic': 3700, 'traditional': 3500 },
            'sharjah': { 'modern': 2800, 'classic': 2500, 'traditional': 2300 },
            'ajman': { 'modern': 2500, 'classic': 2200, 'traditional': 2000 },
            'ummalquwain': { 'modern': 2300, 'classic': 2000, 'traditional': 1800 },
            'rasalkhaimah': { 'modern': 2400, 'classic': 2100, 'traditional': 1900 },
            'fujairah': { 'modern': 2600, 'classic': 2300, 'traditional': 2100 }
        };

        // Finishing multipliers
        const finishingMultipliers = {
            'low': 0.8,
            'medium': 1.0,
            'high': 1.3
        };

        const basePrice = basePrices[region]?.[style] || 3000;
        const finishingMultiplier = finishingMultipliers[finishing] || 1.0;
        const pricePerSqm = basePrice * finishingMultiplier;
        const estimatedCost = area * pricePerSqm;

        // Update results
        document.getElementById('estimated-cost').textContent = Math.round(estimatedCost).toLocaleString() + ' درهم';
        document.getElementById('result-area').textContent = area + ' متر مربع';
        document.getElementById('result-region').textContent = getRegionName(region);
        document.getElementById('result-style').textContent = getStyleName(style);
        document.getElementById('result-finishing').textContent = getFinishingName(finishing);
        document.getElementById('result-price-per-sqm').textContent = Math.round(pricePerSqm).toLocaleString() + ' درهم';

        // Show results
        document.getElementById('result-card').style.display = 'block';
        document.getElementById('result-card').scrollIntoView({ behavior: 'smooth' });

        // Store calculation data for project creation
        window.calculationData = {
            area: area,
            region: region,
            neighborhood: selectedNeighborhood,
            style: style,
            finishing: finishing,
            estimatedCost: estimatedCost,
            pricePerSqm: pricePerSqm,
            // Building details from step 3
            floors: parseInt(document.getElementById('floors').value) || 1,
            majlis: parseInt(document.getElementById('majlis').value) || 1,
            bedrooms: parseInt(document.getElementById('bedrooms').value) || 1,
            guestBedrooms: parseInt(document.getElementById('guest-bedrooms').value) || 0,
            bathrooms: parseInt(document.getElementById('bathrooms').value) || 1,
            parking: parseInt(document.getElementById('parking').value) || 1,
            otherRooms: parseInt(document.getElementById('other-rooms').value) || 0,
            finishingLevel: document.getElementById('finishing-level').value || 'medium',
            additionalFeatures: document.getElementById('additional-features').value || '',
            notes: document.getElementById('notes').value || ''
        };
    }

    function showCreateProjectForm() {
        if (!window.calculationData) {
            alert('يرجى إكمال حساب التكلفة أولاً');
            return;
        }

        // Pre-fill form with calculation data
        document.getElementById('project_area').value = window.calculationData.area;
        document.getElementById('project_location').value = getRegionName(window.calculationData.region);
        document.getElementById('project_neighborhood').value = window.calculationData.neighborhood;
        document.getElementById('project_style').value = window.calculationData.style;
        document.getElementById('project_estimated_cost').value = Math.round(window.calculationData.estimatedCost);

        // Set property type based on style
        if (window.calculationData.style === 'traditional') {
            document.getElementById('project_property_type').value = 'villa';
        } else {
            document.getElementById('project_property_type').value = 'residential';
        }

        // Pre-fill building details from step 3
        document.getElementById('floors').value = window.calculationData.floors || 1;
        document.getElementById('majlis').value = window.calculationData.majlis || 1;
        document.getElementById('bedrooms').value = window.calculationData.bedrooms || 1;
        document.getElementById('guest-bedrooms').value = window.calculationData.guestBedrooms || 0;
        document.getElementById('bathrooms').value = window.calculationData.bathrooms || 1;
        document.getElementById('parking').value = window.calculationData.parking || 1;
        document.getElementById('other-rooms').value = window.calculationData.otherRooms || 0;
        document.getElementById('finishing-level').value = window.calculationData.finishingLevel || 'medium';
        document.getElementById('additional-features').value = window.calculationData.additionalFeatures || '';
        document.getElementById('notes').value = window.calculationData.notes || '';

        document.getElementById('createProjectModal').classList.remove('hidden');
    }

    function closeCreateProjectForm() {
        document.getElementById('createProjectModal').classList.add('hidden');
    }

    // Handle project creation form submission
    document.getElementById('createProjectForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        // Add calculation data to form
        if (window.calculationData) {
            formData.append('floors', window.calculationData.floors || 1);
            formData.append('majlis_count', window.calculationData.majlis || 1);
            formData.append('bedrooms', window.calculationData.bedrooms || 1);
            formData.append('guest_bedrooms', window.calculationData.guestBedrooms || 0);
            formData.append('bathrooms', window.calculationData.bathrooms || 1);
            formData.append('parking_spaces', window.calculationData.parking || 1);
            formData.append('other_rooms', window.calculationData.otherRooms || 0);
            formData.append('finishing_level', window.calculationData.finishingLevel || 'medium');
            formData.append('additional_features', window.calculationData.additionalFeatures || '');
            formData.append('additional_notes', window.calculationData.notes || '');
        }

        fetch('{{ route("cost-calculator.create-project") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                closeCreateProjectForm();
                window.location.href = data.redirect_url;
            } else {
                alert('حدث خطأ أثناء إنشاء المشروع');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('حدث خطأ أثناء إنشاء المشروع');
        });
    });

    function getRegionName(region) {
        const names = {
            'abudhabi': 'أبو ظبي',
            'dubai': 'دبي',
            'sharjah': 'الشارقة',
            'ajman': 'عجمان',
            'ummalquwain': 'أم القيوين',
            'rasalkhaimah': 'رأس الخيمة',
            'fujairah': 'الفجيرة'
        };
        return names[region] || region;
    }

    function getStyleName(style) {
        const names = {
            'modern': 'عصري',
            'classic': 'كلاسيكي',
            'traditional': 'تراثي'
        };
        return names[style] || style;
    }

    function getFinishingName(finishing) {
        const names = {
            'low': 'منخفض',
            'medium': 'متوسط',
            'high': 'عالي'
        };
        return names[finishing] || finishing;
    }
</script>
@endsection
