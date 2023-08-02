global$total; <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transactions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body>
<table class="table">
    <thead>
    <tr>
        <th scope="col">Date</th>
        <th scope="col">Check#</th>
        <th scope="col">Description</th>
        <th scope="col">Amount</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($fileData)) : ?>
        <?php foreach ($fileData as $file): ?>
            <tr>
                <th scope="row"><?= dateFormatter($file['date']) ?></th>
                <td><?= $file['check'] ?></td>
                <td><?= $file['description'] ?></td>
                <?php if ($file['amount']<0) :?>
                    <td style="color:red;"><?= amountFormmater($file['amount']) ?></td>
                <?php else: ?>
                <td style="color:green;"><?= amountFormmater($file['amount']) ?></td>
                <?php endif ?>
            </tr>
        <?php endforeach ?>
    <?php endif ?>
    </tbody>
    <footer>
        <tr>
            <th scope="row" style="color:green;">Incomes: <?= amountFormmater($total['income']) ?></th>
            <th style="color:red;">Expenses: <?= amountFormmater($total['expenses']) ?></th>
            <th>Total: <?= amountFormmater($total['total']) ?></th>
        </tr>
    </footer>
</table>
</body>
</html>