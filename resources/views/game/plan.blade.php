<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Our  Plan 💖</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            background: #fdf2f8;
            font-family: 'Segoe UI', sans-serif;
        }
        .plan-container {
            max-width: 900px;
            margin: 40px auto;
            padding: 40px 20px;
            background: #fff;
            border-radius: 30px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.08);
        }
        h1 {
            text-align: center;
            font-weight: 800;
            color: #9d174d;
        }
        .subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 40px;
        }
        .timeline {
            position: relative;
            margin: 40px 0 0 0;
            padding-left: 30px;
        }
        .timeline::before {
            content: '';
            position: absolute;
            left: 32px;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, #f9a8d4 0%, #f472b6 100%);
            border-radius: 2px;
        }
        .timeline-step {
            position: relative;
            margin-bottom: 50px;
            display: flex;
            align-items: flex-start;
        }
        .timeline-icon {
            z-index: 1;
            width: 64px;
            height: 64px;
            background: #fff;
            border: 4px solid #ec4899;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: #be185d;
            margin-right: 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.10);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(236,72,153,0.4); }
            70% { box-shadow: 0 0 0 15px rgba(236,72,153,0); }
            100% { box-shadow: 0 0 0 0 rgba(236,72,153,0); }
        }
        .timeline-content {
            background: #fdf2f8;
            border-radius: 18px;
            padding: 18px 28px;
            box-shadow: 0 4px 16px rgba(236,72,153,0.07);
            min-width: 0;
            flex: 1;
        }
        .timeline-content h5 {
            margin: 0 0 6px 0;
            color: #be185d;
            font-weight: 700;
        }
        .timeline-content .month {
            font-size: 1.1rem;
            font-weight: 600;
            color: #9d174d;
        }
        .timeline-content p {
            margin: 0;
            color: #6b7280;
        }
        .timeline-step:last-child {
            margin-bottom: 0;
        }
        @media (max-width: 600px) {
            .timeline {
                padding-left: 0;
            }
            .timeline::before {
                left: 50%;
                margin-left: -2px;
            }
            .timeline-step {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            .timeline-icon {
                margin: 0 0 12px 0;
            }
            .timeline-content {
                padding: 14px 12px;
            }
        }
        .final-section {
            text-align: center;
            margin-top: 60px;
        }
        .final-section h2 {
            color: #9d174d;
            font-weight: 800;
        }
        .final-section p {
            color: #6b7280;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

<section class="plan-container">
    <h1>Our  Plan 💖</h1>
    <p class="subtitle">A journey of love, growth, and new beginnings</p>

    <div class="timeline">
        <div class="timeline-step" data-aos="fade-right">
            <div class="timeline-icon">🌸</div>
            <div class="timeline-content">
                <span class="month">February (Week 1)</span>
                <h5>First Date in Marrakech</h5>
                <p>Our adventure begins with our first magical date in Marrakech, making memories to cherish forever.</p>
            </div>
        </div>
        <div class="timeline-step" data-aos="fade-right" data-aos-delay="100">
            <div class="timeline-icon">🏡</div>
            <div class="timeline-content">
                <span class="month">February (Week 2)</span>
                <h5>Back to Nador</h5>
                <p>Returning to Nador, carrying you in my heart and looking forward to our next chapter.</p>
            </div>
        </div>
        <div class="timeline-step" data-aos="fade-right" data-aos-delay="200">
            <div class="timeline-icon">🌙</div>
            <div class="timeline-content">
                <span class="month">February – March (Ramadan)</span>
                <h5>Job Search in Marrakech</h5>
                <p>During Ramadan, focusing on finding a stable job in Marrakech to build our future together.</p>
            </div>
        </div>
        <div class="timeline-step" data-aos="fade-right" data-aos-delay="300">
            <div class="timeline-icon">🌆</div>
            <div class="timeline-content">
                <span class="month">March (After Ramadan)</span>
                <h5>Move to Marrakech</h5>
                <p>After Ramadan, making the big move to Marrakech, ready to start our new life side by side.</p>
            </div>
        </div>
        <div class="timeline-step" data-aos="fade-right" data-aos-delay="400">
            <div class="timeline-icon">🎉</div>
            <div class="timeline-content">
                <span class="month">April</span>
                <h5>Back to Nador for  Event</h5>
                <p>Returning to Nador to attend a special  event, sharing joy with our loved ones.</p>
            </div>
        </div>
        <div class="timeline-step" data-aos="fade-right" data-aos-delay="500">
            <div class="timeline-icon">💍</div>
            <div class="timeline-content">
                <span class="month">May</span>
                <h5>Proposal in Marrakech</h5>
                <p>Coming back to Marrakech with my parents to officially propose and ask for your hand in marriage.</p>
            </div>
        </div>
        <div class="timeline-step" data-aos="fade-right" data-aos-delay="600">
            <div class="timeline-icon">👰🤵</div>
            <div class="timeline-content">
                <span class="month">June</span>
                <h5>Our Wedding</h5>
                <p>Celebrating our love and commitment with our wedding, marking the start of our forever.</p>
            </div>
        </div>
    </div>

    <div class="final-section" data-aos="fade-up">
        <h2>Every step is a promise to you 🤍</h2>
        <p>This plan is not just a timeline—it's my commitment to our future, hand in hand, heart to heart.</p>
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>

</body>
</html>
