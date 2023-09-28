<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/struk.css')}}">
    <title>Receipt example</title>
</head>

<body>
    <!-- <div class="page"> -->
    <div class="ticket">
        <!-- <img src="./logo.png" alt="Logo" class="centered"> -->
        <p class="centered">Dapur Rempong Resto
            <br>Dusun IV Kota Raman
            <br>Raman Utara Lampung Timur

        </p>
        <table>
            <thead>
                <tr>
                    <th class="quantity">Menu</th>
                    <th class="description">Jumlah</th>
                    <th class="price">Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksi_pembelians as $tr_pembelian)
                @php
                $hasil_rupiah = number_format($tr_pembelian->foodmenu->harga,0,',','.');
                $hasil_tambah = number_format($tr_pembelian->totalharga,0,',','.');
                @endphp
                <tr>
                    <td class="quantity" style="width: 45%">{{$tr_pembelian->foodmenu->food_name}}<br>${{$hasil_rupiah}}</td>
                    <td class="description" style="text-align: center;" style="width: 3%">{{$tr_pembelian->jumlah_pesanan}}</td>
                    <td class="price" style="width: 40%">{{$hasil_tambah}}</td>
                </tr>
                @endforeach
                @php
                $total = number_format($total_bayar,0,',','.');
                $tunai = number_format($transaksi->jumlah_bayar,0,',','.');
                @endphp
                <tr>

                    <td colspan="3" class="price" style="text-align: center;">Total : &nbsp;&nbsp;&nbsp;&nbsp;Rp.{{$total}}</td>
                </tr>

                <tr>

                    <td colspan="3" class="price" style="text-align: center;">Tunai : &nbsp;&nbsp;&nbsp;&nbsp;Rp.{{$tunai}}</td>
                </tr>
                @php
                $kembali = $transaksi->jumlah_bayar - $total_bayar;
                $hasil = number_format($kembali,0,',','.');
                @endphp
                <tr>

                    <td colspan="3" class="price" style="text-align: center;">Kembali : &nbsp;&nbsp;&nbsp;&nbsp;Rp.{{$hasil}}</td>
                </tr>

            </tbody>
        </table>
        <p class="centered">
            Thanks You
            <br>Menerima Pesanan dan Catering
            <br>Wa . 082281231615
        </p>
    </div>
    <!-- </div> -->
    <button id="btnPrint" class="hidden-print">Print</button>
    <script src="script.js"></script>
</body>
<script>
    window.print();
</script>

</html>