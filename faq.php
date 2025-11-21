<?php
require_once __DIR__ . '/app/bootstrap.php';
$pageTitle = 'Soalan Lazim — Cara membuat pesanan';
$siteTitle = 'Soalan Lazim';
$siteSubtitle = 'Cara membuat pesanan dan soalan lazim.';
include __DIR__ . '/views/header.php';
?>
  <main class="admin-card" style="margin-top:18px">
    <h2>Soalan Lazim</h2>
    <p class="muted">Tekan soalan untuk melihat jawapan. Jika anda masih mempunyai pertanyaan, hubungi melalui WhatsApp.</p>

    <div class="faq-list" style="margin-top:18px">
      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Bagaimana saya membuat pesanan?</button>
        <div class="faq-a" hidden>
          <p>Buka butiran produk dan pilih pakej serta perisa (jika tersedia). Klik "Pesan melalui WhatsApp" untuk menghantar pesanan anda beserta butiran kepada kami</p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Bolehkah saya menukar ketersediaan?</button>
        <div class="faq-a" hidden>
          <p>Boleh — penjual boleh togol item menggunakan pautan kongsi admin. Pautan ini boleh dihantar melalui WhatsApp/Telegram untuk mengaktifkan/nyahaktifkan produk dengan cepat untuk hari tersebut.</p>
        </div>
      </div>

      <div class="faq-item">
        <button class="faq-q" aria-expanded="false">Pembayaran & pengambilan</button>
        <div class="faq-a" hidden>
          <p>Pilihan pembayaran bergantung pada penjual: tunai ketika pengambilan, pindahan bank, atau gerbang pembayaran (akan datang). Tanyakan melalui WhatsApp untuk kaedah pembayaran yang tersedia.</p>
        </div>
      </div>
    </div>

    <style>
    .faq-list { display:block; gap:12px; }
    .faq-item { margin-bottom:12px; }
    .faq-q {
      display:block;
      width:100%;
      text-align:left;
      padding:12px 16px;
      background:var(--card);
      border:1px solid var(--border);
      border-radius:8px;
      font-weight:700;
      cursor:pointer;
    }
    .faq-q:focus { outline:3px solid rgba(66,153,225,0.25); }
    .faq-a { padding:12px 16px; border-left:4px solid var(--accent-2); background:linear-gradient(180deg, rgba(0,0,0,0.02), transparent); margin-top:6px; border-radius:6px; }
    </style>

    <script>
    (function(){
      var items = document.querySelectorAll('.faq-item');
      items.forEach(function(it){
        var btn = it.querySelector('.faq-q');
        var panel = it.querySelector('.faq-a');
        if(!btn || !panel) return;
        btn.addEventListener('click', function(){
          var expanded = btn.getAttribute('aria-expanded') === 'true';
          btn.setAttribute('aria-expanded', expanded ? 'false' : 'true');
          if (expanded) { panel.hidden = true; } else { panel.hidden = false; }
        });
      });
    })();
    </script>
  </main>

<?php include __DIR__ . '/views/footer.php'; ?>

