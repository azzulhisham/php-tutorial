<?php
    include("keselamatan.php");
    include("sambungan.php");
    include("admin_menu.php");
?>


<link rel="stylesheet" href="aasenarai.css">
<link rel="stylesheet" href="aabutton.css">

<main>
    <form action="kehadiran_inset.php" method="post">
        <table>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Tindakan</th>
            </tr>


            <?php
            if(isset($_GET['idaktiviti']))
                $idaktiviti = $_GET['idaktiviti'];

            echo "<input type='text' hidden name='idaktiviti' value='$idaktiviti'";

            $sql = "select * from aktiviti where idaktiviti='$idaktiviti'";
            $result = mysqli_query($sambungan, $sql);
            $aktiviti = mysqli_fetch_array($result);
            $namaaktiviti = $aktiviti["namaaktiviti"];

            echo "<div class='laporan'>
                    <h3 class='tajuk'>MENAMBAH AHLI KE AKTIVITI</h3>
                    <h3 class='laporan'>Aktiviti: $namaaktiviti<br>
                <?div>";


            $sql = "select * from ahli where idahli
                NOT IN (SELECT idahli FROM kehadiran WHERE idaktiviti = '$idaktiviti');";

            $result = mysqli_query($sambungan, $sql);
            while($ahli = mysqli_fetch_array($result)) {
                echo "<tr><td>$ahli[idahli]</td>
                    <td class='nama'>$ahli[namaahli]</td>
                    <td><input type='checkbox' name='$ahli[idahli]'></td></tr>";
            }
            ?>
        </table>
        <center><button class="tambah" type="submit" name="submit">Tambah</button></center
    </form>
</main>

<?php
    include("footer.php");
?>