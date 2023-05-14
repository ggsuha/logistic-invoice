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
                    <th>Tanggal</th>
                    <th>Nomor Resi</th>
                    <th>Pengirim</th>
                    <th>Penerima</th>
                    <th>Tujuan</th>
                    <th>Detail</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <template v-if="(shipments.data.length > 0)">
                    <tr v-for="shipment, index in shipments.data" :key="shipment.id">
                      <td>{{ shipments.from + index }}</td>
                      <td>{{ moment(shipment.created_at).locale("id").tz("Asia/Jakarta").format('YYYY-MM-DD') }}</td>
                      <td>{{ shipment.air_waybill ?? '-' }}</td>
                      <td>{{ shipment.shipper.name }} <br>{{ shipment.shipper.phone }}</td>
                      <td>{{ shipment.receiver.name }} <br>{{ shipment.receiver.phone }}<br>{{
                        shipment.receiver.address.street
                      }}</td>
                      <td>{{ shipment.receiver.address.postal_code.country.name }}</td>
                      <td>Berat: {{ shipment.weight }} kg<br>Qty: {{ shipment.pcs }}</td>
                      <td>
                        <Link :href="$route('admin.shipment.edit', { shipment: shipment.id })" class="btn btn-success"
                          title="Lihat"><i class="far fa-eye"></i>
                        </Link>&nbsp;
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
import { Head, Link } from "@inertiajs/vue3";
import moment from "moment-timezone";
import "moment/dist/locale/id";

const { route } = useRoute();

const props = defineProps({
  shipments: {
    type: Object,
    required: true,
  }
})
</script>

<style scoped></style>
