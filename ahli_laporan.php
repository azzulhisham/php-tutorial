<?php
    include("keselamatan.php");
    include("sambungan.php");
    include("ahli_menu.php");
?>

<link rel="stylesheet" href="aasenarai.css">
<link rel="stylesheet" href="aabutton.css">


<main>
    <table id='senarai-jadual' class="senarai">
        <caption>Senarai Aktiviti Yang Dihadiri</caption>

        <tr>
            <th>ID</th>
            <th>Aktiviti</th>
            <th>Hadir</th>
        </tr>



        <?php
        session_start();
        $idahli = $_SESSION["idpengguna"];
        $namahli = $_SESSION["namapengguna"];

        $sql = "select * from kehadiran
            join aktiviti on kehadiran.idaktiviti = aktiviti.idaktiviti
            join ahli on kehadiran.idahli = ahli.idahli
            where kehadiran.idahli = '$idahli' ";

        $result = mysqli_query($sambungan, $sql);
        while($kehadiran = mysqli_fetch_array($result)) {
            echo "<tr><td>$kehadiran[idaktiviti]</td>
                    <td class='nama'>$kehadiran[namaaktiviti]</td>
                                    <td>";
            
            if($kehadiran['hadir'] == "ya")
                echo "<img src='imej/right.png'>";
            else
                echo "<img src='imej/absent.png'>";

            echo "</td></tr>";
        }
    ?>

    </table>


    <!-- <center><button class="cetak" onclick='window.print()'>Cetak</button></center>  -->
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

