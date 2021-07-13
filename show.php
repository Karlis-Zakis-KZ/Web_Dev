<?php
require("conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet/style2.css">
    <title>Data</title>
</head>

<body>
    <?php if ($data->num_rows > 0) { ?>

        <div class="container">
            <input type="text" id="myInput" onkeyup="search()" placeholder="Search for names..">
        </div>
        <div class="container">
            <button onclick="window.location.reload()"> Reset</button>
            <button onclick="sortTable()">Sort By Name</button>
            <?php while ($row = $domains->fetch_assoc()) {
                $domain = ucfirst($row['name']);
            ?>
                <button onclick="searchSpecific('<?php echo $domain ?>')"> <?php echo $domain ?></button>
            <?php } ?>

        </div>
        <span class="error" id="error">
            <?php if (isset($_GET['error'])) {
                echo "<li>Please Select First</li>";
            } ?>
        </span>
        <form action="conn.php" method="POST">

            <div class="container">
                <button type="submit" name="exportCsv" class="exportBtn">Export CSV</button>
                <table id="myTable">
                    <tr>
                        <th>Select</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    <?php while ($row = $data->fetch_assoc()) { ?>
                        <tr>
                            <td><input type="checkbox" value="<?php echo $row["id"] ?>" name="csv[]" onclick="removeError()"></td>
                            <td><?php echo $row["email"] ?></td>
                            <td>
                                <a class="deleteLink" href="conn.php?delete=<?php echo $row['id'] ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </table>

            </div>
        </form>
        <div class="container">
            <div class=" pagination">
                <?php $pagi = ceil($totalRecords / 10);
                for ($i = 1; $i <= $pagi; $i++) {
                ?>
                    <a class="<?php echo $currentPage == $i ? "active" : "" ?>" href="?page=<?php echo $i ?>"><?php echo $i; ?></a>
                <?php } ?>
            </div>
        </div>
    <?php } else {
        echo "<h1>No Emails added yet</h1>";
    } ?>
    <!-- JS Script -->
    <script src="js/script2.js"></script>
    <script>
        function removeError() {
            document.getElementById("error").style.display = "none"
        }
    </script>
</body>

</html>