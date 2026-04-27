<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('manufacturing_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('bom_id')->constrained()->onDelete('cascade');
            $table->decimal('qty_ordered', 15, 4);
            $table->decimal('qty_produced', 15, 4)->default(0);
            $table->string('status')->default('draft'); // draft, confirmed, scheduled, in_progress, done
            $table->dateTime('scheduled_start')->nullable();
            $table->dateTime('scheduled_end')->nullable();
            $table->dateTime('actual_start')->nullable();
            $table->dateTime('actual_end')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('confirmed_by')->nullable()->constrained('users');
            $table->foreignId('started_by')->nullable()->constrained('users');
            $table->foreignId('completed_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('manufacturing_orders');
    }
};