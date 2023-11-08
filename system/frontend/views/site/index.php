<?php

// $this->title = 'Home';
// $this->params['breadcrumbs'][] = ['label' => 'Home', 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>

<!-- Our Culture -->
  <?=$contactUs->our_culture?>
<!-- Our Culture end-->

<!-- Youtube Video -->
<div class="embed-responsive embed-responsive-21by9">
    <?= $contactUs->youtube_api ?>
</div>
<!-- Youtube Video end -->

<?php

$css = <<< CSS
.embed-responsive-item {
  width: 854px !important;
  height: 470px !important;
  margin-left: 125px !important;
}

@media (max-width: 768px) {
  .embed-responsive .embed-responsive-item {
    width: 90% !important;
    height: 100% !important;
    margin-left: 25px !important;
  }
}
CSS;

$this->registerCss($css);