<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('suppliers_name'); // Supplier name
            $table->string('suppliers_company')->nullable(); // Supplier company
            $table->string('suppliers_email')->unique()->nullable(); // Email
            $table->string('suppliers_phone')->nullable(); // Phone number
            $table->text('suppliers_address')->nullable(); // Address
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
