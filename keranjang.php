<?php
session_start();

// echo "<pre>";
// print_r($_SESSION['keranjang']);
// echo "</pre>";

$conn = new mysqli("localhost","root","","omlet_db");

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
    echo "<script>location='katalog.php';</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/omlet.png" type="">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="keranjang.css">
    <title>Keranjang</title>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <link rel="stylesheet" href="http://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"
        integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="image/omlet.png" type="">
    <link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>


</head>

<body>

    <div>
        <nav>
            <input type="checkbox" id="check">
            <label for="check" class="checkbtn">
                <i class="fas fa-bars"></i>
            </label>
            <label class="logo">Omlet</label>
            <ul>
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="katalog.php">Katalog</a></li>
                <li><a href="katalog.php">About</a></li>
                <li><a href="keranjang.php" class="btn btn-success position-relative rounded-circle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-shopping-bag">
                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z">
                            </path>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                        </svg>
                    </a>
                </li>
                <li><a href="logout.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </a></li>
            </ul>
        </nav>
    </div>


    <section class="konten">
        <div class="container">
            <h1>Keranjang Belanja</h1>
            <hr>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        <th>harga</th>
                        <th>Jumlah</th>
                        <th>Subharga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $nomor=1; ?>
                    <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah): ?>

                    <?php
                    $ambil = $conn->query(" SELECT * FROM produk
                        WHERE id_produk=' $id_produk'");
                    $pecah = $ambil->fetch_assoc();
                    $subharga = $pecah["harga_produk"]*$jumlah;
                    ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $pecah["nama_produk"]; ?></td>
                            <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
                            <td><?php echo $jumlah; ?></td>
                            <td>Rp. <?php echo number_format($subharga); ?></td>
                            <td>
                                <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs" >Hapus</a>
                            </td>
                        </tr>
                    <?php $nomor++; ?>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </section>
    


    <!-- cart items detail
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quality</th>
                <th>Subtotal</th>
            </tr>
            <tr>
                <td>
                    <div class="cart-info">
                        <img src="image/ks1.png">
                        <div>
                            <p>Kaos Polos</p>
                            <small>Prince: $100.00</small>
                            <a class="Remove" href="">Remove</a>
                        </div>
                    </div>
                </td>
                <td><input type="number" value="1"></td>
                <td>$100.00</td>
            </tr>
        </table>
    </div> -->

    <!-- cart items detail -->

    <!-- <br> -->
    <!-- <br> -->
    <!-- <div class="row"> -->
    <!-- <div class="col"> -->
    <!-- <h1>Keranjang Belanja</h1> -->
    <!-- </div> -->
    <!-- </div> -->
    <!-- <div class="row"> -->
    <!-- <div class="col-12"> -->
    <!-- <div class="table-responsive"> -->
    <!-- <table class="table"> -->
    <!-- <tr> -->
    <!-- <th>Foto</th> -->
    <!-- <th>Nama Produk</th> -->
    <!-- <th>Harga Satuan</th> -->
    <!-- <th>Kuantitas</th> -->
    <!-- <th>Total Harga</th> -->
    <!-- <th>Hapus</th> -->
    <!-- </tr> -->
    <!-- <tr> -->
    <!-- <td> -->
    <!-- <img src="image/ks1.png" class="img-cart-keranjang"> -->
    <!-- </td> -->
    <!-- <td> -->
    <!-- Kaos Polos -->
    <!-- </td> -->
    <!-- <td> -->
    <!-- IDR 25.000 -->
    <!-- </td> -->
    <!-- <td> -->
    <!-- <input type="number" class="form-control input-kuantitas"> -->
    <!-- </td> -->
    <!-- <td> -->
    <!-- IDR 50.000 -->
    <!-- </td> -->
    <!-- <td> -->
    <!-- <a href="#" class="btn btn-danger rounded-circle btn-tambah"> -->
    <!-- <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/sv -->
    <!-- <g clip-path=" url(#clip0_54_458)"> -->
    <!-- <path d="M1.125 16.3123C1.125 16.7599 1.30279 17.1891 1.61926 17.5056C1.93572 17.822 2.36495 -->
    <!-- 17.9998H12.9375C13.3851 17.9998 13.8143 17.822 14.1307 17.5056C14.4472 17.1891 14.625 16.7599 14.625 16.3123V4 -->
    <!-- 7.31232C10.6875 7.16314 10.7468 7.02006 10.8523 6.91458C10.9577 6.80909 11.1008 6.74982 11.25 6.74982C11.3992  -->
    <!-- 6.91458C11.7532 7.02006 11.8125 7.16314 11.8125 7.31232V15.1873C11.8125 15.3365 11.7532 15.4796 11.6477 15.585 -->
    <!-- 11.25  -->
    <!-- 15.7498C11.1008 15.7498 10.9577 15.6906 10.8523 15.5851C10.7468 15.4796 10.6875 15.3365 10.6875 15.1873V7.3123 -->
    <!-- 7.37176  -->
    <!-- 7.02006 7.47725 6.91458C7.58274 6.80909 7.72582 6.74982 7.875 6.74982C8.02418 6.74982 8.16726 6.80909 8.27275  -->
    <!-- 7.16314  -->
    <!-- 8.4375 7.31232V15.1873C8.4375 15.3365 8.37824 15.4796 8.27275 15.5851C8.16726 15.6906 8.02418 15.7498 7.875 15 -->
    <!-- 15.6906  -->
    <!-- 7.47725 15.5851C7.37176 15.4796 7.3125 15.3365 7.3125 15.1873V7.31232ZM3.9375 7.31232C3.9375 7.16314 3.99676 7 -->
    <!-- 6.80909  -->
    <!-- 4.35082 6.74982 4.5 6.74982C4.64918 6.74982 4.79226 6.80909 4.89775 6.91458C5.00324 7.02006 5.0625 7.16314 5.0 -->
    <!-- 5.00324 15.4796 4.89775 15.5851C4.79226 15.6906 4.64918 15.7498 4.5 15.7498C4.35082 15.7498 4.20774 15.6906 4. -->
    <!-- 15.3365 3.9375 15.1873V7.31232ZM15.1875 1.12482H10.9688L10.6383 0.467401C10.5683 0.326851 10.4604 0.208624 10. -->
    <!-- 10.0394  -->
    <!-- -0.000289557 9.88242 -0.000176942H5.86406C5.7074 -0.000779187 5.55373 0.0427622 5.42067 0.125459C5.28761 0.208 -->
    <!-- 0.467401L4.78125 1.12482H0.5625C0.413316 1.12482 0.270242 1.18409 0.164752 1.28958C0.0592632 1.39506 0 1.53814 -->
    <!-- 0.0592632 3.10458 0.164752 3.21007C0.270242 3.31556 0.413316 3.37482 0.5625 3.37482H15.1875C15.3367 3.37482 15 -->
    <!-- 3.21007C15.6907  -->
    <!-- 3.10458 15.75 2.96151 15.75 2.81232V1.68732C15.75 1.53814 15.6907 1.39506 15.5852 1.28958C15.4798 1.18409 15.3 -->
    <!-- fill=" white" /> -->
    <!-- </g> -->
    <!-- <defs> -->
    <!-- <clipPath id="clip0_54_458"> -->
    <!-- <rect width="15.75" height="18" fill="white" /> -->
    <!-- </clipPath> -->
    <!-- </defs> -->
    <!-- </svg> -->
    <!--  -->
    <!-- </a> -->
    <!-- </td> -->
    <!-- </tr> -->
    <!-- <tr> -->
    <!-- <td> -->
    <!-- <img src="image/ks1.png" class="img-cart-keranjang"> -->
    <!-- </td> -->
    <!-- <td> -->
    <!-- Kaos Polos -->
    <!-- </td> -->
    <!-- <td> -->
    <!-- IDR 25.000 -->
    <!-- </td> -->
    <!-- <td> -->
    <!-- <input type="number" class="form-control input-kuantitas"> -->
    <!-- </td> -->
    <!-- <td> -->
    <!-- IDR 50.000 -->
    <!-- </td> -->
    <!-- <td> -->
    <!-- <a href="#" class="btn btn-danger rounded-circle btn-tambah"> -->
    <!-- <svg width="16" height="18" viewBox="0 0 16 18" fill="none" xmlns="http://www.w3.org/2000/sv -->
    <!-- <g clip-path=" url(#clip0_54_458)"> -->
    <!-- <path d="M1.125 16.3123C1.125 16.7599 1.30279 17.1891 1.61926 17.5056C1.93572 17.822 2.36495 -->
    <!-- 17.9998H12.9375C13.3851 17.9998 13.8143 17.822 14.1307 17.5056C14.4472 17.1891 14.625 16.7599 14.625 16.3123V4 -->
    <!-- 7.31232C10.6875 7.16314 10.7468 7.02006 10.8523 6.91458C10.9577 6.80909 11.1008 6.74982 11.25 6.74982C11.3992  -->
    <!-- 6.91458C11.7532 7.02006 11.8125 7.16314 11.8125 7.31232V15.1873C11.8125 15.3365 11.7532 15.4796 11.6477 15.585 -->
    <!-- 11.25  -->
    <!-- 15.7498C11.1008 15.7498 10.9577 15.6906 10.8523 15.5851C10.7468 15.4796 10.6875 15.3365 10.6875 15.1873V7.3123 -->
    <!-- 7.37176  -->
    <!-- 7.02006 7.47725 6.91458C7.58274 6.80909 7.72582 6.74982 7.875 6.74982C8.02418 6.74982 8.16726 6.80909 8.27275  -->
    <!-- 7.16314  -->
    <!-- 8.4375 7.31232V15.1873C8.4375 15.3365 8.37824 15.4796 8.27275 15.5851C8.16726 15.6906 8.02418 15.7498 7.875 15 -->
    <!-- 15.6906  -->
    <!-- 7.47725 15.5851C7.37176 15.4796 7.3125 15.3365 7.3125 15.1873V7.31232ZM3.9375 7.31232C3.9375 7.16314 3.99676 7 -->
    <!-- 6.80909  -->
    <!-- 4.35082 6.74982 4.5 6.74982C4.64918 6.74982 4.79226 6.80909 4.89775 6.91458C5.00324 7.02006 5.0625 7.16314 5.0 -->
    <!-- 5.00324 15.4796 4.89775 15.5851C4.79226 15.6906 4.64918 15.7498 4.5 15.7498C4.35082 15.7498 4.20774 15.6906 4. -->
    <!-- 15.3365 3.9375 15.1873V7.31232ZM15.1875 1.12482H10.9688L10.6383 0.467401C10.5683 0.326851 10.4604 0.208624 10. -->
    <!-- 10.0394  -->
    <!-- -0.000289557 9.88242 -0.000176942H5.86406C5.7074 -0.000779187 5.55373 0.0427622 5.42067 0.125459C5.28761 0.208 -->
    <!-- 0.467401L4.78125 1.12482H0.5625C0.413316 1.12482 0.270242 1.18409 0.164752 1.28958C0.0592632 1.39506 0 1.53814 -->
    <!-- 0.0592632 3.10458 0.164752 3.21007C0.270242 3.31556 0.413316 3.37482 0.5625 3.37482H15.1875C15.3367 3.37482 15 -->
    <!-- 3.21007C15.6907  -->
    <!-- 3.10458 15.75 2.96151 15.75 2.81232V1.68732C15.75 1.53814 15.6907 1.39506 15.5852 1.28958C15.4798 1.18409 15.3 -->
    <!-- fill=" white" /> -->
    <!-- </g> -->
    <!-- <defs> -->
    <!-- <clipPath id="clip0_54_458"> -->
    <!-- <rect width="15.75" height="18" fill="white" /> -->
    <!-- </clipPath> -->
    <!-- </defs> -->
    <!-- </svg> -->
    <!--  -->
    <!-- </a> -->
    <!-- </td> -->
    <!--  -->
    <!--  -->
    <!--  -->
    <!-- </table> -->
    <!-- </div> -->
    <!-- </div> -->
    <!-- </div> -->



</body>

</html>