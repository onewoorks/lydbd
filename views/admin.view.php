<?php
$pageTitle = 'Admin — Toggle availability';
$siteTitle = 'Admin';
$siteSubtitle = 'Share toggle links via WhatsApp/Telegram to update availability quickly.';
include __DIR__ . '/header.php';
?>

    <main class="admin-card">
      <table>
        <thead>
          <tr><th>Product</th><th>Available</th><th style="width:420px">Actions / Share link</th></tr>
        </thead>
        <tbody>
        <?php foreach ($products as $idx => $p): ?>
          <tr>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= !empty($p['available']) ? 'Yes' : 'No' ?></td>
            <td>
              <?php $togglePath = 'toggle/' . rawurlencode($p['id']) . '?token=' . rawurlencode(SECRET_TOKEN); ?>
              <a class="btn" href="<?= url($togglePath) ?>">Toggle</a>
              <button class="copy-btn" data-copy-target="#share-<?= $idx ?>">Copy</button>
              <button class="copy-btn" data-share-url="<?= e(url($togglePath)) ?>">Share</button>
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
