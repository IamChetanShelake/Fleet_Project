<?php

namespace Database\Seeders;

use App\Models\ContactSubmission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $submissions = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@email.com',
                'phone' => '+1 (555) 123-4567',
                'service_type' => 'Web Development',
                'message' => 'Hi, I\'m interested in your web development services. I have a small business and need a professional website built. Can you provide a quote for a complete e-commerce solution?',
                'status' => 'new',
                'created_at' => now()->subDays(2),
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.j@email.com',
                'phone' => '+1 (555) 987-6543',
                'service_type' => 'Mobile App',
                'message' => 'Hello! I saw your portfolio and I\'m very impressed with your mobile app development work. I have an idea for a fitness tracking app and would like to discuss the possibility of working together.',
                'status' => 'read',
                'read_at' => now()->subDays(1),
                'created_at' => now()->subDays(3),
            ],
            [
                'name' => 'Mike Davis',
                'email' => 'mike.davis@company.com',
                'phone' => '+1 (555) 456-7890',
                'service_type' => 'Consultation',
                'message' => 'Good afternoon. I represent a mid-sized corporation and we\'re looking to modernize our existing web platform. We need a comprehensive audit and recommendations for improvement. Please contact me to schedule a consultation.',
                'status' => 'replied',
                'read_at' => now()->subDays(4),
                'created_at' => now()->subDays(5),
            ],
            [
                'name' => 'Emily Chen',
                'email' => 'emily.chen@gmail.com',
                'phone' => null,
                'service_type' => 'UI/UX Design',
                'message' => 'Hi there! I\'m a freelance designer looking to collaborate on some exciting projects. Your work style really resonates with me, and I think we could create something amazing together. Let\'s connect!',
                'status' => 'new',
                'created_at' => now()->subHours(6),
            ],
            [
                'name' => 'Robert Wilson',
                'email' => 'r.wilson@startup.io',
                'phone' => '+1 (555) 234-5678',
                'service_type' => 'Web Development',
                'message' => 'Hello! We\'re a startup working on an innovative SaaS platform. We need a skilled development team to help us build our MVP. Our timeline is aggressive but we\'re willing to pay competitive rates for quality work.',
                'status' => 'read',
                'read_at' => now()->subHours(12),
                'created_at' => now()->subHours(18),
            ],
            [
                'name' => 'Lisa Anderson',
                'email' => 'lisa.anderson@email.com',
                'phone' => '+1 (555) 345-6789',
                'service_type' => 'Maintenance',
                'message' => 'Hi, I have a website that I built a few years ago and it\'s starting to show its age. I need someone to update it with modern design trends and ensure it\'s mobile-responsive. Do you offer website maintenance packages?',
                'status' => 'archived',
                'read_at' => now()->subDays(7),
                'created_at' => now()->subDays(10),
            ],
            [
                'name' => 'David Brown',
                'email' => 'david.brown@techcorp.com',
                'phone' => '+1 (555) 567-8901',
                'service_type' => 'Consultation',
                'message' => 'Dear team, We\'re planning a complete digital transformation for our company. This includes new website, mobile apps, and internal systems. We\'d like to discuss a long-term partnership. Please reach out to schedule a discovery call.',
                'status' => 'replied',
                'read_at' => now()->subDays(6),
                'created_at' => now()->subDays(8),
            ],
            [
                'name' => 'Anna Martinez',
                'email' => 'anna.martinez@restaurant.com',
                'phone' => '+1 (555) 678-9012',
                'service_type' => 'Web Development',
                'message' => 'Hello! I own a restaurant and we\'re looking to create an online ordering system. We want something user-friendly that integrates with our POS system. Can you help us with this?',
                'status' => 'new',
                'created_at' => now()->subHours(2),
            ],
        ];

        foreach ($submissions as $submission) {
            ContactSubmission::create($submission);
        }
    }
}
