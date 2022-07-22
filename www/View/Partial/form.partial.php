<form enctype="multipart/form-data" class="<?= $config["config"]["class"] ?>" method="<?= $config["config"]["method"] ?? "POST" ?>" action="<?= $config["config"]["action"] ?? "" ?>">
    <?php foreach ($config["inputs"] as $name => $input) : ?>
        <div class='<?= $input["type"] == 'hidden' ? "" : "column pr-3 pl-3 pb-5" ?>'>
            <label class='<?= $input["type"] == 'hidden' ? "" : "mb-2" ?>'><?= $input["name"] ?? "" ?></label>
            <?php if ($input["type"] == 'textarea') : ?>
                <textarea name="<?= $name ?>" id="<?= $input["id"] ?>" class="<?= $input["class"] ?? "" ?>" placeholder="<?= $input["placeholder"] ?? "" ?>" <?= (!empty($input["required"])) ? 'required="required"' : '' ?>><?= $input["value"] ?? "" ?></textarea>
            <?php elseif ($input["type"] == 'select') : ?>
                <select name="<?= $name ?>" id="<?= $input["id"] ?>" class="<?= $input["class"] ?? "" ?>" <?= (!empty($input["required"])) ? 'required="required"' : '' ?>>
                    <?php foreach ($input["options"] as $key => $value) : ?>
                        <option value="<?= $key ?>" <?= ($input["value"] == $key) ? 'selected' : '' ?>><?= $value ?></option>
                    <?php endforeach; ?>
                </select>
            <?php elseif ($input["type"] == 'file') : ?>
                <label class="">

                    <div class="w-100 button button-secondary">
                        <span id="text">Ajouter une image</span>
                        <input name="<?= $input["id"] ?>" id="<?= $input["id"] ?>" type="file" class="hidden file" accept="image/*" />
                    </div>

                </label>
            <?php else : ?>
                <?php if ($input["type"] == "checkbox") : ?>
                    <label class="switch ml-5">
                        <input type="checkbox" name="<?= $name ?>" id="<?= $input["id"] ?>" <?= $input['value'] ? 'checked' : '' ?> <?= (!empty($input["required"])) ? 'required="required"' : '' ?>>
                        <span class="slider round"></span>
                    </label>
                <?php else : ?>
                    <input name="<?= $name ?>" id="<?= $input["id"] ?>" type="<?= $input["type"] ?>" class="<?= $input["class"] ?? "" ?>" options="<?= $input["options"] ?? "" ?>" value="<?= $input["value"] ?? "" ?>" placeholder="<?= $input["placeholder"] ?? "" ?>" <?= (!empty($input["required"])) ? 'required="required"' : '' ?> <?= (!empty($input["disabled"])) ? 'disabled' : '' ?> <?= (!empty($input["step"])) ? 'step=' . $input["step"] . '' : '' ?>>
                <?php endif ?>
            <?php endif ?>
        </div>
    <?php endforeach; ?>

    <div class="column mt-2 pr-3 pl-3">
        <input type="submit" class="button button-primary w-100 h-100 mt-3" value="<?= $config["config"]["submit"] ?? "Valider" ?>"></input>
    </div>
</form>