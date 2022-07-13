<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <h1 class="pl-8"><?= $title ?></h1>
  <div class="pr-2 pl-2">
    <?php
    $this->includePartial("error", ['visible' => isset($error) ? $error : false, 'message' => isset($errorMessage) ? $errorMessage : null, 'list' => isset($listErrors) ? $listErrors : null]);
    $this->includePartial("success", ['visible' => isset($success) ? $success : false, 'message' => isset($successMessage) ? $successMessage : null, 'list' => isset($listSuccess) ? $listSuccess : null]);
    ?>
  </div>
  <?php $this->includePartial("form", $page->getFormPage($page->getId() ? $page : null)) ?>
</div>



<script>
  var is_focus = false;

  function truncate(str, no_words) {
    return str.split(" ").splice(0, no_words).join(" ");
  }

  $("#title").keyup(function() {
    if (!is_focus) {
      var str = truncate($(this).val(), 5)
      var trims = $.trim(str)
      var slug = trims.normalize('NFD').replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '')
      $("#slug").val('/' + slug.toLowerCase().substring(0, 50))
    }
  })

  $('#slug').on("focusout", function() {
    is_focus = true;
  });
</script>