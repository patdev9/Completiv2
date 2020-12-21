<template>
  <app-layout>
    <div>
      <button
        v-on:click="toggleModal()"
        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3"
      >
        Créer un cour
      </button>
    </div>
    <FullCalendar :options="calendarOptions" class="w-full p-4" />
    <div>
      <div
        v-if="showModal"
        class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex"
      >
        <div class="relative w-auto my-6 mx-auto max-w-3xl">
          <!--content-->
          <div
            class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none"
          >
            <!--header-->
            <div
              class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t"
            >
              <h3 class="text-3xl font-semibold">Filière</h3>
              <button
                class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
                v-on:click="closeModal()"
              >
                <span
                  class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"
                >
                  ×
                </span>
              </button>
            </div>
            <!--body-->
            <div class="relative p-6 flex-auto">
              <div class="mb-4">
                <label>Choisi le ccp</label>
                <select
                  v-on:change="getunit"
                  name="categorie"
                  v-model="newEvent.id"
                  class="form-control"
                >
                  <option
                    v-for="(ccp, index) in ccps"
                    :key="index"
                    :value="ccp.id"
                  >
                    {{ ccp.CCP }}
                  </option>
                </select>
              </div>
              <div class="mb-4">
                <label>uniter</label>
                <select
                  v-model="newEvent.id_unit"
                  name="subcategory"
                  class="form-control"
                >
                  <option
                    v-for="unit in uniters"
                    :key="unit.id"
                    :value="unit.id"
                  >
                    {{ unit.nom }}
                  </option>
                </select>
              </div>
              <div class="mb-4">
                <label>Formateur</label>
                <select
                  v-model="newEvent.id_formateur"
                  name="subcategory"
                  class="form-control"
                >
                  <option
                    v-for="formateur in formateurs"
                    :key="formateur.id"
                    :value="formateur.id"
                  >
                    {{ formateur.nom }}
                  </option>
                </select>
              </div>
              <div class="mb-4">
                <label
                  for="exampleFormControlInput1"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Nom de l'uniter</label
                >
                <input
                  type="datetime-local"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="exampleFormControlInput1"
                  placeholder="Entrer le nom de la filière"
                  v-model="newEvent.start"
                />
                <div v-if="$page.errors.nom" class="text-red-500">
                  {{ $page.errors.title[0] }}
                </div>
              </div>
              <div class="mb-4">
                <label
                  for="exampleFormControlInput1"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Nom de l'uniter</label
                >
                <input
                  type="datetime-local"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="exampleFormControlInput1"
                  placeholder="Entrer le nom de la filière"
                  v-model="newEvent.end"
                />
                <div v-if="$page.errors.nom" class="text-red-500">
                  {{ $page.errors.title[0] }}
                </div>
              </div>
            </div>

            <!--footer-->
            <div
              class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b"
            >
              <div
                class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
              >
                <span
                  class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"
                >
                  <button
                    v-on:click.prevent="store()"
                    type="button"
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                    v-show="!editMode"
                  >
                    Sauvgarder
                  </button>
                </span>
                <span
                  class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto"
                >
                  <button
                    v-on:click.prevent=""
                    type="button"
                    class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                    v-show="editMode"
                    @click="update(form)"
                  >
                    Modifier
                  </button>
                </span>
                <span
                  class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto"
                >
                  <button
                    v-on:click="closeModal()"
                    type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                  >
                    Annuler
                  </button>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div
        v-if="showModal"
        class="opacity-25 fixed inset-0 z-40 bg-black"
      ></div>
    </div>

    <div
      v-if="showDetails"
      class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex"
    >
      <div class="relative w-auto my-6 mx-auto max-w-3xl">
        
        <!--content-->
        <div
          class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none"

        >

          <!--header-->
          <div
            class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t"
          >
            <h3 class="text-3xl font-semibold">Détails du cour</h3>
            <button
              class="p-1 ml-auto bg-transparent border-0 text-black opacity-5 float-right text-3xl leading-none font-semibold outline-none focus:outline-none"
              v-on:click="showDetails=false"
            >
              <span
                class="bg-transparent text-black opacity-5 h-6 w-6 text-2xl block outline-none focus:outline-none"
              >
                ×
              </span>
            </button>
          </div>
          <!--body-->
          <div class="relative p-6 flex-auto">
            <div class="mb-4">
              
              <p>CCP: {{this.details.ccp.CCP}}</p>
              <p>Uniter d'enseignement: {{this.details.uniter.nom}}</p>
              <p>Classe: {{this.details.classe.nom}}</p>
              <p>Formateur: {{this.details.formateur.nom}}</p>
            </div>
          </div>
          <!--footer-->
          <div
            class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b"
          >
            <div
              class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
            >
              <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button
                  v-on:click.prevent="appel()"
                  type="button"
                  class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5"
                  
                >
                  Faire l'appel
                </button>
              </span>
            </div>
          </div>
        </div>
      
      </div>
    </div>
    
  </app-layout>
</template>

<script>
import AppLayout from "../../Layouts/AppLayout.vue";
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
import timeGridPlugin from "@fullcalendar/timegrid";
import ListPlugin from "@fullcalendar/list";
export default {
  components: { AppLayout, FullCalendar },
  props: ["cours", "classe", "ccps"],
  data() {
    return {
      details:[],
      formateurs: [],
      uniters: [],
      showModal: false,
      showDetails: false,
      editMode: false,
      calendarOptions: {
        plugins: [dayGridPlugin, interactionPlugin, timeGridPlugin, ListPlugin],
        initialView: "timeGridWeek",
        headerToolbar: {
          start: "title",
          center: "listWeek timeGridWeek dayGridMonth",
          end: "prev today next",
        },
        slotMinTime: "07:00:00",
        allDaySlot: false,
        locale: "fr",
        firstDay: 1,
        eventClick: function (info, view) {
          console.log(info.event);
          // window.location.href ='/appel/'+info.event.id
          this.getcour(info.event.id)
          this.showDetails = !this.showDetails;
         
          console.log(this.showModal);
        }.bind(this),

        events: [
          {
            title: "kdfkdk <br> djsldj",

            start: "2020-12-16T09:00:00",
            end: "2020-12-16T12:30:00",
          },
          {
            title: "lalala",
            start: "2020-12-16T13:30:00",
            end: "2020-12-16T17:00:00",
          },
        ],
      },
      newEvent: {
        id: "",
        id_unit: "",
        id_formateur: "",
        start: "",
        end: "",
      },
    };
  },
  mounted() {
    for (let i = 0; i < this.$props.cours.length; i++) {
      console.log("a");
      this.calendarOptions.events.push({
        id: this.$props.cours[i].id,
        title: this.$props.cours[i].ccp.CCP,
        start: this.$props.cours[i].date_start.replace(" ", "T"),
        end: this.$props.cours[i].date_end.replace(" ", "T"),
      });
    }
    axios
      .get("/formateur")
      .then((res) => (this.formateurs = res.data))
      .catch((err) => console.log(err));
  },
  methods: {
    toggleModal: function () {
      this.showModal = !this.showModal;
    },
    closeModal: function () {
      this.showModal = !this.showModal;
      this.reset();
      this.editMode = false;
    },
    edit() {
      this.editMode = true;
      this.toggleModal();
    },
    reset() {
      this.newEvent = {
        id: "",
        id_unit: "",
        id_formateur: "",
        start: "",
        end: "",
      };
    },
    getunit() {
      axios
        .get("/units/" + this.newEvent.id)
        .then((res) => (this.uniters = res.data))
        .catch((err) => console.log(err));
    },
    getcour(id) {
      axios
        .get("/courDetails/" + id)
        .then((res) => (this.details = res.data))
        .catch((err) => console.log(err));
    },
    store() {
      let data = new FormData();
      data.append("classe_id", this.classe.id);
      data.append("ccp_id", this.newEvent.id);
      data.append("unit_id", this.newEvent.id_unit);
      data.append("id_formateur", this.newEvent.id_formateur);
      data.append("start", this.newEvent.start.replace("T", " "));
      data.append("end", this.newEvent.end.replace("T", " "));
      this.$inertia.post("/edtsave", data);
      this.closeModal();
    },
    appel(){
      window.location.href ='/appel/'+this.details.id
    }
  },
};
</script>

<style>
</style>