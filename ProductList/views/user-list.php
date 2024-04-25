<div class="card container p-3 m-3">
    <?php if ($params["isSuccess"]) : ?>
        <div class="alert alert-success">
            Felhasználó létrehozása sikeres
        </div>
    <?php endif ?>
    <form action="/felhasznalok" method="post" class="form-group">
        <input type="text" name="firstname" class="form-control w-25" placeholder="Keresztnév..."> <br>
        <input type="text" name="lastname" class="form-control w-25" placeholder="Vezetéknév..."> <br>
        <input type="text" name="address" class="form-control w-25" placeholder="Cím..."> <br>
        <label for="isSubscribed">Fel van iratkozva?</label>
        <select name="isSubscribed" class="form-control w-25" id="isSubscribed">
            <option value="1">Igen</option>
            <option value="0">Nem</option>
        </select> <br>
        <input type="submit" name="submit" class="btn btn-success" value="Küldés">
    </form>
    <?php foreach ($params['users'] as $user) : ?>
        <div class="p-2 border">
            <h3 class="m-0"><strong>Név: </strong> <?= $user["firstname"] . " " . $user["lastname"] ?></h3>
            <p class="m-0"><strong>Cím: </strong> <?= $user["address"] ?></p>
            <p class="m-0"><strong><?= $user["isSubscribed"] === 1 ? "Fel van iratkozva" : "Nincs feliratkozva" ?></strong></p>
        <?php if ($user['id'] === $params['editedUserId']) : ?>
            <form action="/edit-user?id=<?= $user['id'] ?>" method="POST" class="form-group">
                <h3>Felhasználó szerkesztése</h3>
                <input type="text" name="editedFirstName" class="form-control w-25 mb-2" placeholder="Új keresztnév..."> <br>
                <input type="text" name="editedLastName" class="form-control w-25" placeholder="Új vezetéknév..."> <br>
                <input type="text" name="editedAddress" class="form-control w-25" placeholder="Új cím..."> <br>
                <label for="editUser">Fel van iratkozva?</label>
                <select name="editedIsSubscribed" class="form-control w-25" id="editUser"> <br>
                    <option value="1">Igen</option>
                    <option value="0">Nem</option>
                </select>
                <input type="submit" class="btn btn-primary mt-2" value="Felhasználó szerkesztése">
            </form>
        </div>
        <?php endif;?>
        <div class="d-flex btn-group">
            <form action="/delete-user?id=<?= $user['id'] ?>" method="POST">
                <button type="submit" class="btn btn-danger">Törlés</button>
            </form>
            <a href="/felhasznalok?szerkesztes=<?= $user['id'] ?>">
                <button class="btn btn-warning ml-2">Szerkesztés</button>
            </a>
        </div>
        <p>ID: <?= $user["id"] ?></p>
        <hr>
    <?php endforeach ?>
</div>