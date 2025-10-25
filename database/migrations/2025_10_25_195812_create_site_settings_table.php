<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, image, file, json
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(false); // يمكن الوصول إليه من الواجهة العامة
            $table->timestamps();
        });

        // إدراج الإعدادات الأساسية
        DB::table('site_settings')->insert([
            [
                'key' => 'site_name',
                'value' => 'منصة انشاءات',
                'type' => 'text',
                'description' => 'اسم الموقع',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'site_description',
                'value' => 'منصة انشاءات لتصميم البيوت العصرية والإسلامية',
                'type' => 'text',
                'description' => 'وصف الموقع',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'site_logo',
                'value' => null,
                'type' => 'image',
                'description' => 'لوجو الموقع',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'site_favicon',
                'value' => null,
                'type' => 'image',
                'description' => 'أيقونة الموقع',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'hero_background',
                'value' => null,
                'type' => 'image',
                'description' => 'صورة خلفية الصفحة الرئيسية',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'about_image',
                'value' => null,
                'type' => 'image',
                'description' => 'صورة قسم من نحن',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@inshaat.com',
                'type' => 'text',
                'description' => 'البريد الإلكتروني للتواصل',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'contact_phone',
                'value' => '+966501234567',
                'type' => 'text',
                'description' => 'رقم الهاتف للتواصل',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'contact_address',
                'value' => 'الرياض، المملكة العربية السعودية',
                'type' => 'text',
                'description' => 'عنوان التواصل',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'social_media',
                'value' => json_encode([
                    'facebook' => '',
                    'twitter' => '',
                    'instagram' => '',
                    'linkedin' => '',
                    'youtube' => ''
                ]),
                'type' => 'json',
                'description' => 'روابط وسائل التواصل الاجتماعي',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'maintenance_mode',
                'value' => '0',
                'type' => 'text',
                'description' => 'وضع الصيانة',
                'is_public' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'site_colors',
                'value' => json_encode([
                    'primary' => '#3B82F6',
                    'secondary' => '#10B981',
                    'accent' => '#F59E0B',
                    'background' => '#F8FAFC'
                ]),
                'type' => 'json',
                'description' => 'ألوان الموقع',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
