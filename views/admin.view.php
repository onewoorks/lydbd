<?php
$pageTitle = 'Admin — Togol ketersediaan';
$siteTitle = 'Admin';
$siteSubtitle = 'Kongsi pautan togol melalui WhatsApp/Telegram untuk kemaskini ketersediaan dengan cepat.';
include __DIR__ . '/header.php';
?>

    <main class="admin-card">
      <table>
        <thead>
          <tr><th>Produk</th><th>Tersedia</th><th style="width:420px">Tindakan / Pautan kongsi</th></tr>
        </thead>
        <tbody>
        <?php foreach ($products as $idx => $p): ?>
          <tr>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= !empty($p['available']) ? 'Ya' : 'Tidak' ?></td>
            <td>
              <?php $togglePath = 'toggle/' . rawurlencode($p['id']) . '?token=' . rawurlencode(SECRET_TOKEN); ?>
              <a class="btn" href="<?= url($togglePath) ?>">Togol</a>
              <button class="copy-btn" data-copy-target="#share-<?= $idx ?>">Salin</button>
              <button class="copy-btn" data-share-url="<?= e(url($togglePath)) ?>">Kongsi</button>
              <div style="margin-top:8px">
                <input id="share-<?= $idx ?>" class="share-url" readonly value="<?= e(url($togglePath)) ?>">
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </main>

<?php include __DIR__ . '/footer.php'; ?>
