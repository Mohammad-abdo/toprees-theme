document.addEventListener('DOMContentLoaded', function(){

  /* ---------- Sticky header ---------- */
  const header = document.querySelector('.site-header');
  if(header){
    const lightHero = document.body.classList.contains('has-light-hero');
    const onScroll = ()=>{
      if(lightHero || window.scrollY > 12) header.classList.add('is-scrolled');
      else header.classList.remove('is-scrolled');
    };
    onScroll();
    window.addEventListener('scroll', onScroll, {passive:true});
  }

  /* ---------- Mobile nav ---------- */
  const burger = document.querySelector('.burger');
  const mobileNav = document.querySelector('.mobile-nav');
  const mobileClose = document.querySelector('.mobile-close');
  if(burger && mobileNav){
    burger.addEventListener('click', ()=> mobileNav.classList.add('is-open'));
    mobileClose && mobileClose.addEventListener('click', ()=> mobileNav.classList.remove('is-open'));
    mobileNav.querySelectorAll('a').forEach(a=> a.addEventListener('click', ()=> mobileNav.classList.remove('is-open')));
  }

  /* ---------- Animated stat counters (defined early so reveal can trigger it) ---------- */
  function runCounter(el){
    if(el.dataset.counted) return;
    el.dataset.counted = '1';
    const target = parseInt(el.getAttribute('data-count'), 10);
    const suffix = el.getAttribute('data-suffix') || '';
    const dur = 1400;
    const start = performance.now();
    function tick(now){
      const p = Math.min(1, (now-start)/dur);
      const eased = 1 - Math.pow(1-p, 3);
      el.textContent = Math.round(target*eased) + suffix;
      if(p < 1) requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
  }

  /* ---------- Reveal on scroll ---------- */
  const revealEls = document.querySelectorAll('.reveal, .reveal-stagger');
  if('IntersectionObserver' in window && revealEls.length){
    const io = new IntersectionObserver((entries)=>{
      entries.forEach(entry=>{
        if(entry.isIntersecting){
          entry.target.classList.add('is-visible');
          if(entry.target.hasAttribute('data-count')) runCounter(entry.target);
          entry.target.querySelectorAll('[data-count]').forEach(runCounter);
          io.unobserve(entry.target);
        }
      });
    }, {threshold:.15, rootMargin:'0px 0px -60px 0px'});
    revealEls.forEach(el=> io.observe(el));
    // Counters that aren't inside a .reveal wrapper still need their own trigger.
    document.querySelectorAll('[data-count]').forEach(el=>{
      if(!el.closest('.reveal, .reveal-stagger')) io.observe(el);
    });
  } else {
    revealEls.forEach(el=> el.classList.add('is-visible'));
    document.querySelectorAll('[data-count]').forEach(runCounter);
  }

  /* ---------- Hero star field ---------- */
  const field = document.querySelector('.hero-field');
  if(field){
    const starSVG = '<svg viewBox="0 0 24 24" class="star-ic"><path d="M12 0l2.9 8.4L24 12l-9.1 3.6L12 24l-2.9-8.4L0 12l9.1-3.6L12 0z"/></svg>';
    for(let i=0;i<22;i++){
      const s = document.createElement('div');
      s.className = 'hero-star';
      s.innerHTML = starSVG;
      const size = 6 + Math.random()*14;
      s.style.width = size+'px';
      s.style.height = size+'px';
      s.style.top = Math.random()*100+'%';
      s.style.left = Math.random()*100+'%';
      s.style.animationDelay = (Math.random()*5)+'s';
      s.style.animationDuration = (4+Math.random()*4)+'s';
      field.appendChild(s);
    }
  }

  /* ---------- Marquee duplication for seamless loop ---------- */
  document.querySelectorAll('.marquee-track').forEach(track=>{
    track.innerHTML += track.innerHTML;
  });

  /* ---------- Service tabs (services.html) ---------- */
  const tabBtns = document.querySelectorAll('.tab-btn');
  const groups = document.querySelectorAll('.service-group');
  if(tabBtns.length && groups.length){
    tabBtns.forEach(btn=>{
      btn.addEventListener('click', ()=>{
        tabBtns.forEach(b=> b.classList.remove('active'));
        btn.classList.add('active');
        const cat = btn.getAttribute('data-cat');
        groups.forEach(g=>{
          if(cat === 'all' || g.getAttribute('data-cat') === cat) g.removeAttribute('hidden');
          else g.setAttribute('hidden','');
        });
      });
    });
  }

  /* ---------- Contact form ---------- */
  const form = document.querySelector('#request-form');
  if(form){
    form.addEventListener('submit', function(e){
      e.preventDefault();
      const card = document.querySelector('.form-card-inner');
      const success = document.querySelector('.form-success');
      const cfg = window.toppersTheme || {};
      if(cfg.ajaxUrl){
        const data = new FormData(form);
        data.append('action', 'toppers_contact');
        data.append('nonce', cfg.nonce || '');
        fetch(cfg.ajaxUrl, { method: 'POST', body: data, credentials: 'same-origin' })
          .then(function(r){ return r.json(); })
          .then(function(json){
            if(json && json.success){
              if(card) card.style.display = 'none';
              if(success) success.classList.add('is-visible');
            } else {
              alert((json && json.data && json.data.message) || (cfg.i18n && cfg.i18n.error) || 'Error');
            }
          })
          .catch(function(){
            alert((cfg.i18n && cfg.i18n.error) || 'Error');
          });
        return;
      }
      if(card) card.style.display = 'none';
      if(success) success.classList.add('is-visible');
    });
    document.querySelectorAll('[data-form-reset]').forEach(btn=>{
      btn.addEventListener('click', ()=>{
        form.reset();
        const card = document.querySelector('.form-card-inner');
        const success = document.querySelector('.form-success');
        if(card) card.style.display = '';
        if(success) success.classList.remove('is-visible');
      });
    });
  }

  /* ---------- FAQ accordion ---------- */
  document.querySelectorAll('.faq-item').forEach(item=>{
    const q = item.querySelector('.faq-q');
    q && q.addEventListener('click', ()=>{
      const isOpen = item.classList.contains('is-open');
      document.querySelectorAll('.faq-item').forEach(i=> i.classList.remove('is-open'));
      if(!isOpen) item.classList.add('is-open');
    });
  });

  /* ---------- FAQ category TOC spy ---------- */
  const faqCats = document.querySelectorAll('.faq-cat[id]');
  const faqLinks = document.querySelectorAll('.faq-toc-link');
  if(faqCats.length && faqLinks.length && 'IntersectionObserver' in window){
    const map = new Map();
    faqLinks.forEach(link=>{
      const id = (link.getAttribute('href') || '').replace('#','');
      if(id) map.set(id, link);
    });
    const spy = new IntersectionObserver((entries)=>{
      entries.forEach(entry=>{
        if(!entry.isIntersecting) return;
        const id = entry.target.id;
        faqLinks.forEach(l=> l.classList.remove('is-active'));
        const active = map.get(id);
        if(active) active.classList.add('is-active');
      });
    }, { rootMargin: '-20% 0px -65% 0px', threshold: 0.01 });
    faqCats.forEach(cat=> spy.observe(cat));
  }

  /* ---------- Active nav link ---------- */
  const path = location.pathname.split('/').pop() || 'index.html';
  document.querySelectorAll('.nav-desktop a, .mobile-nav a').forEach(a=>{
    const href = a.getAttribute('href');
    if(href === path) a.classList.add('active');
  });

  /* ---------- Notifications Dropdown ---------- */
  const cfg = window.toppersTheme || {};
  const notifToggle = document.getElementById('notifDropdownToggle');
  const notifMenu = document.getElementById('notifMenu');
  if(notifToggle && notifMenu){
    const notifBtn = notifToggle.querySelector('.icon-btn');
    const closeNotif = ()=>{
      notifMenu.classList.remove('is-active');
      if(notifBtn) notifBtn.setAttribute('aria-expanded', 'false');
    };
    const openNotif = ()=>{
      notifMenu.classList.add('is-active');
      if(notifBtn) notifBtn.setAttribute('aria-expanded', 'true');
    };
    if(notifBtn){
      notifBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        if(notifMenu.classList.contains('is-active')) closeNotif();
        else openNotif();
      });
    }
    document.addEventListener('click', (e) => {
      if(!notifToggle.contains(e.target)) closeNotif();
    });
    document.addEventListener('keydown', (e) => {
      if(e.key === 'Escape') closeNotif();
    });

    const restBase = (cfg.restUrl || '').replace(/\/?$/, '/');
    const restNonce = cfg.restNonce || '';
    const restPost = (path)=>{
      if(!restBase || !restNonce) return Promise.resolve();
      return fetch(restBase + path, {
        method: 'POST',
        credentials: 'same-origin',
        headers: { 'X-WP-Nonce': restNonce }
      });
    };
    notifMenu.querySelectorAll('[data-notif-id]').forEach((el) => {
      el.addEventListener('click', () => {
        const id = el.getAttribute('data-notif-id');
        if(id) restPost('notifications/' + id + '/read');
      });
    });
    const markAll = notifMenu.querySelector('[data-notif-read-all]');
    if(markAll){
      markAll.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        restPost('notifications/read-all').then(() => {
          notifMenu.querySelectorAll('.notif-item.unread').forEach((n) => n.classList.remove('unread'));
          const badge = notifToggle.querySelector('.notif-badge');
          if(badge) badge.remove();
          markAll.remove();
        });
      });
    }
  }

  /* ---------- Order Modal: WhatsApp or student portal ---------- */
  const modalHTML = `
    <div class="order-modal-overlay" id="orderModalOverlay">
      <div class="order-modal-card">
        <div class="order-modal-header">
          <h4 id="orderModalTitle">اطلب خدمة</h4>
          <button class="order-modal-close" id="orderModalClose" type="button">&times;</button>
        </div>
        <div class="order-modal-body">
          <p class="order-choice-lede">تقدر تطلب الخدمة بطريقتين:</p>
          <div class="order-choice-grid">
            <a class="order-choice-card" id="orderChoiceWhatsapp" href="${cfg.whatsapp || '#'}" target="_blank" rel="noopener">
              <span class="order-choice-kicker">الطريقة الأولى</span>
              <strong>تواصل عبر واتساب</strong>
              <span>راسلنا مباشرة ونكمل معك التفاصيل من هناك.</span>
            </a>
            <a class="order-choice-card order-choice-card--system" id="orderChoiceSystem" href="${cfg.requestUrl || '/toppers-client/?tab=new'}">
              <span class="order-choice-kicker">الطريقة الثانية</span>
              <strong>${cfg.loggedIn ? 'اطلب من حسابك' : 'سجّل دخول واطلب من المنصة'}</strong>
              <span>الطلب يظهر في حساب الطالب، ويوصل لفريق توبرز لنكمل الفلو المعتاد.</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  `;
  document.body.insertAdjacentHTML('beforeend', modalHTML);

  const orderModalOverlay = document.getElementById('orderModalOverlay');
  const orderModalClose = document.getElementById('orderModalClose');
  const orderModalTitle = document.getElementById('orderModalTitle');
  const orderChoiceWhatsapp = document.getElementById('orderChoiceWhatsapp');
  const orderChoiceSystem = document.getElementById('orderChoiceSystem');

  function withServiceQuery(base, service){
    if(!service) return base;
    const join = base.indexOf('?') === -1 ? '?' : '&';
    return base + join + 'service=' + encodeURIComponent(service);
  }

  function withWhatsappText(base, service){
    if(!service || !base) return base;
    const join = base.indexOf('?') === -1 ? '?' : '&';
    return base + join + 'text=' + encodeURIComponent('أرغب في طلب خدمة: ' + service);
  }

  document.querySelectorAll('.open-order-modal').forEach(btn => {
    btn.addEventListener('click', (e) => {
      e.preventDefault();
      const card = btn.closest('.card') || btn.closest('.service-card') || btn.closest('.svc-order');
      let sName = '';
      if(card){
        const h3 = card.querySelector('h3');
        if(h3) sName = h3.textContent.trim();
      } else if(btn.getAttribute('data-service')){
        sName = btn.getAttribute('data-service');
      }
      orderModalTitle.textContent = sName ? ('طلب: ' + sName) : 'اطلب خدمة';
      if(orderChoiceWhatsapp){
        orderChoiceWhatsapp.href = withWhatsappText(cfg.whatsapp || '#', sName);
      }
      if(orderChoiceSystem){
        orderChoiceSystem.href = withServiceQuery(cfg.requestUrl || '/toppers-client/?tab=new', sName);
      }
      orderModalOverlay.classList.add('is-open');
    });
  });

  if(orderModalClose){
    orderModalClose.addEventListener('click', () => {
      orderModalOverlay.classList.remove('is-open');
    });
  }
  if(orderModalOverlay){
    orderModalOverlay.addEventListener('click', (e) => {
      if(e.target === orderModalOverlay){
        orderModalOverlay.classList.remove('is-open');
      }
    });
  }

  document.querySelectorAll('.services-menu a[href^="#cat-"]').forEach(function(link){
    link.addEventListener('click', function(){
      document.querySelectorAll('.services-menu a').forEach(function(a){ a.classList.remove('active'); });
      link.classList.add('active');
    });
  });

  const serviceSections = document.querySelectorAll('.service-section');
  const serviceMenuLinks = document.querySelectorAll('.services-menu a');
  if(serviceSections.length && serviceMenuLinks.length){
    window.addEventListener('scroll', function(){
      let current = '';
      serviceSections.forEach(function(section){
        if(window.pageYOffset >= section.offsetTop - 150){
          current = section.getAttribute('id');
        }
      });
      serviceMenuLinks.forEach(function(link){
        link.classList.remove('active');
        if(current && (link.getAttribute('href') || '').indexOf(current) !== -1){
          link.classList.add('active');
        }
      });
    }, {passive:true});
  }

  function applyBlogFilter(cat){
    var cards = document.querySelectorAll('#blogGrid .article-card');
    var visible = 0;
    cards.forEach(function(card){
      var slugs = (card.getAttribute('data-cat') || '').split(/\s+/);
      var show = cat === 'all' || slugs.indexOf(cat) !== -1;
      card.hidden = !show;
      if(show) visible += 1;
    });
    var empty = document.getElementById('blogEmpty');
    if(empty) empty.hidden = visible > 0;
  }
  document.querySelectorAll('.js-blog-filter').forEach(function(btn){
    btn.addEventListener('click', function(e){
      e.preventDefault();
      document.querySelectorAll('.js-blog-filter').forEach(function(b){ b.classList.remove('active'); });
      btn.classList.add('active');
      applyBlogFilter(btn.getAttribute('data-cat') || 'all');
    });
  });

  document.querySelectorAll('.t-filter').forEach(function(btn){
    btn.addEventListener('click', function(){
      document.querySelectorAll('.t-filter').forEach(function(b){ b.classList.remove('is-active'); });
      btn.classList.add('is-active');
      var type = btn.getAttribute('data-filter');
      document.querySelectorAll('.t-card[data-type]').forEach(function(card){
        card.hidden = type !== 'all' && card.getAttribute('data-type') !== type;
      });
    });
  });



  /* ---------- Profile Tabs Logic ---------- */
  const profileNavBtns = document.querySelectorAll('.profile-nav-btn');
  const profileTabs = document.querySelectorAll('.profile-tab');

  if(profileNavBtns.length && profileTabs.length){
    // Check URL params for active tab
    const urlParams = new URLSearchParams(window.location.search);
    const tabParam = urlParams.get('tab');
    
    if(tabParam){
      let targetId = 'tab-' + tabParam;
      if(document.getElementById(targetId)){
        profileNavBtns.forEach(btn => btn.classList.remove('active'));
        profileTabs.forEach(tab => tab.classList.remove('active'));
        
        document.querySelector(`[data-target="${targetId}"]`).classList.add('active');
        document.getElementById(targetId).classList.add('active');
      }
    }

    profileNavBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        profileNavBtns.forEach(b => b.classList.remove('active'));
        profileTabs.forEach(t => t.classList.remove('active'));
        
        btn.classList.add('active');
        document.getElementById(btn.getAttribute('data-target')).classList.add('active');
      });
    });
  }

  
  /* ---------- Load Orders in Profile & Update Stats ---------- */
  const ordersListEl = document.getElementById('ordersList');
  if(ordersListEl){
    let orders = JSON.parse(localStorage.getItem('toppers_orders') || '[]');
    
    // Update Overview Stats
    const statActive = document.getElementById('statActiveOrders');
    if(statActive){
      const activeCount = orders.filter(o => o.status !== 'مكتمل').length;
      // Animate stat
      let current = 0;
      const target = activeCount;
      if(target > 0) {
        const interval = setInterval(() => {
          current++;
          statActive.textContent = current;
          if(current >= target) clearInterval(interval);
        }, 150);
      } else {
        statActive.textContent = '0';
      }
    }

    if(orders.length === 0){
      ordersListEl.innerHTML = '<div style="padding:40px;text-align:center;color:#666">لا توجد طلبات سابقة. <a href="services.html" style="color:var(--gold)">اطلب الآن</a></div>';
    } else {
      let html = '';
      orders.reverse().forEach(o => {
        let statusClass = 'pending';
        let progress = 20; // default for new
        if(o.status.includes('مراجعة')) progress = 30;
        if(o.status.includes('تجهيز') || o.status.includes('تنفيذ')) {
          statusClass = 'progress';
          progress = 65;
        }
        if(o.status.includes('مكتمل')) {
          statusClass = 'completed';
          progress = 100;
        }

        html += `
          <div class="order-card glass-card" style="flex-direction:column; align-items:stretch">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:15px">
              <div class="order-card-info">
                <h4>${o.service} <span style="color:#999;font-size:0.9rem;font-weight:normal;margin-right:10px">${o.id}</span></h4>
                <div class="order-card-meta">
                  <span><i class="fa-solid fa-calendar-days" aria-hidden="true"></i> ${o.date}</span>
                  <span><i class="fa-solid fa-graduation-cap" aria-hidden="true"></i> ${o.level}</span>
                </div>
              </div>
              <div class="order-actions" style="margin:0">
                <span class="order-status status-${statusClass}">${o.status}</span>
                <button class="btn btn-outline btn-sm" style="margin-right:15px;padding:6px 12px" onclick="document.querySelector('[data-target=\'tab-chat\']').click(); document.getElementById('chatHeaderTitle').textContent = 'بخصوص ${o.id} - ${o.service}'">محادثة</button>
              </div>
            </div>
            
            <div class="order-progress-container">
              <div class="order-progress-bar" style="width: 0%" data-progress="${progress}%"></div>
            </div>
            <div class="order-progress-label">
              <span>تم استلام الطلب</span>
              <span>جاري العمل</span>
              <span>مكتمل</span>
            </div>
          </div>
        `;
      });
      ordersListEl.innerHTML = html;

      // Trigger progress bar animations
      setTimeout(() => {
        document.querySelectorAll('.order-progress-bar').forEach(bar => {
          bar.style.width = bar.getAttribute('data-progress');
        });
      }, 300);
    }
  }

  
  /* ---------- Mock Chat Form ---------- */
  const chatForm = document.getElementById('chatForm');
  const chatInput = document.getElementById('chatInput');
  const chatMessages = document.getElementById('chatMessages');
  if(chatForm){
    chatForm.addEventListener('submit', (e) => {
      e.preventDefault();
      const text = chatInput.value.trim();
      if(!text) return;
      
      const time = new Date().toLocaleTimeString('ar-SA', {hour: '2-digit', minute:'2-digit'});
      
      const msgHTML = `
        <div class="message msg-sent">
          <div class="msg-bubble">${text}</div>
          <div class="msg-time">${time}</div>
        </div>
      `;
      chatMessages.insertAdjacentHTML('beforeend', msgHTML);
      chatInput.value = '';
      chatMessages.scrollTop = chatMessages.scrollHeight;

      // Mock response after 1 second
      setTimeout(() => {
        const replyHTML = `
          <div class="message msg-received">
            <div class="msg-bubble">شكراً لتواصلك، سيتم الرد عليك في أقرب وقت.</div>
            <div class="msg-time">${new Date().toLocaleTimeString('ar-SA', {hour: '2-digit', minute:'2-digit'})}</div>
          </div>
        `;
        chatMessages.insertAdjacentHTML('beforeend', replyHTML);
        chatMessages.scrollTop = chatMessages.scrollHeight;
      }, 1000);
    });
  }


  /* Auth is handled by the Toppers Platform plugin. */


  /* ---------- Hero Slider Logic ---------- */
  const heroSlider = document.getElementById('heroSlider');
  if(heroSlider){
    const slides = heroSlider.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.slider-dot');
    const nextBtn = document.getElementById('sliderNext');
    const prevBtn = document.getElementById('sliderPrev');
    let currentSlide = 0;
    const totalSlides = slides.length;
    let autoPlayInterval;

    function goToSlide(index) {
      if(index < 0) index = totalSlides - 1;
      if(index >= totalSlides) index = 0;
      
      slides.forEach(s => s.classList.remove('is-active'));
      dots.forEach(d => d.classList.remove('active'));
      
      currentSlide = index;
      
      // Update transform (RTL so + instead of -)
      heroSlider.style.transform = `translateX(${currentSlide * 100}%)`;
      
      slides[currentSlide].classList.add('is-active');
      if(dots[currentSlide]) dots[currentSlide].classList.add('active');
    }

    function startAutoPlay() {
      clearInterval(autoPlayInterval);
      autoPlayInterval = setInterval(() => { goToSlide(currentSlide + 1); }, 6000);
    }

    if(nextBtn){
      nextBtn.addEventListener('click', () => { goToSlide(currentSlide - 1); startAutoPlay(); });
    }
    if(prevBtn){
      prevBtn.addEventListener('click', () => { goToSlide(currentSlide + 1); startAutoPlay(); });
    }
    
    dots.forEach((dot, idx) => {
      dot.addEventListener('click', () => { goToSlide(idx); startAutoPlay(); });
    });

    startAutoPlay();
  }

  /* ---------- Testimonials filters + media ---------- */
  var tTabs = document.querySelectorAll('.t-filters .tab-btn');
  var tCards = document.querySelectorAll('.t-masonry .t-card');
  if(tTabs.length && tCards.length){
    function applyTFilter(filter){
      tCards.forEach(function(card){
        var type = card.getAttribute('data-type');
        var isCta = type === '__cta';
        if(filter === 'all'){
          card.classList.toggle('is-hidden', isCta);
        } else {
          card.classList.toggle('is-hidden', type !== filter);
        }
      });
    }
    tTabs.forEach(function(btn){
      btn.addEventListener('click', function(){
        tTabs.forEach(function(b){ b.classList.remove('active'); });
        btn.classList.add('active');
        applyTFilter(btn.getAttribute('data-filter'));
      });
    });
  }

  var videoModal = document.getElementById('videoModal');
  var videoModalPlayer = document.getElementById('videoModalPlayer');
  var videoModalClose = document.getElementById('videoModalClose');
  if(videoModal && videoModalPlayer){
    document.querySelectorAll('.video-thumb').forEach(function(thumb){
      thumb.addEventListener('click', function(){
        var src = thumb.getAttribute('data-video');
        if(src) videoModalPlayer.setAttribute('src', src);
        videoModal.classList.add('is-open');
        videoModalPlayer.play().catch(function(){});
      });
    });
    function closeVideoModal(){
      videoModal.classList.remove('is-open');
      videoModalPlayer.pause();
      videoModalPlayer.removeAttribute('src');
      videoModalPlayer.load();
    }
    if(videoModalClose) videoModalClose.addEventListener('click', closeVideoModal);
    videoModal.addEventListener('click', function(e){
      if(e.target === videoModal) closeVideoModal();
    });
  }

  /* ---------- Screenshot Lightbox Modal Logic ---------- */
  function setupImageModal(modalId, closeBtnId, imgId) {
    var modal = document.getElementById(modalId);
    var closeBtn = document.getElementById(closeBtnId);
    var modalImg = document.getElementById(imgId);
    if (!modal || !modalImg) return;

    document.querySelectorAll('.t-screenshot-wrap').forEach(function(wrap) {
      wrap.addEventListener('click', function(e) {
        e.preventDefault();
        var fullSrc = wrap.getAttribute('data-full-image');
        if (!fullSrc) {
          var img = wrap.querySelector('img');
          if (img) fullSrc = img.getAttribute('src');
        }
        if (fullSrc) {
          modalImg.setAttribute('src', fullSrc);
          modal.classList.add('is-open');
        }
      });
    });

    function closeModal() {
      modal.classList.remove('is-open');
      setTimeout(function() {
        modalImg.removeAttribute('src');
      }, 300);
    }

    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', function(e) {
      if (e.target === modal || e.target.classList.contains('image-modal-box')) {
        closeModal();
      }
    });
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && modal.classList.contains('is-open')) {
        closeModal();
      }
    });
  }
  setupImageModal('imageModal', 'imageModalClose', 'imageModalImg');
  setupImageModal('homeImageModal', 'homeImageModalClose', 'homeImageModalImg');

  /* ---------- Audio Player Logic (Working HTML5 Playback) ---------- */
  const audioPlayers = document.querySelectorAll('.audio-player');
  var activeAudio = null;
  var activePlayer = null;

  function formatAudioTime(sec) {
    if (!isFinite(sec) || isNaN(sec) || sec < 0) return '0:00';
    var m = Math.floor(sec / 60);
    var s = Math.floor(sec % 60);
    return m + ':' + (s < 10 ? '0' : '') + s;
  }

  audioPlayers.forEach(function(player) {
    const btn = player.querySelector('.audio-btn');
    const progressBar = player.querySelector('.audio-progress-bar');
    const timeDisplay = player.querySelector('.audio-time');
    const waveform = player.querySelector('.audio-waveform');
    const src = player.getAttribute('data-audio');
    const defaultTimeText = timeDisplay ? timeDisplay.textContent.trim() : '0:45';

    var audio = src ? new Audio(src) : null;

    if (audio) {
      audio.preload = 'metadata';
      audio.addEventListener('loadedmetadata', function() {
        if (audio.duration && timeDisplay) {
          timeDisplay.textContent = formatAudioTime(audio.duration);
        }
      });

      audio.addEventListener('timeupdate', function() {
        if (audio.duration && progressBar) {
          var progress = (audio.currentTime / audio.duration) * 100;
          progressBar.style.width = progress + '%';
          if (timeDisplay) {
            var remain = Math.max(0, audio.duration - audio.currentTime);
            timeDisplay.textContent = formatAudioTime(remain);
          }
        }
      });

      audio.addEventListener('ended', function() {
        player.classList.remove('is-playing');
        if (progressBar) progressBar.style.width = '0%';
        if (timeDisplay) timeDisplay.textContent = audio.duration ? formatAudioTime(audio.duration) : defaultTimeText;
        if (activeAudio === audio) {
          activeAudio = null;
          activePlayer = null;
        }
      });

      audio.addEventListener('pause', function() {
        player.classList.remove('is-playing');
      });

      audio.addEventListener('play', function() {
        player.classList.add('is-playing');
      });
    }

    if (btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        if (!audio || !src) {
          player.classList.toggle('is-playing');
          return;
        }

        // If another audio is currently playing, pause and reset it
        if (activeAudio && activeAudio !== audio) {
          activeAudio.pause();
          if (activePlayer) activePlayer.classList.remove('is-playing');
        }

        if (audio.paused) {
          audio.play().then(function() {
            player.classList.add('is-playing');
            activeAudio = audio;
            activePlayer = player;
          }).catch(function(err) {
            console.log('Audio playback prevented or error:', err);
          });
        } else {
          audio.pause();
          player.classList.remove('is-playing');
        }
      });
    }

    if (waveform && audio) {
      waveform.addEventListener('click', function(e) {
        if (!audio.duration) return;
        var rect = waveform.getBoundingClientRect();
        var clickX = e.clientX - rect.left;
        var ratio = clickX / rect.width;
        if (document.documentElement.getAttribute('dir') === 'rtl') {
          ratio = 1 - ratio;
        }
        ratio = Math.max(0, Math.min(1, ratio));
        audio.currentTime = ratio * audio.duration;
      });
    }
  });

  /* ---------- AI Research Assistant Generator (5 Unique Results) ---------- */
  var aiForm = document.getElementById('aiResearchForm');
  if (aiForm) {
    var aiData = window.ToppersAIData || {};
    var templates = aiData.templates || [];
    var contactUrl = aiData.contactUrl || '/contact';
    var whatsappNum = aiData.whatsappNum || '966549093465';

    var majorInput = document.getElementById('ai-major');
    var degreeSelect = document.getElementById('ai-degree');
    var interestsText = document.getElementById('ai-interests');
    var loadingBox = document.getElementById('ai-loading');
    var resultsBox = document.getElementById('ai-results');
    var cardsGrid = document.getElementById('ai-cards-grid');
    var statusText = document.getElementById('ai-status-text');
    var progressBar = document.getElementById('aiProgressBar');

    // Quick chip buttons
    document.querySelectorAll('.ai-chip-btn').forEach(function(chipBtn) {
      chipBtn.addEventListener('click', function() {
        var chipVal = this.getAttribute('data-chip');
        if (!chipVal) return;
        var current = interestsText.value.trim();
        if (current.indexOf(chipVal) === -1) {
          interestsText.value = current ? current + '، ' + chipVal : chipVal;
        }
        interestsText.focus();
        this.classList.add('is-added');
        var self = this;
        setTimeout(function() { self.classList.remove('is-added'); }, 600);
      });
    });

    var loadingMessages = [
      'جاري تحليل الكلمات المفتاحية ومطابقتها بالتخصص...',
      'فحص الأطر الأكاديمية ومعايير رؤية 2030...',
      'استبعاد العناوين المستهلكة وبناء 5 أفكار نوعية...',
      'صياغة العناوين وتحديد المنهجيات المقترحة...'
    ];

    function generateFiveIdeas() {
      var major = majorInput.value.trim() || 'التخصص المختار';
      var degree = degreeSelect.value.trim() || 'رسالة ماجستير';
      var interests = interestsText.value.trim() || major;

      // Extract primary keywords
      var keywordList = interests.split(/[\s,،]+/).filter(function(w){ return w.length > 2; });
      var primeKeyword = keywordList.slice(0, 3).join(' ') || interests;

      // Shuffle templates and pick 5 distinct
      var pool = templates.slice();
      for (var i = pool.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = pool[i];
        pool[i] = pool[j];
        pool[j] = temp;
      }
      var selected = pool.slice(0, 5);

      // Methodologies & Badges map
      var methodologyTypes = [
        'منهج وصفي تحليلي (دراسة مسحية)',
        'منهج شبه تجريبي / دراسة مقارنة',
        'منهج كمي ميداني (تحليل إحصائي متقدم)',
        'منهج استشرافي (أسلوب دلفاي / تحليل سيناريوهات)',
        'دراسة حالة معمقة ونمذجة بنائية'
      ];

      cardsGrid.innerHTML = '';

      selected.forEach(function(item, idx) {
        var rawTitle = item.pattern || 'دراسة متقدمة في {major} قائمة على {keyword}';
        var title = rawTitle
          .replace(/\{major\}/g, major)
          .replace(/\{degree\}/g, degree)
          .replace(/\{keyword\}/g, primeKeyword);

        var rawDesc = item.desc || 'بحث أكاديمي متقدم لمرحلة {degree} يدرس كيفية توظيف {keyword} لتطوير الممارسات الأكاديمية والتطبيقية في {major}.';
        var desc = rawDesc
          .replace(/\{major\}/g, major)
          .replace(/\{degree\}/g, degree)
          .replace(/\{keyword\}/g, primeKeyword);

        var meth = item.methodology || methodologyTypes[idx % methodologyTypes.length];
        var impact = item.impact || 'تقديم نموذج استرشادي قابل للتطبيق الميداني';

        var orderHref = contactUrl + (contactUrl.indexOf('?') === -1 ? '?' : '&') + 'topic=' + encodeURIComponent(title) + '&major=' + encodeURIComponent(major) + '&degree=' + encodeURIComponent(degree);
        var waMessage = encodeURIComponent('السلام عليكم توبرز، أرغب في الاستفسار وطلب مساعدة في إعداد فكرة البحث التالية:\n' + title + '\n(التخصص: ' + major + ' - المرحلة: ' + degree + ')');
        var waHref = 'https://wa.me/' + whatsappNum + '?text=' + waMessage;

        var card = document.createElement('div');
        card.className = 'ai-card-result';
        card.innerHTML =
          '<div class="acr-header">' +
            '<span class="acr-num-badge">الخيار 0' + (idx + 1) + '</span>' +
            '<span class="acr-meth-badge"><i class="fa-solid fa-chart-column" aria-hidden="true"></i> ' + meth + '</span>' +
            '<span class="acr-fresh-badge"><i class="fa-solid fa-star" aria-hidden="true"></i> فكرة حصرية</span>' +
          '</div>' +
          '<h3 class="acr-title">' + title + '</h3>' +
          '<p class="acr-desc">' + desc + '</p>' +
          '<div class="acr-meta">' +
            '<span><strong>المساهمة الأكاديمية:</strong> ' + impact + '</span>' +
          '</div>' +
          '<div class="acr-actions">' +
            '<a href="' + orderHref + '" class="btn btn-gold btn-sm">' +
              '<span>اطلب هذا البحث الآن</span>' +
              '<i class="fa-solid fa-arrow-left" aria-hidden="true"></i>' +
            '</a>' +
            '<a href="' + waHref + '" target="_blank" rel="noopener" class="btn btn-outline-wa btn-sm">' +
              '<i class="fa-brands fa-whatsapp" aria-hidden="true"></i>' +
              '<span>واتساب</span>' +
            '</a>' +
            '<button type="button" class="btn btn-copy-title btn-sm" data-copy="' + title.replace(/"/g, '&quot;') + '">' +
              '<span class="copy-text"><i class="fa-regular fa-copy" aria-hidden="true"></i> نسخ العنوان</span>' +
            '</button>' +
          '</div>';

        cardsGrid.appendChild(card);
      });

      // Hook up copy buttons
      cardsGrid.querySelectorAll('.btn-copy-title').forEach(function(btn) {
        btn.addEventListener('click', function() {
          var textToCopy = this.getAttribute('data-copy');
          var textSpan = this.querySelector('.copy-text');
          var self = this;
          if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(textToCopy);
          } else {
            var tempInput = document.createElement('textarea');
            tempInput.value = textToCopy;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
          }
          textSpan.innerHTML = '<i class="fa-solid fa-check" aria-hidden="true"></i> تم النسخ بنجاح!';
          self.classList.add('is-copied');
          setTimeout(function() {
            textSpan.innerHTML = '<i class="fa-regular fa-copy" aria-hidden="true"></i> نسخ العنوان';
            self.classList.remove('is-copied');
          }, 2000);
        });
      });
    }

    function runAIGeneration() {
      aiForm.style.display = 'none';
      resultsBox.style.display = 'none';
      loadingBox.style.display = 'block';

      if (progressBar) progressBar.style.width = '0%';
      var msgIndex = 0;
      if (statusText) statusText.textContent = loadingMessages[0];

      var interval = setInterval(function() {
        msgIndex++;
        if (msgIndex < loadingMessages.length && statusText) {
          statusText.textContent = loadingMessages[msgIndex];
        }
        if (progressBar) {
          progressBar.style.width = ((msgIndex + 1) / loadingMessages.length) * 100 + '%';
        }
      }, 550);

      setTimeout(function() {
        clearInterval(interval);
        loadingBox.style.display = 'none';
        generateFiveIdeas();
        resultsBox.style.display = 'block';
        resultsBox.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 2400);
    }

    aiForm.addEventListener('submit', function(e) {
      e.preventDefault();
      runAIGeneration();
    });

    var rerollBtnTop = document.getElementById('aiRerollBtn');
    if (rerollBtnTop) {
      rerollBtnTop.addEventListener('click', function() {
        runAIGeneration();
      });
    }

    var rerollBtnBottom = document.getElementById('aiRerollBtnBottom');
    if (rerollBtnBottom) {
      rerollBtnBottom.addEventListener('click', function() {
        runAIGeneration();
      });
    }

    var editInputBtn = document.getElementById('aiEditInputBtn');
    if (editInputBtn) {
      editInputBtn.addEventListener('click', function() {
        resultsBox.style.display = 'none';
        aiForm.style.display = 'block';
        aiForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
      });
    }
  }

});