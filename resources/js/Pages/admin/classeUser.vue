<template>
  <app-layout>
      <div class="w-full p-4">
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
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
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
      tableHeader: []
    }
  },
  methods: {
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