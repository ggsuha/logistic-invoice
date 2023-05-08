<template>
  <nav v-if="links.length > 3">
    <ul class="pagination">
      <template v-for="link in props.links" :key="link.label">
        <li v-if="link.label.includes('laquo')" :class="['page-item', { disabled: link.url == null }]">
          <Link class="page-link" :href="link.url ?? '#'" aria-label="Sebelumnya">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Prev</span>
          </Link>
        </li>
        <li v-if="!link.label.includes('laquo') && !link.label.includes('raquo')"
          :class="['page-item', { active: link.active, disabled: link.url == null }]">
          <Link class="page-link" :href="link.url">{{ link.label }}</Link>
        </li>

        <li v-if="link.label.includes('raquo')" :class="['page-item', { disabled: link.url == null }]">
          <Link class="page-link" :href="link.url ?? '#'" aria-label="Selanjutnya">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
          </Link>
        </li>
      </template>
    </ul>
  </nav>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

const props = defineProps({
  links: {
    type: Object,
    required: true,
  }
});

</script>
