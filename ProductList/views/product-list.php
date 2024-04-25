<div class="card container p-3 m-3">
        <?php if ($params["isSuccess"]) : ?>
            <div class="alert alert-success">
                Termék létrehozása sikeres
            </div>
        <?php endif ?>
        <form action="/termekek" method="post" class="form-group">
            <input type="text" name="name" class="form-control w-25" placeholder="Név..."> <br>
            <input type="number" name="price" class="form-control w-25" placeholder="Ár..."> <br>
            <input type="text" name="quantity" class="form-control w-25" placeholder="Darabszám..."> <br>
            <input type="number" name="discount" class="form-control w-25" min="1" max="99" placeholder="Kedvezmény (százalékos)..."> <br>
            <textarea name="description" cols="30" class="form-control w-50" rows="10" placeholder="Termék leírás..."></textarea> <br>
            <input type="submit" name="submit" class="btn btn-success" value="Küldés">
        </form>
        <?php foreach ($params['products'] as $product) : ?>
            <div class="p-2 border">
                <h3 class="m-0"><strong>Név:</strong> <?= $product["name"] ?></h3>
                <p class="m-0"><strong><?= $product["discount"] === 1 ? "" : "Kedvezményes " ;?> Ár:</strong> <?= $product["price"] - $product["price"] * $product["discount"] ?> Ft</p>
                <p class="m-0"><strong>Mennyiség:</strong> <?= $product["quantity"] ?></p>
                <p class="m-0"><strong>Leírás:</strong> <?= $product["description"] ?></p>
            
            <?php if ($product['id'] === $params['editedProductId']) : ?>
                <form action="/edit-product?id=<?= $product['id'] ?>" method="POST" class="form-group ">
                    <h3>Termék szerkesztése</h3>
                    <input type="text" name="editedName" class="form-control w-25 mb-2" placeholder="Új név...">
                    <input type="number" name="editedPrice" class="form-control w-25" placeholder="Új ár...">
                    <input type="text" name="editedQuantity" class="form-control w-25" placeholder="Új darabszám..."> <br>
                    <input type="number" name="editedDiscount" class="form-control w-25" min="1" max="99" placeholder="Új Kedvezmény (százalékos)..."> <br>
                    <textarea name="editedDescription" cols="30" class="form-control w-50" rows="10" placeholder="Új termék leírás..."></textarea> <br>
                    <input type="submit" class="btn btn-primary mt-2" value="Termék szerkesztése">
                </form>
            </div>
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