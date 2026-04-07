import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import AdminLayout from './layout/wrapper/admin_index.vue'
import ClientLayout from './layout/wrapper/client_index.vue'
import TeachLayout from './layout/wrapper/teach_index.vue'
import BlankLayout from './layout/wrapper/blank_index.vue'
import Toaster from "@meforma/vue-toaster";

const app = createApp(App)

app.use(router)

app.use(Toaster, {
  position: "top-right",
})

app.component("admin-layout", AdminLayout);
app.component("client-layout", ClientLayout);
app.component("teach-layout", TeachLayout);
app.component("blank-layout", BlankLayout);
app.directive('fade-up', {
  mounted(el) {
    el.classList.add('fade-up');
    const observer = new IntersectionObserver((entries, observerInstance) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observerInstance.unobserve(entry.target);
        }
      });
    }, {
      threshold: 0.1 
    });

    observer.observe(el);
  }
});

app.mount("#app")