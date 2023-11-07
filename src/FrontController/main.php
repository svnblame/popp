<?php
    $request = \POPP\FrontController\Registry::instance()->getRequest();
?>

<html lang="en">
<head>
    <title>Woo! It's Woo!</title>
</head>
<body>
    <table>
        <tr>
            <td>
                <?php print $request->getFeedbackString('</td></tr><tr><td>') ?>
            </td>
        </tr>
    </table>
</body>
</html>
