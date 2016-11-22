<?php
/**
 * @author Abhay Kumar Verma
 * Lucknow
 */
include_once 'DistanceFinder.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Simple Distance Finder</title>
    </head>
    <body>
        <h3>Simple Distance Finder </h3>
        <form method="post">
            <label>From:</label>
            <select name="address">
                <option>Lucknow</option>  
                <option>Kanpur</option>
                <option>Faizabad</option>
                <option>Gorakhpur</option>
                <option>Barabanki</option>
                <option>Raibarelly</option>
            </select>
            <label>To:</label>
            <select name="addresses">
                <option>Gorakhpur</option>
                <option>Barabanki</option>
                <option>Raibarelly</option>
                <option>Lucknow</option>  
                <option>Kanpur</option>
                <option>Faizabad</option>
            </select>
            <input type="submit" name="find" onclick="callAjax()" value="find"/>
        </form>
        <?php echo "<p>Total Distance Between $address To $addresses is"?>
        <h3 style="color:green"><?php echo (int)$dist."Km" ?></h3>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script>
                function callAjax() {
                    $.ajax({url: 'DistanceFinder.php',
                        data: {action: 'test'},
                        type: 'post',
                        success: function (output) {
                            alert(output);
                        }
                    });
                }
        </script>
    </body>

</html>
