<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easy job - Find Your Dream Job</title>
    <style>
        /* Base Styles & Variables - Corporate Trust Palette */
        :root {
            --primary-color: #0f2537; /* Very Dark Corporate Navy */
            --primary-hover: #08141e; /* Almost Black Navy */
            --success-color: #0d9488; /* Professional Teal */
            --success-bg: #ccfbf1;    /* Soft Teal wash */
            --bg-light: #f8fafc;      
            --text-dark: #334155;    
            --text-gray: #64748b;
            --border-color: #e2e8f0;
            --error-color: #ef4444;   /* Added for global consistency */
        }


        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: var(--bg-light); color: var(--text-dark); line-height: 1.6; }
        a { text-decoration: none; color: inherit; }


        /* Navigation */
        header { background-color: white; padding: 1rem 5%; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; }
        .logo { font-size: 1.5rem; font-weight: bold; color: var(--primary-color); }
        .nav-links { display: flex; align-items: center; }
        .nav-links a { margin-left: 1.5rem; font-weight: 500; }
        
        .btn-post { background-color: var(--primary-color); color: white; padding: 0.5rem 1rem; border-radius: 5px; transition: background 0.3s; display: inline-block; }
        .btn-post:hover { background-color: var(--primary-hover); }
        .btn-logout { background: none; border: none; font-size: 1rem; cursor: pointer; font-weight: 500; color: var(--text-dark); }


        /* Hero Section */
        .hero { text-align: center; padding: 5rem 5%; background: linear-gradient(rgba(15, 37, 55, 0.05), rgba(15, 37, 55, 0.1)); }
        .hero h1 { font-size: 3rem; margin-bottom: 1rem; }
        .hero p { font-size: 1.2rem; color: var(--text-gray); margin-bottom: 2.5rem; }


        /* Search Box */
        .search-box { background: white; padding: 1rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; max-width: 800px; margin: 0 auto; gap: 10px; }
        .search-box input { flex: 1; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 5px; font-size: 1rem; box-sizing: border-box; }
        
        /* Updated focus shadow to match dark navy theme */
        .search-box input:focus { outline: none; border-color: var(--primary-color); box-shadow: 0 0 0 2px rgba(15, 37, 55, 0.1); }
        
        .search-box button { background-color: var(--primary-color); color: white; border: none; padding: 0.8rem 2rem; border-radius: 5px; font-size: 1rem; cursor: pointer; font-weight: bold; transition: background 0.3s; }
        .search-box button:hover { background-color: var(--primary-hover); }


        /* Shared Section Title */
        .section-title { text-align: center; margin-bottom: 3rem; font-size: 2rem; color: var(--text-dark); }


        /* About Us / Features Section */
        .about-section { background: white; padding: 4rem 5%; border-bottom: 1px solid var(--border-color); }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 2rem; max-width: 1200px; margin: 0 auto; text-align: center; }
        .feature-card { padding: 1rem; transition: transform 0.2s; }
        .feature-card:hover { transform: translateY(-5px); }
        .feature-icon { width: 64px; height: 64px; margin: 0 auto 1rem auto; color: var(--primary-color); background: var(--bg-light); border-radius: 50%; padding: 1rem; display: flex; align-items: center; justify-content: center; }
        .feature-icon svg { width: 100%; height: 100%; }
        .feature-text { font-weight: bold; font-size: 1.1rem; color: var(--text-dark); }


        /* Job Listings Section */
        .featured-jobs { padding: 4rem 5%; max-width: 1200px; margin: 0 auto; min-height: 40vh; }
        .job-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; }


        /* Job Cards */
        .job-card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border: 1px solid var(--border-color); transition: transform 0.2s; display: flex; flex-direction: column; position: relative; }
        .job-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px rgba(0,0,0,0.1); }
        .card-applied { border-color: var(--success-bg); background-color: #f8fafc; }
        
        .applied-badge { position: absolute; top: 1.5rem; right: 1.5rem; background: var(--success-bg); color: var(--success-color); padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.8rem; font-weight: bold; }
        .job-title { font-size: 1.25rem; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary-color); padding-right: 80px; }
        .company-name { color: var(--text-gray); margin-bottom: 1rem; font-weight: 500; }
        
        .job-tags { display: flex; gap: 10px; margin-bottom: 1rem; flex-wrap: wrap; }
        .tag { background: var(--bg-light); padding: 0.3rem 0.6rem; border-radius: 4px; font-size: 0.85rem; color: var(--text-gray); border: 1px solid var(--border-color); }
        .job-desc { color: var(--text-gray); margin-bottom: 1.5rem; font-size: 0.9rem; flex-grow: 1; }


        /* Card Buttons */
        .apply-btn { display: inline-block; width: 100%; text-align: center; padding: 0.8rem; background: white; border: 1px solid var(--primary-color); color: var(--primary-color); border-radius: 5px; font-weight: bold; transition: all 0.3s; margin-top: auto; }
        .apply-btn:hover { background: var(--primary-color); color: white; }
        .btn-secondary { border-color: var(--text-gray); color: var(--text-gray); }
        .btn-secondary:hover { background: var(--text-gray); color: white; }


        /* Empty State */
        .empty-state { text-align: center; grid-column: 1 / -1; padding: 3rem; background: white; border-radius: 8px; border: 1px dashed var(--border-color); }
        .empty-state h3 { margin-bottom: 0.5rem; color: var(--text-dark); }
        .empty-state p { color: var(--text-gray); margin-bottom: 1.5rem; }


        /* FAQ Section */
        .faq-section { background: white; padding: 4rem 5%; border-top: 1px solid var(--border-color); }
        .faq-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 1.5rem; max-width: 1000px; margin: 0 auto; }
        .faq-card { background: var(--bg-light); padding: 2rem; border-radius: 8px; border: 1px solid var(--border-color); }
        .faq-q { font-weight: bold; color: var(--primary-color); font-size: 1.1rem; margin-bottom: 0.8rem; display: flex; align-items: flex-start; gap: 10px; }
        .faq-a { color: var(--text-gray); font-size: 0.95rem; line-height: 1.6; margin-left: 1.8rem; }
        .faq-icon { color: var(--primary-color); flex-shrink: 0; margin-top: 0.2rem; }


        /* Testimonials Section */
        .testimonials { background: var(--bg-light); padding: 4rem 5%; border-top: 1px solid var(--border-color); }
        .testimonial-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; max-width: 1200px; margin: 0 auto; }
        .comment-card { background: white; padding: 2rem; border-radius: 8px; border: 1px solid var(--border-color); box-shadow: 0 2px 4px rgba(0,0,0,0.02); }
        .stars { color: #eab308; margin-bottom: 1rem; font-size: 1.2rem; letter-spacing: 2px; }
        .comment-text { color: var(--text-gray); font-style: italic; margin-bottom: 1.5rem; font-size: 0.95rem; }
        .user-info { display: flex; align-items: center; gap: 1rem; }
        .avatar { width: 45px; height: 45px; background: var(--primary-color); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2rem; }
        .user-name { font-weight: bold; color: var(--text-dark); display: block; }
        .user-role { font-size: 0.85rem; color: var(--text-gray); }


        /* Team Section */
        .team-section { background: white; padding: 4rem 5%; border-top: 1px solid var(--border-color); }
        .team-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 3rem 2rem; max-width: 1000px; margin: 0 auto; text-align: center; }
        .team-card { padding: 1rem; }
        .team-avatar { width: 120px; height: 120px; margin: 0 auto 1.5rem auto; background: var(--bg-light); border-radius: 50%; object-fit: cover; display: block; border: 3px solid var(--primary-color); }
        .team-name { font-size: 1.2rem; font-weight: bold; color: var(--text-dark); margin-bottom: 0.3rem; }
        .team-role { color: var(--text-gray); font-size: 0.95rem; font-weight: 500; margin-bottom: 0.5rem; }


        /* Footer */
        footer { background: var(--text-dark); text-align: center; padding: 2rem; color: white; }


        /* Responsive Settings */
        @media (max-width: 768px) {
            .search-box { flex-direction: column; }
            .hero h1 { font-size: 2rem; }
            .nav-links { display: none; }
            .faq-grid { grid-template-columns: 1fr; }
            .team-grid { grid-template-columns: 1fr; }
        }


        html { scroll-behavior: smooth; }
    </style>
</head>
<body>


    <header>
        <a href="/" class="logo">easy job</a>
        <nav class="nav-links">
            <a href="/">Home</a>
            <a href="/#about-section">Why Us</a>
            <a href="/#jobs-section">Find Jobs</a>
            @if(session('is_logged_in'))
                <a href="{{ url('/dashboard') }}" style="margin-left: 1.5rem; font-weight: bold; color: var(--primary-color);">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 1.5rem;">
                    @csrf
                    <button type="submit" class="btn-logout">Log Out</button>
                </form>
            @else
                <a href="{{ route('login') }}" style="margin-left: 1.5rem;">Log in</a>
                <a href="{{ route('register') }}" style="margin-left: 1.5rem;">Register</a>
            @endif
            <a href="{{ route('jobs.create') }}" class="btn-post" style="margin-left: 1.5rem;">Post a Job</a>
        </nav>
    </header>


    <section class="hero">
        <h1>Find the job that fits your life</h1>
        <p>Search thousands of jobs from top companies and startups.</p>
        
        <form action="/" method="GET" class="search-box">
            <input type="text" name="search" placeholder="Search babysitter, barista, tutor..." value="{{ request('search') }}">
            <button type="submit">Search Jobs</button>
        </form>
    </section>


    <section id="about-section" class="about-section">
        <h2 class="section-title">Why Choose easy job?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z"></path></svg></div>
                <div class="feature-text">No Extra Fees</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.667 1.332 15.36 15.36 0 01-12.667-.332z"></path></svg></div>
                <div class="feature-text">Free to Join</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5"></path></svg></div>
                <div class="feature-text">Provide Certificate</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"></path></svg></div>
                <div class="feature-text">No Illegal Work</div>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"></path></svg></div>
                <div class="feature-text">100% Legal Work</div>
            </div>
        </div>
    </section>


    <section id="jobs-section" class="featured-jobs">
        @if(request('search'))
            <h2 class="section-title">Search Results for "{{ request('search') }}"</h2>
        @else
            <h2 class="section-title">Latest Opportunities</h2>
        @endif
        
        <div class="job-grid">
            @forelse($jobs as $job)
                <div class="job-card {{ session('applied_for_job_' . $job->id) ? 'card-applied' : '' }}">
                    @if(session('applied_for_job_' . $job->id))
                        <div class="applied-badge">✓ Applied</div>
                    @endif
                    <div class="job-title">{{ $job->title }}</div>
                    <div class="company-name">{{ $job->company }}</div>
                    <div class="job-tags">
                        <span class="tag">📍 {{ $job->location }}</span>
                        <span class="tag">💼 {{ $job->tags }}</span>
                    </div>
                    <p class="job-desc">{{ Str::limit($job->description, 100) }}</p>
                    @if(session('applied_for_job_' . $job->id))
                        <a href="/jobs/{{ $job->id }}" class="apply-btn btn-secondary">Review Details</a>
                    @else
                        <a href="/jobs/{{ $job->id }}" class="apply-btn">View Details</a>
                    @endif
                </div>
            @empty
                <div class="empty-state">
                    <h3>No jobs found</h3>
                    <p>We couldn't find any jobs matching your search criteria.</p>
                    <a href="/" class="btn-post">Clear Search</a>
                </div>
            @endforelse
        </div>
    </section>


    <section class="faq-section">
        <h2 class="section-title">Frequently Asked Questions</h2>
        <div class="faq-grid">
            <div class="faq-card">
                <div class="faq-q">
                    <svg class="faq-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Is easy job really free for job seekers?
                </div>
                <div class="faq-a">Absolutely! Our platform is 100% free for job seekers. There are no agent fees, no upfront deposits, and no hidden charges ever.</div>
            </div>
            <div class="faq-card">
                <div class="faq-q">
                    <svg class="faq-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    How do you protect me from scams?
                </div>
                <div class="faq-a">Your safety is our priority. Every employer goes through a verification process. We strictly ban any jobs that ask you to pay upfront, buy items, or do scam-related tasks.</div>
            </div>
            <div class="faq-card">
                <div class="faq-q">
                    <svg class="faq-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Are the job opportunities listed here legal?
                </div>
                <div class="faq-a">Yes. All jobs listed on our platform fully comply with Malaysian employment laws and regulations. We have zero tolerance for illegal or risky work.</div>
            </div>
            <div class="faq-card">
                <div class="faq-q">
                    <svg class="faq-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    How can I be sure I will get paid on time?
                </div>
                <div class="faq-a">We monitor employer feedback closely to ensure fair and timely compensation. Any employer found withholding payments is permanently banned.</div>
            </div>
            <div class="faq-card">
                <div class="faq-q">
                    <svg class="faq-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Do I need an account to browse jobs?
                </div>
                <div class="faq-a">You can freely browse and search for jobs without an account. However, you will need to create a free profile to submit applications and post jobs.</div>
            </div>
            <div class="faq-card">
                <div class="faq-q">
                    <svg class="faq-icon" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    How does the job certificate work?
                </div>
                <div class="faq-a">Once you successfully complete a verified job through our platform, you can receive an easy job certificate of completion to help build your resume.</div>
            </div>
        </div>
    </section>


    <section class="testimonials">
        <h2 class="section-title">What Our Users Say</h2>
        <div class="testimonial-grid">
            <div class="comment-card">
                <div class="stars">★★★★★</div>
                <p class="comment-text">"I got hired within a week! The process was so smooth and I didn't have to worry about any hidden fees. Highly recommend this platform."</p>
                <div class="user-info">
                    <div class="avatar">S</div>
                    <div><span class="user-name">Sarah Lim</span><span class="user-role">Hired as a Barista</span></div>
                </div>
            </div>
            <div class="comment-card">
                <div class="stars">★★★★★</div>
                <p class="comment-text">"I love how clear the job descriptions are. No scams, just 100% real and legal opportunities. It's exactly what I was looking for."</p>
                <div class="user-info">
                    <div class="avatar">A</div>
                    <div><span class="user-name">Ahmad Faiz</span><span class="user-role">Freelance Tutor</span></div>
                </div>
            </div>
            <div class="comment-card">
                <div class="stars">★★★★★</div>
                <p class="comment-text">"The certificate they provided really helped me stand out to employers. Best job portal I've used in Malaysia!"</p>
                <div class="user-info">
                    <div class="avatar" style="background: #0f172a;">M</div>
                    <div><span class="user-name">Mei Ling</span><span class="user-role">Recent Graduate</span></div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <p>&copy; {{ date('Y') }} easy job. All rights reserved.</p>
    </footer>


</body>
</html>



