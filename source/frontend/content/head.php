<?php require $web_root . "/../backend/data-structure/main.php";?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta name="keywords" content="HTML, CSS, SQL, PHP, JavaScript">
    <meta name="description" content="Presentation of Real Madrid statistics from the 2014/2015 season">
    <meta charset="UTF-8">
    <meta name="author" content="Roar Hoksnes Eriksen">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Real Madrid Statistics - Season 2014/2015</title>
    <link rel="stylesheet" href="/realmadrid/styles/style.css">
    <?php if ($content != null): ?>
        <link rel="stylesheet" href="/realmadrid/styles/<?php echo $content ?>.css">
    <?php endif; ?>
    <link rel="stylesheet" href="/realmadrid/styles/external-libraries/font-awesome.min.css">
    <link rel="stylesheet" href="/realmadrid/styles/external-libraries/magnific-popup.css">
    <link rel="stylesheet" href="/realmadrid/styles/external-libraries/bootstrap.min.css">
    <link rel="stylesheet" href="/realmadrid/styles/external-libraries/bootstrap-theme.min.css">
    <link rel="stylesheet" href="/realmadrid/styles/external-libraries/sidebar.css">
</head>
