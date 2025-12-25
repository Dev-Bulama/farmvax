<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\AnimalHealthProfessional;
use App\Models\Volunteer;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ========================================
        // 1. CREATE ADMIN USER
        // ========================================
        
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@farmvax.com',
            'phone' => '+234-800-000-0001',
            'address' => 'FarmVax Headquarters, Abuja, Nigeria',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        
        $this->command->info('✅ Admin created: admin@farmvax.com / admin123');
        
        // ========================================
        // 2. CREATE FARMERS (3 users)
        // ========================================
        
        $farmer1 = User::create([
            'name' => 'John Farmer',
            'email' => 'farmer@farmvax.com',
            'phone' => '+234-800-111-1111',
            'address' => 'Farm Village, Kaduna State, Nigeria',
            'password' => Hash::make('farmer123'),
            'role' => 'farmer',
            'email_verified_at' => now(),
        ]);
        
        $farmer2 = User::create([
            'name' => 'Mary Livestock',
            'email' => 'mary@farmvax.com',
            'phone' => '+234-800-111-2222',
            'address' => 'Green Valley Farm, Kano State, Nigeria',
            'password' => Hash::make('farmer123'),
            'role' => 'farmer',
            'email_verified_at' => now(),
        ]);
        
        $farmer3 = User::create([
            'name' => 'David Rancher',
            'email' => 'david@farmvax.com',
            'phone' => '+234-800-111-3333',
            'address' => 'Sunrise Ranch, Plateau State, Nigeria',
            'password' => Hash::make('farmer123'),
            'role' => 'farmer',
            'email_verified_at' => now(),
        ]);
        
        $this->command->info('✅ Farmers created (3): farmer@farmvax.com / farmer123');
        
        // ========================================
        // 3. CREATE ANIMAL HEALTH PROFESSIONALS
        // ========================================
        
        // Approved Professional
        $professional1 = User::create([
            'name' => 'Dr. Sarah Veterinarian',
            'email' => 'professional@farmvax.com',
            'phone' => '+234-800-222-1111',
            'address' => 'Veterinary Clinic, Lagos State, Nigeria',
            'password' => Hash::make('professional123'),
            'role' => 'animal_health_professional',
            'email_verified_at' => now(),
        ]);
        
        AnimalHealthProfessional::create([
            'user_id' => $professional1->id,
            'professional_type' => 'veterinarian',
            'license_number' => 'VET-2024-001',
            'organization' => 'Lagos Veterinary Clinic',
            'specialization' => 'Livestock Health',
            'experience_years' => 10,
            'assigned_territory' => 'Lagos State',
            'approval_status' => 'approved',
            'approved_by' => $admin->id,
            'approved_at' => now(),
            'submitted_at' => now()->subDays(5),
        ]);
        
        $this->command->info('✅ Professional (Approved) created: professional@farmvax.com / professional123');
        
        // Pending Professional
        $professional2 = User::create([
            'name' => 'Dr. James Veterinary',
            'email' => 'pending@farmvax.com',
            'phone' => '+234-800-222-2222',
            'address' => 'Animal Clinic, Abuja, Nigeria',
            'password' => Hash::make('professional123'),
            'role' => 'animal_health_professional',
            'email_verified_at' => now(),
        ]);
        
        AnimalHealthProfessional::create([
            'user_id' => $professional2->id,
            'professional_type' => 'veterinarian',
            'license_number' => 'VET-2024-002',
            'organization' => 'Abuja Animal Health Center',
            'specialization' => 'Farm Advisory',
            'experience_years' => 5,
            'assigned_territory' => 'FCT Abuja',
            'approval_status' => 'pending',
            'submitted_at' => now()->subDays(2),
            'application_notes' => 'Looking forward to helping farmers in my community.',
        ]);
        
        $this->command->info('✅ Professional (Pending) created: pending@farmvax.com / professional123');
        
        // ========================================
        // 4. CREATE VOLUNTEER
        // ========================================
        
        $volunteer1 = User::create([
            'name' => 'Alice Volunteer',
            'email' => 'volunteer@farmvax.com',
            'phone' => '+234-800-333-1111',
            'address' => 'Community Center, Kano State, Nigeria',
            'password' => Hash::make('volunteer123'),
            'role' => 'volunteer',
            'email_verified_at' => now(),
        ]);
        
        // Create volunteer profile
        Volunteer::create([
            'user_id' => $volunteer1->id,
            'organization' => 'Community Development NGO',
            'motivation' => 'Want to help local farmers improve their livestock health.',
            'status' => 'active',
            'availability' => 'Weekends',
            'farmers_enrolled' => 0,
        ]);
        
        $this->command->info('✅ Volunteer created: volunteer@farmvax.com / volunteer123');
        
        // ========================================
        // 5. CREATE SAMPLE LIVESTOCK DATA (Using Raw SQL)
        // ========================================
        
        // Use DB::insert for maximum compatibility
        DB::insert('INSERT INTO livestock (user_id, owner_id, type, breed, tag_number, date_of_birth, gender, health_status, notes, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $farmer1->id, $farmer1->id, 'cattle', 'Holstein', 'COW-001', now()->subYears(2), 'female', 'healthy', 'High milk producer', now(), now()
        ]);
        
        DB::insert('INSERT INTO livestock (user_id, owner_id, type, breed, tag_number, date_of_birth, gender, health_status, notes, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $farmer1->id, $farmer1->id, 'cattle', 'Angus', 'COW-002', now()->subYears(3), 'male', 'healthy', 'Breeding bull', now(), now()
        ]);
        
        DB::insert('INSERT INTO livestock (user_id, owner_id, type, breed, tag_number, date_of_birth, gender, health_status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $farmer2->id, $farmer2->id, 'goat', 'Boer', 'GOAT-001', now()->subYear(), 'female', 'healthy', now(), now()
        ]);
        
        DB::insert('INSERT INTO livestock (user_id, owner_id, type, breed, tag_number, date_of_birth, gender, health_status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $farmer2->id, $farmer2->id, 'sheep', 'Merino', 'SHEEP-001', now()->subMonths(18), 'female', 'healthy', now(), now()
        ]);
        
        DB::insert('INSERT INTO livestock (user_id, owner_id, type, breed, tag_number, date_of_birth, gender, health_status, notes, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $farmer3->id, $farmer3->id, 'poultry', 'Rhode Island Red', 'CHICKEN-FLOCK-A', now()->subMonths(6), 'female', 'healthy', 'Egg laying flock - 50 birds', now(), now()
        ]);
        
        $this->command->info('✅ Sample livestock created (5 animals)');
        
        // ========================================
        // 6. CREATE SERVICE REQUESTS (Using Raw SQL - Only Required Columns)
        // ========================================
        
        // Use only columns that definitely exist
        DB::insert('INSERT INTO service_requests (user_id, service_type, description, preferred_date, urgency_level, status, contact_phone, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $farmer1->id,
            'vaccination',
            'Need FMD vaccination for 10 cattle',
            now()->addDays(5),
            'medium',
            'pending',
            $farmer1->phone,
            now(),
            now()
        ]);
        
        DB::insert('INSERT INTO service_requests (user_id, service_type, description, preferred_date, urgency_level, status, contact_phone, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $farmer2->id,
            'treatment',
            'One goat showing signs of illness - fever and loss of appetite',
            now()->addDays(1),
            'high',
            'pending',
            $farmer2->phone,
            now(),
            now()
        ]);
        
        DB::insert('INSERT INTO service_requests (user_id, service_type, description, preferred_date, urgency_level, status, contact_phone, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)', [
            $farmer3->id,
            'consultation',
            'Advice on improving poultry egg production',
            now()->addWeek(),
            'low',
            'pending',
            $farmer3->phone,
            now(),
            now()
        ]);
        
        $this->command->info('✅ Service requests created (3 requests)');
        
        // ========================================
        // 7. SUMMARY
        // ========================================
        
        $this->command->newLine();
        $this->command->info('========================================');
        $this->command->info('   DATABASE SEEDED SUCCESSFULLY!');
        $this->command->info('========================================');
        $this->command->newLine();
        $this->command->info('📧 LOGIN CREDENTIALS:');
        $this->command->newLine();
        $this->command->info('ADMIN:');
        $this->command->info('  Email: admin@farmvax.com');
        $this->command->info('  Password: admin123');
        $this->command->newLine();
        $this->command->info('FARMER:');
        $this->command->info('  Email: farmer@farmvax.com');
        $this->command->info('  Password: farmer123');
        $this->command->newLine();
        $this->command->info('PROFESSIONAL (Approved):');
        $this->command->info('  Email: professional@farmvax.com');
        $this->command->info('  Password: professional123');
        $this->command->newLine();
        $this->command->info('PROFESSIONAL (Pending):');
        $this->command->info('  Email: pending@farmvax.com');
        $this->command->info('  Password: professional123');
        $this->command->newLine();
        $this->command->info('VOLUNTEER:');
        $this->command->info('  Email: volunteer@farmvax.com');
        $this->command->info('  Password: volunteer123');
        $this->command->newLine();
        $this->command->info('========================================');
        $this->command->info('Total Users: ' . User::count());
        $this->command->info('Total Livestock: ' . DB::table('livestock')->count());
        $this->command->info('Total Service Requests: ' . DB::table('service_requests')->count());
        $this->command->info('========================================');
    }
}