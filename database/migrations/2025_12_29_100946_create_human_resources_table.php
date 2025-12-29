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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('status');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();

            $table->timestamps();
            $table->softDeletes();
        }) ;

        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('fullName');
            $table->string('email')->unique();
            $table->string('phoneNumber')->nullable();
            $table->date('birthDate')->nullable();
            $table->date('hireDate');
            $table->unsignedBigInteger('departmentId');
            $table->unsignedBigInteger('roleId');
            $table->string('status');
            $table->decimal('salary', 10, 2);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('departmentId')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('roleId')->references('id')->on('roles')->onDelete('cascade');
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description')->nullable();
            $table->foreignId('assignedTo')->constrained('employees')->onDelete('cascade');
            $table->date('dueDate')->nullable();
            $table->string('status');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('payroll', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employeeId')->constrained('employees')->onDelete('cascade');
            $table->decimal('salary', 10, 2);
            $table->decimal('bonuses', 10, 2)->nullable();
            $table->decimal('deductions', 10, 2)->nullable();
            $table->decimal('netSalary', 10, 2);
            $table->date('paymentDate');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('presence', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employeeId')->constrained('employees')->onDelete('cascade');
            $table->date('date');
            $table->time('checkIn')->nullable();
            $table->time('checkOut')->nullable();
            $table->string('status');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employeeId')->constrained('employees')->onDelete('cascade');
            $table->string('leaveReason')->nullable();
            $table->date('startDate');
            $table->date('endDate');
            $table->string('status');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('payroll');
        Schema::dropIfExists('presence');
        Schema::dropIfExists('leaves');
    }
};
