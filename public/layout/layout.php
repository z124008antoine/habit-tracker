<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $documentTitle ?></title>
    <link rel="stylesheet" href="styles/main.css">
</head>
<body>

<?php include 'layout/navigation.php'; ?>
<main>
    <?php renderPage(); ?>
</main>

<?php include 'layout/footer.php'; ?>

</body>
</html>