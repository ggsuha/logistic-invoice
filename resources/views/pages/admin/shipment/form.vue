<template layout="admin">
  <Head :title="`${action} Order`" />

  <PageSection :header="`${action} Order`">
    <div class="row">
      <div class="col-lg-6 col-md-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Pengirim</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="shipper_name">Nama</label>
              <input id="shipper_name" v-model="form.shipper.name" type="text" class="form-control" autofocus
                placeholder="Contoh: Budi Gemilang" autocomplete="off" />
            </div>
            <div class="form-group">
              <label for="shipper_phone">Nomor Telepon</label>
              <input id="shipper_phone" v-model="form.shipper.phone" type="text" class="form-control"
                placeholder="Contoh: 085272383281" autocomplete="off" />
            </div>
            <div class="form-group">
              <label for="shipper_address">Alamat</label>
              <textarea id="shipper_address" v-model="form.shipper.address" class="form-control" style="height: 100%;"
                rows="4" placeholder="Contoh: Jalan Pemuda no 15, Cengkareng Selatan" autocomplete="off"></textarea>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Penerima</h4>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="receiver_name">Nama</label>
              <input id="receiver_name" v-model="form.receiver.name" type="text" class="form-control" autofocus
                placeholder="Contoh: Park Ji Sung" />
            </div>
            <div class="form-group">
              <label for="receiver_phone">Nomor Telepon</label>
              <input id="receiver_phone" v-model="form.receiver.phone" type="text" class="form-control"
                placeholder="Contoh: 01 2827 2727" />
            </div>
            <div class="form-group">
              <label for="receiver_address">Alamat</label>
              <textarea id="receiver_address" v-model.number="form.receiver.address.street" class="form-control"
                style="height: 100%;" rows="4"
                placeholder="Contoh: #205, 426-14, Gung-dong, Yuseong-gu, Daejeon"></textarea>
            </div>
            <div class="form-group">
              <label for="receiver_country">Negara</label>
              <BKSelect id="receiver_country" v-model.number="form.country_id" :data-placeholder="'Pilih negara tujuan'"
                allow-empty>
                <option v-for="option in countries" :key="option.id" :value="option.id">{{ option.name }}</option>
              </BKSelect>
            </div>
            <div class="form-group">
              <label for="receiver_postal_code">Kode Pos</label>
              <BKSelect id="receiver_postal_code" v-model.number="form.receiver.address.postal_code_id"
                :data-placeholder="'Pilih kode pos'" allow-empty :options="postal_codes">
              </BKSelect>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12 col-md-12 col-12 col-sm-12">
        <div class="card">
          <div class="card-header">
            <h4>Detail Paket</h4>
          </div>
          <div class="card-body">
            <section>
              <div class="form-row">
                <div class="col-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label for="type">Jenis Paket</label>
                    <BKSelect id="type" v-model.number="form.shipment.category_id" :data-placeholder="'Pilih jenis paket'"
                      allow-empty>
                      <option v-for="option in categories" :key="option.id" :value="option.id">{{ option.name }}</option>
                    </BKSelect>
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label for="weight">Berat (Kg)</label>
                    <input id="weight" v-model.number="form.shipment.weight" type="number" min="1" class="form-control"
                      placeholder="Contoh: 10" />
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label for="content">Detail Isi</label>
                    <input id="content" v-model="form.shipment.content" type="text" class="form-control"
                      placeholder="Contoh: Food" />
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label for="pcs">Pcs</label>
                    <input id="pcs" v-model="form.shipment.pcs" type="text" class="form-control"
                      placeholder="Jumlah paket / koli" />
                  </div>
                </div>
              </div>

              <div class="form-row">
                <div class="col-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label for="item_custom_value">Value (USD)</label>
                    <input id="item_custom_value" v-model.number="form.shipment.value" type="number" class="form-control"
                      placeholder="Contoh: 100" />
                  </div>
                </div>
                <div class="col-12 col-sm-12 col-md-6">
                  <div class="form-group">
                    <label for="dimension">Dimensi</label>
                    <input id="dimension" v-model="form.shipment.dimension" type="text" class="form-control"
                      placeholder="Contoh: 100 cm" />
                  </div>
                </div>
              </div>
            </section>
            <div class="form-group row mb-4">
              <div class="col-12">
                <a v-if="shipment" target="_blank"
                  :href="$route('admin.shipment.invoice', { shipment: shipment.shipment.id })" class="btn btn-warning">
                  Print Invoice
                </a>
                <button class="btn btn-primary float-right" @click="submit">
                  {{ action }} Order
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <template v-if="shipment">
      <PageTitle>Daftar Item</PageTitle>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="float-right mb-3">
                <button type="button" data-toggle="modal" data-target="#item-form" class="btn btn-primary">Tambah
                  Item</button>
              </div>
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 5px">No</th>
                      <th>Deskripsi</th>
                      <th>Quantity</th>
                      <th>Unit</th>
                      <th>Value per Unit</th>
                      <th>Total Value</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <template v-if="(items?.data?.length > 0)">
                      <tr v-for="item, index in items.data" :key="item.id">
                        <td>{{ items.from + index }}</td>
                        <td>{{ item.description }}</td>
                        <td>{{ item.quantity }}</td>
                        <td style="text-transform: capitalize;">{{ item.unit }}</td>
                        <td>{{ item.value }}</td>
                        <td>{{ item.quantity * item.value }}</td>
                        <td>
                          <button class="btn btn-danger" title="Hapus"><i class="fas fa-trash"></i>
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
              <PaginationSection :links="items?.links" />
            </div>
          </div>
        </div>
      </div>
    </template>
  </PageSection>

  <div v-if="shipment" class="modal fade" tabindex="-1" role="dialog" id="item-form">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Item</h5>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="item-description">Deskripsi</label>
              <input id="item-description" v-model="modalForm.description" type="text" class="form-control"
                placeholder="Contoh: Kertas" />
            </div>
            <div class="form-group">
              <label for="item-quantity">Quantity</label>
              <input id="item-quantity" v-model.number="modalForm.quantity" type="text" class="form-control"
                placeholder="Contoh: 10" />
            </div>
            <div class="form-group">
              <label for="item-unit">Satuan Unit</label>
              <BKSelect id="item-unit" v-model="modalForm.unit" :data-placeholder="'Pilih satuan unit'" allow-empty>
                <option v-for="option in unit_options" :key="option.id" :value="option.id">{{ option.text }}</option>
              </BKSelect>
            </div>
            <div class="form-group">
              <label for="item-value">Value per Unit</label>
              <input id="item-value" v-model="modalForm.value" type="text" class="form-control"
                placeholder="Contoh: 100" />
            </div>
          </form>
        </div>
        <div class="modal-footer bg-whitesmoke br">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button class="btn btn-primary float-right" @click="modalSubmit">
            Tambah
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import PageSection from "@components/admin/layout/Page/PageSection.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { useRoute } from "@/scripts/utils/ziggy/useRoute";
import { BKSelect } from "@timedoor/baskito-ui";
import swal from "sweetalert";
import { computed, onMounted, ref, watch } from "vue";
import axios from "axios";
import PageTitle from "@/views/components/admin/layout/Page/PageTitle.vue";
import PaginationSection from "@/views/components/pagination-section.vue";

const { route } = useRoute();

const props = defineProps({
  shipment: {
    type: Object,
    default: null
  },
  countries: {
    type: Object,
    required: true,
  },
  categories: {
    type: Object,
    required: true,
  },
  items: {
    type: Object,
    default: []
  }
})

const postal_codes = ref([{}]);
const unit_options = ref([
  { id: 'set', text: "Set" },
  { id: 'pack', text: "Pack" },
  { id: 'pcs', text: "Pcs" }
]);

const action = computed(() => {
  return props.shipment ? 'Ubah' : 'Buat';
})

const form = useForm({
  shipment: {
    number: props.shipment?.shipment?.number,
    air_waybill: props.shipment?.shipment?.air_waybill,
    category_id: props.shipment?.shipment?.category_id,
    weight: props.shipment?.shipment?.weight,
    content: props.shipment?.shipment?.content,
    pcs: props.shipment?.shipment?.pcs,
    value: props.shipment?.shipment?.value,
    dimension: props.shipment?.shipment?.dimension,
  },
  shipper: {
    name: props.shipment?.shipper?.name,
    phone: props.shipment?.shipper?.phone,
    address: props.shipment?.shipper?.address,
  },
  receiver: {
    id: props.shipment?.receiver?.id,
    name: props.shipment?.receiver?.name,
    phone: props.shipment?.receiver?.phone,
    address: {
      street: props.shipment?.receiver?.address?.street ?? '',
      postal_code_id: props.shipment?.receiver?.address?.postal_code_id,
    }
  },
  country_id: props.shipment?.receiver?.address?.country_id,
  // item: {
  //   name: props.shipment?.item?.name,
  //   quantity: props.shipment?.item?.quantity,
  //   weight: props.shipment?.item?.weight,
  //   weight_unit: props.shipment?.item?.weight_unit,
  //   custom_value: props.shipment?.item?.custom_value,
  //   x_axis: props.shipment?.item?.x_axis,
  //   y_axis: props.shipment?.item?.y_axis,
  //   z_axis: props.shipment?.item?.z_axis,
  //   dimension_unit: props.shipment?.item?.dimension_unit ?? 'cm',
  // }
});


const modalForm = useForm({
  description: null,
  quantity: null,
  unit: null,
  value: null,
});

onMounted(() => {
  if (props.shipment != null) {
    getPostalCodes(form.country_id)
    form.receiver.address.postal_code_id = props.shipment?.receiver?.address?.postal_code_id
  }
})

watch(() => form.country_id, async (id) => {
  if (id == null) {
    postal_codes.value = [{}]

    return
  }

  getPostalCodes(id, true)
})

function getPostalCodes(id: number, refresh = false) {
  axios
    .get(route("admin.postalcode", { id: id }))
    .then((response: object) => {
      if (refresh) {
        form.receiver.address.postal_code_id = null;
      }

      postal_codes.value = response.data
    });
}

function submit() {
  if (props.shipment == null) {
    form.post(route("admin.shipment.store"), {
      onSuccess: (response) => {
        swal("Data berhasil disimpan");
      },
      onFinish: () => {
        //
      }
    });
  } else {
    form.patch(route("admin.shipment.update", { shipment: props.shipment.shipment.id }), {
      onSuccess: (response) => {
        swal("Data berhasil diubah.");
      },
      onFinish: () => {
        //
      }
    });
  }
}

function modalSubmit() {
  modalForm.post(route("admin.shipment.item.store", { shipment: props.shipment.shipment.id }), {
    onSuccess: (response) => {
      swal("Item berhasil ditambahkan.");
      modalClose();
    },
    onFinish: () => {
      //
    }
  });
}

function modalClose() {
  var closeButton = document.querySelector('button[data-dismiss="modal"]');
  closeButton.click();

  modalForm.reset();
}
</script>

<style scoped></style>
