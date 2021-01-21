<template>
  <app-layout>
   <div class="w-full p-4">
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <button
            v-on:click="toggleModal()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3"
          >
            Ajouter un Titre
          </button>
          <div
            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
          >
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Nom
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Description
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Organisme certificateur
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Date de début d'accreditation
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Date de renouvellemnet
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    CCP
                  </th>

                  
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="titre in this.$props.titres" v-bind:key="titre.id">
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ titre.Nom }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ titre.Description }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ titre.Organisme_certificateur }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ titre.Date_debut_accreditation }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ titre.Date_renouvellement }}
                </td>                 
                <td class="px-6 py-4 whitespace-nowrap">
                   <div class="text-sm text-gray-900" v-for="ccp in titre.ccp" v-bind:key="ccp.id" >{{ccp.Nom}} {{ccp.pivot.Volume_horaire}} h</div>
                </td>                  
                
                  <td
                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a @click="edit(titre.id)" class="text-indigo-600 hover:text-indigo-900"
                      >Modifier</a>
                    <a
                      @click="destroy(titre.id)"
                      class="text-indigo-600 hover:text-indigo-900 ml-1"
                      >Supprimer</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
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
              <h3 class="text-3xl font-semibold">Titre</h3>
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
                <label
                  for="exampleFormControlInput1"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Nom du Titre</label
                >
                <input
                  type="text"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="exampleFormControlInput1"
                  placeholder="Entrer le nom de la filière"
                  v-model="form.nom"
                />
                <div v-if="$page.errors.title" class="text-red-500">
                  {{ $page.errors.title[0] }}
                </div>
              </div>
              <div class="mb-4">
                <label
                  for="exampleFormControlInput1"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Description</label
                >
                <input
                  type="text"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="exampleFormControlInput1"
                  placeholder="Entrer le nom de la filière"
                  v-model="form.description"
                />
                <div v-if="$page.errors.title" class="text-red-500">
                  {{ $page.errors.title[0] }}
                </div>
              </div>
              <div class="mb-4">
                <label
                  for="exampleFormControlInput1"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Organisme certificateur</label
                >
                <input
                  type="text"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="exampleFormControlInput1"
                  placeholder="Entrer le nom de la filière"
                  v-model="form.O_certificateur"
                />
                <div v-if="$page.errors.title" class="text-red-500">
                  {{ $page.errors.title[0] }}
                </div>
              </div>
              <div class="mb-4">
                <label
                  for="exampleFormControlInput1"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Date d'accréditation</label
                >
                <input
                  type="text"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="exampleFormControlInput1"
                  placeholder="Entrer le nom de la filière"
                  v-model="form.date_accre"
                />
                <div v-if="$page.errors.title" class="text-red-500">
                  {{ $page.errors.title[0] }}
                </div>
              </div>
              <div class="mb-4">
                <label
                  for="exampleFormControlInput1"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Date de renouvellemnt</label
                >
                <input
                  type="text"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="exampleFormControlInput1"
                  placeholder="Entrer le nom de la filière"
                  v-model="form.date_renouvellement"
                />
                <div v-if="$page.errors.title" class="text-red-500">
                  {{ $page.errors.title[0] }}
                </div>
              </div>
              <!-- <multiselect v-model="value" tag-placeholder="Ajouter un ccp" placeholder="Ajouter un ccp" label="name" track-by="code" :options="options" :multiple="true" :taggable="true" @tag="addTag"></multiselect> -->
            </div>
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
                    @click="update()"
                  >Modifier
                  </button>
                </span>
                <span
                  class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                  <button
                    v-on:click="closeModal()"
                    type="button"
                    class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
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
      <select id="select" style="visibility:hidden" >
          <option v-for="ccp in ccps" v-bind:key="ccp.id"> {{ccp.Nom}} </option>     
      </select>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
import Multiselect from 'vue-multiselect'
import Button from '../../Jetstream/Button.vue'

export default {
  components: { AppLayout, Multiselect },
    props:['titres','ccps'],
    data() {
    return {
      showModal: false,
      editMode: false,
      form: {
        modifid:null,
        nom: null,
        description:null,
        O_certificateur:null,
        date_accre:null,
        date_renouvellement:null,
        code:null
      },
       value: [],
      options: []
    };
  },
  mounted(){
      this.loadOptions()
  },
  methods:{
      toggleModal: function () {
      this.showModal = !this.showModal;
    },
    closeModal: function () {
      this.showModal = !this.showModal;
      this.reset();
      this.editMode = false;
    },
    edit(id) {
    this.modifid=id
      this.editMode = true;
      this.toggleModal();
    axios.get('/titreget/'+id).then(res=>this.form = {
        nom: res.data.Nom,
        description:res.data.Description,
        O_certificateur:res.data.Organisme_certificateur,
        date_accre:res.data.Date_debut_accreditation,
        date_renouvellement:res.data.Date_renouvellement,

      })
    },
    update(){
        let dat = new FormData();
        dat.append("nom", this.form.nom);
        dat.append("Description", this.form.description);
        dat.append("Organisme_certificateur", this.form.O_certificateur);
        dat.append("Date_debut_accreditation", this.form.date_accre);
        dat.append("Date_renouvellement", this.form.date_renouvellement);
        this.$inertia.post("/titreupdate/"+this.modifid, dat)
        this.closeModal();
        
    },
    

    reset() {
      this.form = {
        modifid:null,
        nom: null,
        description:null,
        O_certificateur:null,
        date_accre:null,
        date_renouvellement:null,
        code:null
      };
      this.value= []
      
    },
    addTag (newTag) {
      const tag = {
        name: newTag,
       code: newTag.substring(0, 2) + Math.floor((Math.random() * 10000000))
      }
      this.options.push(tag)
      this.value.push(tag)
    },
     loadOptions() {
                        const options = document.getElementById('select').options;
                        for (let i = 0; i < this.$props.ccps.length; i++) {
                            this.options.push({
                                code: this.$props.ccps[i].id,
                                name: this.$props.ccps[i].Nom,
                                selected: options[i].getAttribute('selectioné') != null ? options[i].getAttribute('selectioné') : false
                            });
                        }
                    },
    store() {
      console.log(this.form.nom);
      let data = new FormData();
      data.append("nom", this.form.nom);
      data.append("Description", this.form.description);
      data.append("Organisme_certificateur", this.form.O_certificateur);
      data.append("Date_debut_accreditation", this.form.date_accre);
      data.append("Date_renouvellement", this.form.date_renouvellement);
      for(let i = 0; i < this.value.length;i++){
      data.append(`${i}`, this.value[i].code)
    }
      this.$inertia.post("/titresave", data);
      this.closeModal();
    },
    destroy(id){
         const Swal = require("sweetalert2");
      Swal.fire({
        title: "êtes vous sur ?",
        text: "La categorie sera definitivement supprimer!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Supprimer!",
        cancelButtonText:'Anuller'
      }).then((result) => {
        if (result.value) {
          this.$inertia
            .delete("/titredelete/" + id)
            .then((res) => {
              Swal.fire(
                "Supprimer!",
                "La categorie a été supprimer.",
                "success"
              );
            })
        .catch((err) => console.log(err));
        }
      });
    }
  }
}
</script>

<style>

</style>