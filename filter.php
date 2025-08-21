<?php
$products = [
    ['name' => 'Sneakers', 'color' => 'white', 'size' => 'large'],
    ['name' => 'Hat', 'color' => 'black', 'size' => 'small'],
    ['name' => 'Scarf', 'color' => 'yellow', 'size' => 'medium'],
    ['name' => 'Gloves', 'color' => 'red', 'size' => 'small'],
    ['name' => 'Boots', 'color' => 'brown', 'size' => 'large'],
];

$color = $_GET['color'] ?? '';
$size = $_GET['size'] ?? '';

function isSelected(string $compare, string $to): string
{
    return $compare === $to ? 'selected' : '';
}

$filteredProducts = array_filter(
    $products,
    fn(array $product): bool =>
    ($color === '' || $product['color'] === $color) &&
    ($size === '' || $product['size'] === $size)
);

$colorStyles = [
    'white' => 'background:#f8f8f8; color:#222;',
    'black' => 'background:#222; color:#fff;',
    'yellow' => 'background:#ffe066; color:#222;',
    'red' => 'background:#ff6b6b; color:#fff;',
    'brown' => 'background:#a0522d; color:#fff;',
];
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Product filter</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #fafafa;
                margin: 0;
                padding: 0;
            }
            h1 {
                background: #222;
                color: #fff;
                padding: 1em;
                margin: 0 0 1em 0;
            }
            form {
                background: #fff;
                padding: 1em;
                margin: 1em auto;
                border-radius: 8px;
                box-shadow: 0 2px 8px rgba(0,0,0,0.07);
                max-width: 400px;
            }
            select, button {
                margin: 0.5em 0.5em 0.5em 0;
                padding: 0.3em;
                font-size: 1em;
            }
            ul {
                list-style: none;
                padding: 0;
                max-width: 400px;
                margin: 1em auto;
            }
            li {
                margin: 0.5em 0;
                padding: 0.7em 1em;
                border-radius: 6px;
                font-weight: bold;
                box-shadow: 0 1px 4px rgba(0,0,0,0.04);
            }
        </style>
    </head>
    <body>
        <h1>Product filter</h1>
        <form method="GET">
            <select name="size" id="size">
                <option value="" <?= isSelected('', $size) ?>>Any</option>
                <option value="small" <?= isSelected('small', $size) ?>>Small</option>
                <option value="medium" <?= isSelected('medium', $size) ?>>Medium</option>
                <option value="large" <?= isSelected('large', $size) ?>>Large</option>
            </select>

            <select name="color" id="color">
                <option value="" <?= isSelected('', $color) ?>>Any</option>
                <option value="white" <?= isSelected('white', $color) ?>>White</option>
                <option value="black" <?= isSelected('black', $color) ?>>Black</option>
                <option value="yellow" <?= isSelected('yellow', $color) ?>>Yellow</option>
                <option value="red" <?= isSelected('red', $color) ?>>Red</option>
                <option value="brown" <?= isSelected('brown', $color) ?>>Brown</option>
            </select>

            <button type="submit">Filter</button>
            <button type="button" onclick="window.location='filter.php'">Reset</button>
        </form>
        <ul>
            <?php if (count($filteredProducts) === 0): ?>
                <li style="background:#fff; color:#222; text-align:center;">No products found</li>
            <?php else: ?>
                <?php foreach($filteredProducts as $product): ?>
                    <li style="<?= $colorStyles[$product['color']] ?? '' ?>">
                        <?= htmlspecialchars($product['name']) ?> -
                        <?= htmlspecialchars($product['color']) ?> -
                        <?= htmlspecialchars($product['size']) ?>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </body>
</html>