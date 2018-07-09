<?php
include_once(APP_DIR . '/controllers/Client.php');
$clients = new Client();
?>
<div class="form-add-client">
    <form action="../app/models/Client.php">
        <input type="text" placeholder="Name" class="name">
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
        $i = 0;
        foreach ($clients->clients as $client) {
            $i++;
            $phones = explode(", ", $client['phones']);
            echo "<tr><td > " . $i .
                "</td><td > " . $client['name'] .
                "</td><td > " . $client['surname'] .
                "</td><td>";

            foreach ($phones as $phone) {
                echo "<a href='tel:" . $phone . "'> " . $phone . "</a>";
            }
            echo "</td></tr> ";
        }
        ?>
    </table>
</div>

