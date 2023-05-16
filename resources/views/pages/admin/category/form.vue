<template layout="admin">
  <Head :title="`${action} Kategori`" />

  <PageSection :header="`${action} Kategori`">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-body">
            <section>
              <div class="form-group">
                <label for="category">Nama</label>
                <input id="category" v-model="form.name" type="text" class="form-control"
                  :class="{ 'is-invalid': form.errors.name }" placeholder="Contoh: Makanan" autocomplete="off" />
                <div v-if="form.errors.name" class="invalid-feedback">
                  {{ form.errors.name }}</div>
              </div>

            </section>
            <div class="form-group row mb-4">
              <div class="col-12">
                <button class="btn btn-primary float-right" @click="submit">
                  {{ action }} Kategori
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </PageSection>
</template>

<script setup lang="ts">
import PageSection from "@components/admin/layout/Page/PageSection.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { useRoute } from "@/scripts/utils/ziggy/useRoute";
import swal from "sweetalert";
import { computed } from "vue";

const { route } = useRoute();

const props = defineProps({
  category: {
    type: Object,
    default: null
  },
})

const action = computed(() => {
  return props.category ? 'Ubah' : 'Buat';
})

const form = useForm({
  name: props.category?.name,
});

function submit() {
  if (props.category == null) {
    form.post(route("admin.category.store"), {
      onSuccess: (response) => {
        swal("Data berhasil disimpan");
      },
      onFinish: () => {
        //
      }
    });
  } else {
    form.patch(route("admin.category.update", { shipment: props.category.id }), {
      onSuccess: (response) => {
        swal("Data berhasil diubah.");
      },
      onFinish: () => {
        //
      }
    });
  }
}
</script>

<style scoped></style>
