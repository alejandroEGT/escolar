<template>
	<div>
		 <div class="viewport">
      <!-- <md-toolbar :md-elevation="1">
        <span class="md-title">Inset</span>
      </md-toolbar> -->
	
			<md-tabs class="md-transparent" md-alignment="fixed">
      			<md-tab id="tab-home" md-label="Docentes">
      				<md-list>
        
		        <!-- <md-divider class="md-inset"></md-divider> -->

			        <md-list-item v-for="(p, index) in json_docentes" :key="index">
			          <md-avatar>
			            <img :src="'/'+p.avatar" alt="People">
			          </md-avatar>

			          <span class="md-list-item-text">{{ p.nombres+' '+p.apellido_paterno+' '+p.apellido_materno }}</span>

			          <md-button @click="url_boxchat(p.user_id)" class="md-icon-button md-list-action">
			            <md-icon class="md-primary">chat_bubble</md-icon>
			          </md-button>
			        </md-list-item>

		       
		     	</md-list>
     			 </md-tab>
      		</md-tabs>
  		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				json_docentes:{}
			}
		},
		created(){
			this.get_docentes()
		},
		methods:{
			url_boxchat($user){
				this.$router.push({name:'docenteboxchat', params:{ user: $user }}); 
			},
			get_docentes(){
				axios.get('api/auth/docente/listar_docentes').then((res)=>{
					this.json_docentes = res.data;
				});
			}
		}
	}

</script>