<?php
include_once("Client.php");
$clients = new Client();
//echo "<pre>";
//var_dump($clients->clients);
//$client->add('Diana', 'Dimko', ['+38050909032','+38987056245']);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="form-add-client">
    <form action="./class.php">
        <input type="text"  placeholder="Name" class="name">
        <input type="text" placeholder="Surname" class="surname">
        <input type="text" placeholder="phone" class="phone">
        <input type="button" value="+">
        <input type="submit" value="Add clinte">
    </form>
</div>
<div class="table">
   <table border="1px">
        <tr>
            <th>
                №
            </th>
            <th>
                Name
            </th>
            <th>
                Surname
            </th>
            <th>
                Phone
            </th>
        </tr>
        <?php
        $i=0;
        foreach ($clients->clients as $client) {
            $i++;
          $phones = explode(", ", $client['phones']);
            echo "<tr><td > " . $i .
                "</td><td > " . $client['name'] .
                "</td><td > " . $client['surname'] .
                "</td><td>";

            foreach ($phones as $phone) {echo "<a href='tel:" . $phone . "'> " . $phone . "</a>";}
            echo "</td></tr> ";
        }


        ?>
    </table>
</div>


</body>
</html>
