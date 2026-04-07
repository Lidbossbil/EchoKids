<template>
  <div v-if="isReady" class="container-xxl bg-white p-0">
    <div id="spinner"
      class="bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      <div class="spinner-border text-primary"></div>
    </div>
<!-- Bỏ trong này sẽ container -->
  </div>
      <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
     <NavbarClient />
    </nav>
   <router-view />
  <FooterClient v-if="isReady" />
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue'
import NavbarClient from '../components/Client/NavbarClient.vue';
import FooterClient from '../components/Client/FooterClient.vue';

const isReady = ref(false)
const loadCSS = (href) => {
  if (!document.querySelector(`link[href="${href}"]`)) {
    const link = document.createElement('link')
    link.rel = 'stylesheet'
    link.href = href
    link.className = 'client-css-file' 
    document.head.appendChild(link)
  }
}

const loadScript = (src) => {
  return new Promise((resolve, reject) => {
    if (document.querySelector(`script[src="${src}"]`)) {
      resolve();
      return;
    }
    const script = document.createElement('script')
    script.src = src
    script.onload = resolve
    script.onerror = reject
    document.body.appendChild(script)
  })
}

onMounted(async () => {
  loadCSS("https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap");
  loadCSS("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css");
  loadCSS("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css");
  
  loadCSS("/Client/lib/animate/animate.min.css");
  loadCSS("/Client/lib/owlcarousel/assets/owl.carousel.min.css");
  loadCSS("/Client/css/bootstrap.min.css");
  loadCSS("/Client/css/style.css");

  await loadScript('https://code.jquery.com/jquery-3.4.1.min.js')
  await loadScript('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js')
  
  await loadScript('/Client/lib/wow/wow.min.js')
  await loadScript('/Client/lib/easing/easing.min.js')
  await loadScript('/Client/lib/waypoints/waypoints.min.js')
  await loadScript('/Client/lib/owlcarousel/owl.carousel.min.js')
  isReady.value = true
  await nextTick()
  await loadScript('/Client/js/main.js')
  setTimeout(() => {
    if (window.WOW) new WOW().init()
    if (window.$ && $('.owl-carousel').length) {
      $('.owl-carousel').owlCarousel()
    }
    window.dispatchEvent(new Event('resize'))
  }, 300)
})
</script>

<style>
</style>