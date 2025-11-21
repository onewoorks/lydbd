<?php
$pageTitle = 'Menu Kami';
$siteTitle = 'Menu Kami';
$siteSubtitle = 'Semua item yang kami bakar - segar setiap hari, dibuat dengan kasih';
include __DIR__ . '/header.php';
?>

<style>
.menu-hero {
  background: linear-gradient(135deg, rgba(239,108,74,0.12), rgba(45,143,111,0.12));
  padding: 32px 24px;
  border-radius: var(--radius);
  text-align: center;
  margin-bottom: 32px;
  border: 1px solid var(--border);
}
.menu-hero h2 {
  margin: 0 0 12px 0;
  font-size: 2rem;
  color: var(--accent-2);
}
.menu-hero p {
  margin: 0;
  font-size: 1.1rem;
  color: var(--muted);
  max-width: 600px;
  margin: 0 auto;
}
.menu-categories {
  display: grid;
  gap: 32px;
}
.menu-category {
  background: var(--card);
  padding: 24px;
  border-radius: var(--radius);
  border: 1px solid var(--border);
  box-shadow: 0 4px 12px rgba(16,24,40,0.04);
}
.menu-category h3 {
  margin: 0 0 8px 0;
  font-size: 1.5rem;
  color: var(--accent-2);
  display: flex;
  align-items: center;
  gap: 10px;
}
.menu-category p.category-desc {
  margin: 0 0 20px 0;
  color: var(--muted);
  font-size: 0.95rem;
}
.menu-items {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 16px;
}
.menu-item {
  display: flex;
  gap: 14px;
  padding: 14px;
  border-radius: 10px;
  border: 1px solid rgba(0,0,0,0.04);
  background: rgba(255,255,255,0.5);
  transition: all 0.2s ease;
}
.menu-item:hover {
  background: rgba(255,255,255,0.9);
  box-shadow: 0 4px 12px rgba(16,24,40,0.08);
  transform: translateY(-2px);
}
.menu-item-image {
  width: 80px;
  height: 80px;
  border-radius: 8px;
  object-fit: cover;
  flex-shrink: 0;
  border: 1px solid var(--border);
}
.menu-item-content {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 4px;
}
.menu-item-content h4 {
  margin: 0;
  font-size: 1.05rem;
  color: #111;
}
.menu-item-content p {
  margin: 0;
  font-size: 0.9rem;
  color: var(--muted);
  line-height: 1.4;
}
.menu-item-price {
  font-weight: 700;
  color: var(--accent-2);
  font-size: 1rem;
  margin-top: 4px;
}
.menu-cta {
  text-align: center;
  margin-top: 32px;
  padding: 24px;
  background: linear-gradient(135deg, rgba(239,108,74,0.08), rgba(45,143,111,0.08));
  border-radius: var(--radius);
  border: 1px solid var(--border);
}
.menu-cta h3 {
  margin: 0 0 12px 0;
  color: var(--accent-2);
}
.menu-cta p {
  margin: 0 0 16px 0;
  color: var(--muted);
}
@media (max-width: 640px) {
  .menu-items {
    grid-template-columns: 1fr;
  }
  .menu-hero h2 {
    font-size: 1.6rem;
  }
}
</style>

<div class="menu-hero">
  <h2>🥖 Barangan Bakeri Kami</h2>
  <p>Semua yang kami buat dibakar segar setiap hari dengan bahan berkualiti dan penuh kasih</p>
</div>

<div class="menu-categories">
  <!-- Breads Category -->
  <section class="menu-category">
    <h3>🍞 Roti Artisan</h3>
    <p class="category-desc">Roti segar yang dibakar dengan kerak rangup dan isi yang lembut</p>
    <div class="menu-items">
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Sourdough" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Sourdough Klasik</h4>
          <p>Roti artisan yang sedikit masam, kenyal dengan kerak keemasan yang rangup</p>
          <div class="menu-item-price">RM8.50</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Baguette" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Baguette Perancis</h4>
          <p>Roti tradisional Perancis, rangup di luar dan gebu di dalam</p>
          <div class="menu-item-price">RM5.00</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Multigrain" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Roti Multigrain</h4>
          <p>Roti bijirin penuh yang padat dengan biji dan khasiat</p>
          <div class="menu-item-price">RM7.50</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Cookies Category -->
  <section class="menu-category">
    <h3>🍪 Biskut & Pencuci Mulut</h3>
    <p class="category-desc">Biskut buatan sendiri yang manis, kenyal dan sukar ditolak</p>
    <div class="menu-items">
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Chocolate Chip" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Biskut Coklat Chip</h4>
          <p>Biskut klasik penuh dengan kepingan coklat premium</p>
          <div class="menu-item-price">RM12.00 / dozen</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Oatmeal Raisin" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Oatmeal & Kismis</h4>
          <p>Biskut oat yang kenyal dengan kismis yang penuh</p>
          <div class="menu-item-price">RM11.00 / dozen</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Double Chocolate" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Double Chocolate</h4>
          <p>Biskut coklat pekat dengan kepingan coklat putih dan gelap</p>
          <div class="menu-item-price">RM13.00 / dozen</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Pastries Category -->
  <section class="menu-category">
    <h3>🥐 Pastri & Kroisan</h3>
    <p class="category-desc">Pastri bermentega dan berlapis, sesuai untuk sarapan atau snek</p>
    <div class="menu-items">
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Butter Croissant" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Kroisan Mentega</h4>
          <p>Pastri Perancis klasik dengan lapisan halus</p>
          <div class="menu-item-price">RM4.50</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Pain au Chocolat" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Kroisan Coklat</h4>
          <p>Kroisan berlapis yang diisi coklat gelap</p>
          <div class="menu-item-price">RM5.00</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Almond Croissant" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Kroisan Badam</h4>
          <p>Kroisan diisi krim badam manis</p>
          <div class="menu-item-price">RM5.50</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Cakes Category -->
  <section class="menu-category">
    <h3>🎂 Kek & Pencuci Mulut</h3>
    <p class="category-desc">Kek dan pencuci mulut yang mewah untuk majlis khas</p>
    <div class="menu-items">
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Chocolate Cake" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Kek Coklat Berlapis</h4>
          <p>Kek coklat pekat dengan ganache coklat yang lembut</p>
          <div class="menu-item-price">RM35.00</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Vanilla Cake" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Kek Vanilla Klasik</h4>
          <p>Kek vanilla lembap dengan lapisan buttercream</p>
          <div class="menu-item-price">RM32.00</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Carrot Cake" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Kek Lobak</h4>
          <p>Kek lobak berempah dengan lapisan krim keju</p>
          <div class="menu-item-price">RM33.00</div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="menu-cta">
  <h3>Sedia untuk Memesan?</h3>
  <p>Semak halaman utama kami untuk item yang tersedia hari ini atau hubungi kami untuk pesanan khas</p>
  <a href="<?= url('/') ?>" class="btn">Lihat Pastri Artisan Hari Ini</a>
  <a href="<?= url('/order') ?>" class="btn secondary" style="margin-left:10px">Pergi ke Troli</a>
</div>

<?php include __DIR__ . '/footer.php'; ?>
