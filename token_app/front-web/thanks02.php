<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Successful</title>
    <style>
        :root {
            --bg-yellow: #FFD700;
            --dark-accent: #000000;
            --card-white: #ffffff; /* Keeping a slight break for readability */
        }

        body {
            background-color: var(--bg-yellow);
            color: var(--dark-accent);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            background: var(--dark-accent);
            padding: 3rem;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
            max-width: 400px;
            width: 90%;
            color: white;
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: var(--bg-yellow);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 1.5rem;
            color: black;
            font-size: 2.5rem;
            animation: popIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        h1 {
            color: var(--bg-yellow);
            margin: 0 0 10px;
            font-weight: 800;
            text-transform: uppercase;
        }

        p {
            color: #cccccc;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .btn {
            background-color: var(--bg-yellow);
            color: black;
            text-decoration: none;
            padding: 14px 32px;
            border-radius: 8px;
            font-weight: 900;
            text-transform: uppercase;
            transition: all 0.2s ease;
            display: inline-block;
            border: 2px solid var(--bg-yellow);
        }

        .btn:hover {
            background-color: transparent;
            color: var(--bg-yellow);
        }

        @keyframes popIn {
            0% { transform: scale(0.5); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="success-icon">✓</div>
        <h1>Confirmed</h1>
        <p>Payment received! We're processing your order right now. Check your inbox for the receipt.</p>
        
        <a href="#" class="btn">Return Home</a>
    </div>

</body>
</html>