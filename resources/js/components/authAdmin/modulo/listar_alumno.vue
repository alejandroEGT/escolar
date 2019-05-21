
<template>
  <div class="animated fadeIn">
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col-md-10">
  					<h5><i class="fas fa-chalkboard-teacher"></i> Lista Alumnos</h5>
  				</div>
  				<div class="col-md-2">
  					<select id="promocion" @change="listar_cursos($event)"  class="form-control float-right">
						<option v-for="a in anios" :value="a.anio">{{a.anio}}</option>	
					</select>
  				</div>
  			</div>
	    </div>
  		<div class="card-body">
			
		    <div class="row justify-content-md-center">
				 <md-button class="md-raised md-primary" @click="url_crearalumno">Crear Alumno</md-button>
				      
				      	
				      	<div style="margin-top:4px;">
				      	<select @change="filter_curso" class="form-control" v-model="cursos">
					    	<option value="0">Filtrar Todos</option>
					    	<option v-for="listar in list_cursos" :value="listar.id">
					    	{{listar.descripcion+' - '+listar.nivel_educativo+' ('+listar.promocion+')'}}</option>
					    </select></div>

		
				      	
				      <div class="table-responsive">

					  <table class="table">
					    <thead>
					    	<tr style="background:#3F8DF7; color:white">
					    		<td></td>
					    		<td>
					    			Grado
					    		</td>
					    		<td>Nombre</td>
					    		<td>Run</td>
					    		<td>Direccion</td>
					    		<td>Activo</td>
					    	</tr>
					    </thead>
					    <tbody>
					    	<tr v-for="listado in listar_alumnos">
					    		<td> 
					    			<md-button @click="url_perfilalumno(listado.alumno_id, listado.curso_id)" class="md-icon-button md-raised md-primary">
								        <md-icon><i class="fas fa-eye"></i></md-icon>
								      </md-button>
								</td>
								
								<td>
									{{ listado.descripcion }}
								</td>

					    		<td>
					    		{{ listado.nombre+' '+listado.apellido_paterno+' '+listado.apellido_materno }}</td>
					    		<td>
					    			<label style="color:#99A3A4" v-if="!listado.run">No hay datos</label>
					    			<label v-if="listado.run">{{ listado.run }}</label>
					    		</td>
					    		<td>
					    			<label style="color:#99A3A4" v-if="!listado.direccion">No hay datos</label>
					    			<label v-if="listado.direccion">{{ listado.direccion }}</label>
					    		</td>
					    		
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
	  			listar_alumnos:[],
	  			cursos:'0',
	  			list_cursos:{},
	  			anios:{},
	  			promocion:''
	  		}
	  	},
	  	
	  	created(){
	  		this.anio_actual();
	  		//this.listar();
	  		//this.listar_cursos();
	  		this.get_anios()
	  	},
	  	methods:{
	  		listar(){
	  			axios.get('api/auth/admin/listaralumno').then((res)=>{
		            this.listar_docentes = res.data;
		        })
	  		},
	  		url_crearalumno(){
	          this.$router.push('admincrearalumno'); 
	   		},
	   		url_perfilalumno($alum, $curso){
	   		  this.$router.push({name:'perfilalumno', params:{ alumno: $alum, curso: $curso}});
	   		},

	   		listar_cursos($val){
	   			axios.get('api/auth/admin/listarcurso_promo/'+$val.target.value).then((res)=>{
	   				this.list_cursos = res.data;
	   			});
	   		},
	   		filter_curso(){
	   			console.log("filter "+this.cursos)
	   			
		   			axios.get('api/auth/admin/listaralumno_filter/'+this.cursos).then((res)=>{
			            this.listar_alumnos = res.data;
			        })
	   			
	   		},
	   		anio_actual(){
	   			axios.get('api/anio_actual').then((res)=>{
						this.promocion = res.data;
						
						axios.get('api/auth/admin/listarcurso_promo/'+this.promocion).then((res)=>{
			   				this.list_cursos = res.data;
			   			});
						
				});
	   		},
	   		get_anios(){
				axios.get('api/auth/anios').then((res)=>{
						this.anios = res.data;
						
				});
			}
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