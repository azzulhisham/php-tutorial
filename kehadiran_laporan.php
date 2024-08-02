<?php
    include("keselamatan.php");
    include("sambungan.php");
    include("admin_menu.php");

?>

<link rel="stylesheet" href="aasenarai.css">
<link rel="stylesheet" href="aabutton.css">

<main> 
    <?php
    if(isset($_POST['submit'])) {

        // idaktiviti, idahli, pilih dari fail
        // kehadiran_pilih.php pastikan anda
        // telah membuat pilihan
        
        $idaktiviti = $_POST['idaktiviti'];
        $idahli = $_POST['idahli'];
        $pilih = $_POST['pilih'];

        if($pilih == 1) {
            $sql = "select * from kehadiran
            join aktiviti on kehadiran.idaktiviti = aktiviti.idaktiviti
            join ahli on kehadiran.idahli = ahli.idahli
            where kehadiran.idaktiviti = '$idaktiviti' ";


            $result = mysqli_query($sambungan, $sql);
            $kehadiran = mysqli_fetch_array($result);
            $bil_rekod = mysqli_num_rows($result);

            if($bil_rekod >0) {

            $tempat = $kehadiran["tempat"];
            $namaaktiviti = $kehadiran["namaaktiviti"];
            $tarikh = date_format(date_create($kehadiran['tarikhmasa']), 'd-m-Y');
            $masa = date_format(date_create($kehadiran['tarikhmasa']), 'h:i A');


        echo "<div class='laporan'>
            <h3 class='tajuk'>Senarai Nama Kehadiran Mengikut Aktiviti</h3>
            <h3 class='laporan'>Aktiviti: $namaaktiviti<br>
            Tempat : $tempat<br>
            Tarikh : $tarikh Masa : $masa</h3>
                </div>";

            echo "<table id='senarai-jadual' class='senarai'>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Hadir</th>
                </tr> ";
    }
else
    echo "<h3 style=text.align:center;margin-top:100px;color:red;>TIADA Senarai
    LAPORAN BAGI AKTIVITI</h3>";

        $result = mysqli_query($sambungan, $sql);
        while($kehadiran = mysqli_fetch_array($result)) {
            echo "<tr><td>$kehadiran[idahli]</td>
                    <td class='nama'>$kehadiran[namaahli]</td>
                    <td>";

                if ($kehadiran['hadir'] == "ya")
                    echo "<img src='imej/right.png'>";
                else
                    echo "<img src='imej/absent.png'>";

            echo "</td></tr>";
        }
        echo "</table>";
    }

    if ($pilih == 2) {
        $sql = "select * from kehadiran
            join aktiviti on kehadiran.idaktiviti = aktiviti.idaktiviti
            join ahli on kehadiran.idahli = ahli.idahli
            where kehadiran.idahli = '$idahli' ";

        $result = mysqli_query($sambungan, $sql);
        $kehadiran = mysqli_fetch_array($result);
        $bil_rekod = mysqli_num_rows($result);

        if ($bil_rekod >0) {

        $namaahli = $kehadiran["namaahli"];

        echo "<div class='laporan'>
            <h3 class='tajuk'>Senarai Nama Kehadiran Mengikut Ahli</h3>
            <h3 class='laporan'>Nama: $namaahli<br>
            </div>";

        echo "<table id='senarai-jadual' table class='senarai'>
            <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Hadir</th>
        </tr> ";
    }
    else
        echo "<h3 style=text.align:center;margin-top:100px;color:red;>TIADA Senarai
        LAPORAN BAGI AKTIVITI</h3>";

                $result = mysqli_query($sambungan, $sql);
        while($kehadiran = mysqli_fetch_array($result)) {
            echo "<tr><td>$kehadiran[idaktiviti]</td>
                    <td class='nama'>$kehadiran[namaaktiviti]</td>
                    <td>";

                if($kehadiran['hadir'] == "ya")
                    echo "<img src='imej/right.png'>";
                else
                    echo"<img src='imej/absent.png'>";

            echo "</td></tr>";
        }
    echo "</table>";
        }
    }
    ?>

    <div class="table-button">
        <div>
            <button class="cetak" onclick='window.print()'>Cetak</button>
        </div>
        
        <div>
            <button id="btn-increase" class="btn-zoom">+</button>
            <button id="btn-reset"  class="btn-zoom">Reset</button>
            <button id="btn-decrease" class="btn-zoom">-</button>
        </div>

    </div>


    <script>
        const btn_increase = document.getElementById('btn-increase')
        const btn_reset = document.getElementById('btn-reset')
        const btn_decrease = document.getElementById('btn-decrease')
        const tbl = document.getElementById('senarai-jadual')

        sizetbl = ['20%', '30%', '40%', '50%', '60%', '70%', '80%']
        fonttbl = ['12px', '13px', '14px', '15px', '16px', '17px', '18px']
        sizeidx = 3

        btn_increase.addEventListener('click', ()=>{
            sizeidx += 1

            if (sizeidx > 6) {
                sizeidx = 6
            }

            changetablesize(sizeidx)
        })

        btn_decrease.addEventListener('click', ()=>{
            sizeidx -= 1

            if (sizeidx < 0) {
                sizeidx = 0
            }

            changetablesize(sizeidx)
        }) 
        
        btn_reset.addEventListener('click', ()=>{
            sizeidx = 3
            changetablesize(sizeidx)
        })  
        
        function changetablesize(idx){
            tbl.style.width = sizetbl[idx]
            tbl.style.fontSize = fonttbl[idx]
        }
    </script>    
</main>

<?php
    include("footer.php");
?>