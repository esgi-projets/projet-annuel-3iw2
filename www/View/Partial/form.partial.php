<form class="<?= $config["config"]["class"] ?>" method="<?= $config["config"]["method"] ?? "POST" ?>" action="<?= $config["config"]["action"] ?? "" ?>">
    <?php foreach ($config["inputs"] as $name => $input) : ?>
        <div class='<?= $input["type"] == 'hidden' ? "" : "column pr-3 pl-3 pb-5" ?>'>
            <label class='<?= $input["type"] == 'hidden' ? "" : "mb-2" ?>'><?= $input["name"] ?? "" ?></label>
            <input name="<?= $name ?>" id="<?= $input["id"] ?>" type="<?= $input["type"] ?>" class="<?= $input["class"] ?? "" ?>" value="<?= $input["value"] ?? "" ?>" placeholder="<?= $input["placeholder"] ?? "" ?>" <?= (!empty($input["required"])) ? 'required="required"' : '' ?>>
        </div>
    <?php endforeach; ?>

    <div class="column mt-2 pr-3 pl-3">
        <input type="submit" class="button button-primary w-100 h-100" value="<?= $config["config"]["submit"] ?? "Valider" ?>"></input>
    </div>
</form>