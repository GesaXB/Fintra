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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->decimal('budget_amount', 10,2)->default(0);
            $table->year('month'); // Mungkin lebih tepat menggunakan 'budget_year' atau 'period'
            $table->timestamps();
            
            // Index untuk performa query
            $table->index(['user_id', 'category_id']);
            $table->index(['user_id', 'month']);
            
            // Unique constraint untuk mencegah duplikasi budget per kategori per bulan
            $table->unique(['user_id', 'category_id', 'month']);
        });
    }

    /**

     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};
