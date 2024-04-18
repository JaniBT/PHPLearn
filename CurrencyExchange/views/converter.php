<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
</head>
<body>
    <?php
        require "../script.php"
    ?>
    <div class="card w-25 m-auto p-3">
        <form action="/" method="GET">
            <input class="form-control mb-2" type="number" name="amount" value="<?= $value ?>">
            
            <select name="from" class="form-control mb-2">
                <?php foreach ($currencies as $currency): ?>
                    <option value="<?= $currency['label'] ?>" <?= $sourceCurrency === $currency['label'] ? "selected" : "" ?>>
                        <?= $currency['name'] ?> <?= $currency['symbol'] ?>
                    </option>
                <?php endforeach ?>
            </select>
            <h1 class="text-center"><?= $result ?></h1>
            <select name="to" class="form-control mb-2">
                <?php foreach ($currencies as $currency): ?>
                    <option value="<?= $currency['label'] ?>" <?= $targetCurrency === $currency['label'] ? "selected" : "" ?>>
                        <?= $currency['name'] ?> <?= $currency['symbol'] ?>
                    </option>
                <?php endforeach ?>
            </select>
            <button class="btn btn-primary form-control">Exchange</button>
        </form>
    </div>
    
</body>
</html>