<?php
    include("keselamatan.php");
    include("sambungan.php");
    include("admin_menu.php");

    if(isset($_POST["submit"])) {
        $idadmin = $_POST["idadmin"];
        $password = $_POST["password"];
        $namaadmin = $_POST["namaadmin"];

        $sql = "insert into admin values('$idadmin', '$password', '$namaadmin')";
        $result = mysqli_query($sambungan, $sql);
        if ($result == true)
        echo "<h4 class='ok'>MESEJ RALAT</h4>
            <div class='ralat'>Berjaya Tambah</div>";
        else
        echo "<h4 class='ralat'MESEJ RALAT</h4>
            <dic class='ralat'>$sql<br><br>".mysqli_error($sambungan)."</div>";
    }
?>

<link rel="stylesheet" href="aborang.css">
<link rel="stylesheet" href="aabutton.css">


<main>
    <h3 class="panjang">TAMBAH ADMIN</h3>
    <form class="panjang"action="admin_insert.php" method="post">

        <table>
            <tr>
                <td> ID Admin</td>

                <td><input required type="text" name="idadmin"></td>
            </tr>
            <tr>
                <td> Nama Admin</td>
                <td><input type="text" name="namaadmin"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" placeorder="max:8 char"></td>
            </tr>
        </table>
        <button class="tambah"type="submit"name="submit">Tambah</button>
    </form>
</main>

<?php
    include("footer.php");
?>