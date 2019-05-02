<template>  	
<div >
	<div class="card">
			<div class="card-header">
  				<h5><i class="fas fa-user-graduate"></i>Administrar {{curso_txt}}</h5>
  			</div>
		  <div class="card-body">
		  </div>
    </div>

  	<div class="table-responsive">
  		 
					<md-button class="md-raised md-primary" @click="show('add_alumno')">Crear Alumno</md-button>

					<modal :name="'add_alumno'" height="auto" :scrollable="true">
								      	<div>
								      		<div class="card">
												<div class="card-header">
									  				<h5><i class="fas fa-user-graduate"></i>Crear Alumno</h5>
									  			</div>
											  <div class="card-body">
											  	
											  	<h6>(Obligatorio)</h6>
												<hr>

											  	<div class="row">
											  		<div class="col-md-3">
											  			<input v-model="form.nombre" type="text" placeholder="Nombres"class="form-control"  name="">
											  		</div>
											  		<div class="col-md-3">
											  			<input v-model="form.apellido_p" type="text" placeholder="Apellido paterno"class="form-control"  name="">
											  		</div>
											  		<div class="col-md-3">
											  			<input v-model="form.apellido_m" type="text" placeholder="Apellido materno" class="form-control" name="">
											  		</div>
											  		<div class="col-md-3">
											  			<select v-model="form.sexo"  class="form-control form-control-md" id="inlineFormCustomSelect">
														       <option value="">Sexo</option>
														        <option value="M">Masculino</option>
														        <option value="F">Femenino</option>
														        <!-- <option value="3">Three</option> -->
														</select>
											  		</div>
											  		
											  	</div>
												<br>
												<h6>(Opcional)</h6>
												<hr>
											  	<div class="row">
											  		<div class="col-md-3" >
											  			<input v-model="form.run" placeholder="Run" type="text"  class="form-control" >
											  			
											  		</div>
											  		<div class="col-md-3">
											  			<datepicker 
													        v-model="form.nacimiento"
													        :language="es" 
													        :bootstrap-styling="true"
													        placeholder="Fecha nacimiento"
															format='dd/MM/yyyy'
													    ></datepicker>
											  		</div>
											  		<div class="col-md-3">
											  			<input v-model="form.direccion" type="text" placeholder="Dirección"class="form-control"  name="">
											  		</div>
											  		<div class="col-md-2">
											  			<!-- <select v-model="form.curso"  class="form-control form-control-md" id="inlineFormCustomSelect">
														       <option value="">Curso...</option>
														        <option v-for="c in cursos" :value="c.id">{{ c.descripcion }}</option>
														        
														        
														</select> -->
											  		</div>
											  		
											  	</div>
											  </div>
											</div>

		  									<br>
		  	 								<md-button class="md-raised md-primary" :style="'float:left'" @click="register">Crear</md-button>
		  	 								<md-button class="md-raised" :style="'float:left'" @click="hide('add_alumno')">Cancelar</md-button>

		  	 								<br><br><br><br><br><br><br><br><br><br><br>
								      	</div>
								      </modal>
					  <table v-if="btb_add_alumnos"  class="table">
					    <thead>
					    	<tr style="background:#3F8DF7; color:white">
					    		<td></td>
					    		<td>Nombre</td>
					    		<td>Run</td>
					    		<td>Direccion</td>
					    		<td>Activo</td>
					    	</tr>
					    </thead>
					    <tbody>
					    	<tr v-for="(listado, i) in list_cursos">
					    		<td> 
					    			  <div class="row">
					    			  	<div class="col-md-4">
					    			  		<md-button @click="show(listado.alumno_id)" class="md-icon-button md-raised md-primary">
								        <md-icon><i class="fas fa-eye"></i></md-icon>
								      </md-button>
								      
					    			  	</div>
					    			  	<div class="col-md-4">
					    			  		<md-button data-toggle="modal" :data-target="'#modal'+listado.alumno_id" class="md-icon-button md-raised md-primary">
								        <md-icon><i class="fas fa-clipboard-check"></i></md-icon>
								      </md-button>
					    			  	</div>
					    			  </div>
										<!-- Modal -->
										<div class="modal fade" :id="'modal'+listado.alumno_id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
										  <div class="modal-dialog" role="document">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h5 class="modal-title" id="exampleModalLongTitle">Documentos</h5>
										        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
										          <span aria-hidden="true">&times;</span>
										        </button>
										      </div>
										      <div class="modal-body">
										        <ul class="nav nav-tabs" id="myTab" role="tablist">
												  <li class="nav-item">
												    <a class="nav-link active" id="documento-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
												  </li>
												  <li class="nav-item">
												    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
												  </li>
												  <li class="nav-item">
												    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
												  </li>
												</ul>
												<div class="tab-content" id="myTabContent">
												  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="documento-tab">
												  	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
												  	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
												  	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
												  	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
												  	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
												  	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
												  </div>
												  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
												  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
												</div>
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
										        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
										      </div>
										    </div>
										  </div>
										</div>




								      <modal :name="''+listado.alumno_id" :adaptive="true" width="90%" height="90%">
								      	<div>
								      		<div class="card">
													<div class="card-header">
										  				<h5><i class="fas fa-user-graduate"></i>Datos del alumno</h5>
										  			</div>
												  <div class="card-body">
									      		<md-tabs class="md-transparent" md-alignment="fixed">
											      <md-tab id="tab-home" md-label="Alumno">
											      	<div>
											      	  <p>Nombre: <input class="form-control" type="text" v-model="listado.nombre"></p>
											      	  <p>Apellido paterno: <input class="form-control" type="text" v-model="listado.apellido_paterno"></p>
											      	 <p>Apellido materno: <input class="form-control" type="text" v-model="listado.apellido_materno"></p>
											      	  <p>Run: <input class="form-control" type="text" v-model="listado.run" placeholder="Ingrese run.."></p>
											      	   <p>Direccion: <input class="form-control" type="text" v-model="listado.direccion" placeholder="Ingrese dirección.."></p>
											      	</div>

											      </md-tab>
											      <md-tab id="tab-pages" md-label="Apoderado" @click="view_apo(listado.alumno_id)">

											      	<div class="card">
											      		<div class="card-header">
											      			Lista de apoderado
											      		</div>
											      		<div class="card-body">
											      			 <div class="table-responsive">

															  <table class="table">
															    <thead>
															    	<tr style="background:#3F8DF7; color:white">
															    		<td>Nombre</td>
															    		<td>Email</td>
															    		<!-- <td>Contacto</td> -->
															    		<td>Activo</td>
															    	</tr>
															    </thead>
															    <tbody>
															    	<tr v-for="listado in list_apo">
															    		<td><img height="50" width="50" :src="'/'+listado.avatar"> {{ listado.nombres+' '+listado.apellido_paterno+' '+listado.apellido_materno }}</td>
															    		<td>{{ listado.email }}</td>
															    		
															    		<td>{{ listado.activo }}</td>
															    	</tr>
															    </tbody>
															  </table>
															</div>
											      		</div>
											      	</div>
											      </md-tab>
											      <md-tab id="tab-posts" md-label="Crear Apoderado">
											      	<div class="card">
											      		<div class="card-header">
											      			Crear apoderado
											      		</div>
											      		<div class="card-body">	
															<input v-model="apod.nombres" type="text" class="form-control" placeholder="Nombres">
															<input v-model="apod.apellido_p" type="text" class="form-control" placeholder="Apellido Paterno">
															<input v-model="apod.apellido_m" type="text" class="form-control" placeholder="Apellido Materno">
															<input v-model="apod.email" type="email" class="form-control" 
															placeholder="Email">
															<!-- <input v-model="apod.contacto" type="numeric"> -->
																<md-button @click="agregar_apo(listado.alumno_id)" class="md-raised md-primary">Crear</md-button>

											      		</div>
											      	</div>
											      </md-tab>
											      
											    </md-tabs>
											</div>
										</div>
								      	</div>
								      </modal>
								</td>
								
								<!-- <td>
									{{ listado.descripcion }}
								</td> -->

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
</template>

<script>
 import Datepicker from 'vuejs-datepicker';
 import {en, es} from 'vuejs-datepicker/dist/locale'
	export default{
		components:{Datepicker},
		data(){
			return{
				
				list_cursos:{},
				contar_alumnos:{},
				curso: this.$route.params.curso,
				curso_txt: this.$route.params.texto,
				btb_add_alumnos:false,
				form:{
	  				nombre:'', apellido_p:'', apellido_m:'',
	  				sexo:'', curso: this.$route.params.curso, direccion:'', nacimiento:'', run:''},
	  			en: en,
      			es: es,
      			apod:{
      				nombres:'', apellido_p:'', apellido_m:'', email:'', alumno:''
      			},
      			list_apo:{}
			}
		},
		created(){

			this.listar_alumnos();
		},
		methods:{
			listar_alumnos(){
	  			axios.get('api/auth/docente/listar_alumno_jcurso/'+this.curso).then((res)=>{
		            this.list_cursos = res.data;
		            this.contar_alumnos = res.data.length+ ' Activo(s)';

		            if (res.data.length > 0) {
		            	this.btb_add_alumnos = true;
		            	
		            }
		        })
	  		},
	  		show ($title) {

			    this.$modal.show(''+$title+'');

			},
			hide ($title) {
			 	this.listar_alumnos()
			    this.$modal.hide(''+$title+'');
			},
			url_crearalumno(){

			},
			register(){
	  			axios.post('api/auth/admin/crearalumno', this.form).then((res)=>{
		            if (res.data == 'success') {
		            	this.form = {
		            		nombre:'', apellido_p:'', apellido_m:'',
	  						sexo:'', curso:this.$route.params.curso, direccion:'', nacimiento:'', run:''};
		           		}

		           		this.$notify({
						  group: 'success',
						  title: 'Alerta',
						  text: 'Alumno Registrado!',
						});
					this.listar_alumnos()

		        })
	  		},
	  		agregar_apo($alumno){
	  			this.apod.alumno = $alumno;
	  			axios.post('api/auth/admin/crearapoderado', this.apod).then((res)=>{
	  				if(res.data.tipo === "success"){
		  				this.$notify({
							  group: ''+res.data.tipo+'',
							  title: 'Alerta',
							  text: ''+res.data.mensaje+'',
							});
		  				this.apod = {
		  					nombres:'', apellido_p:'', apellido_m:'', email:'', alumno:''
		  				}
	  				}
	  			});
	  		},
	  		view_apo($al){
	  			this.listar_apoderado($al);
	  		},
	  		listar_apoderado($alumno){
	  			axios.get('api/auth/admin/listar_apoderado/'+$alumno+'/'+this.curso ).then((res)=>{
	  				this.list_apo = res.data;
	  			});
	  		}
		}
	}
</script>