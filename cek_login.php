<?php
//mengaktifkan sesion pada php
session_start();

include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data user yang sesuai
$login = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' and password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password ditemukan di database
if ($cek > 0)
{
    $data = mysqli_fetch_assoc($login);
    // jika user login sebagai admin
    if ($data['level'] == "admin")
    {
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['level'] = 'admin';

        // alihkan ke halaman dashboard admin
        header("location: halaman_admin.php");
    }
    // jika user login sebagai pegawai
    elseif ($data['level'] == "pegawai")
    {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = 'pegawai';

        // alihkan ke halaman dashboard admin
        header("location: halaman_pegawai.php");
    }
    // jika user login sebagai pengurus
    elseif ($data['level'] == "pengurus")
    {
        $_SESSION['username'] = $username;
        $_SESSION['level'] = 'pengurus';

        // alihkan ke halaman dashboard admin
        header("location: halaman_pengurus.php");
    }
    else
    {
        // alihkan ke halaman login
        header("location: index.php?pesan=gagal");
    }
}
else
{
    header("location: index.php?pesan=gagal");
}
?>