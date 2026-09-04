/**
 * Tek-Craft Toppres — front-end interactions (vanilla JS).
 */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    /* Sticky header — keep solid on interior pages */
    var header = document.querySelector('.site-header');
    if (header) {
      var keepSolid = header.classList.contains('tk-solid');
      var onScroll = function () {
        if (keepSolid || window.scrollY > 40) {
          header.classList.add('is-scrolled');
        } else {
          header.classList.remove('is-scrolled');
        }
      };
      onScroll();
      window.addEventListener('scroll', onScroll, { passive: true });
    }

    /* Mobile nav */
    var burger = document.querySelector('.burger');
    var mobileNav = document.querySelector('.mobile-nav');
    var mobileClose = document.querySelector('.mobile-close');
    var lastFocus = null;

    function openMobileNav() {
      if (!mobileNav) return;
      lastFocus = document.activeElement;
      mobileNav.hidden = false;
      mobileNav.setAttribute('aria-hidden', 'false');
      // Force reflow so transform transition runs after un-hiding.
      void mobileNav.offsetWidth;
      mobileNav.classList.add('is-open');
      if (burger) {
        burger.setAttribute('aria-expanded', 'true');
        burger.setAttribute('aria-label', burger.getAttribute('data-label-close') || 'إغلاق القائمة');
      }
      document.documentElement.classList.add('tk-nav-open');
      if (mobileClose) mobileClose.focus();
    }

    function closeMobileNav() {
      if (!mobileNav || !mobileNav.classList.contains('is-open')) return;
      mobileNav.classList.remove('is-open');
      if (burger) {
        burger.setAttribute('aria-expanded', 'false');
        burger.setAttribute('aria-label', burger.getAttribute('data-label-open') || 'فتح القائمة');
      }
      document.documentElement.classList.remove('tk-nav-open');
      window.setTimeout(function () {
        if (!mobileNav.classList.contains('is-open')) {
          mobileNav.hidden = true;
          mobileNav.setAttribute('aria-hidden', 'true');
        }
      }, 400);
      if (lastFocus && typeof lastFocus.focus === 'function') {
        lastFocus.focus();
      }
    }

    if (burger && mobileNav) {
      burger.setAttribute('data-label-open', burger.getAttribute('aria-label') || 'فتح القائمة');
      burger.setAttribute('data-label-close', 'إغلاق القائمة');
      burger.addEventListener('click', function () {
        if (mobileNav.classList.contains('is-open')) {
          closeMobileNav();
        } else {
          openMobileNav();
        }
      });
      if (mobileClose) {
        mobileClose.addEventListener('click', closeMobileNav);
      }
      mobileNav.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', closeMobileNav);
      });
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeMobileNav();
      });
      window.addEventListener(
        'resize',
        function () {
          if (window.innerWidth > 980) closeMobileNav();
        },
        { passive: true }
      );
    }

    /* Reveal on scroll */
    var revealEls = document.querySelectorAll('.reveal, .reveal-stagger');
    if ('IntersectionObserver' in window && revealEls.length) {
      var io = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('is-visible');
              io.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.15, rootMargin: '0px 0px -60px 0px' }
      );
      revealEls.forEach(function (el) {
        io.observe(el);
      });
    } else {
      revealEls.forEach(function (el) {
        el.classList.add('is-visible');
      });
    }

    /* Marquee seamless loop */
    document.querySelectorAll('.marquee-track').forEach(function (track) {
      track.innerHTML += track.innerHTML;
    });

    /* Service category tabs */
    var tabBtns = document.querySelectorAll('.tab-btn');
    var groups = document.querySelectorAll('.service-group');
    if (tabBtns.length && groups.length) {
      tabBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
          tabBtns.forEach(function (b) {
            b.classList.remove('active');
          });
          btn.classList.add('active');
          var cat = btn.getAttribute('data-cat');
          groups.forEach(function (g) {
            if (cat === 'all' || g.getAttribute('data-cat') === cat) {
              g.removeAttribute('hidden');
            } else {
              g.setAttribute('hidden', '');
            }
          });
        });
      });
    }

    /* Stat counters */
    var counters = document.querySelectorAll('[data-count]');
    if (counters.length && 'IntersectionObserver' in window) {
      var countIo = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            var el = entry.target;
            var target = parseInt(el.getAttribute('data-count'), 10);
            var suffix = el.getAttribute('data-suffix') || '';
            var dur = 1400;
            var start = performance.now();
            function tick(now) {
              var p = Math.min(1, (now - start) / dur);
              var eased = 1 - Math.pow(1 - p, 3);
              el.textContent = Math.round(target * eased) + suffix;
              if (p < 1) requestAnimationFrame(tick);
            }
            requestAnimationFrame(tick);
            countIo.unobserve(el);
          });
        },
        { threshold: 0.5 }
      );
      counters.forEach(function (c) {
        countIo.observe(c);
      });
    }

    /* FAQ accordion */
    document.querySelectorAll('.faq-item').forEach(function (item) {
      var q = item.querySelector('.faq-q');
      if (!q) return;
      q.addEventListener('click', function () {
        var isOpen = item.classList.contains('is-open');
        document.querySelectorAll('.faq-item').forEach(function (i) {
          i.classList.remove('is-open');
        });
        if (!isOpen) item.classList.add('is-open');
      });
    });

    /* Hero slider — fade (supports multiple instances) */
    document.querySelectorAll('.tk-hero, .hero-slider-wrapper').forEach(function (root) {
      var slides = root.querySelectorAll('[data-tk-hero-slide], .hero-slide');
      if (!slides.length) return;

      var dotsWrap = root.querySelector('[data-tk-hero-dots], #sliderDots, .slider-dots');
      var dots = dotsWrap ? dotsWrap.querySelectorAll('.slider-dot') : [];
      var nextBtn = root.querySelector('[data-tk-hero-next], #sliderNext');
      var prevBtn = root.querySelector('[data-tk-hero-prev], #sliderPrev');
      var current = 0;
      var total = slides.length;
      var timer = null;
      var autoplay = root.getAttribute('data-autoplay') !== '0';
      var speed = parseInt(root.getAttribute('data-speed') || '6000', 10) || 6000;

      function goTo(index) {
        if (index < 0) index = total - 1;
        if (index >= total) index = 0;
        slides.forEach(function (slide, i) {
          var on = i === index;
          slide.classList.toggle('is-active', on);
          if (on) {
            slide.removeAttribute('hidden');
            slide.setAttribute('aria-hidden', 'false');
          } else {
            slide.setAttribute('hidden', '');
            slide.setAttribute('aria-hidden', 'true');
          }
        });
        dots.forEach(function (dot, i) {
          dot.classList.toggle('active', i === index);
        });
        current = index;
      }

      function start() {
        if (!autoplay || total < 2) return;
        clearInterval(timer);
        timer = setInterval(function () {
          goTo(current + 1);
        }, speed);
      }

      function stop() {
        clearInterval(timer);
      }

      if (nextBtn) {
        nextBtn.addEventListener('click', function () {
          goTo(current + 1);
          start();
        });
      }
      if (prevBtn) {
        prevBtn.addEventListener('click', function () {
          goTo(current - 1);
          start();
        });
      }
      dots.forEach(function (dot, idx) {
        dot.addEventListener('click', function () {
          goTo(idx);
          start();
        });
      });

      root.addEventListener('mouseenter', stop);
      root.addEventListener('mouseleave', start);
      root.addEventListener('focusin', stop);
      root.addEventListener('focusout', start);

      // Touch swipe
      var touchX = null;
      root.addEventListener(
        'touchstart',
        function (e) {
          touchX = e.changedTouches[0].screenX;
        },
        { passive: true }
      );
      root.addEventListener(
        'touchend',
        function (e) {
          if (touchX === null) return;
          var dx = e.changedTouches[0].screenX - touchX;
          if (Math.abs(dx) > 40) {
            goTo(dx > 0 ? current - 1 : current + 1);
            start();
          }
          touchX = null;
        },
        { passive: true }
      );

      goTo(0);
      start();
    });

    /* Services sidebar menu (smooth scroll + active state) */
    var servicesMenu = document.getElementById('servicesMenu');
    if (servicesMenu) {
      servicesMenu.querySelectorAll('a[href^="#"]').forEach(function (link) {
        link.addEventListener('click', function (e) {
          var id = link.getAttribute('href');
          var target = id ? document.querySelector(id) : null;
          if (!target) return;
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
          servicesMenu.querySelectorAll('a').forEach(function (a) {
            a.classList.remove('active');
          });
          link.classList.add('active');
        });
      });
    }

    /* Reveal on scroll */
    var revealEls = document.querySelectorAll('.reveal, .reveal-stagger');
    if (revealEls.length && 'IntersectionObserver' in window) {
      var io = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add('is-visible');
              io.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.12, rootMargin: '0px 0px -40px 0px' }
      );
      revealEls.forEach(function (el) {
        io.observe(el);
      });
    } else {
      revealEls.forEach(function (el) {
        el.classList.add('is-visible');
      });
    }

    /* Count-up stats */
    var counters = document.querySelectorAll('[data-count]');
    if (counters.length && 'IntersectionObserver' in window) {
      var cio = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            var el = entry.target;
            var target = parseInt(el.getAttribute('data-count') || '0', 10);
            var suffix = el.getAttribute('data-suffix') || '';
            var startVal = 0;
            var dur = 1200;
            var t0 = null;
            function step(ts) {
              if (!t0) t0 = ts;
              var p = Math.min(1, (ts - t0) / dur);
              var val = Math.floor(startVal + (target - startVal) * p);
              el.textContent = val.toLocaleString('ar-EG') + suffix;
              if (p < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
            cio.unobserve(el);
          });
        },
        { threshold: 0.4 }
      );
      counters.forEach(function (el) {
        cio.observe(el);
      });
    }

    /* Reading progress on single articles */
    var progressBar = document.getElementById('readProgress');
    var articleBody = document.querySelector('.tk-single-article .article-body');
    if (progressBar && articleBody) {
      var onReadScroll = function () {
        var rect = articleBody.getBoundingClientRect();
        var total = articleBody.offsetHeight - window.innerHeight;
        var scrolled = Math.min(Math.max(-rect.top, 0), Math.max(total, 1));
        var pct = total > 0 ? (scrolled / total) * 100 : 0;
        progressBar.style.width = pct + '%';
      };
      window.addEventListener('scroll', onReadScroll, { passive: true });
      onReadScroll();
    }

    /* TOC active state */
    var tocLinks = document.querySelectorAll('.tk-single-article .toc-list a');
    if (tocLinks.length && 'IntersectionObserver' in window) {
      var headings = [];
      tocLinks.forEach(function (link) {
        var id = link.getAttribute('href');
        if (id && id.charAt(0) === '#') {
          var h = document.getElementById(id.slice(1));
          if (h) headings.push({ el: h, link: link });
        }
      });
      var tio = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            tocLinks.forEach(function (l) {
              l.classList.remove('is-active');
            });
            var match = headings.find(function (item) {
              return item.el === entry.target;
            });
            if (match) match.link.classList.add('is-active');
          });
        },
        { rootMargin: '-20% 0px -60% 0px', threshold: 0 }
      );
      headings.forEach(function (item) {
        tio.observe(item.el);
      });
    }
  });
})();
