@extends('layouts.app')

@section('title', 'معرض أعمالي - insha\'at')

@section('content')
<style>
    .portfolio-header {
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        color: white;
        padding: 3rem 0;
        margin-bottom: 2rem;
    }

    .portfolio-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .portfolio-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        text-align: center;
        transition: transform 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        color: #64748b;
        font-size: 0.9rem;
    }

    .portfolio-filters {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
    }

    .filters-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        align-items: end;
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

    .form-select {
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.9rem;
        background: white;
        transition: border-color 0.3s ease;
    }

    .form-select:focus {
        outline: none;
        border-color: #14b8a6;
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.1);
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #14b8a6, #0d9488);
        color: white;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
    }

    .btn-secondary {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #e2e8f0;
    }

    .btn-secondary:hover {
        background: #e2e8f0;
        color: #334155;
    }

    .portfolio-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .portfolio-item {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .portfolio-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.15);
    }

    .portfolio-image {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #f0fdf4, #ecfdf5);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #14b8a6;
    }

    .portfolio-content {
        padding: 1.5rem;
    }

    .portfolio-title-item {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }

    .portfolio-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .meta-label {
        font-size: 0.8rem;
        color: #64748b;
        font-weight: 500;
    }

    .meta-value {
        font-size: 0.9rem;
        color: #1e293b;
        font-weight: 600;
    }

    .portfolio-description {
        color: #64748b;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
    }

    .portfolio-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .empty-state i {
        font-size: 4rem;
        color: #cbd5e1;
        margin-bottom: 1.5rem;
    }

    .empty-state h3 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #94a3b8;
        margin-bottom: 2rem;
    }

    .add-project-section {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        margin-bottom: 2rem;
        text-align: center;
    }

    .add-project-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #14b8a6, #0d9488);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        font-size: 2rem;
        color: white;
    }

    @media (max-width: 768px) {
        .portfolio-header {
            padding: 2rem 0;
        }

        .portfolio-title {
            font-size: 2rem;
        }

        .portfolio-stats {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .portfolio-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        .filters-grid {
            grid-template-columns: 1fr;
        }

        .portfolio-actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="portfolio-header">
    <div class="container">
        <h1 class="portfolio-title">معرض أعمالي</h1>
        <p style="font-size: 1.1rem; opacity: 0.9;">عرض المشاريع المنجزة والأعمال السابقة</p>
    </div>
</div>

<div class="container">
    <!-- Statistics -->
    <div class="portfolio-stats">
        <div class="stat-card">
            <div class="stat-icon" style="background: #d1fae5; color: #065f46;">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="stat-number" style="color: #065f46;">{{ $portfolio->where('status', 'completed')->count() ?? 0 }}</div>
            <div class="stat-label">مشاريع مكتملة</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #dbeafe; color: #1e40af;">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-number" style="color: #1e40af;">{{ $portfolio->where('status', 'in_progress')->count() ?? 0 }}</div>
            <div class="stat-label">مشاريع قيد التنفيذ</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #fef3c7; color: #92400e;">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-number" style="color: #92400e;">4.8</div>
            <div class="stat-label">متوسط التقييم</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon" style="background: #e0e7ff; color: #3730a3;">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-number" style="color: #3730a3;">{{ $portfolio->count() ?? 0 }}</div>
            <div class="stat-label">إجمالي المشاريع</div>
        </div>
    </div>

    <!-- Add New Project -->
    <div class="add-project-section">
        <div class="add-project-icon">
            <i class="fas fa-plus"></i>
        </div>
        <h2 style="font-size: 1.5rem; font-weight: 600; color: #1e293b; margin-bottom: 1rem;">
            أضف مشروع جديد لمعرضك
        </h2>
        <p style="color: #64748b; margin-bottom: 2rem;">
            شارك أعمالك المنجزة مع العملاء المحتملين لزيادة فرص الحصول على مشاريع جديدة
        </p>
        <a href="#" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            إضافة مشروع جديد
        </a>
    </div>

    <!-- Filters -->
    <div class="portfolio-filters">
        <h2 style="font-size: 1.5rem; font-weight: 600; color: #1e293b; margin-bottom: 1.5rem;">
            <i class="fas fa-filter" style="margin-left: 0.5rem; color: #14b8a6;"></i>
            تصفية المشاريع
        </h2>

        <form method="GET" action="{{ route('consultant.portfolio') }}">
            <div class="filters-grid">
                <div class="form-group">
                    <label class="form-label">حالة المشروع</label>
                    <select name="status" class="form-select">
                        <option value="">جميع الحالات</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>مكتمل</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>قيد التنفيذ</option>
                        <option value="planning" {{ request('status') == 'planning' ? 'selected' : '' }}>قيد التخطيط</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">نوع المشروع</label>
                    <select name="project_type" class="form-select">
                        <option value="">جميع الأنواع</option>
                        <option value="villa" {{ request('project_type') == 'villa' ? 'selected' : '' }}>فيلا</option>
                        <option value="apartment" {{ request('project_type') == 'apartment' ? 'selected' : '' }}>شقة</option>
                        <option value="building" {{ request('project_type') == 'building' ? 'selected' : '' }}>مبنى</option>
                        <option value="commercial" {{ request('project_type') == 'commercial' ? 'selected' : '' }}>تجاري</option>
                    </select>
                </div>

                <div class="form-group">
                    <label class="form-label">السنة</label>
                    <select name="year" class="form-select">
                        <option value="">جميع السنوات</option>
                        <option value="2024" {{ request('year') == '2024' ? 'selected' : '' }}>2024</option>
                        <option value="2023" {{ request('year') == '2023' ? 'selected' : '' }}>2023</option>
                        <option value="2022" {{ request('year') == '2022' ? 'selected' : '' }}>2022</option>
                        <option value="2021" {{ request('year') == '2021' ? 'selected' : '' }}>2021</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                        تصفية
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Portfolio Grid -->
    @if(isset($portfolio) && $portfolio->count() > 0)
    <div class="portfolio-grid">
        @foreach($portfolio as $project)
        <div class="portfolio-item">
            <div class="portfolio-image">
                <i class="fas fa-building"></i>
            </div>

            <div class="portfolio-content">
                <h3 class="portfolio-title-item">{{ $project->title ?? 'مشروع جديد' }}</h3>

                <div class="portfolio-meta">
                    <div class="meta-item">
                        <span class="meta-label">النوع</span>
                        <span class="meta-value">{{ $project->type ?? 'فيلا' }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">المساحة</span>
                        <span class="meta-value">{{ $project->area ?? '500' }} م²</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">السنة</span>
                        <span class="meta-value">{{ $project->year ?? '2024' }}</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-label">الحالة</span>
                        <span class="meta-value">{{ $project->status ?? 'مكتمل' }}</span>
                    </div>
                </div>

                <p class="portfolio-description">
                    {{ $project->description ?? 'وصف المشروع يظهر هنا. يمكنك إضافة تفاصيل المشروع والتصميم المطبق.' }}
                </p>

                <div class="portfolio-actions">
                    <a href="#" class="btn btn-primary btn-sm">
                        <i class="fas fa-eye"></i>
                        عرض التفاصيل
                    </a>
                    <a href="#" class="btn btn-secondary btn-sm">
                        <i class="fas fa-edit"></i>
                        تعديل
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state">
        <i class="fas fa-folder-open"></i>
        <h3>لا توجد مشاريع في المعرض</h3>
        <p>لم تقم بإضافة أي مشاريع لمعرضك حتى الآن. ابدأ بإضافة مشروعك الأول!</p>
        <a href="#" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            إضافة مشروع جديد
        </a>
    </div>
    @endif
</div>
@endsection





