<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Carbon;

class HumanResourcesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        DB::table('departments')->insert([
            ['name' => 'Human Resources', 'description' => 'Handles recruitment and employee relations', 'status' => 'active', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'IT', 'description' => 'Manages technology and infrastructure', 'status' => 'active', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['name' => 'Finance', 'description' => 'Oversees financial planning and management', 'status' => 'active', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        DB::table('roles')->insert([
            ['title' => 'Manager', 'description' => 'Oversees department operations', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Developer', 'description' => 'Builds and maintains software applications', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['title' => 'Accountant', 'description' => 'Manages financial records and transactions', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);

        DB::table('employees')->insert([
            [
                'fullname' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phoneNumber' => $faker->phoneNumber(),
                'birthDate' => $faker->date(),
                'hireDate' => $faker->date(),
                'departmentId' => 1,
                'roleId' => 1,
                'status' => 'active',
                'salary' => $faker->randomFloat(2, 50000, 90000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'fullname' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phoneNumber' => $faker->phoneNumber(),
                'birthDate' => $faker->date(),
                'hireDate' => $faker->date(),
                'departmentId' => 2,
                'roleId' => 2,
                'status' => 'active',
                'salary' => $faker->randomFloat(2, 50000, 90000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'fullname' => 'Robert Johnson',
                'email' => 'robert.johnson@example.com',
                'phoneNumber' => $faker->phoneNumber(),
                'birthDate' => $faker->date(),
                'hireDate' => $faker->date(),
                'departmentId' => 3,
                'roleId' => 3,
                'status' => 'active',
                'salary' => $faker->randomFloat(2, 50000, 90000),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        DB::table('tasks')->insert([
            [
                'title' => 'Prepare Monthly Report',
                'description' => 'Compile and analyze monthly financial data',
                'assignedTo' => 3,
                'dueDate' => Carbon::now()->addDays(7),
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'title' => 'Develop New Feature',
                'description' => 'Implement the new user authentication feature',
                'assignedTo' => 2,
                'dueDate' => Carbon::now()->addDays(14),
                'status' => 'in_progress',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        DB::table('payroll')->insert([
            [
                'employeeId' => 1,
                'salary' => 75000.00,
                'bonuses' => 5000.00,
                'deductions' => 2000.00,
                'netSalary' => 78000.00,
                'paymentDate' => Carbon::parse('2025-12-01'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employeeId' => 2,
                'salary' => 85000.00,
                'bonuses' => 7000.00,
                'deductions' => 3000.00,
                'netSalary' => 89000.00,
                'paymentDate' => Carbon::parse('2025-12-01'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employeeId' => 3,
                'salary' => 70000.00,
                'bonuses' => 4000.00,
                'deductions' => 1500.00,
                'netSalary' => 72500.00,
                'paymentDate' => Carbon::parse('2025-12-01'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        DB::table('presence')->insert([
            [
                'employeeId' => 1,
                'date' => Carbon::now()->subDays(1)->toDateString(),
                'checkIn' => '09:00:00',
                'checkOut' => '17:00:00',
                'status' => 'present',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employeeId' => 2,
                'date' => Carbon::now()->subDays(1)->toDateString(),
                'checkIn' => '09:15:00',
                'checkOut' => '17:15:00',
                'status' => 'present',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);

        DB::table('leaves')->insert([
            [
                'employeeId' => 1,
                'leaveReason' => 'Vacation',
                'startDate' => Carbon::now()->addDays(10)->toDateString(),
                'endDate' => Carbon::now()->addDays(15)->toDateString(),
                'status' => 'approved',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'employeeId' => 2,
                'leaveReason' => 'Sick Leave',
                'startDate' => Carbon::now()->addDays(5)->toDateString(),
                'endDate' => Carbon::now()->addDays(7)->toDateString(),
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}
