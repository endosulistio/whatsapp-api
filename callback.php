<?php
include_once("koneksi.php");
header('content-type: application/json');
$data = json_decode(file_get_contents('php://input'), true);
file_put_contents('callback.txt', '[' . date('Y-m-d H:i:s') . "]\n" . json_encode($data) . "\n\n", FILE_APPEND);
$nomor =   preg_replace('/@c.us/', '', $data['sender']);;
$pesan = filter_var($data['msg'], FILTER_SANITIZE_STRING);
// auto reply
$msg = strtolower($pesan);

if ($msg == '' && $pesan == '') {
} else {

    $cek = $koneksi->query("SELECT * FROM receive_chat WHERE nomor = '$nomor' ");
    $nomorscanner = $koneksi->query("SELECT nomor FROM pengaturan")->fetch_assoc()['nomor'];
    if (mysqli_num_rows($cek) > 0) {
        $datetime = date('Y-m-d H:i:s');
        $datachat = mysqli_fetch_assoc($cek);
        $idpesan = $datachat['id_pesan'];
        $insert = $koneksi->query("INSERT INTO receive_chat VALUES (null,'$idpesan','$nomor','$pesan','0','$nomorscanner','$datetime')");
    } else {
        $datetime = date('Y-m-d H:i:s');
        $id = rand(1111, 9999);
        $insert = $koneksi->query("INSERT INTO receive_chat VALUES (null,'$id','$nomor','$pesan','0','$nomorscanner','$datetime')");
    }
}
// wa web
