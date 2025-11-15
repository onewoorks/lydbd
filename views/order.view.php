<main class="admin-card" style="margin-top:18px">
  <h2>Your cart</h2>
  <div id="cartTable">
    <!-- cart rows inserted by JS -->
  </div>
  <div style="margin-top:12px;display:flex;gap:8px">
    <button id="confirmBtn" class="btn">Confirm and send via WhatsApp</button>
    <button id="clearBtn" class="btn secondary">Clear cart</button>
  </div>
</main>

<script>
// initialize order page when LydiaCart is available
(function(){
  function escapeHtml(s){ return String(s||'').replace(/[&<>"']/g,function(c){return{'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;','\'' :'&#39;'}[c];}); }

  function init(){
    if (!window.LydiaCart) return setTimeout(init, 80);

    function render(){
      var cart = window.LydiaCart.loadCart() || [];
      var el = document.getElementById('cartTable');
      if (!el) return;
      if (!cart.length) { el.innerHTML = '<p>Your cart is empty.</p>'; return; }
      var html = '<table style="width:100%;border-collapse:collapse"><thead><tr><th>Item</th><th>Details</th><th>Qty</th><th>Price</th><th></th></tr></thead><tbody>';
      cart.forEach(function(it, idx){
        html += '<tr><td>'+escapeHtml(it.name)+'</td><td>'+escapeHtml((it.packageLabel||'') + (it.flavour?(' / '+it.flavour):''))+'</td><td><input type="number" min="1" data-idx="'+idx+'" class="qty" value="'+(it.qty||1)+'" style="width:70px"></td><td>$'+(Number(it.price*it.qty).toFixed(2))+'</td><td><button data-remove="'+idx+'" class="btn secondary">Remove</button></td></tr>';
      });
      html += '</tbody></table>';
      el.innerHTML = html;

      document.querySelectorAll('button[data-remove]').forEach(function(b){ b.addEventListener('click', function(){ var i = Number(b.getAttribute('data-remove')); window.LydiaCart.removeFromCart(i); render(); }); });
      document.querySelectorAll('input.qty').forEach(function(inp){ inp.addEventListener('change', function(){ var i = Number(inp.getAttribute('data-idx')); var cart = window.LydiaCart.loadCart(); cart[i].qty = Number(inp.value) || 1; window.LydiaCart.saveCart(cart); render(); }); });
    }

    document.getElementById('clearBtn').addEventListener('click', function(){ window.LydiaCart.clearCart(); render(); });
    document.getElementById('confirmBtn').addEventListener('click', function(){
      var msg = window.LydiaCart.buildWhatsAppMessage();
      if (!msg) { alert('Your cart is empty'); return; }
      if (!confirm('Send this order via WhatsApp?\n\n'+msg.replace(/\n/g,'\n'))) return;
      var wa = 'https://wa.me/?text=' + encodeURIComponent(msg);
      // clear cart and send
      window.LydiaCart.clearCart();
      window.location.href = wa;
    });

    // initial render
    render();
  }

  // start init after DOM is ready
  if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init); else init();
})();
</script>

