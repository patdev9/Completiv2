<template>
  <app-layout>
    <div class="w-full p-4">
      <h2>{{ this.$props.filiere.nom }}</h2>
      <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
          <button
            v-on:click="toggleModal()"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3"
          >
            Créer une classe
          </button>
          <div
            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
          >
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    nom de la classe
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                  >
                    effectif
                  </th>
                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Voir les etudiants</span>
                  </th>

                  <th scope="col" class="relative px-6 py-3">
                    <span class="sr-only">Edit</span>
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr
                  v-for="classe in this.$props.classes"
                  v-bind:key="classe.id"
                >
                  <td class="px-6 py-4 whitespace-nowrap">
                    {{ classe.nom }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    {{ classe.etudiant.length }}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                    <a
                      v-bind:href="'/classeuser/' + classe.id"
                      class="text-indigo-600 hover:text-indigo-900"
                      >Voir les étudiants</a
                    >
                  </td>
                  <td
                    class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                  >
                    <a class="text-indigo-600 hover:text-indigo-900"
                      >Modifier</a
                    >
                    <a
                      @click="destroy(classe.id)"
                      class="text-indigo-600 hover:text-indigo-900 ml-1"
                      >Supprimer</a
                    >
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
                <label
                  for="exampleFormControlInput1"
                  class="block text-gray-700 text-sm font-bold mb-2"
                  >Nom du ccp</label
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
                    Save
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
                    Update
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
                    Cancel
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
import AppLayout from "../../Layouts/AppLayout.vue";
export default {
  components: { AppLayout },
  props: ["classes", "filiere"],
  data() {
    return {
      showModal: false,
      editMode: false,
      form: {
        nom: null,
      },
    };
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
      this.form = {
        nom: null,
      };
    },
    store() {
      console.log(this.form.nom);
      let data = new FormData();
      data.append("nom", this.form.nom);
      data.append("filiere_id", this.$props.filiere.id);
      this.$inertia.post("/classesave", data);
      this.closeModal();
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
            .delete("/classedelete/" + id)
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
  },
};
</script>

<style>
</style>