<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Directory content</title>
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/sortable.js"></script>
</head>
<body>

<div class="container">

    <table class="sortable">
        <thead>
            <tr>
                <th>Filename</th>
                <th>Type</th>
                <th>Size <small>(bytes)</small></th>
                <th>Date Modified</th>
            </tr>
        </thead>
        <tbody>
            <?php include_once __DIR__ . '/utiles/directoryItems.php'; ?>
        </tbody>
    </table>

    <h2><?php echo "<a href='$ahref'>$atext hidden files</a>"; ?></h2>
</div>

</body>
</html>
