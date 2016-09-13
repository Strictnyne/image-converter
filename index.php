<!DOCTYPE html>

<html>
    <head>
        <link href="framework/css/toolkit.min.css" rel="stylesheet">
        <link href="framework/css/extension.css" rel="stylesheet">
        <link href="framework/css/font-awesome.min.css" rel="stylesheet">
<!--        <script src="framework/js/jquery-3.1.0.min.js"></script>-->

        <title>image.converter</title>
    </head>

    <?php
        // Variable Settings //
        $dest_path = "images/destination/";
        $source_path = "images/source/";

        // Actual conversaion happens here //
        function executeImageConversion($source_path, $dest_path) {
            $images = glob($source_path.'/*.png');

            foreach($images as $image) {
                $path = pathinfo($image);
                $temp_image = imagecreatefrompng($source_path . '/' . basename($image));
                imagejpeg($temp_image, $dest_path . '/' . $path['filename'] . '.jpg', 100);
            }

            ?>
                <div id="confirmation" style="text-align: center;">
                    <h3>
                        Images are converted.
                    </h3>
                </div>
            <?php
        }
    ?>

    <body>
        <div class="grid">
            <div class="col span-12">
                <img src="images/header.png" alt="It's T-Rexcellent">
            </div>
        </div>

        <div class="grid">
            <div class="col span-6 push-3">

                <table id="images-table" class="table is-striped is-striped">
                    <thead>
                        <tr>
                            <th colspan="2">
                                Current Image List(PNG)
                            </th>
                        </tr>
                    </thead>

                    <tbody>
<!--                        <tr>-->
<!--                            <td>-->
                                <?php
                                    $images = glob($source_path.'/*.png');

                                    if(count($images) > 0) {
                                        foreach($images as $image) {
                                            echo "<tr>";
                                            echo "<td><i class='fa fa-picture-o' aria-hidden='true'></i> " . basename($image) . "</td>";
                                            echo "<td>" . number_format(filesize($image) / 1024, 2) . " KB </td>";
                                            echo "</tr>";
                                        }
                                    }
                                    else        {
                                        echo "<tr><td style='text-align: center;'>No images found</td></tr>";
                                    }

                                ?>
    <!--                            </td>-->
    <!--                        </tr>-->
                    </tbody>
                </table>

            </div>
        </div>

        <div class="grid">
            <div class="col span-6 push-3">
                <div style="text-align: right;">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input id="convert-images" type="submit" name="submit" value="Convert Images" class="button">
                    </form>
                </div>
            </div>
        </div>

        <div class="grid">
            <div class="col span-6 push-3">
                <div id="confirmation" style="text-align: center; display: none;">
                    <h3>
                        Images are converted.
                    </h3>
                </div>
            </div>
        </div>

        <?php
            if(isset($_POST['submit'])) {
                executeImageConversion($source_path, $dest_path);
            }
        ?>

    </body>
</html>
