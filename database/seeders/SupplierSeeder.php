<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Canon Professional Services',
                'contact_person' => 'John Smith',
                'email' => 'john.smith@canon.com',
                'phone' => '+1-800-123-4567',
                'address' => '123 Camera Street, New York, NY 10001',
                'status' => 'active',
            ],
            [
                'name' => 'Sony Alpha Pro',
                'contact_person' => 'Sarah Johnson',
                'email' => 'sarah.johnson@sony.com',
                'phone' => '+1-800-987-6543',
                'address' => '456 Electronics Avenue, Los Angeles, CA 90001',
                'status' => 'active',
            ],
            [
                'name' => 'Nikon Professional',
                'contact_person' => 'Michael Brown',
                'email' => 'michael.brown@nikon.com',
                'phone' => '+1-800-555-1234',
                'address' => '789 Lens Boulevard, Chicago, IL 60601',
                'status' => 'active',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
} 