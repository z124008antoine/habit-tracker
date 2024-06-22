<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $documentTitle ?></title>
    <link rel="stylesheet" href="styles/main.css">
    <script src="https://cdn.jsdelivr.net/npm/party-js@latest/bundle/party.min.js" defer></script>
</head>

<body>
    <div class="layout">
        <?php include __DIR__ . '/navigation.php'; ?>

        <main>
            <?php renderPage(); ?>
        </main>
        
        <?php include __DIR__ . '/footer.php'; ?>
    </div>
</body>
</html>