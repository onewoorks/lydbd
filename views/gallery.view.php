<?php
$pageTitle = 'Galeri';
$siteTitle = 'Galeri';
$siteSubtitle = '';
include __DIR__ . '/header.php';
?>

<style>
.photo-gallery {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
  gap: 16px;
  margin: 20px 0;
}
.gallery-item {
  position: relative;
  overflow: hidden;
  border-radius: 8px;
  aspect-ratio: 1 / 1;
  border: 1px solid var(--border);
}
.gallery-photo {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.gallery-item:hover .gallery-photo {
  opacity: 0.9;
}

@media (max-width: 768px) {
  .photo-gallery {
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
  }
}
</style>

<div class="photo-gallery">
  <div class="gallery-item">
    <img src="<?= url('assets/placeholder.svg') ?>" alt="Roti Artisan" class="gallery-photo">
  </div>
  <div class="gallery-item">
    <img src="<?= url('assets/placeholder.svg') ?>" alt="Biskut" class="gallery-photo">
  </div>
  <div class="gallery-item">
    <img src="<?= url('assets/placeholder.svg') ?>" alt="Kroisan" class="gallery-photo">
  </div>
  <div class="gallery-item">
    <img src="<?= url('assets/placeholder.svg') ?>" alt="Kek" class="gallery-photo">
  </div>
  <div class="gallery-item">
    <img src="<?= url('assets/placeholder.svg') ?>" alt="Baguette" class="gallery-photo">
  </div>
  <div class="gallery-item">
    <img src="<?= url('assets/placeholder.svg') ?>" alt="Pastri" class="gallery-photo">
  </div>
  <div class="gallery-item">
    <img src="<?= url('assets/placeholder.svg') ?>" alt="Pastri Artisan" class="gallery-photo">
  </div>
  <div class="gallery-item">
    <img src="<?= url('assets/placeholder.svg') ?>" alt="Acara" class="gallery-photo">
  </div>
</div>

<style>
.gallery-hero {
  background: linear-gradient(135deg, rgba(239,108,74,0.12), rgba(45,143,111,0.12));
  padding: 40px 24px;
  border-radius: var(--radius);
  text-align: center;
  margin-bottom: 40px;
  border: 1px solid var(--border);
}
.gallery-hero h2 {
  margin: 0 0 12px 0;
  font-size: 2.2rem;
  color: var(--accent-2);
}
.gallery-hero p {
  margin: 0;
  font-size: 1.1rem;
  color: var(--muted);
  max-width: 700px;
  margin: 0 auto;
  line-height: 1.6;
}

/* Photo Gallery Grid */
.photo-gallery {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 20px;
  margin-bottom: 40px;
}
.gallery-item {
  position: relative;
  overflow: hidden;
  border-radius: 14px;
  aspect-ratio: 1 / 1;
  cursor: pointer;
  box-shadow: 0 6px 16px rgba(16,24,40,0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border: 1px solid var(--border);
}
.gallery-item:hover {
  transform: translateY(-6px);
  box-shadow: 0 12px 32px rgba(16,24,40,0.18);
}
.gallery-photo {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}
.gallery-item:hover .gallery-photo {
  transform: scale(1.1);
}
.gallery-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.3), transparent);
  padding: 20px;
  color: white;
  transform: translateY(100%);
  transition: transform 0.3s ease;
}
.gallery-item:hover .gallery-overlay {
  transform: translateY(0);
}
.gallery-overlay-title {
  font-weight: 700;
  font-size: 1.1rem;
  margin: 0 0 4px 0;
}
.gallery-overlay-desc {
  font-size: 0.9rem;
  margin: 0;
  opacity: 0.9;
}

/* Category Filter (optional) */
.gallery-filters {
  display: flex;
  justify-content: center;
  gap: 12px;
  margin-bottom: 32px;
  flex-wrap: wrap;
}
.filter-btn {
  padding: 10px 20px;
  border-radius: 8px;
  border: 1px solid var(--border);
  background: var(--card);
  color: var(--muted);
  cursor: pointer;
  font-weight: 600;
  transition: all 0.2s ease;
}
.filter-btn:hover, .filter-btn.active {
  background: var(--accent-2);
  color: white;
  border-color: var(--accent-2);
}

.gallery-cta {
  text-align: center;
  margin-top: 48px;
  padding: 32px;
  background: linear-gradient(135deg, rgba(239,108,74,0.08), rgba(45,143,111,0.08));
  border-radius: var(--radius);
  border: 1px solid var(--border);
}
.gallery-cta h3 {
  margin: 0 0 12px 0;
  color: var(--accent-2);
  font-size: 1.6rem;
}
.gallery-cta p {
  margin: 0 0 20px 0;
  color: var(--muted);
  font-size: 1.05rem;
}

@media (max-width: 768px) {
  .photo-gallery {
    grid-template-columns: repeat(2, 1fr);
    gap: 14px;
  }
  .gallery-hero h2 {
    font-size: 1.7rem;
  }
  .gallery-hero p {
    font-size: 1rem;
  }
}
@media (max-width: 480px) {
  .photo-gallery {
    grid-template-columns: 1fr;
    gap: 16px;
  }
}
</style>


<script>
// Simple category filter
(function(){
  const filters = document.querySelectorAll('.filter-btn');
  const items = document.querySelectorAll('.gallery-item');
  
  filters.forEach(btn => {
    btn.addEventListener('click', function(){
      // Update active state
      filters.forEach(f => f.classList.remove('active'));
      this.classList.add('active');
      
      const filter = this.dataset.filter;
      
      // Filter items
      items.forEach(item => {
        if(filter === 'all' || item.dataset.category === filter){
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });
})();
</script>

<div class="gallery-cta">
  <h3>Suka Apa Yang Anda Lihat?</h3>
  <p>Pesan barangan bakeri segar hari ini atau hubungi kami untuk pesanan khas</p>
  <a href="<?= url('/') ?>" class="btn">Layari Pastri Artisan Hari Ini</a>
  <a href="<?= url('/menu') ?>" class="btn secondary" style="margin-left:10px">Lihat Menu Penuh</a>
</div>

<?php include __DIR__ . '/footer.php'; ?>
