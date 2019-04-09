<template>
	<!-- animated infinite bounce delay-1s -->
	<div class="animated fadeIn">
		<div class="container table-responsive">
			<div class="row">
				<div class="col-md-5" style="">
					<i class="fas fa-cube fa-3x"></i>
					 <md-chip><label style="font-size: 20px">
					 	<strong v-zLoading:circle="isLoading">{{ 'Curso/'+get_curso.descripcion }}
					 		<small>{{get_curso.promocion}}</small>
					 	</strong>
					 </label></md-chip>
					
				</div>
			</div>
		</div>
		<br>
		<md-tabs>
      <md-tab id="tab-home" md-label="Inicio" v-zLoading:circle="isLoading">
		<div class="animated fadeIn">
			<div class="card">
				<div class="card-header">
		  				<h5><i class="far fa-address-book"></i> Inicio</h5>
		  			</div>

		  		<div class="card-body">
					
				      	<div class="row">

				      		<div class="col-md-3" style="margin-top:2px">
				      			<md-chip class="md-primary"> <i class="far fa-address-book fa-1x"></i> 
				      				<strong>Docente jefe:</strong> <label v-if="docente_jefe != null">{{ docente_jefe.nombres+' '+docente_jefe.apellido_paterno+' '+docente_jefe.apellido_materno }}</label>
				      			</md-chip>
				      		</div>
				      		<div class="col-md-2" style="margin-top:2px">
				      			<md-chip class="md-accent"> <i class="far fa-address-book fa-1x"></i> <strong>Asignaturas:</strong> {{ contar_asignatura+' activas' }}</md-chip>
				      		</div>
				      		<div class="col-md-3" style="margin-top:2px">
				      			<md-chip>Alumnos: {{ contar_alumnos }}</md-chip>
				      		</div>
				      	</div>
				      </div>
			</div>
		</div>
		<br><br><br><br><br>



      </md-tab>
      <md-tab id="tab-pages" md-label="Asignaturas">
      		
      		<div class="card">
      			<div class="card-header">
      				Agregar asignatura
      			</div>
	      		<div class="card-body">
	      				<div class="row">
	      					<div class="col-md-3">
	      						<select v-model="form.asignatura" class="form-control">
	      							<option value=''>Seleccione asignatura..</option>
	      							<option v-for="a in select_asignaturas_json" :value="a.id">{{a.descripcion}}</option>
	      						</select>
	      					</div>
	      					<div class="col-md-3">
	      						<select v-model="form.docente" class="form-control">
	      							<option value=''>Seleccione Docente..</option>
	      							<option v-for="a in select_docente_json" :value="a.docente_id">
	      								{{a.nombres+' '+a.apellido_paterno+' '+a.apellido_materno}}
	      							</option>
	      						</select>
	      					</div>
	      					<div class="col-md-2">
	      						<input v-model="form.horas" type="numeric"  placeholder="Horas de duración" class="form-control" name="">
	      					</div>
	      					<div class="col-md-2">
	      						<md-checkbox v-model="form.jefe" class="md-primary">Jefe de curso</md-checkbox>
	      					</div>
	      					<div class="col-md-2">
	      						<md-button class="md-raised md-primary" :style="'float:left'" @click="register">Crear</md-button>
	      					</div>
	      				</div>
	      		</div>
      		</div>
			<br>
      		<div class="card">
      			<div class="table-responsive">
					  <table class="table">
					    <thead>
					    	<tr style="background:#3F8DF7; color:white">
					    		<td>Asignatura</td>
					    		<td>Docente</td>
					    		<td>Jefe curso</td>
					    	</tr>
					    </thead>
					    <tbody>
					    	<tr v-for="listado in listar_asignatura">
					    		<td>{{ listado.descripcion }}</td>

					    		<td v-if="listado.nombres !=null">{{ listado.nombres+' '+listado.apellido_paterno+' '+listado.apellido_materno }}</td>
					    		<td v-if="listado.nombres ==null"><label style="">Sin Docente</label></td>

					    		<td>{{ listado.jefe_curso }}</td>
					    		
					    		
					    	</tr>
					    </tbody>
					  </table>
					</div>
      		</div>

      </md-tab>
      <md-tab id="tab-posts" md-label="Alumnos">
      	
		<div class="card">
		<div class="card-header">
  				<h5><i class="fas fa-chalkboard-teacher"></i> Lista Alumnos</h5>
  			</div>

  		<div class="card-body">
			
		    <div class="row justify-content-md-center">
				      
				      	
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
					    	<tr v-for="listado in list_cursos">
					    		<td> 
					    			<md-button class="md-icon-button md-raised md-primary">
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


      </md-tab>
      <md-tab id="tab-favorites" md-label="Favorites"></md-tab>
    </md-tabs>
	</div>
</template>

<script>

// import { setConfig } from 'zLoading';

//       setConfig({
//         type: 'circle',
//         size: 100,
//         timeOut: 3000
//       });
	export default{
		data(){
			return{
				isLoading: true,
				curso: this.$route.params.id,
				get_curso:{},
				select_asignaturas_json:{},
				select_docente_json:{},
				form:{
					jefe: false,
					asignatura:'',
					docente:'',
					curso: this.$route.params.id,
					horas:''
				},
				listar_asignatura:{},
				docente_jefe:{
					nombres:'', apellido_paterno:'', apellido_materno:''
				},
				contar_asignatura:'',
				list_cursos:{},
				contar_alumnos:'',
			}
		},
		created(){
			this.traer_inicio();
			this.traer_curso();
			this.select_asignaturas();
			this.select_docentes();
			this.listar_asignaturas();
			this.listar_alumnos();
			
		},
		methods:{
			register(){

				if (this.form.asignatura=='' || this.form.docente=='' || this.form.horas=='') {

					this.$notify({
							  group: 'error',
							  title: 'Alerta',
							  text: 'LLenar todos los campos!',
					});					
					return false;
				}
					axios.post('api/auth/admin/agregarasignatura',this.form).then((res)=>{
						if (res.data == "exists") {
							this.$notify({
							  group: 'error',
							  title: 'Alerta',
							  text: 'Asignatura ya registrado!',
							});
							return false;
						}
						if (res.data == "success") {
							this.$notify({
							  group: 'success',
							  title: 'Alerta',
							  text: 'Docente y curso agregados!',
							});
							this.listar_asignaturas();
							this.traer_inicio();
							////////////////////////////
							return false;
						}
						if (res.data == "failed") {
							this.$notify({
							  group: 'error',
							  title: 'Alerta',
							  text: 'Algo anda mal, revisar bien campos',
							});
							return false;
						}
						if (res.data == "exist_jefe") {
							this.$notify({
							  group: 'error',
							  title: 'Alerta',
							  text: 'Ya hay un jefe en este curso',
							});
							return false;
						}

					});
			},
			traer_inicio(){
				axios.get('api/auth/admin/traer_inicio/'+this.curso).then((res)=>{
					this.docente_jefe = res.data.docentejefe
					this.isLoading=false;
				});
			},
			traer_curso(){
				axios.get('api/auth/admin/perfil_curso/'+this.curso).then((res)=>{
					this.get_curso= res.data;
				});	
			},
			select_asignaturas(){
				axios.get('api/auth/admin/obtener_asignaturas').then((res)=>{
					this.select_asignaturas_json = res.data;
				});
			},
			select_docentes(){
				axios.get('api/auth/admin/obtener_docentes').then((res)=>{
					this.select_docente_json = res.data;
				});
			},
			listar_asignaturas(){
				axios.get('api/auth/admin/listar_asignatura_en_curso/'+this.curso).then((res)=>{
					this.listar_asignatura = res.data;
					this.contar_asignatura = res.data.length;
				});
			},
			listar_alumnos(){
	  			axios.get('api/auth/admin/listaralumno_filter/'+this.curso).then((res)=>{
		            this.list_cursos = res.data;
		            this.contar_alumnos = res.data.length+ ' Activo(s)';
		        })
	  		},

			
		}
	}
</script>