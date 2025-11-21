<?php
require_once __DIR__ . '/app/bootstrap.php';
$pageTitle = 'Tentang Kami';
$siteTitle = 'Tentang Kami';
$siteSubtitle = 'Pembuat roti kecil yang menghasilkan roti & biskut segar setiap hari.';
include __DIR__ . '/views/header.php';
?>

  <main class="about-section">
    <div class="about-grid">
      <div class="about-image">
        <img src="<?= url('assets/logo.svg') ?>" alt="<?= e($siteTitle) ?>">
      </div>
      <div class="about-info">
        <div class="about-card">
          <h2>Tentang Lyd Batter & Dough</h2>
          <p class="about-desc">Kami membakar segar setiap hari menggunakan bahan berkualiti tinggi. Stok dan item tersedia berubah setiap hari — semak laman atau hubungi kami melalui WhatsApp untuk pilihan hari ini. Kami berdedikasi untuk menghasilkan pastri dan roti yang kaya rasa, dibuat dengan resipi yang teliti dan sentuhan kasih sayang.</p>
          <h3>Hubungi</h3>
          <p class="muted about-contact">Pesanan melalui WhatsApp. Klik butang Whatsapp untuk sebarang pertanyan</p>
          <a href="https://wa.me/60169896368/" target="_blank" class="btn btn-whatsapp">WhatsApp</a>
        </div>
      </div>
    </div>
  </main>

<?php include __DIR__ . '/views/footer.php'; ?>

