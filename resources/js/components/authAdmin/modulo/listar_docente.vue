
<template>
  <div class="animated fadeIn">
	<div class="card">
		<div class="card-header">
  				<h5><i class="fas fa-chalkboard-teacher"></i> Lista Docente</h5>
  			</div>
  		<div class="card-body">
		    <div class="row justify-content-md-center">
				 
				      <div class="table-responsive">

				      	<md-button class="md-raised md-primary" @click="url_creardocente">Crear Docente</md-button>
					  <table class="table">
					    <thead>
					    	<tr style="background:#3F8DF7; color:white">
					    		<td>Nombre</td>
					    		<td>Email</td>
					    		<td>Contacto</td>
					    		<td>Activo</td>
					    	</tr>
					    </thead>
					    <tbody>
					    	<tr v-for="listado in listar_docentes">
					    		<td><img height="50" width="50" :src="'/'+listado.avatar"> {{ listado.nombres+' '+listado.apellido_paterno+' '+listado.apellido_materno }}</td>
					    		<td>{{ listado.email }}</td>
					    		<td>{{ listado.contacto }}</td>
					    		<td>{{ listado.activo }}</td>
					    	</tr>
					    </tbody>
					  </table>
					</div>
			</div>
		</div>
	</div>
  </div>
</template>

<script>


  export default {
  		
	  	data(){
	  		return{
	  			listar_docentes:[]
	  		}
	  	},
	  	
	  	created(){
	  		this.listar();
	  	},
	  	methods:{
	  		listar(){
	  			axios.get('api/auth/admin/obtener_docentes').then((res)=>{
		            this.listar_docentes = res.data;
		        })
	  		},
	  		url_creardocente(){
		         this.$router.push('admincreardocente'); 
		    },
	  	}
    }
</script>

<style lang="scss" scoped>
  .md-progress-bar {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
  }

  input[type="date"]:before {
   content: attr(placeholder) !important;
   color: rgba(0,0,0,.4);
   margin-right: 0.5em;
   display:block;
 }

/* Your cool style */
body{
  background-color:rgba(0,0,0,.1);
}
input[type="date"]{
  padding:10px 5px 10px 5px;
  border:0px;
  border-bottom:1px solid rgba(0,0,0,.1);
  margin:auto;
  display:block;
  background-color:transparent;
  outline:0;
}

.sinbordefondo {
  background-color: #eee;
  border: 0;
}
</style>