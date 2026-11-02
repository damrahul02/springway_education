<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Inquiry;
use App\Models\NewsPost;
use App\Models\GalleryItem;
use App\Models\PageContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@springwaybd.com'],
            [
                'name' => 'Midhat Abduzzahir (Mishu)',
                'phone' => '+880 1341 55 88 22',
                'role' => 'admin',
                'status' => 'active',
                'designation' => 'Founder & CEO',
                'bio' => 'Founder of Springway Education, guiding students towards world-class international education.',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 2. Executive User
        $executive = User::updateOrCreate(
            ['email' => 'executive@springwaybd.com'],
            [
                'name' => 'Tanvir Ahmed',
                'phone' => '+880 1711 00 22 33',
                'role' => 'executive',
                'status' => 'active',
                'designation' => 'Senior Study Abroad Counselor (UK & Canada)',
                'bio' => 'Expert counselor for Russell Group universities and Canadian PGWP programs.',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // 3. Sample Inquiries
        if (Inquiry::count() === 0) {
            $sampleInquiries = [
                [
                    'name' => 'Sarah Rahman',
                    'email' => 'sarah.rahman@gmail.com',
                    'phone' => '+880 1712 345678',
                    'destination' => 'United Kingdom',
                    'message' => 'Completed BSc in CSE from SUST with CGPA 3.65. Looking for MSc in Advanced Software Engineering with scholarship options for September intake.',
                    'status' => 'in_progress',
                    'assigned_to' => $executive->id,
                    'internal_notes' => 'IELTS 7.0 (no band less than 6.5). Preparing documents for Queen Mary University of London and University of Birmingham.',
                    'created_at' => now()->subDays(2),
                ],
                [
                    'name' => 'MD Arif Hossain',
                    'email' => 'arif.hossain89@yahoo.com',
                    'phone' => '+880 1819 876543',
                    'destination' => 'Canada',
                    'message' => 'Interested in 2-year Postgraduate Diploma in International Business Management in Ontario or British Columbia with 3-year PGWP.',
                    'status' => 'new',
                    'assigned_to' => null,
                    'internal_notes' => 'Needs initial consultation on bank solvency and provincial attestation letter (PAL) requirements.',
                    'created_at' => now()->subDays(1),
                ],
                [
                    'name' => 'Nusrat Jahan',
                    'email' => 'nusrat.jahan.syl@gmail.com',
                    'phone' => '+880 1913 223344',
                    'destination' => 'Australia',
                    'message' => 'HSC passed in 2024 with GPA 5.0. Planning for Bachelor of Nursing in Melbourne or Sydney with registered nurse pathway.',
                    'status' => 'contacted',
                    'assigned_to' => $executive->id,
                    'internal_notes' => 'Registered for IELTS test next month. Target score 7.0 overall.',
                    'created_at' => now()->subHours(6),
                ],
                [
                    'name' => 'Rafiqul Islam',
                    'email' => 'rafiqul.islam.bd@gmail.com',
                    'phone' => '+880 1622 998877',
                    'destination' => 'United States',
                    'message' => 'Working professional with 4 years experience at a multinational company. Seeking STEM-designated MBA program with OPT.',
                    'status' => 'admitted',
                    'assigned_to' => $admin->id,
                    'internal_notes' => 'I-20 received from University of North Texas. Scheduling mock visa interview for F-1 visa.',
                    'created_at' => now()->subDays(5),
                ],
                [
                    'name' => 'Fahim Chowdhury',
                    'email' => 'fahim.chy.sylhet@outlook.com',
                    'phone' => '+880 1533 112233',
                    'destination' => 'Germany',
                    'message' => 'BSc in Mechanical Engineering. Interested in tuition-free English-taught Masters program in Automotive Engineering.',
                    'status' => 'new',
                    'assigned_to' => null,
                    'internal_notes' => 'Needs APS certificate guidance and German blocked account advice.',
                    'created_at' => now()->subHours(2),
                ],
                [
                    'name' => 'Sadia Akter',
                    'email' => 'sadia.akter@gmail.com',
                    'phone' => '+880 1788 445566',
                    'destination' => 'Malaysia',
                    'message' => 'Affordable Bachelor in Computer Science at Monash University Malaysia campus or Sunway University.',
                    'status' => 'visa_granted',
                    'assigned_to' => $executive->id,
                    'internal_notes' => 'eVAL visa approval letter received. Student flight booked for next week.',
                    'created_at' => now()->subDays(10),
                ]
            ];

            foreach ($sampleInquiries as $item) {
                Inquiry::create($item);
            }
        }

        // 4. News & Updates Seeding
        if (NewsPost::count() === 0) {
            $newsData = [
                [
                    'title' => 'Springway Multi-Destination International Education Expo 2026 Announced in Sylhet',
                    'category' => 'Events',
                    'summary' => 'Representatives from over 45 universities across the UK, Canada, Australia, and the USA will participate directly at Rose View Hotel, Sylhet.',
                    'content' => "<p>We are thrilled to announce the <strong>Springway Multi-Destination International Education Expo 2026</strong>, scheduled to take place at the Grand Ballroom, Rose View Hotel, Sylhet. This flagship event brings together official university delegates, senior counselors, and visa specialists under one roof.</p><p>Students attending will receive:</p><ul><li>Instant on-spot profile evaluations</li><li>Direct interaction with official university representatives</li><li>Up to 50% merit-based scholarship assessments</li><li>Application fee waivers from partner institutions</li><li>Guidance on post-study work permits and immigration rules</li></ul><p>Admissions are open for upcoming September and January intakes. Pre-registration is completely free of charge.</p>",
                    'image' => '/images/hero/slide1.jpg',
                    'author_id' => $admin->id,
                    'is_published' => true,
                    'published_at' => now()->subDays(3),
                    'views_count' => 342,
                ],
                [
                    'title' => 'UK Student Visa Regulations & Financial Requirements: Complete 2026 Guide',
                    'category' => 'Visa Updates',
                    'summary' => 'Comprehensive breakdown of updated maintenance funds, CAS issuance timelines, and healthcare surcharge requirements for Bangladeshi students.',
                    'content' => "<p>The UK Visas and Immigration (UKVI) has updated financial thresholds and verification procedures for international students. Our compliance team has assembled key takeaways to ensure zero refusal rates for our applicants.</p><h3>Key Points Covered:</h3><ol><li><strong>Maintenance Funds:</strong> Inner London and Outer London maintenance calculation adjustments.</li><li><strong>28-Day Bank Statement Rule:</strong> Explicit guidance on accepted financial institutions and acceptable funds seasoning.</li><li><strong>Credibility Interviews:</strong> Tips and mock interview frameworks designed by Springway mentors to confidently pass UKVI compliance checks.</li></ol><p>Our students continue to enjoy a 98% first-time visa approval rate thanks to rigorous pre-submission audits.</p>",
                    'image' => '/images/hero/slide2.jpg',
                    'author_id' => $executive->id,
                    'is_published' => true,
                    'published_at' => now()->subDays(7),
                    'views_count' => 520,
                ],
                [
                    'title' => 'Canada Post-Graduation Work Permit (PGWP) & Provincial Attestation Letter (PAL) Clarifications',
                    'category' => 'Scholarships',
                    'summary' => 'What Bangladeshi applicants need to know about Provincial Attestation Letters (PAL) and qualifying public university Master degree programs.',
                    'content' => "<p>Recent regulatory enhancements by IRCC have created new pathways while prioritizing Master's and doctoral degree applicants. Master's graduates continue to qualify for up to a full 3-year Post-Graduation Work Permit (PGWP) regardless of the course length, provided it is at least 8 months long.</p><p>Springway Education assists students in securing timely Provincial Attestation Letters (PAL) across British Columbia, Ontario, Alberta, and Nova Scotia, ensuring clean visa documentation and fast turnaround times.</p>",
                    'image' => '/images/hero/slide3.jpg',
                    'author_id' => $admin->id,
                    'is_published' => true,
                    'published_at' => now()->subDays(12),
                    'views_count' => 418,
                ],
                [
                    'title' => 'Over 40 Students Celebrate Visa Success in Fall Batch at Springway Office',
                    'category' => 'Student Story',
                    'summary' => 'Heartwarming pre-departure ceremony held at Kaniz Plaza office as students prepare to embark on their undergraduate and postgraduate journeys overseas.',
                    'content' => "<p>Springway Education hosted a joyous pre-departure briefing and celebration at our Sylhet head office in Kaniz Plaza, Zindabazar. Over 40 students with confirmed visas for prestigious universities including Queen Mary University of London, University of Alberta, Deakin University, and Sunway University attended with their families.</p><p>Founder & CEO Midhat Abduzzahir (Mishu) addressed the students, handing over personalized pre-departure packs including emergency contacts, sim cards, airport transit guides, and student housing confirmations.</p>",
                    'image' => '/images/hero/slide4.jpg',
                    'author_id' => $admin->id,
                    'is_published' => true,
                    'published_at' => now()->subDays(18),
                    'views_count' => 610,
                ]
            ];

            foreach ($newsData as $item) {
                $item['slug'] = Str::slug($item['title']);
                NewsPost::create($item);
            }
        }

        // 5. Gallery Items Seeding (Photos and Videos)
        if (GalleryItem::count() === 0) {
            $galleryData = [
                [
                    'title' => 'International Education Expo — Student Counseling Sessions',
                    'type' => 'image',
                    'url' => '/images/hero/slide1.jpg',
                    'category' => 'Seminars & Expos',
                    'caption' => 'One-on-one sessions between students and university delegates at the Grand Ballroom, Sylhet.',
                    'is_featured' => true,
                    'sort_order' => 1,
                ],
                [
                    'title' => 'Pre-Departure Briefing & Celebration at Head Office',
                    'type' => 'image',
                    'url' => '/images/hero/slide2.jpg',
                    'category' => 'Student Success',
                    'caption' => 'Successful visa recipients receiving their official travel briefing and transit kits.',
                    'is_featured' => true,
                    'sort_order' => 2,
                ],
                [
                    'title' => 'Official Delegation Visit from UK Partner Universities',
                    'type' => 'image',
                    'url' => '/images/hero/slide3.jpg',
                    'category' => 'University Visits',
                    'caption' => 'Senior international officers discussing scholarship quotas and fast-track admissions for Bangladeshi students.',
                    'is_featured' => true,
                    'sort_order' => 3,
                ],
                [
                    'title' => 'CEO Midhat Abduzzahir (Mishu) Mentoring Prospective Students',
                    'type' => 'image',
                    'url' => '/images/ceo.jpg',
                    'category' => 'Office',
                    'caption' => 'Personal mentorship sessions at Kaniz Plaza, Zindabazar office.',
                    'is_featured' => true,
                    'sort_order' => 4,
                ],
                [
                    'title' => 'Campus Life & University Tour Overview',
                    'type' => 'video',
                    'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
                    'thumbnail' => '/images/hero/slide4.jpg',
                    'category' => 'Campus Tours',
                    'caption' => 'Discover what studying abroad feels like with high-ranking international universities.',
                    'is_featured' => true,
                    'sort_order' => 5,
                ],
                [
                    'title' => 'Student Visa Handover & Success Stories',
                    'type' => 'image',
                    'url' => '/images/hero/slide1.jpg',
                    'category' => 'Student Success',
                    'caption' => 'Proud moments as our students receive their biometric passport stamps for the UK and Canada.',
                    'is_featured' => false,
                    'sort_order' => 6,
                ]
            ];

            foreach ($galleryData as $item) {
                GalleryItem::create($item);
            }
        }

        // 6. Page Contents Seeding
        $pageSections = [
            [
                'page' => 'about',
                'section_key' => 'hero',
                'title' => 'Pioneering Global Education Opportunities from Sylhet',
                'subtitle' => 'About Springway Education',
                'content' => 'Founded with a dedication to honesty, transparency, and excellence, Springway Education has evolved into Sylhet’s premier international education advisory firm. We bridge the gap between talented Bangladeshi scholars and the world’s leading universities.',
                'image' => '/images/hero/slide1.jpg',
            ],
            [
                'page' => 'about',
                'section_key' => 'mission_vision',
                'title' => 'Our Core Mission & Guiding Principles',
                'subtitle' => 'Integrity · Transparency · Student-Centric',
                'content' => 'To empower students with authentic, unbiased, and top-tier career advisory services that lead to life-transforming academic achievements abroad. We envision a future where geographical and procedural boundaries never stand in the way of ambition.',
                'image' => null,
            ],
            [
                'page' => 'contact',
                'section_key' => 'office_details',
                'title' => 'Visit Our Head Office in Zindabazar, Sylhet',
                'subtitle' => 'Central & Accessible Location',
                'content' => 'Located on the 3rd floor of Kaniz Plaza in the heart of Zindabazar, Sylhet. Walk in for open counseling sessions from Saturday through Thursday, 10:00 AM to 6:30 PM.',
                'image' => null,
            ],
            [
                'page' => 'services',
                'section_key' => 'overview',
                'title' => 'End-to-End Educational Consultancy Services',
                'subtitle' => 'From First Consultation to Boarding Your Flight',
                'content' => 'We offer full-spectrum support including academic career mapping, university shortlisting, statement of purpose (SOP) development, scholarship negotiation, embassy visa filing, and overseas accommodation booking.',
                'image' => '/images/hero/slide3.jpg',
            ]
        ];

        foreach ($pageSections as $section) {
            PageContent::updateOrCreate(
                ['page' => $section['page'], 'section_key' => $section['section_key']],
                $section
            );
        }
    }
}
