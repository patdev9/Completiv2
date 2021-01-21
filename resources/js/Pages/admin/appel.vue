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
                nom
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                prenom
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                email
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Absent
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Retard
              </th>
              <th scope="col" class="relative px-6 py-3">
                <span class="sr-only">Edit</span>
              </th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <tr v-for="user in this.$props.users[0].user" v-bind:key="user.id">
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
                <div>
  <input type="checkbox" :id="user.id" :value="user.id" v-model="absents"
         >
  <label for="scales">Absent</label>
</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <div>
  <input type="checkbox" :id="user.id" :value="user.id" v-model="retards"
         >
  <label for="scales">Retard</label>
</div>
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
<button @click="store()">SAVE</button>
  </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
export default {
  components: { AppLayout },
  props:['users','cour'],

    data(){
      return {
          absents:[],
          retards:[],
          form:{
            checked:null
          }
      }

  },
  methods:{
      store(){
        let data = []
        
        for(let i = 0; i < this.absents.length; i++){ 
            data.push({
                'id_user_abs': this.absents[i],
                'cour_id': this.$props.cour.id,
                'td':this.absents.length
            }) 
            this.$inertia.post('/absencesave',data)
        
        }
         for(let i = 0; i< this.retards.length; i++){ 
            data.push({
                'id_user_retard': this.retards[i],
                'cour_id': this.$props.cour.id,
                'td':0
            }) 
            this.$inertia.post('/absencesave',data)
        
        }
    }
  }

}
</script>

<style>

</style>