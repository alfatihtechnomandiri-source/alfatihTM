/* Alfatih Techno Mandiri — interaksi antarmuka */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {

    /* ---------- Menu mobile ---------- */
    var navToggle = document.getElementById('navToggle');
    if (navToggle) {
      navToggle.addEventListener('click', function () {
        var open = document.body.classList.toggle('nav-open');
        navToggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      });
    }

    /* ---------- Bayangan header & tombol kembali ke atas ---------- */
    var header = document.getElementById('siteHeader');
    var toTop = document.getElementById('toTop');

    function onScroll() {
      var y = window.scrollY || window.pageYOffset;
      if (header) header.classList.toggle('is-scrolled', y > 12);
      if (toTop) toTop.classList.toggle('is-visible', y > 560);
    }
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    if (toTop) {
      toTop.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
      });
    }

    /* ---------- Animasi angka ---------- */
    var counters = document.querySelectorAll('[data-count]');
    if (counters.length) {
      var jalankan = function (el) {
        var target = parseFloat(el.getAttribute('data-count')) || 0;
        var suffix = el.getAttribute('data-suffix') || '';
        var mulai = performance.now();
        var durasi = 1200;
        function langkah(now) {
          var p = Math.min((now - mulai) / durasi, 1);
          var eased = 1 - Math.pow(1 - p, 3);
          el.textContent = Math.round(target * eased).toLocaleString('id-ID') + suffix;
          if (p < 1) requestAnimationFrame(langkah);
        }
        requestAnimationFrame(langkah);
      };

      if ('IntersectionObserver' in window) {
        var observer = new IntersectionObserver(function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              jalankan(entry.target);
              observer.unobserve(entry.target);
            }
          });
        }, { threshold: 0.4 });
        counters.forEach(function (c) { observer.observe(c); });
      } else {
        counters.forEach(jalankan);
      }
    }

    /* ---------- Lightbox galeri ---------- */
    var lightbox = document.getElementById('lightbox');
    if (lightbox) {
      var lbImg = document.getElementById('lightboxImg');
      var lbCaption = document.getElementById('lightboxCaption');

      function buka(src, caption) {
        lbImg.setAttribute('src', src);
        lbImg.setAttribute('alt', caption || '');
        lbCaption.textContent = caption || '';
        lightbox.hidden = false;
        document.body.style.overflow = 'hidden';
      }
      function tutup() {
        lightbox.hidden = true;
        lbImg.removeAttribute('src');
        document.body.style.overflow = '';
      }

      document.querySelectorAll('[data-lightbox]').forEach(function (item) {
        item.addEventListener('click', function () {
          buka(item.getAttribute('data-lightbox'), item.getAttribute('data-caption'));
        });
      });
      lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox || e.target.closest('[data-lightbox-close]') || e.target.closest('.lightbox-close')) {
          tutup();
        }
      });
      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !lightbox.hidden) tutup();
      });
    }

    /* ---------- Formulir permintaan penawaran ---------- */
    var quoteForm = document.getElementById('quoteForm');
    if (quoteForm && quoteForm.querySelector('.alert-error')) {
      setTimeout(function () {
        quoteForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 220);
    }
    var contactForm = document.querySelector('.form-card form');
    if (contactForm && document.querySelector('.form-card .alert-error')) {
      setTimeout(function () {
        contactForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, 220);
    }

    /* ---------- Gulir halus untuk tautan internal ---------- */
    document.querySelectorAll('a[href^="#"]:not([href="#"])').forEach(function (link) {
      link.addEventListener('click', function (e) {
        var target = document.querySelector(link.getAttribute('href'));
        if (!target) return;
        e.preventDefault();
        var offset = target.getBoundingClientRect().top + window.scrollY - 96;
        window.scrollTo({ top: offset, behavior: 'smooth' });
      });
    });
  });
})();
