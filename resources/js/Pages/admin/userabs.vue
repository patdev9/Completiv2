<template>
  <app-layout>
      {{this.$props.user.email}}
      <div >
          <p>abs.cour</p>
          <div class="flex flex-col mt-2">
              <div class="flex flex-row mt-2" v-for="abs in absence" v-bind:key='abs.id'>
                  
					<div    id="status"
						class="flex w-full items-center justify-between bg-white
						dark:bg-gray-800 px-8 py-6 border-l-4 border-gray-500
						dark:border-green-300">
						<!-- card -->
						<div class="flex">
							<img
								class="h-12 w-12 rounded-full object-cover"
                                :src="$props.user.profile_photo_url"
								alt="infamous" />
							<div class="flex flex-col ml-6">
								<span class="text-lg font-bold">Date</span>
								<div class="mt-4 flex">
									<div class="flex">
										
										<svg
											class="h-5 w-5 fill-current
											dark:text-gray-300"
											viewBox="0 0 24 24">
											<path
												d="M19
												19H5V8h14m-3-7v2H8V1H6v2H5c-1.11
												0-2 .89-2 2v14a2 2 0 002 2h14a2 2
												0 002-2V5a2 2 0 00-2-2h-1V1m-1
												11h-5v5h5v-5z"></path>
										</svg>
										<span
											class="ml-2 text-sm text-gray-600
											dark:text-gray-300 capitalize">
											{{abs.cour.date_start.slice(0,10)}}
										</span>
									</div>

									<div class="flex ml-6">
										<svg
											class="h-5 w-5 fill-current
											dark:text-gray-300"
											viewBox="0 0 24 24">
											<path
												d="M13 2.05v2.02c3.95.49 7 3.85 7
												7.93 0 3.21-1.92 6-4.72 7.28L13
												17v5h5l-1.22-1.22C19.91 19.07 22
												15.76 22
												12c0-5.18-3.95-9.45-9-9.95M11
												2c-1.95.2-3.8.96-5.32 2.21L7.1
												5.63A8.195 8.195 0 0111 4V2M4.2
												5.68C2.96 7.2 2.2 9.05 2
												11h2c.19-1.42.75-2.77
												1.63-3.9L4.2 5.68M6
												8v2h3v1H8c-1.1 0-2 .9-2
												2v3h5v-2H8v-1h1c1.11 0 2-.89
												2-2v-1a2 2 0 00-2-2H6m6
												0v5h3v3h2v-3h1v-2h-1V8h-2v3h-1V8h-2M2
												13c.2 1.95.97 3.8 2.22
												5.32l1.42-1.42A8.21 8.21 0 014
												13H2m5.11 5.37l-1.43 1.42A10.04
												10.04 0 0011 22v-2a8.063 8.063 0
												01-3.89-1.63z"></path>
										</svg>
										<span
											class="ml-2 text-sm text-gray-600
											dark:text-gray-300 capitalize">
											{{abs.cour.date_start.slice(11)}} à {{abs.cour.date_end.slice(11)}}
										</span>
									</div>
								</div>

								
							</div>
                            <div class="flex flex-col ml-6">
                                <span class="text-lg font-bold">Statut</span>
								<div class="mt-4 flex">
									<div class="flex">
										
										
										<span
											class="ml-2 text-sm text-gray-600
											dark:text-gray-300 capitalize">
											{{abs.statut.statu}}
										</span>
									</div>
                                </div>
                            </div>
						</div>

						
					</div>

					<div v-on:click="get_just(abs.justificatif.id)"
						class="text-center flex flex-col items-center
						justify-center bg-white dark:bg-gray-800
						dark:text-gray-300 ml-1 px-12 cursor-pointer
						hover:bg-blue-200 dark-hover:bg-blue-500 rounded-lg">
						<svg class="h-5 w-5 fill-current" viewBox="0 0 24 24">
							<path
								d="M9.47 9.65l-1.41 1.42L11
								14l5.19-5.18-1.41-1.42L11 11.18M17 3H7c-1.1 0-2
								.9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2m0 15l-5-2.18L7
								18V5h10z"></path>
						</svg>
                        <p>voir le justificatif</p>
					</div>
				</div>
          </div>
      </div>
      <template v-if="this.just.length != 0">
          <div class="flex flex-row">
              <div class="flex-col">
                  {{just.id}}
              </div>
              <div class="flex-col">
                  fdfd
              </div>
          </div>
      </template>
      <template v-else>
          choisir un utilisateur
      </template>
  </app-layout>
</template>

<script>
import AppLayout from '../../Layouts/AppLayout.vue'
export default {
  components: { AppLayout },
  props:['absence','user'],
  data(){
      return{
          just:[]
      }
  },
 methods:{
      get_just(id){ 
            axios.get('/userjust/'+id).then(res=>this.just=res.data).catch(err=>console.log(err))
        }
 }

}
</script>

<style>

</style>