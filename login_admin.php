<?php
    session_start();
    include("sambungan.php");
    
    if(isset($_POST["submit"])) {
        $userid = $_POST["userid"];
        $password = $_POST["password"];
        
        $jumpa = FALSE;
        
        // if($jumpa == FALSE) {
        //     $sql = "SELECT * FROM ahli";
        //     $result = mysqli_query($sambungan, $sql);
            
        //     while($ahli = mysqli_fetch_array($result)) {
        //         if ($ahli["idahli"] == $userid && $ahli["password"] == $password) {
        //             $jumpa = TRUE;

        //             session_start();
        //             $_SESSION["idpengguna"] = $ahli["idahli"];
        //             $_SESSION["namapengguna"] = $ahli["namaahli"];
        //             $_SESSION["status"] = "ahli";
        //             break;
        //         }
        //     }
        // }
        
        if($jumpa == FALSE) {
            $sql = "SELECT * FROM admin";
            $result = mysqli_query($sambungan, $sql);
            
            while($admin = mysqli_fetch_array($result)) {
                if ($admin["idadmin"] == $userid && $admin["password"] == $password) {
                    $jumpa = TRUE;
                    
                    session_start();
                    $_SESSION["idpengguna"] = $admin["idadmin"];
                    $_SESSION["namapengguna"] = $admin["namaadmin"];
                    $_SESSION["status"] = "admin";
                    break;
                }
            }
        }
        
        if($jumpa == TRUE) 
            if($_SESSION["status"] == "ahli") 
                header("location: ahli_home.php");
            else if($_SESSION["status"] == "admin") 
                header("location: admin_home.php");
        else
            echo "window.location='login_admin.php'";
        
        echo "<script>alert('kesalahan pada username atau password');</script>";   
    }
?>

<link rel="stylesheet" href="aabutton.css">
<link rel="stylesheet" href="aaborang.css">

<center>
    <img class="tajuk" src="imej/tajuk.png" width=700>
</center>

<h3 class="pendek">LOG IN ADMIN</h3>
<form class="pendek" action="login_admin.php" method="post">
    <table>
        <tr>
            <td><img src="imej/user.png"></td>
            <td><input type="text" name="userid" placeholder="idpengguna"</td>
        </tr>
        <tr>
            <td><img src="imej/lock.png"></td>
            <td><input type="password" name="password" placeholder="password"</td>
        </tr>        
    </table>

    <button class="login" type="submit" name="submit">Login</button>
    <button class="signup" type="button" onclick="window.location='index.php'">Login Ahli</button>
</form>
















