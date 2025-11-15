// app.js - small helpers for admin copy/share
document.addEventListener('DOMContentLoaded', function(){
  // copy buttons (admin)
  document.querySelectorAll('[data-copy-target]').forEach(function(btn){
    btn.addEventListener('click', function(){
      var target = document.querySelector(btn.getAttribute('data-copy-target'));
      if (!target) return;
      target.select && target.select();
      try{
        var ok = document.execCommand('copy');
        // fallback for modern API
        if (!ok && navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(target.value || target.getAttribute('value'));
        }
        btn.textContent = 'Copied';
        setTimeout(function(){ btn.textContent = 'Copy'; }, 1500);
      }catch(e){
        console.warn('copy failed', e);
      }
    });
  });

  // share button: if navigator.share is available, use it
  document.querySelectorAll('[data-share-url]').forEach(function(btn){
    btn.addEventListener('click', function(){
      var url = btn.getAttribute('data-share-url');
      if (navigator.share) {
        navigator.share({title:document.title, text:'Toggle product availability', url:url}).catch(()=>{});
      } else {
        // fallback: copy to clipboard
        if (navigator.clipboard && navigator.clipboard.writeText) {
          navigator.clipboard.writeText(url).then(function(){
            btn.textContent='Copied';
            setTimeout(()=>btn.textContent='Share',1500);
          });
        }
      }
    });
  });

  // sprinkle effect removed — no-op

  // Footer slogan rotation: cycle through an array of appetizing taglines every 2 minutes
  (function(){
    var slogans = [
      'Freshly baked daily — warm, buttery treats waiting for you.',
      'Warm from the oven — irresistible bites every morning.',
      'Buttery, flaky, and baked with love.',
      'Treat yourself today — hand-baked goodness.',
      'Small bakery. Big flavour. Taste the difference.',
      'Start your day with a slice of sunshine.',
      'Hand-rolled, hand-baked, heart-approved.',
      'Sweet, savory, and made for sharing.',
      'From our oven to your hands — enjoy!',
      'Crave-worthy bakes, baked fresh every day.'
    ];
    var el = document.getElementById('footer-slogan');
    if (!el) return;
  // start at a random slogan so we don't always show the first item
  var idx = Math.floor(Math.random() * slogans.length);
  // set initial slogan immediately
  el.textContent = slogans[idx];
  // helper to show next slogan with fade
    var fadeMs = 920; // match CSS transition (~900ms)
    function showNext(){
      // fade out
      el.classList.add('fading-out');
      el.classList.remove('fading-in');
      setTimeout(function(){
        idx = (idx + 1) % slogans.length;
        el.textContent = slogans[idx];
        // fade in
        el.classList.remove('fading-out');
        el.classList.add('fading-in');
      }, fadeMs);
    }
    // start with visible class to ensure correct state
    el.classList.add('fading-in');
    // rotate every 2 minutes (120000 ms)
    setInterval(showNext, 8000);
  })();

  // Mobile hamburger toggle
  (function(){
    var hamb = document.getElementById('site-hamburger');
    var nav = document.getElementById('site-nav');
    if (!hamb || !nav) return;
    var backdrop = null;
    var previouslyFocused = null;
    var trapListener = null;

    function createBackdrop(){
      if (backdrop) return backdrop;
      backdrop = document.createElement('div');
      backdrop.className = 'nav-backdrop';
      backdrop.addEventListener('click', function(){ closeMenu(); });
      document.body.appendChild(backdrop);
      // small delay before showing for CSS transition
      requestAnimationFrame(function(){ backdrop.classList.add('visible'); });
      return backdrop;
    }

    function removeBackdrop(){
      if (!backdrop) return;
      backdrop.classList.remove('visible');
      // wait for transition before removing
      setTimeout(function(){ if(backdrop && backdrop.parentNode) backdrop.parentNode.removeChild(backdrop); backdrop = null; }, 220);
    }

    var closeBtn = null;
  var panelHeader = null;

    function createCloseButton(){
      if (closeBtn) return closeBtn;
      closeBtn = document.createElement('button');
      closeBtn.className = 'nav-close';
      closeBtn.setAttribute('aria-label','Close menu');
      closeBtn.innerHTML = '&times;';
      closeBtn.addEventListener('click', function(){ closeMenu(); });
      nav.appendChild(closeBtn);
      return closeBtn;
    }

    function removeCloseButton(){
      if (!closeBtn) return;
      closeBtn.removeEventListener('click', closeMenu);
      if (closeBtn.parentNode) closeBtn.parentNode.removeChild(closeBtn);
      closeBtn = null;
    }

    function createPanelHeader(){
      if (panelHeader) return panelHeader;
      var brand = document.querySelector('.site-header .brand');
      panelHeader = document.createElement('div');
      panelHeader.className = 'nav-panel-header';
      if (brand){
        // clone the brand node (logo + title) into the panel header
        var clone = brand.cloneNode(true);
        // reduce logo size if present
        var logo = clone.querySelector('.logo'); if(logo){ logo.style.width='36px'; logo.style.height='36px'; }
        panelHeader.appendChild(clone);
      }
      nav.insertBefore(panelHeader, nav.firstChild);
      return panelHeader;
    }

    function removePanelHeader(){
      if (!panelHeader) return;
      if (panelHeader.parentNode) panelHeader.parentNode.removeChild(panelHeader);
      panelHeader = null;
    }

    function trapFocus(container){
      var focusable = container.querySelectorAll('a, button, input, select, textarea, [tabindex]:not([tabindex="-1"])');
      focusable = Array.prototype.slice.call(focusable).filter(function(el){ return !el.hasAttribute('disabled') && el.offsetParent !== null; });
      if (focusable.length === 0) return function(){};
      var first = focusable[0];
      var last = focusable[focusable.length-1];
      trapListener = function(e){
        if (e.key === 'Tab'){
          if (e.shiftKey){
            if (document.activeElement === first){ e.preventDefault(); last.focus(); }
          } else {
            if (document.activeElement === last){ e.preventDefault(); first.focus(); }
          }
        }
      };
      document.addEventListener('keydown', trapListener);
      // return cleanup
      return function(){ if(trapListener) { document.removeEventListener('keydown', trapListener); trapListener = null; } };
    }

    function openMenu(){
      // save previously focused element
      previouslyFocused = document.activeElement;
      createBackdrop();
      createPanelHeader();
      createCloseButton();
      nav.classList.add('open');
      hamb.setAttribute('aria-expanded', 'true');
      // move focus into the nav for accessibility
      var first = nav.querySelector('a, button'); if(first && first.focus) first.focus();
      // enable focus trap
      var cleanupTrap = trapFocus(nav);
      // store cleanup function on nav so closeMenu can call it
      nav._cleanupTrap = cleanupTrap;
    }

    function closeMenu(){
      nav.classList.remove('open');
      hamb.setAttribute('aria-expanded','false');
      removeBackdrop();
      removeCloseButton();
      removePanelHeader();
      // remove focus trap
      if (nav._cleanupTrap){ try{ nav._cleanupTrap(); }catch(e){} nav._cleanupTrap = null; }
      // restore focus to previous element
      try{ if(previouslyFocused && previouslyFocused.focus) previouslyFocused.focus(); }catch(e){}
      previouslyFocused = null;
    }

    hamb.addEventListener('click', function(){
      if (nav.classList.contains('open')) closeMenu(); else openMenu();
    });

    // close menu when a nav link is clicked (mobile)
    nav.querySelectorAll('a').forEach(function(a){
      a.addEventListener('click', function(){ if (nav.classList.contains('open')) closeMenu(); });
    });

    // close on ESC
    document.addEventListener('keydown', function(ev){ if (ev.key === 'Escape' && nav.classList.contains('open')) closeMenu(); });
  })();
});
