<template layout="admin">
  <Head title="List Kategori" />

  <PageSection header="List Kategori">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Kategori/Tipe</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 5px">No</th>
                    <th style="width: 65%">Nama</th>
                    <th>Jumlah Order</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <template v-if="(categories.data.length > 0)">
                    <tr v-for="category, index in categories.data" :key="category.id">
                      <td>{{ categories.from + index }}</td>
                      <td>{{ category.name }}</td>
                      <td>{{ category.shipments_count }}</td>
                      <td>
                        <Link :href="$route('admin.category.edit', { category: category.id })" class="btn btn-success"
                          title="Lihat"><i class="far fa-eye"></i>
                        </Link>&nbsp;
                        <button class="btn btn-danger" title="Hapus" :disabled="category.shipments_count > 0"
                          @click="remove(category.id)"><i class="fas fa-trash"></i>
                        </button>
                      </td>
                    </tr>
                  </template>

                  <template v-else>
                    <tr class="text-center">
                      <td colspan="10">Tidak ada data</td>
                    </tr>
                  </template>

                </tbody>
              </table>
            </div>
            <Pagination :links="categories.links" />
          </div>
        </div>
      </div>
    </div>
  </PageSection>
</template>

<script setup lang="ts">
import Pagination from "@/views/components/pagination-section.vue";
import PageSection from "@components/admin/layout/Page/PageSection.vue";
import { useRoute } from "@/scripts/utils/ziggy/useRoute";
import { Head, Link, router } from "@inertiajs/vue3";
import swal from "sweetalert";

const { route } = useRoute();

const props = defineProps({
  categories: {
    type: Object,
    required: true,
  }
})

function remove(id: number) {
  swal(`Apakah anda yakin??`, {
    buttons: ["Tidak", "Ya"],
    dangerMode: true,
  }).then((ok) => {
    if (ok) {
      router.delete(route('admin.category.destroy', { category: id }), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
          swal('Data berhasil dihapus!');
        }
      });
    }
  });
}
</script>

<style scoped></style>
