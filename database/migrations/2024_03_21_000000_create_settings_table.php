<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->timestamps();
        });

        // Insert default settings
        $defaultSettings = [
            'site_name' => 'Haz Creatives Studio',
            'timezone' => 'UTC',
            'date_format' => 'Y-m-d',
            'currency' => 'USD',
            'company_name' => 'Haz Creatives Studio',
            'address' => '',
            'contact_number' => '',
            'invoice_prefix' => 'INV',
            'next_invoice_number' => '1',
            'email_notifications' => true,
            'invoice_notifications' => true,
            'payment_notifications' => true,
            'auto_backup' => 'daily',
            'backup_storage' => 'local',
            'enable_2fa' => false,
        ];

        foreach ($defaultSettings as $key => $value) {
            DB::table('settings')->insert([
                'key' => $key,
                'value' => $value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
}; 