<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8">
	<title>Welcome Whatsapp API</title>

</head>
<body>
<div id="cardimg"></div>

<button id="logout" href="#" class="btn btn-danger mt-6">logout</button>
<button id="scanqrr" href="#" class="btn btn-primary mt-6">Scan qr</button>
<button id="cekstatus" href="#" class="btn btn-success mt-6">Cek Koneksi</button>

<script src="<?=base_url('assets/jquery/jquery.min.js')?>"></script>
<script src="<?=base_url('assets/jquery-easing/jquery.easing.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/3.1.0/socket.io.js" integrity="sha512-+l9L4lMTFNy3dEglQpprf7jQBhQsQ3/WvOnjaN/+/L4i0jOstgScV0q2TjfvRF4V+ZePMDuZYIQtg5T4MKr+MQ==" crossorigin="anonymous"></script>
<script>
    // ini untuk di hosting
    // var socket = io()
    // ini untuk di local
    var socket = io('http://localhost:8000', {
        transports: ['websocket',
            'polling',
            'flashsocket'
        ]
    });

    socket.emit('ready', 'sdf');
    socket.on('loader', function() {
        $('#cardimg').html(`<img src="<?=base_url('assets/img/Preloader-Gif.gif')?>" class="card-img-top center" alt="cardimg" id="qrcode"  style="height:250px; width:250px;">`);
    })
    socket.on('message', function(msg) {
        $('.log').html(`<li>` + msg + `</li>`);
    })
    socket.on('qr', function(src) {
        $('#cardimg').html(` <img src="` + src + `" class="card-img-top" alt="cardimg" id="qrcode" style="height:250px; width:250px;">`);
    });


    // ketika terhubung
    socket.on('authenticated', function(src) {
        const nomors = src.jid;
        const nomor = nomors.replace(/\D/g, '');
        // console.log(src.imgUrl);
        $('#cardimg').html(` <img src="` + src.imgUrl + `" class="card-img-top" alt="foto profil" id="qrcode" style="height:250px; width:250px;"><br><br>
            <ul>
            <li> Nama : ${src.name}</li>
            <li> Nomor Wa : ${nomor}</li>
            <li> Phone : ${src.phone.device_model}</li>
            <li> WA Versi : ${src.phone.wa_version}</li>
            </ul>
            
            `);
        //  $('#cardimg').html(`<h2 class="text-center text-success mt-4">Whatsapp Connected.<br>` + src + `<h2>`);

    });

    socket.on('profile', function(y) {
        json.parse()
    })

    socket.on('close', function(src) {
        $('#cardimg').html(`<h2 class="text-center text-danger mt-4">` + src + `<h2>`);
    })
    $('#logout').click(function() {
        $('#cardimg').html(`<h2 class="text-center text-dark mt-4">Please wait..<h2>`);
        $('.log').html(`<li>Connecting..</li>`);
        socket.emit('logout', 'delete');
    })

    $('#scanqrr').click(function() {
        socket.emit('scanqr', 'scanqr');
    })
    $('#cekstatus').click(function() {
        socket.emit('cekstatus', 'cekstatus');
    })

    socket.on('isdelete', function(msg) {
        $('#cardimg').html(msg);
    })
</script>

</body>
</html>
