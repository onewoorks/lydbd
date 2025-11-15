// Simple client-side cart with events and toasts
(function(){
  function loadCart(){
    try{ return JSON.parse(localStorage.getItem('cart')||'[]'); }catch(e){ return []; }
  }
  function saveCart(cart){ localStorage.setItem('cart', JSON.stringify(cart)); }
  function addToCart(item){
    var cart = loadCart();
    item.qty = parseInt(item.qty||1);
    var found = cart.find(c=>c.id===item.id && c.package===item.package && c.flavour===item.flavour);
    if(found) found.qty = (parseInt(found.qty||0) + item.qty);
    else cart.push(item);
    saveCart(cart);
    dispatchCartChanged();
    showToast((item.name||'Item')+' — '+item.qty+' added');
    return cart;
  }
  function removeFromCart(index){
    var cart = loadCart(); cart.splice(index,1); saveCart(cart); dispatchCartChanged(); return cart;
  }
  function clearCart(){ localStorage.removeItem('cart'); dispatchCartChanged(); }
  function getTotalItems(){ var cart = loadCart(); return cart.reduce(function(s,i){ return s + (parseInt(i.qty)||0); }, 0); }
  function buildWhatsAppMessage(){
    var cart = loadCart(); if (!cart.length) return '';
    var lines = ['New order from website:'];
    var total = 0;
    cart.forEach(function(it, idx){
      var price = Number(it.price || 0);
      var line = (idx+1)+'. '+it.name+' - '+(it.packageLabel || '')+' x'+it.qty+' - $'+(price*it.qty).toFixed(2);
      if(it.flavour) line += ' ('+it.flavour+')';
      if(it.note) line += ' - Note: '+it.note;
      lines.push(line);
      total += price*it.qty;
    });
    lines.push('Total: $'+total.toFixed(2));
    return lines.join('\n');
  }

  // events & toasts
  function dispatchCartChanged(){
    var ev = new CustomEvent('lydia:cart:changed', { detail: { total: getTotalItems() } });
    window.dispatchEvent(ev);
  }
  function showToast(msg, timeout){
    timeout = timeout || 2200;
    var t = document.getElementById('lydia-toast');
    if(!t){ t = document.createElement('div'); t.id='lydia-toast'; t.className='lydia-toast'; document.body.appendChild(t); }
    t.textContent = msg; t.classList.add('visible');
    clearTimeout(t._to);
    t._to = setTimeout(function(){ t.classList.remove('visible'); }, timeout);
  }

  // expose API
  window.LydiaCart = { loadCart: loadCart, saveCart: saveCart, addToCart: addToCart, removeFromCart: removeFromCart, clearCart: clearCart, buildWhatsAppMessage: buildWhatsAppMessage, getTotalItems: getTotalItems };
})();
