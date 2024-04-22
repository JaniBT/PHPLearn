<div class="card container p-3 m-3">
        <?php if ($params["isSuccess"]) : ?>
            <div class="alert alert-success">
                Termék létrehozása sikeres
            </div>
        <?php endif ?>
        <form action="/termekek" method="post">
            <input type="text" name="name" placeholder="Név..."> <br>
            <input type="number" name="price" placeholder="Ár..."> <br>
            <input type="submit" name="submit" class="btn btn-success" value="Küldés">
        </form>
        <?php foreach ($params['products'] as $product) : ?>
            <h3>Név: <?= $product["name"] ?></h3>
            <p>Ár: <?= $product["price"] ?> Ft</p>
            <hr>
        <?php endforeach ?>
</div>