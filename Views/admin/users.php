<table class="table table-stripped">
    <thead>
        <!-- <th>E-mail</th> -->
        <th>Pseudo</th>
        <th>Actif</th>
        <th>Roles</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <!-- <td><?= $user->email ?></td> -->
                <td><?= $user->pseudo ?></td>
                <td>
                    <!-- <?= $user->actif ?> -->
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="customSwitch<?= $user->id ?>" <?= $user->actif ? 'checked' : '' ?> data-id="<?= $user->id ?>">
                        <label class="custom-control-label" for="customSwitch<?= $user->id ?>"></label>
                    </div>
                </td>
                <td>
                    <?php
                    if ($user->roles == '["ROLE_ADMIN"]') {
                        echo "Admin";
                    } else {
                        echo "Abonné(e)";
                    }
                    ?>
                </td>
                <td>
                    <a href="/admin/modifUser/<?= $user->id ?>" class="btn btn-warning">Modifier</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>