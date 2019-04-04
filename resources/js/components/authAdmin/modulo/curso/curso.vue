<template>
	<div>
		<div class="container table-responsive">
			<div class="row">
				<div class="col-md-5" style="">
					<i class="fas fa-cube fa-3x"></i>
					 <md-chip><label style="font-size: 20px">
					 	<strong>{{ 'Curso/'+get_curso.descripcion }}
					 		<small>{{get_curso.promocion}}</small>
					 	</strong>
					 </label></md-chip>
					
				</div>
			</div>
		</div>
		<br>
		<md-tabs>
      <md-tab id="tab-home" md-label="Inicio">
      	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
      	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
      	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
      	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
      	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
      	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
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
					    		<td>{{ listado.nombres+' '+listado.apellido_paterno+' '+listado.apellido_materno }}</td>
					    		<td>{{ listado.jefe_curso }}</td>
					    		
					    		
					    	</tr>
					    </tbody>
					  </table>
					</div>
      		</div>

      </md-tab>
      <md-tab id="tab-posts" md-label="Alumnos"></md-tab>
      <md-tab id="tab-favorites" md-label="Favorites"></md-tab>
    </md-tabs>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				curso: this.$route.params.id,
				get_curso:{},
				select_asignaturas_json:{},
				select_docente_json:{},
				form:{
					jefe: false,
					asignatura:'',
					docente:'',
					curso: this.$route.params.id
				},
				listar_asignatura:{}
			}
		},
		created(){
			this.traer_curso();
			this.select_asignaturas();
			this.select_docentes();
			this.listar_asignaturas();
		},
		methods:{
			register(){
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
				});
			}
		}
	}
</script>