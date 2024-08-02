<?php   
    include("keselamatan.php");
    include("sambungan.php");
    include("admin_menu.php");

    echo "<main class='aktiviti'><div class='aktiviti-cont'>";

    $sql = "select * from aktiviti";
    $result = mysqli_query($sambungan,$sql);

    while($aktiviti = mysqli_fetch_array($result)) {
        echo "<div>
                <img class='home' src='imej/$aktiviti[gambar]'>
                <figcaption>$aktiviti[namaaktiviti]</figcaption>
            </div>";
    }

    echo "</div></main>";

    include("footer.php");
?>