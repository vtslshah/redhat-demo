<?php
/**
 * Sample PHP + HTML page
 * - Variables, arrays, loops, conditionals
 * - Form handling (POST) with validation
 * - Output escaping (XSS-safe)
 * - Reusable function
 */

declare(strict_types=1);

// ---------- Helpers ----------
function e(?string $value): string
{
    return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
}

function formatPrice(float $amount): string
{
    return '₹' . number_format($amount, 2);
}

// ---------- Data ----------
$pageTitle = 'Sample PHP Page';
$today     = date('l, d F Y');

$products = [
    ['name' => 'Laptop',   'price' => 55999.00, 'inStock' => true],
    ['name' => 'Mouse',    'price' => 499.50,   'inStock' => true],
    ['name' => 'Keyboard', 'price' => 1299.00,  'inStock' => false],
    ['name' => 'Monitor',  'price' => 12499.99, 'inStock' => true],
];

// ---------- Form handling ----------
$errors  = [];
$success = false;
$old     = ['name' => '', 'email' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old['name']    = trim($_POST['name'] ?? '');
    $old['email']   = trim($_POST['email'] ?? '');
    $old['message'] = trim($_POST['message'] ?? '');

    if ($old['name'] === '') {
        $errors['name'] = 'Name is required.';
    }
    if (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Enter a valid email address.';
    }
    if (mb_strlen($old['message']) < 10) {
        $errors['message'] = 'Message must be at least 10 characters.';
    }

    if (empty($errors)) {
        $success = true;
        // e.g. save to DB or send mail here
    }
}

$total = array_sum(array_column($products, 'price'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: system-ui, sans-serif; background: #f4f6f9; color: #222; margin: 0; padding: 2rem; }
        .container { max-width: 800px; margin: auto; }
        .card { background: #fff; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 2px 8px rgba(0,0,0,.06); }
        h1 { margin-top: 0; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: .6rem; border-bottom: 1px solid #eee; text-align: left; }
        th { background: #fafafa; }
        .badge { padding: .2rem .6rem; border-radius: 20px; font-size: .8rem; }
        .in  { background: #d1fae5; color: #065f46; }
        .out { background: #fee2e2; color: #991b1b; }
        label { display: block; margin-top: 1rem; font-weight: 600; }
        input, textarea { width: 100%; padding: .6rem; border: 1px solid #ccc; border-radius: 6px; margin-top: .3rem; }
        .error { color: #b91c1c; font-size: .85rem; }
        .alert { padding: 1rem; border-radius: 6px; background: #d1fae5; color: #065f46; }
        button { margin-top: 1rem; padding: .7rem 1.5rem; border: 0; border-radius: 6px; background: #2563eb; color: #fff; cursor: pointer; }
        button:hover { background: #1d4ed8; }
    </style>
</head>
<body>
<div class="container">

    <div class="card">
        <h1><?= e($pageTitle) ?></h1>
        <p>Today is <strong><?= e($today) ?></strong>. PHP version: <?= e(PHP_VERSION) ?></p>
    </div>

    <!-- Loop + conditional -->
    <div class="card">
        <h2>Products</h2>
        <table>
            <thead>
                <tr><th>#</th><th>Name</th><th>Price</th><th>Status</th></tr>
            </thead>
            <tbody>
            <?php foreach ($products as $i => $product): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= e($product['name']) ?></td>
                    <td><?= formatPrice($product['price']) ?></td>
                    <td>
                        <?php if ($product['inStock']): ?>
                            <span class="badge in">In stock</span>
                        <?php else: ?>
                            <span class="badge out">Out of stock</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr><th colspan="2">Total</th><th colspan="2"><?= formatPrice($total) ?></th></tr>
            </tfoot>
        </table>
    </div>

    <!-- Form -->
    <div class="card">
        <h2>Contact Form</h2>

        <?php if ($success): ?>
            <div class="alert">Thanks, <?= e($old['name']) ?>! Your message was received.</div>
        <?php else: ?>
            <form method="post" action="<?= e($_SERVER['PHP_SELF']) ?>" novalidate>
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?= e($old['name']) ?>">
                <?php if (isset($errors['name'])): ?><div class="error"><?= e($errors['name']) ?></div><?php endif; ?>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= e($old['email']) ?>">
                <?php if (isset($errors['email'])): ?><div class="error"><?= e($errors['email']) ?></div><?php endif; ?>

                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4"><?= e($old['message']) ?></textarea>
                <?php if (isset($errors['message'])): ?><div class="error"><?= e($errors['message']) ?></div><?php endif; ?>

                <button type="submit">Send</button>
            </form>
        <?php endif; ?>
    </div>

    <footer style="text-align:center;color:#888;">
        &copy; <?= date('Y') ?> Sample Site
    </footer>
</div>
</body>
</html>
