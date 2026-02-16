<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        :root {
            --primary-yellow: #FFD700;
            --dark-bg: #121212;
            --text-gray: #a0a0a0;
        }

        body {
            background-color: var(--dark-bg);
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: #1e1e1e;
            padding: 3rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            border-top: 5px solid var(--primary-yellow);
            max-width: 400px;
            width: 90%;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: var(--primary-yellow);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 1.5rem;
            color: black;
            font-size: 2.5rem;
            font-weight: bold;
            animation: scaleUp 0.5s ease-out;
        }

        h1 {
            color: var(--primary-yellow);
            margin: 0 0 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        p {
            color: var(--text-gray);
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn {
            background-color: var(--primary-yellow);
            color: black;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: bold;
            transition: transform 0.2s, background 0.2s;
            display: inline-block;
        }

        .btn:hover {
            background-color: #e6c200;
            transform: translateY(-2px);
        }

        @keyframes scaleUp {
            0% { transform: scale(0); }
            80% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="success-icon">✓</div>
        <h1>Success!</h1>
        <p>Your payment has been processed successfully. A receipt has been sent to your email.</p>
        
        <a href="#" class="btn">Back to Dashboard</a>
    </div>

</body>
</html>