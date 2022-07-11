<div class="col-12-xl col-12-lg col-12-md col-12-sm col-12-xs">
  <h1 class="pl-8"><?= $title ?></h1>
  <?php $this->includePartial("form", $page->getFormPage($page->getId() ? $page : null)) ?>
</div>



<script>
  function truncate(str, no_words) {
    return str.split(" ").splice(0, no_words).join(" ");
  }

  $("#title").keyup(function() {
    var str = truncate($(this).val(), 5)
    var trims = $.trim(str)
    var slug = trims.normalize('NFD').replace(/[^a-z0-9]/gi, '-').replace(/-+/g, '-').replace(/^-|-$/g, '')
    $("#slug").val('/' + slug.toLowerCase().substring(0, 50))
  })
</script>