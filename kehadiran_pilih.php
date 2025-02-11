<?php
    include("keselamatan.php");
    include("sambungan.php");
    include("admin_menu.php");

?>

<link rel="stylesheet" href="aasenarai.css">
<link rel="stylesheet" href="aabutton.css">
<link rel="stylesheet" href="aaborang.css">

<main>

    <h3 class="pendek">PILIH JENIS LAPORAN</h3>
    <form class="pendek" action="kehadiran_laporan.php" method="post">

        <select id='pilih' name='pilih' onchange='papar_pilihan()'>
            <option value=1>Senarai Mengikut Aktiviti</option>
            <option value=2>Senarai Mengikut ahli</option>
        </select> <br>

        <div id="aktiviti" style="display:block">
            <select name="idaktiviti">
                <?php
                    include('sambungan.php');
                    $sql = "select * from aktiviti";
                    $data = mysqli_query($sambungan, $sql);
                    while ($aktiviti = mysqli_fetch_array($data)) {
                        $id_aktiviti = $aktiviti['idaktiviti'];
                        $nama_aktiviti = $aktiviti['namaaktiviti'];
                        echo "<option value='" . $id_aktiviti . "'>" . $nama_aktiviti . "</option>";
                    }
                ?>
            </select>
        </div>

        <div id="ahli" style="display:none">
            <select name="idahli">
                <?php
                    include('sambungan.php');
                    $sql = "select * from ahli";
                    $data = mysqli_query($sambungan, $sql);
                    while ($ahli = mysqli_fetch_array($data)) {
                        echo "<option value='$ahli[idahli]'>$ahli[namaahli]</option>";
                    }
                ?>
            </select>
        </div>
        <button class="papar" name="submit">papar</button>
    </form>
   


<script>
    function papar_pilihan() {
        var pilih = document.getElementById("pilih").value;
        var paparaktiviti = 'none';
        var paparahli = 'none';

        if(pilih == 1) {
            paparaktiviti = 'block';
            paparahli = 'none';
        }
        else if (pilih == 2) {
            paparaktiviti = 'none';
            paparahli = 'block';
        }
        document.getElementById('aktiviti').style.display = paparaktiviti;
        document.getElementById('ahli').style.display = paparahli;
    }

    papar_pilihan()
</script>
</main>

<?php
    include("footer.php");
?>