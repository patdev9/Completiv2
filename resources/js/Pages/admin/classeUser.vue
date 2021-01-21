<template>
  <app-layout>
      <div class="w-full p-4">
         <button
            v-on:click="toggleModal()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3"
          >
            Ajouter un etudiant
          </button>
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <upload-excel-component :on-success="handleSuccess" :before-upload="beforeUpload" />
      <button @click="store()"> store</button>
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                nom
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                prenom
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                email
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Role
              </th>
              <th scope="col" class="relative px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="user in this.$props.classe[0].user" v-bind:key="user.id">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center">
                  <div class="flex-shrink-0 h-10 w-10">
                    <img class="h-10 w-10 rounded-full" :src="user.profile_photo_url" alt="">
                  </div>
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      {{user.nom}}
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{user.prenom}}
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                {{user.email}}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a @click="edit(user.id)" href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                <a @click="destroy(user.id)" href="#" class="text-indigo-600 hover:text-indigo-900">Supprimer</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="w-full">
  
<table>
    <thead >
        <tr >
        <th v-for="(item,index) of tableHeader" :key="index">{{item}}</th>
        </tr>
    </thead>
    <tbody>
        <tr v-for="(tr,index) in tableData" :key="index">
            <td v-for="(td,index) in tr" v-bind:key="index">
                {{td}}
            </td>
        </tr>
    </tbody>
</table>
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
              <h3 class="text-3xl font-semibold">Étudiant</h3>
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
                  >Nom de l'étudiant</label
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
                  >Prenom de l'étudiant</label
                >
                <input
                  type="text"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="exampleFormControlInput1"
                  placeholder="Entrer le nom de la filière"
                  v-model="form.prenom"
                />
                <div v-if="$page.errors.title" class="text-red-500">
                  {{ $page.errors.title[0] }}
                </div>
              </div>
              <div class="mb-4">
                <label
                  for="exampleFormControlInput1"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Date_naissnace</label
                >
                <input
                  type="date"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="exampleFormControlInput1"
                  placeholder="Entrer le nom de la filière"
                  v-model="form.Date_naissance"
                />
                <div v-if="$page.errors.title" class="text-red-500">
                  {{ $page.errors.title[0] }}
                </div>
              </div>
              <div class="mb-4">
                <label
                  for="exampleFormControlInput1"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Lieu naissnace</label
                >
                <input
                  type="text"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="exampleFormControlInput1"
                  placeholder="Entrer le nom de la filière"
                  v-model="form.Lieu_naissance"
                />
                <div v-if="$page.errors.title" class="text-red-500">
                  {{ $page.errors.title[0] }}
                </div>
              </div>
              <div class="mb-4">
                <label
                  for="exampleFormControlInput1"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Nationalité</label
                >
                <input
                  type="text"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="exampleFormControlInput1"
                  placeholder="Entrer le nom de la filière"
                  v-model="form.Nationalite"
                />
                <div v-if="$page.errors.title" class="text-red-500">
                  {{ $page.errors.title[0] }}
                </div>
              </div>
              <div class="text-4">
                <label
                  for="exampleFormControlInput1"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Email</label
                >
                <input
                  type="text"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="exampleFormControlInput1"
                  placeholder="Entrer le nom de la filière"
                  v-model="form.email"
                />
                <div v-if="$page.errors.title" class="text-red-500">
                  {{ $page.errors.title[0] }}
                </div>
              </div>
              <div v-show="!editMode" class="mb-4">
                <label
                  for="exampleFormControlInput1"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Mot de passe</label
                >
                <input
                  type="text"
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  id="exampleFormControlInput1"
                  placeholder="Entrer le nom de la filière"
                  v-model="form.password"
                />
                <div v-if="$page.errors.title" class="text-red-500">
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
                    v-on:click.prevent="storeOne()"
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
  </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
import UploadExcelComponent from './test.vue'
export default {
  components: { AppLayout, UploadExcelComponent },
  props:['users','classe'],
    data() {
    return {
      tableData: [],
      tableHeader: [],
      showModal: false,
      editMode: false,
      form:{
        modifid:null,
        nom: null,
        prenom:null,
        Date_naissance:null,
        Lieu_naissance:null,
        Nationalite:null,
        email:null,
        password:null,
      }
    }
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
      reset() {
      this.form = {
        modifid:null,
        nom: null,
        prenom:null,
        Date_naissance:null,
        Lieu_naissance:null,
        Nationalite:null,
        email:null,
        password:null,
      };
    },
    edit(id) {
      this.editMode = true;
      this.toggleModal();
      axios.get("/Userget/"+id).then(res=>this.form ={
        nom: res.data.nom,
        prenom:res.data.prenom,
        modifid:id,
        Date_naissance:res.data.Date_naissance,
        Lieu_naissance:res.data.Lieu_naissance,
        Nationalite:res.data.Nationalite,
        email:res.data.email,
      }).catch(err=>console.log(err))
    },


  destroy(id) {
      const Swal = require("sweetalert2");
      Swal.fire({
        title: "êtes vous sur ?",
        text: "La categorie sera definitivement supprimer!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Supprimer!",
      }).then((result) => {
        if (result.value) {
          this.$inertia
            .delete("/UserDelete/" + id)
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
    },



    update(){
let data = new FormData()
        data.append('nom',this.form.nom)
        data.append('prenom',this.form.prenom)
        data.append('email',this.form.email)
        data.append('Date_naissance',this.form.Date_naissance)
        data.append('Lieu_naissance',this.form.Lieu_naissance)
        data.append('Nationalite',this.form.Nationalite)
        data.append('classe_id', this.$props.classe[0].id,)
        this.$inertia.post('/UserUpdate/'+this.form.modifid,data)
        this.closeModal();
    },

    storeOne(){
        let data = new FormData()
        data.append('nom',this.form.nom)
        data.append('prenom',this.form.prenom)
        data.append('email',this.form.email)
        data.append('Date_naissance',this.form.Date_naissance)
        data.append('Lieu_naissance',this.form.Lieu_naissance)
        data.append('Nationalite',this.form.Nationalite)
        data.append('password',this.form.password)
        data.append('classe_id', this.$props.classe[0].id,)
        this.$inertia.post('/Usave',data)
        this.closeModal();
  },

    beforeUpload(file) {
      const isLt1M = file.size / 1024 / 1024 < 1
      if (isLt1M) {
        return true
      }
      this.$message({
        message: 'les fichier de plus de 1m ne sont pas supporter.',
        type: 'warning'
      })
      return false
    },
    handleSuccess({ results, header }) {
      this.tableData = results
      this.tableHeader = header
    },
    store(){
        let data = []
        console.log(this.$props.classe[0].id)
        for(let i = 0; i < this.tableData.length; i++){
            let td = Object.values(this.tableData[i])  
            console.log(td)
            data.push({
              'classe_id': this.$props.classe[0].id,
                'nom': td[0],
                'prenom': td[1],
                'email': td[2],
                'Date_naissance': td[3],
                'Lieu_naissance': td[4],
                'Nationalite': td[5],
                'password': td[6],
            }) 
            this.$inertia.post('/classeUsave',data)
        
        }
    }
  }
  

}
</script>

<style>

</style>