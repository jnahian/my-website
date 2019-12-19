<template>
  <div class="main-layout">
    <navbar />

    <div class="container mt-4">
      <child />
    </div>
  </div>
</template>

<script>
import Navbar from '~/components/Navbar'
// Using font-awesome 5 icons
// import '@fortawesome/fontawesome-free/css/all.min.css';

// jQuery.extend(true, jQuery.fn.datetimepicker.defaults, {
//     icons: {
//         time: 'far fa-clock',
//         date: 'far fa-calendar',
//         up: 'fas fa-arrow-up',
//         down: 'fas fa-arrow-down',
//         previous: 'fas fa-chevron-left',
//         next: 'fas fa-chevron-right',
//         today: 'fas fa-calendar-check',
//         clear: 'far fa-trash-alt',
//         close: 'far fa-times-circle'
//     }
// });

export default {
  name: 'MainLayout',

  components: {
    Navbar
  }
}
</script>
