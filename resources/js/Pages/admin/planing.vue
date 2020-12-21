<template>
  <app-layout>
    <div class="w-full p-4">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                nom de la classe
              </th>
              <th scope="col" class="relative px-6 py-3">
                <span class="sr-only">Voir les etudiants</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200"> 
            <tr v-for="classe in this.$props.classes" v-bind:key="classe.id">
              <td class="px-6 py-4 whitespace-nowrap">
                {{classe.nom}}
              </td>
                <td class="px-6 py-4 whitespace-nowrap  text-sm font-medium">
                <a v-bind:href="'/EDT/'+classe.id" class="text-indigo-600 hover:text-indigo-900">Voir l'empoie du temps</a>
              </td> 
            </tr>    
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
  </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
export default {
  components: { AppLayout },
  props:['classes']

}
</script>

<style>

</style>