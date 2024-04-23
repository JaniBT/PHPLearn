<div class="card container p-3 m-3">
        <?php if ($params["isSuccess"]) : ?>
            <div class="alert alert-success">
                Termék létrehozása sikeres
            </div>
        <?php endif ?>
        <form action="/termekek" method="post" class="form-group">
            <input type="text" name="name" class="form-control w-25" placeholder="Név..."> <br>
            <input type="number" name="price" class="form-control w-25" placeholder="Ár..."> <br>
            <input type="submit" name="submit" class="btn btn-success" value="Küldés">
        </form>
        <?php foreach ($params['products'] as $product) : ?>
            <h3>Név: <?= $product["name"] ?></h3>
            <p>Ár: <?= $product["price"] ?> Ft</p>
            <?php if ($product['id'] === $params['editedProductId']) : ?>
                <form action="/edit-product?id=<?= $product['id'] ?>" method="POST" class="form-group ">
                    <h3>Termék szerkesztése</h3>
                    <input type="text" name="editedName" class="form-control w-25 mb-2" placeholder="Új név...">
                    <input type="number" name="editedPrice" class="form-control w-25" placeholder="Új ár...">
                    <input type="submit" class="btn btn-primary mt-2" value="Termék szerkesztése">
                </form>
            <?php endif;?>
            <div class="d-flex btn-group">
                <form action="/delete-product?id=<?= $product['id'] ?>" method="POST">
                    <button type="submit" class="btn btn-danger">Törlés</button>
                </form>
                <a href="/termekek?szerkesztes=<?= $product['id'] ?>">
                    <button class="btn btn-warning ml-2">Szerkesztés</button>
                </a>
            </div>
            <p>ID: <?= $product["id"] ?></p>
            <hr>
        <?php endforeach ?>
</div>