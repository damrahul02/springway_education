@extends('layouts.app')

@section('title', 'Contact Us – Springway Education Sylhet | Kaniz Plaza Office')
@section('meta_description', 'Contact Springway Education Sylhet at Kaniz Plaza (3rd Floor), Zindabazar. Call or WhatsApp +880 1341 55 88 22 or book a free 1-on-1 consultation.')

@push('styles')
<style>
    .contact-wrapper {
        padding: 80px 0;
        background: var(--gray-light);
    }
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 40px;
        align-items: start;
    }
    .contact-card {
        background: #ffffff;
        border: 1.5px solid #e8edf8;
        border-radius: var(--radius);
        padding: 30px;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
        margin-bottom: 24px;
        position: relative;
        overflow: hidden;
    }
    .contact-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-md);
        border-color: var(--blue);
    }
    .contact-icon-box {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.35rem;
        margin-bottom: 18px;
    }
    .contact-card h3 {
        font-family: 'Poppins', sans-serif;
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 8px;
    }
    .contact-card p {
        color: var(--gray);
        font-size: 0.88rem;
        line-height: 1.6;
        margin-bottom: 16px;
    }

    /* Form Card */
    .form-card {
        background: #ffffff;
        border: 1.5px solid #e8edf8;
        border-radius: var(--radius);
        padding: 40px;
        box-shadow: var(--shadow-md);
    }
    .form-header {
        margin-bottom: 28px;
    }
    .form-header h2 {
        font-family: 'Poppins', sans-serif;
        font-size: 1.65rem;
        font-weight: 800;
        color: var(--navy);
        margin-bottom: 8px;
    }
    .form-header p {
        color: var(--gray);
        font-size: 0.9rem;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 20px;
    }
    .form-group label {
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--navy);
    }
    .form-group label .req {
        color: #ef4444;
    }
    .form-control {
        width: 100%;
        padding: 13px 16px;
        border: 1.5px solid #e2e8f0;
        border-radius: var(--radius-sm);
        font-size: 0.9rem;
        font-family: inherit;
        color: var(--dark);
        background: #ffffff;
        transition: var(--transition);
        outline: none;
    }
    .form-control:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.15);
    }
    textarea.form-control {
        resize: vertical;
        min-height: 110px;
    }

    .btn-submit {
        background: var(--gradient);
        color: #ffffff;
        border: none;
        padding: 15px 36px;
        border-radius: 50px;
        font-weight: 800;
        font-size: 0.95rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-lg);
        background: var(--gradient-rev);
    }

    /* Map Section */
    .map-section {
        padding: 80px 0;
        background: #ffffff;
    }
    .map-frame {
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border: 1.5px solid #e8edf8;
        height: 420px;
        width: 100%;
    }

    /* Trust items row */
    .trust-strip {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-top: 50px;
    }
    .trust-box {
        background: #ffffff;
        border: 1.5px solid #e8edf8;
        border-radius: var(--radius-sm);
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .trust-box i {
        font-size: 1.5rem;
        color: var(--blue);
    }
    .trust-box .tb-title {
        font-size: 0.88rem;
        font-weight: 700;
        color: var(--navy);
    }
    .trust-box .tb-sub {
        font-size: 0.76rem;
        color: var(--gray);
    }

    @media (max-width: 960px) {
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 32px;
        }
        .form-row {
            grid-template-columns: 1fr;
            gap: 0;
        }
        .trust-strip {
            grid-template-columns: 1fr 1fr;
        }
        .form-card {
            padding: 24px;
        }
    }
    @media (max-width: 540px) {
        .trust-strip {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-grid"></div>
    <div class="page-hero-content">
        <div class="page-hero-badge">
            <i class="fas fa-headset"></i> {{ $contactContent['hero']->subtitle ?? 'Get In Touch' }}
        </div>
        <h1 class="page-hero-title">
            @if(!empty($contactContent['hero']->title))
                {{ $contactContent['hero']->title }}
            @else
                Visit Our Office or <span class="accent">Connect With Us</span>
            @endif
        </h1>
        <p class="page-hero-sub">
            {{ $contactContent['hero']->content ?? 'Located in the heart of Sylhet at Kaniz Plaza, Zindabazar. Walk in for a free face-to-face consultation or drop us a message anytime.' }}
        </p>
        <div class="breadcrumb-trail">
            <a href="{{ route('home') }}">Home</a>
            <i class="fas fa-chevron-right" style="font-size:0.7rem;"></i>
            <span>Contact Us</span>
        </div>
    </div>
</section>

<!-- Contact Info & Booking Section -->
<section class="contact-wrapper">
    <div class="container">
        <div class="contact-grid">
            
            <!-- Left Column: Contact Cards -->
            <div>
                <!-- Sylhet Office Card -->
                <div class="contact-card">
                    <div class="contact-icon-box" style="background:var(--sky-light); color:var(--blue);">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3>Sylhet Head Office</h3>
                    <p>Kaniz Plaza (3rd Floor), Zindabazar, Sylhet-3100, Bangladesh.</p>
                    <div style="display:inline-flex; align-items:center; gap:8px; background:#ecfdf5; color:#047857; font-size:0.75rem; font-weight:700; padding:6px 14px; border-radius:50px;">
                        <span style="width:8px; height:8px; border-radius:50%; background:#10b981; display:inline-block;"></span>
                        Open for Walk-In Consultations
                    </div>
                </div>

                <!-- Call & WhatsApp Card -->
                <div class="contact-card">
                    <div class="contact-icon-box" style="background:#ecfdf5; color:#059669;">
                        <i class="fas fa-phone-volume"></i>
                    </div>
                    <h3>Call & WhatsApp</h3>
                    <p>Speak directly with a certified senior study abroad counselor.</p>
                    <div style="display:flex; flex-direction:column; gap:10px;">
                        <a href="tel:+8801341558822" style="display:flex; align-items:center; justify-content:space-between; padding:12px 16px; background:var(--gray-light); border-radius:10px; font-weight:700; font-size:0.88rem; color:var(--navy);">
                            <span><i class="fas fa-phone" style="color:var(--sky); margin-right:8px;"></i> +880 1341 55 88 22</span>
                            <i class="fas fa-arrow-right" style="font-size:0.75rem;"></i>
                        </a>
                        <a href="https://wa.me/8801341558822" target="_blank" style="display:flex; align-items:center; justify-content:space-between; padding:12px 16px; background:#dcfce7; border-radius:10px; font-weight:700; font-size:0.88rem; color:#15803d;">
                            <span><i class="fab fa-whatsapp" style="font-size:1.1rem; margin-right:8px;"></i> WhatsApp Direct Chat</span>
                            <i class="fas fa-external-link-alt" style="font-size:0.75rem;"></i>
                        </a>
                    </div>
                </div>

                <!-- Working Hours & Email Card -->
                <div class="contact-card">
                    <div class="contact-icon-box" style="background:#f3e8ff; color:#7e22ce;">
                        <i class="far fa-clock"></i>
                    </div>
                    <h3>Office Hours & Email</h3>
                    <div style="font-size:0.88rem; color:var(--gray); line-height:1.8;">
                        <div style="margin-bottom:10px;">
                            <strong style="color:var(--navy); display:block;">Email Address:</strong>
                            <a href="mailto:info@springwaybd.com" style="color:var(--blue); font-weight:600;">info@springwaybd.com</a>
                        </div>
                        <div>
                            <strong style="color:var(--navy); display:block;">Opening Hours:</strong>
                            <span>Saturday – Thursday: 10:00 AM – 7:00 PM</span><br>
                            <span style="color:#ef4444; font-weight:600;">Friday: Closed (Online support available)</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Booking Form -->
            <div>
                <div class="form-card">
                    <div class="form-header">
                        <div class="section-tag" style="margin-bottom:8px;"><i class="fas fa-clipboard-check"></i> Free Assessment</div>
                        <h2>Book Your 1-on-1 Consultation</h2>
                        <p>Fill out the form below. Our education consultants will review your background and get in touch within 24 hours.</p>
                    </div>

                    @if(session('consultation_success') || session('success'))
                    <div style="background:#ecfdf5; border:1px solid #a7f3d0; border-radius:12px; padding:16px 20px; color:#065f46; margin-bottom:24px; display:flex; align-items:flex-start; gap:12px;">
                        <i class="fas fa-check-circle" style="font-size:1.3rem; color:#10b981; margin-top:2px;"></i>
                        <div>
                            <strong style="display:block; font-size:0.95rem;">Request Received Successfully!</strong>
                            <span style="font-size:0.84rem;">{{ session('consultation_success') ?? session('success') }}</span>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('consultation.submit') }}" method="POST">
                        @csrf
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Full Name <span class="req">*</span></label>
                                <input type="text" name="name" id="name" required placeholder="e.g. Tanvir Ahmed" class="form-control" value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone / WhatsApp <span class="req">*</span></label>
                                <input type="tel" name="phone" id="phone" required placeholder="e.g. +880 1712 345678" class="form-control" value="{{ old('phone') }}">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="email">Email Address <span class="req">*</span></label>
                                <input type="email" name="email" id="email" required placeholder="name@example.com" class="form-control" value="{{ old('email') }}">
                            </div>

                            <div class="form-group">
                                <label for="destination">Preferred Destination</label>
                                <select name="destination" id="destination" class="form-control">
                                    <option value="">Select Target Country</option>
                                    <option value="United Kingdom">United Kingdom (UK)</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Australia">Australia</option>
                                    <option value="United States">United States (USA)</option>
                                    <option value="Malaysia">Malaysia</option>
                                    <option value="Germany">Germany (Europe)</option>
                                    <option value="Other / Need Guidance">Other / Need Guidance</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="education_level">Last Completed Education</label>
                                <select name="education_level" id="education_level" class="form-control">
                                    <option value="">Select Qualification</option>
                                    <option value="HSC / A-Levels">HSC / A-Levels</option>
                                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                                    <option value="Master's Degree">Master's Degree</option>
                                    <option value="Diploma / Polytechnic">Diploma / Polytechnic</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="english_test">English Test Status</label>
                                <select name="english_test" id="english_test" class="form-control">
                                    <option value="">Select Status</option>
                                    <option value="IELTS / PTE Completed">IELTS / PTE Completed</option>
                                    <option value="Currently Preparing">Currently Preparing</option>
                                    <option value="MOI Eligible">Without IELTS / MOI Eligible</option>
                                    <option value="Duolingo / Oxford ELLT">Duolingo / Oxford ELLT</option>
                                    <option value="Not started yet">Not started yet</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="message">Message or Inquiries (Optional)</label>
                            <textarea name="message" id="message" rows="3" placeholder="Tell us your desired major, intake timeline, budget, or specific questions..." class="form-control">{{ old('message') }}</textarea>
                        </div>

                        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px; margin-top:10px;">
                            <span style="font-size:0.78rem; color:var(--gray); display:inline-flex; align-items:center; gap:6px;">
                                <i class="fas fa-lock" style="color:#10b981;"></i> Your information remains 100% confidential.
                            </span>

                            <button type="submit" class="btn-submit">
                                <span>Submit Free Assessment</span>
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Trust Features Strip -->
        <div class="trust-strip">
            <div class="trust-box">
                <i class="fas fa-hand-holding-heart"></i>
                <div>
                    <div class="tb-title">100% Free Counseling</div>
                    <div class="tb-sub">No consultation fees</div>
                </div>
            </div>
            <div class="trust-box">
                <i class="fas fa-user-graduate"></i>
                <div>
                    <div class="tb-title">Senior Counselors</div>
                    <div class="tb-sub">Direct expert guidance</div>
                </div>
            </div>
            <div class="trust-box">
                <i class="fas fa-shield-alt"></i>
                <div>
                    <div class="tb-title">No File Charges</div>
                    <div class="tb-sub">Transparent processing</div>
                </div>
            </div>
            <div class="trust-box">
                <i class="fas fa-passport"></i>
                <div>
                    <div class="tb-title">98% Visa Ratio</div>
                    <div class="tb-sub">Proven track record</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Google Map Location Section -->
<section class="map-section">
    <div class="container">
        <div class="section-header">
            <div class="section-tag"><i class="fas fa-map-marked-alt"></i> Office Location</div>
            <h2 class="section-title">How to Find <span class="accent">Our Sylhet Office</span></h2>
            <p class="section-desc">Located on the 3rd Floor of Kaniz Plaza in Zindabazar, opposite City Center.</p>
        </div>

        <div class="map-frame">
            <iframe
                title="Springway Education Sylhet Location"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3619.1678887649504!2d91.8687791!3d24.8973653!2m3!1f0!2f0!3f0!3m2!1i1024!2f768!4f13.1!3m3!1m2!1s0x3750552b0475471d%3A0x673d31aa4921ea6!2sKaniz%20Plaza%2C%20Zinda%20Bazar%2C%20Sylhet!5e0!3m2!1sen!2sbd!4v1700000000000!5m2!1sen!2sbd"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>
@endsection
