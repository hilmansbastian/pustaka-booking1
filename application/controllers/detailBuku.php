<?php
if ($buku->stok < 1) {
    echo "<i class='btn btn-outlineprimary fas fw fa-shopping-cart'> Booking&nbsp;&nbsp 0</i>";
} else {
    echo "<a class='btn btn-outlineprimary fas fw fa-shoppingcart' href='" . base_url('booking/tambahBooking/' . $buku->id) . "'> Booking</a>";
}
?>

<a class="btn btn-outlinewarning fas fw fa-search" href="<?= base_url('home/detailBuku/' . $buku->id); ?>"> Detail</a></p>