    <main class="admin-card" style="margin-top:18px">
      <h2>Troli Anda</h2>
      <div id="cartTable">
        <!-- cart rows inserted by JS -->
      </div>
      <div style="margin-top:12px;display:flex;gap:8px">
        <button id="confirmBtn" class="btn">Sahkan dan hantar melalui WhatsApp</button>
        <button id="clearBtn" class="btn secondary">Kosongkan troli</button>
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
          if (!cart.length) { el.innerHTML = '<p>Troli anda kosong.</p>'; return; }
          var html = '<table style="width:100%;border-collapse:collapse"><thead><tr><th>Produk</th><th>Butiran</th><th>Kuantiti</th><th>Harga</th><th></th></tr></thead><tbody>';
          cart.forEach(function(it, idx){
            var details = (it.packageLabel||'') + (it.flavour?(' / '+it.flavour):'') + (it.extras?(' + '+it.extras):'');
            html += '<tr><td>'+escapeHtml(it.name)+'</td><td>'+escapeHtml(details)+'</td><td><input type="number" min="1" data-idx="'+idx+'" class="qty" value="'+(it.qty||1)+'" style="width:70px"></td><td>RM'+(Number(it.price*it.qty).toFixed(2))+'</td><td><button data-remove="'+idx+'" class="btn secondary">Buang</button></td></tr>';
          });
          html += '</tbody></table>';
          el.innerHTML = html;

          document.querySelectorAll('button[data-remove]').forEach(function(b){ b.addEventListener('click', function(){ var i = Number(b.getAttribute('data-remove')); window.LydiaCart.removeFromCart(i); render(); }); });
          document.querySelectorAll('input.qty').forEach(function(inp){ inp.addEventListener('change', function(){ var i = Number(inp.getAttribute('data-idx')); var cart = window.LydiaCart.loadCart(); cart[i].qty = Number(inp.value) || 1; window.LydiaCart.saveCart(cart); render(); }); });
        }

        document.getElementById('clearBtn').addEventListener('click', function(){ window.LydiaCart.clearCart(); render(); });
        document.getElementById('confirmBtn').addEventListener('click', function(){
          var msg = window.LydiaCart.buildWhatsAppMessage();
          if (!msg) { 
            Swal.fire({
              icon: 'warning',
              title: 'Troli Kosong',
              text: 'Troli anda kosong',
              confirmButtonColor: '#6B4423'
            });
            return; 
          }
          
          // Ask for customer name first
          Swal.fire({
            title: 'Nama Pemesan',
            input: 'text',
            inputPlaceholder: 'Masukkan nama anda',
            inputAttributes: {
              autocapitalize: 'words',
              autocomplete: 'name'
            },
            showCancelButton: true,
            confirmButtonText: 'Seterusnya',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#6B4423',
            cancelButtonColor: '#999',
            inputValidator: (value) => {
              if (!value) {
                return 'Sila masukkan nama anda'
              }
            }
          }).then(function(result){
            if (result.isConfirmed && result.value) {
              var customerName = result.value.trim();
              var finalMsg = 'Nama: ' + customerName + '\n\n' + msg;
              
              // Show order confirmation with name
              Swal.fire({
                title: 'Sahkan Pesanan',
                html: '<div style="text-align:left;font-size:0.85rem;max-height:400px;overflow-y:auto;padding:10px;background:#f8f8f8;border-radius:8px;white-space:pre-wrap;word-break:break-word">' + finalMsg.replace(/</g, '&lt;').replace(/>/g, '&gt;') + '</div>',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Hantar via WhatsApp',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#6B4423',
                cancelButtonColor: '#999',
                width: '600px',
                backdrop: 'rgba(0,0,0,0.6)'
              }).then(function(confirmResult){
                if (confirmResult.isConfirmed) {
                  var wa = 'https://wa.me/60169896368?text=' + encodeURIComponent(finalMsg);
                  window.LydiaCart.clearCart();
                  window.location.href = wa;
                }
              });
            }
          });
        });

        // initial render
        render();
      }

      // start init after DOM is ready
      if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', init); else init();
    })();
    </script>