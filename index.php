<?php
if ($_FILES):

    $files = $_FILES['file'];
    $file_path = $files['tmp_name'];

    $blob_file = file_get_contents($file_path);
    $blob_file = unserialize(gzuncompress($blob_file));
endif;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blob reader</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>

<section class="py-5">
    <div class="container">

        <h1>Matomo Blob reader</h1>
        <p>Download blob as binary file and import them in this viewer to reader the content</p>

        <form action="?" method="POST" enctype="multipart/form-data">
            <div class="input-group">
                <input type="file" id="file" name="file" class="form-control">
                <button type="submit" class="btn btn-outline-success">Envoyer</button>
            </div>
        </form>

        <?php if (isset($blob_file)): ?>
            <ul class="nav nav-tabs mt-5" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="table-tab" data-bs-toggle="tab" data-bs-target="#table-tab-pane"
                            type="button" role="tab" aria-controls="table-tab-pane" aria-selected="true">Table
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="raw-tab" data-bs-toggle="tab" data-bs-target="#raw-tab-pane"
                            type="button" role="tab" aria-controls="raw-tab-pane" aria-selected="false">RAW data
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="table-tab-pane" role="tabpanel" aria-labelledby="table-tab"
                     tabindex="0">

                    <div class="table-responsive mt-5">
                        <table class="table table-hover table-striped table-bordered mb-0">

                            <thead>
                            <tr>
                                <?php foreach ($blob_file[0][0] as $index => $value): ?>
                                    <th><?php echo $index; ?></th>
                                <?php endforeach; ?>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($blob_file as $blob): ?>
                                <tr>
                                    <?php foreach ($blob[0] as $index => $value): ?>
                                        <td>
                                            <span><?php echo $value !== null ? $value : '-' ?></span>
                                        </td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="tab-pane fade" id="raw-tab-pane" role="tabpanel" aria-labelledby="raw-tab" tabindex="0">
                    <?php var_dump($blob_file); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>
</html>