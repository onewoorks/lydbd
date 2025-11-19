<?php
$pageTitle = 'Our Menu';
$siteTitle = 'Our Menu';
$siteSubtitle = 'All items we bake - fresh daily, made with love';
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
  <h2>🥖 Our Baked Goods</h2>
  <p>Everything we make is baked fresh daily with premium ingredients and lots of love</p>
</div>

<div class="menu-categories">
  <!-- Breads Category -->
  <section class="menu-category">
    <h3>🍞 Artisan Breads</h3>
    <p class="category-desc">Freshly baked breads with crispy crust and soft interior</p>
    <div class="menu-items">
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Sourdough" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Classic Sourdough</h4>
          <p>Tangy, chewy artisan bread with a crispy golden crust</p>
          <div class="menu-item-price">$8.50</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Baguette" class="menu-item-image">
        <div class="menu-item-content">
          <h4>French Baguette</h4>
          <p>Traditional French bread, crispy outside and fluffy inside</p>
          <div class="menu-item-price">$5.00</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Multigrain" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Multigrain Loaf</h4>
          <p>Hearty whole grain bread packed with seeds and nutrients</p>
          <div class="menu-item-price">$7.50</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Cookies Category -->
  <section class="menu-category">
    <h3>🍪 Cookies & Treats</h3>
    <p class="category-desc">Sweet, chewy, and irresistible homemade cookies</p>
    <div class="menu-items">
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Chocolate Chip" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Chocolate Chip Cookies</h4>
          <p>Classic cookies loaded with premium chocolate chips</p>
          <div class="menu-item-price">$12.00 / dozen</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Oatmeal Raisin" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Oatmeal Raisin</h4>
          <p>Chewy oatmeal cookies with plump raisins</p>
          <div class="menu-item-price">$11.00 / dozen</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Double Chocolate" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Double Chocolate</h4>
          <p>Rich chocolate cookies with white and dark chocolate chunks</p>
          <div class="menu-item-price">$13.00 / dozen</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Pastries Category -->
  <section class="menu-category">
    <h3>🥐 Pastries & Croissants</h3>
    <p class="category-desc">Buttery, flaky pastries perfect for breakfast or snack</p>
    <div class="menu-items">
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Butter Croissant" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Butter Croissant</h4>
          <p>Classic French pastry with delicate layers</p>
          <div class="menu-item-price">$4.50</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Pain au Chocolat" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Pain au Chocolat</h4>
          <p>Flaky croissant filled with dark chocolate</p>
          <div class="menu-item-price">$5.00</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Almond Croissant" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Almond Croissant</h4>
          <p>Croissant filled with sweet almond cream</p>
          <div class="menu-item-price">$5.50</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Cakes Category -->
  <section class="menu-category">
    <h3>🎂 Cakes & Desserts</h3>
    <p class="category-desc">Decadent cakes and desserts for special occasions</p>
    <div class="menu-items">
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Chocolate Cake" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Chocolate Layer Cake</h4>
          <p>Rich chocolate cake with silky chocolate ganache</p>
          <div class="menu-item-price">$35.00</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Vanilla Cake" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Classic Vanilla Cake</h4>
          <p>Moist vanilla cake with buttercream frosting</p>
          <div class="menu-item-price">$32.00</div>
        </div>
      </div>
      <div class="menu-item">
        <img src="<?= url('assets/placeholder.svg') ?>" alt="Carrot Cake" class="menu-item-image">
        <div class="menu-item-content">
          <h4>Carrot Cake</h4>
          <p>Spiced carrot cake with cream cheese frosting</p>
          <div class="menu-item-price">$33.00</div>
        </div>
      </div>
    </div>
  </section>
</div>

<div class="menu-cta">
  <h3>Ready to Order?</h3>
  <p>Check our homepage for today's available items or contact us for custom orders</p>
  <a href="<?= url('/') ?>" class="btn">View Today's Fresh Bakes</a>
  <a href="<?= url('/order') ?>" class="btn secondary" style="margin-left:10px">Go to Cart</a>
</div>

<?php include __DIR__ . '/footer.php'; ?>
