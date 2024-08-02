<?php   
    include("keselamatan.php");
    include("sambungan.php");
    include("ahli_menu.php");

    session_start();
    $idahli = $_SESSION["idpengguna"];
    $namaahli = $_SESSION["namapengguna"];

    if(isset($_POST["submit"])) {
        $idaktiviti = $_POST["idaktiviti"];

        $sql = "insert into kehadiran values('$idahli', '$idaktiviti', 'ya')";
        $result = mysqli_query($sambungan, $sql);
        if ($result == true)
        echo "<h4 class='ok'>MESEJ OUTPUT</h4>
            <div class='ralat'>Berjaya tamabah</div>";
        else
        echo "<h4 class='ralat'MESEJ RALAT</h4>
            <dic class='ralat'>$sql<br><br>".mysqli_error($sambungan)."</div>";
    }
?>

<link rel="stylesheet" href="aaborang.css">
<link rel="stylesheet" href="aabutton.css">

<main>
    <h3 class="panjang">TAMBAH AHLI KE AKTIVITI</h3>
    <form class="panjang"action="ahli_daftar.php" method="post">
        <table>
        <tr>
            <td>Id Ahli</td>
            <td><input type="text" name="idahli" value="<?php echo $idahli;?>"></td>
        </tr>
        <tr>
            <td>Nama Ahli</td>
            <td><input type="text" name="namaahli" value="<?php echo $namaahli;?>"></td>
        </tr>
        <tr>
            <td>Nama Aktiviti</td>
            <td>
                <select name="idaktiviti">
                <?php
                    $sql = "select * from aktiviti where idaktiviti
                    NOT IN (SELECT idaktiviti FROM kehadiran WHERE idahli = '$idahli')";
                    $data = mysqli_query($sambungan, $sql);
                    while($aktiviti = mysqli_fetch_array($data)){
                        echo "<option value='$aktiviti[idaktiviti]'>$aktiviti[namaaktiviti]</option>";
                    }
                ?>
                </select>
            </td>
        </tr>
        </table>
        <button class="tambah" type="submit" name="submit">Tambah</button>
    </form>
</main>

<?php
    include("footer.php");
?>