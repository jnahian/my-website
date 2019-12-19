<template>
  <div class="card border-primary">
    <h5 v-if="title" class="card-header text-primary">
      {{ title }}
    </h5>

    <div class="card-body">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  name: 'Card',

  props: {
    title: { type: String, default: null }
  }
}
</script>
