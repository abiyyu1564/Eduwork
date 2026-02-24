<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $errors = [];
        $name = htmlspecialchars($_POST["name"]);
        $price = htmlspecialchars($_POST["price"]);
        $description = htmlspecialchars($_POST["description"]);
        $stok = htmlspecialchars($_POST["stok"]);

        if($name === "" || $price === "" || $description === "" || $stok === ""){
            $errors[] = "Semua field harus diisi";
        }

        if(strlen($name) > 100){
            $errors[] = "Nama tidak boleh lebih dari 100 karakter";
        }

        if ($price < 0){
            $errors[] = "Harga tidak boleh negatif";
        }

        if ($stok < 0 || filter_var($stok, FILTER_VALIDATE_INT) === false){
            $errors[] = "Stok tidak boleh negatif atau bukan bilangan bulat";
        }
        
    }else{
        echo "Akses Ditolak";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <?php if (count($errors) > 0): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else: ?>
        <div class="alert alert-success">
            <h4>Submit Berhasil</h4>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Detail Data</h5>
                            <p class="card-text">Nama: <?= $name ?></p>
                            <p class="card-text">Price: <?= $price ?></p>
                            <p class="card-text">Description: <?= $description ?></p>
                            <p class="card-text">Stok: <?= $stok ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</html>