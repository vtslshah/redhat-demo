<?php
$podName = gethostname();
$podIP   = $_SERVER['SERVER_ADDR'] ?? gethostbyname($podName);
$phpVer  = phpversion();
$time    = date('Y-m-d H:i:s T');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDG Pune | OpenShift PHP Demo version 2.0 </title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #151515 0%, #292929 100%);
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background: #1f1f1f;
            border-top: 5px solid #ee0000; /* Red Hat Red */
            border-radius: 10px;
            padding: 2.5rem;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.6);
            max-width: 520px;
            width: 90%;
            text-align: center;
        }
        .badge {
            background: #4285F4; /* Google Blue */
            color: white;
            padding: 5px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
        h1 { margin: 1rem 0 0.5rem; font-size: 2rem; }
        p.subtitle { color: #b8bbbe; margin-bottom: 1.5rem; }
        .metrics {
            background: #141414;
            border-radius: 8px;
            padding: 1rem;
            text-align: left;
            font-family: monospace;
            font-size: 0.95rem;
            line-height: 1.8;
            border: 1px solid #333;
        }
        .label { color: #ee0000; font-weight: bold; }
        .footer { margin-top: 1.5rem; font-size: 0.85rem; color: #8a8d90; }
    </style>
</head>
<body>
    <div class="card">
        <span class="badge">GDG Pune Live Demo version 2.0 </span>
        <h1>Hello, OpenShift! 🚀</h1>
        <p class="subtitle">Deployed directly from Git via Source-to-Image (S2I)</p>
        
        <div class="metrics">
            <div><span class="label">Pod Name:</span> <?= htmlspecialchars($podName) ?></div>
            <div><span class="label">Pod IP:</span>   <?= htmlspecialchars($podIP) ?></div>
            <div><span class="label">PHP Ver:</span>  <?= htmlspecialchars($phpVer) ?></div>
            <div><span class="label">Server Time:</span> <?= htmlspecialchars($time) ?></div>
        </div>

        <div class="footer">
            Session by <strong>BYOLABS</strong> • Powered by Red Hat OpenShift
        </div>
    </div>
</body>
</html>
