<template>
  <div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <Link :href="$route('admin.shipment.index')"><img src="@/images/logo.png" alt="logo" class="w-75" />
        </Link>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <Link :href="$route('admin.shipment.index')"><img src="@/images/logo.png" alt="logo" class="w-50" />
        </Link>
      </div>
      <ul class="sidebar-menu mt-3">
        <!-- <SideBarHeader>Example</SideBarHeader> -->
        <div style="text-align: center;">
          <Link :href="$route('admin.shipment.create')" class="btn btn-primary" title="Buat Order">Buat Order
          </Link>
        </div>
        <SideBarLink icon="fas fa-list" :href="$route('admin.shipment.index')" :active="routeIs('admin.shipment.index')">
          Order
        </SideBarLink>
        <SideBarLink icon="fas fa-clone" :href="$route('admin.category.index')" :active="routeIs('admin.category.index')">
          Kategori Order
        </SideBarLink>
        <SideBarLink icon="fas fa-user" href="#">
          Akun
        </SideBarLink>
      </ul>
    </aside>
  </div>
</template>

<script setup lang="ts">
import { nextTick, onMounted } from "vue";
import initStisla from "@/scripts/utils/stisla";
import SideBarLink from "./SideBarLink.vue";
import SideBarDropdown from "./SideBarDropdown.vue";
import { Link } from "@inertiajs/vue3";
import { useRoute } from "@/scripts/utils/ziggy/useRoute";

const { routeIs } = useRoute();

onMounted(() => {
  nextTick(() => {
    initStisla();
  });
});

if (import.meta.hot) {
  import.meta.hot.accept(() => {
    nextTick(() => {
      initStisla();
    });
  });
}
</script>

<style scoped>
.sidebar-brand {
  height: fit-content;
}
</style>
