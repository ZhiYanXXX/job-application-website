<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>easy job - Find Your Dream Job</title>
    <style>
        /* Base Styles & Variables - Corporate Trust Palette */
        :root {
            --primary-color: #0f2537; 
            --primary-hover: #08141e; 
            --success-color: #0d9488; 
            --success-bg: #ccfbf1;    
            --bg-light: #f8fafc;      
            --text-dark: #334155;    
            --text-gray: #64748b;
            --border-color: #e2e8f0;
            --error-color: #ef4444;   
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: var(--bg-light); color: var(--text-dark); line-height: 1.6; }
        a { text-decoration: none; color: inherit; }

        /* Navigation */
        header { background-color: white; padding: 1rem 5%; box-shadow: 0 2px 4px rgba(0,0,0,0.05); display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; }
        .logo { font-size: 1.5rem; font-weight: bold; color: var(--primary-color); }
        .nav-links { display: flex; align-items: center; }
        .nav-links a { margin-left: 1.5rem; font-weight: 500; cursor: pointer; }
        
        .btn-post { background-color: var(--primary-color); color: white; padding: 0.5rem 1rem; border-radius: 5px; transition: background 0.3s; display: inline-block; }
        .btn-post:hover { background-color: var(--primary-hover); }
        .btn-logout { background: none; border: none; font-size: 1rem; cursor: pointer; font-weight: 500; color: var(--text-dark); }

        /* Favorites Badge */
        .fav-badge { background: var(--success-bg); color: var(--success-color); padding: 2px 8px; border-radius: 12px; font-size: 0.8rem; font-weight: bold; margin-left: 5px; transition: all 0.3s; }
        .nav-links a#toggle-saved-view.active-view { color: var(--success-color); font-weight: bold; }

        /* Hero Section */
        .hero { text-align: center; padding: 5rem 5%; background: linear-gradient(rgba(15, 37, 55, 0.05), rgba(15, 37, 55, 0.1)); }
        .hero h1 { font-size: 3rem; margin-bottom: 1rem; }
        .hero p { font-size: 1.2rem; color: var(--text-gray); margin-bottom: 2.5rem; }

        /* Interactive Search Box */
        .search-box { background: white; padding: 1rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); display: flex; max-width: 800px; margin: 0 auto; gap: 10px; }
        .search-box input { flex: 1; padding: 0.8rem; border: 1px solid var(--border-color); border-radius: 5px; font-size: 1rem; box-sizing: border-box; transition: border-color 0.3s; }
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

        /* Interactive Job Cards */
        .job-card { background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border: 1px solid var(--border-color); transition: transform 0.2s, box-shadow 0.2s; display: flex; flex-direction: column; position: relative; }
        .job-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px rgba(0,0,0,0.1); }
        .card-applied { border-color: var(--success-bg); background-color: #f8fafc; }
        
        /* Save Heart Toggle */
        .save-btn { position: absolute; top: 1.5rem; right: 1.5rem; background: none; border: none; cursor: pointer; color: #cbd5e1; transition: color 0.3s, transform 0.2s; z-index: 2; padding: 0; outline: none; }
        .save-btn:hover { transform: scale(1.1); color: #94a3b8; }
        .save-btn.saved { color: #ef4444; }
        .save-btn.saved svg { fill: #ef4444; }
        
        .applied-badge { position: absolute; top: 1.5rem; right: 3.5rem; background: var(--success-bg); color: var(--success-color); padding: 0.2rem 0.6rem; border-radius: 20px; font-size: 0.8rem; font-weight: bold; }
        .job-title { font-size: 1.25rem; font-weight: bold; margin-bottom: 0.5rem; color: var(--primary-color); padding-right: 80px; }
        .company-name { color: var(--text-gray); margin-bottom: 1rem; font-weight: 500; }
        
        .job-tags { display: flex; gap: 10px; margin-bottom: 1rem; flex-wrap: wrap; }
        .tag { background: var(--bg-light); padding: 0.3rem 0.6rem; border-radius: 4px; font-size: 0.85rem; color: var(--text-gray); border: 1px solid var(--border-color); }
        .job-desc { color: var(--text-gray); margin-bottom: 1.5rem; font-size: 0.9rem; flex-grow: 1; }

        .apply-btn { display: inline-block; width: 100%; text-align: center; padding: 0.8rem; background: white; border: 1px solid var(--primary-color); color: var(--primary-color); border-radius: 5px; font-weight: bold; transition: all 0.3s; margin-top: auto; }
        .apply-btn:hover { background: var(--primary-color); color: white; }
        .btn-secondary { border-color: var(--text-gray); color: var(--text-gray); }
        .btn-secondary:hover { background: var(--text-gray); color: white; }

        .empty-state { text-align: center; grid-column: 1 / -1; padding: 3rem; background: white; border-radius: 8px; border: 1px dashed var(--border-color); display: none; }
        .empty-state.active { display: block; }
        .empty-state h3 { margin-bottom: 0.5rem; color: var(--text-dark); }
        .empty-state p { color: var(--text-gray); margin-bottom: 1.5rem; }

        /* Interactive FAQ Section */
        .faq-section { background: white; padding: 4rem 5%; border-top: 1px solid var(--border-color); }
        .faq-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 1.5rem; max-width: 1000px; margin: 0 auto; }
        .faq-card { background: var(--bg-light); padding: 2rem; border-radius: 8px; border: 1px solid var(--border-color); cursor: pointer; user-select: none; transition: background 0.3s; }
        .faq-card:hover { background: #f1f5f9; }
        .faq-q { font-weight: bold; color: var(--primary-color); font-size: 1.1rem; display: flex; align-items: flex-start; justify-content: space-between; gap: 10px; }
        .faq-icon { color: var(--primary-color); flex-shrink: 0; transition: transform 0.3s ease; }
        .faq-a { color: var(--text-gray); font-size: 0.95rem; line-height: 1.6; max-height: 0; overflow: hidden; transition: max-height 0.3s ease-out, margin-top 0.3s ease-out; opacity: 0; }
        
        /* FAQ Active State */
        .faq-card.active .faq-a { max-height: 200px; margin-top: 1rem; opacity: 1; }
        .faq-card.active .faq-icon { transform: rotate(180deg); }

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

        footer { background: var(--text-dark); text-align: center; padding: 2rem; color: white; }

        /* Button Loading State */
        .is-loading { pointer-events: none; opacity: 0.8; position: relative; color: transparent !important; }
        .is-loading::after { content: ""; position: absolute; left: 50%; top: 50%; width: 1.2rem; height: 1.2rem; border: 2px solid white; border-radius: 50%; border-top-color: transparent; transform: translate(-50%, -50%); animation: spin 0.8s linear infinite; }
        @keyframes spin { to { transform: translate(-50%, -50%) rotate(360deg); } }

        /* Slide-in Toast Notifications */
        #toast-container { position: fixed; bottom: 20px; right: 20px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; }
        .toast { background: var(--success-bg); color: var(--success-color); padding: 1rem 1.5rem; border-radius: 8px; border: 1px solid var(--success-color); box-shadow: 0 4px 12px rgba(0,0,0,0.1); display: flex; align-items: center; gap: 10px; font-weight: bold; font-size: 0.95rem; transform: translateX(120%); animation: slideIn 0.4s forwards cubic-bezier(0.175, 0.885, 0.32, 1.275); }
        .toast.fade-out { animation: fadeOut 0.4s forwards ease-in; }
        @keyframes slideIn { to { transform: translateX(0); } }
        @keyframes fadeOut { to { transform: translateX(120%); opacity: 0; } }

        @media (max-width: 768px) {
            .search-box { flex-direction: column; }
            .hero h1 { font-size: 2rem; }
            .nav-links { display: none; }
            .faq-grid { grid-template-columns: 1fr; }
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
            
            <a id="toggle-saved-view">Favorites <span class="fav-badge" id="fav-counter">0</span></a>

            @if(session('is_logged_in'))
                <a href="{{ url('/dashboard') }}" style="margin-left: 1.5rem; font-weight: bold; color: var(--primary-color);">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}" style="display: inline; margin-left: 1.5rem;" class="loading-form">
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
        
        <form action="/" method="GET" class="search-box loading-form">
            <input type="text" id="live-search-input" name="search" placeholder="Search barista, remote, designer..." value="{{ request('search') }}">
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
            <h2 class="section-title" id="jobs-title">Search Results for "{{ request('search') }}"</h2>
        @else
            <h2 class="section-title" id="jobs-title">Latest Opportunities</h2>
        @endif
        
        <div class="job-grid" id="job-grid">
            @forelse($jobs as $job)
                <div class="job-card {{ session('applied_for_job_' . $job->id) ? 'card-applied' : '' }}">
                    
                    <button class="save-btn" data-job-id="{{ $job->id }}" title="Save for later">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                    </button>

                    @if(session('applied_for_job_' . $job->id))
                        <div class="applied-badge">✓ Applied</div>
                    @endif
                    <div class="job-title">{{ $job->title }}</div>
                    <div class="company-name">{{ $job->company }}</div>
                    <div class="job-tags">
                        <span class="tag location-tag">📍 {{ $job->location }}</span>
                        <span class="tag type-tag">💼 {{ $job->tags }}</span>
                    </div>
                    <p class="job-desc">{{ Str::limit($job->description, 100) }}</p>
                    @if(session('applied_for_job_' . $job->id))
                        <a href="/jobs/{{ $job->id }}" class="apply-btn btn-secondary">Review Details</a>
                    @else
                        <a href="/jobs/{{ $job->id }}" class="apply-btn apply-action-btn">View Details</a>
                    @endif
                </div>
            @empty
                @endforelse
            
            <div class="empty-state" id="js-empty-state">
                <h3 id="empty-state-title">No jobs found</h3>
                <p id="empty-state-desc">We couldn't find any jobs matching your search.</p>
                <button class="btn-post" onclick="document.getElementById('live-search-input').value = ''; document.getElementById('live-search-input').dispatchEvent(new Event('input'));" style="margin-top:1rem;">Clear Search</button>
            </div>
        </div>
        
        @if(empty($jobs))
            <div class="empty-state active">
                <h3>No jobs found</h3>
                <p>We couldn't find any jobs matching your search criteria.</p>
                <a href="/" class="btn-post">Clear Search</a>
            </div>
        @endif
    </section>

    <section class="faq-section">
        <h2 class="section-title">Frequently Asked Questions</h2>
        <div class="faq-grid">
            <div class="faq-card">
                <div class="faq-q">
                    Is easy job really free for job seekers?
                    <svg class="faq-icon" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <div class="faq-a">Absolutely! Our platform is 100% free for job seekers. There are no agent fees, no upfront deposits, and no hidden charges ever.</div>
            </div>
            <div class="faq-card">
                <div class="faq-q">
                    How do you protect me from scams?
                    <svg class="faq-icon" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <div class="faq-a">Your safety is our priority. Every employer goes through a verification process. We strictly ban any jobs that ask you to pay upfront, buy items, or do scam-related tasks.</div>
            </div>
            <div class="faq-card">
                <div class="faq-q">
                    Are the job opportunities listed here legal?
                    <svg class="faq-icon" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <div class="faq-a">Yes. All jobs listed on our platform fully comply with Malaysian employment laws and regulations. We have zero tolerance for illegal or risky work.</div>
            </div>
            <div class="faq-card">
                <div class="faq-q">
                    How can I be sure I will get paid on time?
                    <svg class="faq-icon" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path></svg>
                </div>
                <div class="faq-a">We monitor employer feedback closely to ensure fair and timely compensation. Any employer found withholding payments is permanently banned.</div>
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
                    <div class="avatar" style="background: #0d9488;">M</div>
                    <div><span class="user-name">Mei Ling</span><span class="user-role">Recent Graduate</span></div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; {{ date('Y') }} easy job. All rights reserved.</p>
    </footer>

    <div id="toast-container"></div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            // 1. Toast Notification Logic
            window.showToast = function(message) {
                const container = document.getElementById('toast-container');
                const toast = document.createElement('div');
                toast.className = 'toast';
                toast.innerHTML = `<svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg> <span>${message}</span>`;
                
                container.appendChild(toast);

                setTimeout(() => {
                    toast.classList.add('fade-out');
                    setTimeout(() => toast.remove(), 400);
                }, 3000);
            };

            @if(session('success')) showToast("{{ session('success') }}"); @endif

            // 2. LocalStorage Setup for Favorites
            let savedJobIds = JSON.parse(localStorage.getItem('easyjob_favorites')) || [];
            const favCounter = document.getElementById('fav-counter');
            
            function updateBadgeCount() {
                if(favCounter) favCounter.innerText = savedJobIds.length;
            }

            // 3. Save for Later (Heart Toggle)
            const saveBtns = document.querySelectorAll('.save-btn');
            saveBtns.forEach(btn => {
                const jobId = btn.getAttribute('data-job-id');
                
                // Highlight hearts if they are already in memory
                if (savedJobIds.includes(jobId)) {
                    btn.classList.add('saved');
                }

                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    btn.classList.toggle('saved');
                    
                    if (btn.classList.contains('saved')) {
                        savedJobIds.push(jobId);
                        showToast('Job saved to your favorites!');
                    } else {
                        // Remove from memory
                        savedJobIds = savedJobIds.filter(id => id !== jobId);
                        showToast('Job removed from favorites.');
                        
                        // If user is currently looking at the favorites tab, hide the card instantly
                        if (isViewingFavorites) {
                            btn.closest('.job-card').style.display = 'none';
                            checkEmptyState();
                        }
                    }
                    
                    // Save the updated list back to the browser
                    localStorage.setItem('easyjob_favorites', JSON.stringify(savedJobIds));
                    updateBadgeCount();
                });
            });

            updateBadgeCount();

            // 4. View Favorites Toggle Button
            const toggleViewBtn = document.getElementById('toggle-saved-view');
            const titleElement = document.getElementById('jobs-title');
            const jobCards = document.querySelectorAll('.job-card');
            const emptyState = document.getElementById('js-empty-state');
            const emptyStateTitle = document.getElementById('empty-state-title');
            const emptyStateDesc = document.getElementById('empty-state-desc');
            const searchInput = document.getElementById('live-search-input');
            let isViewingFavorites = false;

            function checkEmptyState() {
                const visibleCards = Array.from(jobCards).filter(card => card.style.display !== 'none');
                if (visibleCards.length === 0) {
                    emptyState.classList.add('active');
                    if (isViewingFavorites) {
                        emptyStateTitle.innerText = "No favorites yet";
                        emptyStateDesc.innerText = "Click the heart icon on any job to save it for later!";
                    } else {
                        emptyStateTitle.innerText = "No jobs found";
                        emptyStateDesc.innerText = "We couldn't find any jobs matching your search.";
                    }
                } else {
                    emptyState.classList.remove('active');
                }
            }

            if (toggleViewBtn) {
                toggleViewBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    isViewingFavorites = !isViewingFavorites;
                    
                    if (isViewingFavorites) {
                        // Switch to Favorites Mode
                        toggleViewBtn.classList.add('active-view');
                        toggleViewBtn.innerHTML = 'View All Jobs';
                        titleElement.innerText = 'Your Saved Favorites';
                        if(searchInput) searchInput.value = ''; // clear search when switching tabs
                        
                        // Loop through all cards and only show the ones with red hearts
                        jobCards.forEach(card => {
                            const heart = card.querySelector('.save-btn');
                            if (heart && heart.classList.contains('saved')) {
                                card.style.display = 'flex';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    } else {
                        // Switch back to Default View
                        toggleViewBtn.classList.remove('active-view');
                        toggleViewBtn.innerHTML = `Favorites <span class="fav-badge" id="fav-counter">${savedJobIds.length}</span>`;
                        titleElement.innerText = 'Latest Opportunities';
                        
                        // Show all cards again
                        jobCards.forEach(card => card.style.display = 'flex');
                    }
                    
                    // Re-bind the newly injected counter variable
                    if(!isViewingFavorites) updateBadgeCount();
                    checkEmptyState();
                });
            }

            // 5. Live Search Filtering (Updated to work with Favorites)
            if (searchInput) {
                searchInput.addEventListener('input', (e) => {
                    const term = e.target.value.toLowerCase();
                    titleElement.innerText = term === '' ? (isViewingFavorites ? 'Your Saved Favorites' : 'Latest Opportunities') : `Results for "${e.target.value}"`;

                    jobCards.forEach(card => {
                        const title = card.querySelector('.job-title').innerText.toLowerCase();
                        const company = card.querySelector('.company-name').innerText.toLowerCase();
                        const tags = card.querySelector('.job-tags').innerText.toLowerCase();
                        const isSaved = card.querySelector('.save-btn').classList.contains('saved');
                        
                        const matchesSearch = title.includes(term) || company.includes(term) || tags.includes(term);
                        
                        // If we are in favorites mode, it MUST be saved to show up
                        if (isViewingFavorites) {
                            card.style.display = (matchesSearch && isSaved) ? 'flex' : 'none';
                        } else {
                            card.style.display = matchesSearch ? 'flex' : 'none';
                        }
                    });

                    checkEmptyState();
                });
            }

            // 6. Expandable FAQ Accordion
            const faqCards = document.querySelectorAll('.faq-card');
            faqCards.forEach(card => {
                card.addEventListener('click', () => {
                    faqCards.forEach(c => { if(c !== card) c.classList.remove('active'); });
                    card.classList.toggle('active');
                });
            });

            // 7. Button Loading States
            const forms = document.querySelectorAll('.loading-form');
            forms.forEach(form => {
                form.addEventListener('submit', function() {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if(submitBtn) submitBtn.classList.add('is-loading');
                });
            });

            const actionBtns = document.querySelectorAll('.apply-action-btn');
            actionBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    this.classList.add('is-loading');
                    setTimeout(() => { this.classList.remove('is-loading'); }, 1500); 
                });
            });
            
        });
    </script>
</body>
</html>


