<template layout="admin">
  <Head title="List Order" />

  <PageSection header="List Order">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Order</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width: 5px">No</th>
                    <th>ID Number</th>
                    <th>Shipper</th>
                    <th>Receiver</th>
                    <th>Air Waybill</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <template v-if="(shipments.data.length > 0)">
                    <tr v-for="shipment, index in shipments.data" :key="shipment.id">
                      <td>{{ shipments.from + index }}</td>
                      <td>{{ shipment.number }}</td>
                      <td>{{ shipment.shipper.name }}</td>
                      <td>{{ shipment.receiver.name }}</td>
                      <td>{{ shipment.air_waybill }}</td>
                      <td>
                        <Link :href="$route('admin.shipment.show', { shipment: shipment.id })" class="btn btn-success"
                          title="Show"><i class="far fa-eye"></i>
                        </Link>&nbsp;
                        <button class="btn btn-danger" title="Edit" @click="remove(shipment.id)"><i
                            class="fas fa-trash"></i>
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
            <Pagination :links="shipments.links" />
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
  shipments: {
    type: Object,
    required: true,
  }
})

function remove(id: number) {
  swal(`Are you sure?`, {
    buttons: ["No", "Yes"],
    dangerMode: true,
  }).then((ok) => {
    if (ok) {
      router.delete(route('admin.shipment.destroy', { shipment: id }), {
        preserveScroll: true,
        preserveState: true,
        onSuccess: () => {
          swal('Data has been deleted!');
        }
      });
    }
  });
}
</script>

<style scoped></style>
