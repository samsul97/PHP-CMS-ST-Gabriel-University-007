<?php
$schemaProperties = $model->schema_properties;
$decodedSchema = json_decode($schemaProperties);
$encodedSchema = json_encode($decodedSchema, JSON_PRETTY_PRINT);
?>
<div>
    <p>
        <span class="label">Title : </span> <?= $model->title ?>
    </p>
    <p>
        <span class="label">Meta Keywords : </span> <?= $model->keywords ?>
    </p>
    <p>
        <span class="label">Meta Description : </span> <?= $model->description ?>
    </p>
    <p>
        <span class="label">Meta Canonical : </span> <?= $model->canonical ?>
    </p>
    <p>
        <span class="label">Heading 1 : </span> <?= $model->heading_1 ?>
    </p>
    <p>
        <span class="label">Heading 2 : </span> <?= $model->heading_2 ?>
    </p>
    <p>
        <span class="label">Heading 3 : </span> <?= $model->heading_3 ?>
    </p>
    <p>
        <span class="label">Heading 4 : </span> <?= $model->heading_4 ?>
    </p>
    <p>
        <span class="label">Heading 5 : </span> <?= $model->heading_5 ?>
    </p>
    <p>
        <span class="label">Heading 6 : </span> <?= $model->heading_6 ?>
    </p>
    <p>
        <span class="label">Meta Robots : </span> <?= $model->robots ?>
    </p>
    <p>
        <span class="label">Schema Properties : </span> <?= nl2br($encodedSchema) ?>
    </p>
</div>

<?php
$css = <<< CSS
.label {
    font-weight: bold;
}
CSS;
$this->registerCss($css);