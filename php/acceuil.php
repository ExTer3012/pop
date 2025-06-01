<?php
$jsonData = file_get_contents('../data/pops.json');
$data = json_decode($jsonData, true);
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'unowned';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Collection Pop Demon Slayer</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1 class="main-title">Collection Pop</h1>
    <div class="filters">
        <a href="?filter=all" class="<?php echo $filter === 'all' ? 'active' : ''; ?>">Toutes</a>
        <a href="?filter=owned" class="<?php echo $filter === 'owned' ? 'active' : ''; ?>">Possédées</a>
        <a href="?filter=unowned" class="<?php echo $filter === 'unowned' ? 'active' : ''; ?>">Non Possédées</a>
    </div>

    <div class="pop-grid">
        <?php foreach ($data['pops'] as $pop): ?>
            <?php
            if (($filter === 'owned' && !$pop['owned']) ||
                ($filter === 'unowned' && $pop['owned'])) {
                continue;
            }
            ?>
            <div class="pop-card">
                <div class="pop-image">
                    <img src="../images/<?php echo htmlspecialchars($pop['image']); ?>" alt="<?php echo htmlspecialchars($pop['name']); ?>">
                    <?php if ($pop['sticker']): ?>
                        <div class="sticker">Sticker</div>
                    <?php endif; ?>
                </div>
                <div class="pop-info">
                    <h3><?php echo htmlspecialchars($pop['name']); ?></h3>
                    <p class="price"><?php echo number_format($pop['price'], 2); ?> €</p>
                    <?php if ($pop['description']): ?>
                        <p class="description"><?php echo htmlspecialchars($pop['description']); ?></p>
                    <?php endif; ?>
                    <div class="status <?php echo $pop['owned'] ? 'owned' : 'not-owned'; ?>">
                        <?php echo $pop['owned'] ? 'Possédée' : 'Non possédée'; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
