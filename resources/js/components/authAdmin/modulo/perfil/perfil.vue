<template>
	<div class="animated fadeIn">
		<div class="card">
			<div class="card-header">
	  				<h5><i class="fas fa-user"></i> Perfil</h5>
	  		</div>

	  		<div class="card-body">
	  			<md-chip><i class="fas fa-school"></i> Establecimiento</md-chip><br><br>
	  			<div class="row justify-content-md-center">
	  				<div class="col-md-3">
	  					<label><strong>Establecimiento:</strong> {{ ob.establecimiento }}
							<a style="color:blue" @click="show('edit_establecimiento')"><i class="far fa-edit"></i></a>
	  					</label>
	  				</div>
	  				<div class="col-md-3">
	  					<label><strong>Dirección:</strong> {{ ob.direccion }}
							<a style="color:blue" @click="show('edit_direccion')"><i class="far fa-edit"></i></a>
	  					</label>
	  				</div>
	  				<div class="col-md-3">
	  					<label><strong>Contacto:</strong> {{ ob.contacto }}
							<a style="color:blue" @click="show('edit_contacto')"><i class="far fa-edit"></i></a>
	  					</label>
	  				</div>
	  				<div class="col-md-3">
	  					<label><strong>Activo</strong> 
	  						<label v-if="ob.estado_cuenta == 'S'"> Si</label>
	  						<label v-if="ob.estado_cuenta == 'N'"> No</label>
	  					</label>
	  				</div>
	  			</div>

	  			<hr>

	  			 <md-chip class="md-primary"><i class="fas fa-user-shield"></i> Administrador</md-chip> <a href=""><i class="far fa-edit"></i></a><br><br>

	  			<div class="row justify-content-md-center">
	  				<div class="col-md-3">
	  					<label><strong>Nombre:</strong> {{ ob.nombres+' '+ob.apellido_paterno+' '+ob.apellido_materno }}

	  					</label>
	  				</div>
	  				<div class="col-md-3">
	  					<label><strong>Email:</strong> {{ ob.email }} <a style="color:blue" @click="show('edit_email')"><i class="far fa-edit"></i></a></label>
	  				</div>
	  				<div class="col-md-3">
	  					<label><strong>Password:</strong> ******* <a style="color:blue" @click="show('edit_password')"><i class="far fa-edit"></i></a></label>
	  				</div>
	  				<div class="col-md-3">
	  					<label><strong>Tipo de usuario:</strong> {{ ob.descripcion }}</label>
	  				</div>
	  			</div>
	  		</div>
	  	</div>

	  	<modal name="edit_establecimiento" width="230" height="130">
	  		<br>
	  		<div class="container">
	  			Editar Establecimiento
				  <div class="row">
					  	<div class="col-md-12">
					  		<input id="edit_establecimiento" type="text" v-model="establecimiento" class="form-control"  >
					    </div>
				  </div>
					
				   <div class="row justify-content-md-center" style="margin-top: 5px">
				   	<div class="col-md-12">
				   		<md-button @click="update_establecimiento" class="md-icon-button md-dense md-raised md-primary">
					        <md-icon><i class="far fa-save"></i></md-icon>

					     </md-button>

					      <md-button @click="hide('edit_establecimiento')" class="md-icon-button md-dense md-raised md-accent">
					        <md-icon><i class="fas fa-times"></i></md-icon>
					      </md-button>
				   	</div>	
				   </div>
	  		</div>
		</modal>
		<modal name="edit_direccion" width="230" height="130">
		  <br>
	  		<div class="container">
	  			Editar Dirección
				  <div class="row">
					  	<div class="col-md-12">
					  		<input id="edit_direccion" type="text" v-model="direccion" class="form-control"  >
					    </div>
				  </div>
				  <div class="row justify-content-md-center" style="margin-top: 5px">
				   	<div class="col-md-12">
				   		<md-button @click="update_direccion" class="md-icon-button md-dense md-raised md-primary">
					        <md-icon><i class="far fa-save"></i></md-icon>

					     </md-button>

					      <md-button @click="hide('edit_direccion')" class="md-icon-button md-dense md-raised md-accent">
					        <md-icon><i class="fas fa-times"></i></md-icon>
					      </md-button>
				   	</div>	
				   </div>
	  		</div>
		</modal>
		<modal name="edit_contacto" width="230" height="130">
		  <br>
	  		<div class="container">
	  			Editar Contacto
				  <div class="row">
					  	<div class="col-md-12">
					  		<input id="edit_contacto" type="text" v-model="contacto" class="form-control" >
					    </div>
				  </div>
				  <div class="row justify-content-md-center" style="margin-top: 5px">
				   	<div class="col-md-12">
				   		<md-button @click="update_contacto" class="md-icon-button md-dense md-raised md-primary">
					        <md-icon><i class="far fa-save"></i></md-icon>

					     </md-button>

					      <md-button @click="hide('edit_contacto')" class="md-icon-button md-dense md-raised md-accent">
					        <md-icon><i class="fas fa-times"></i></md-icon>
					      </md-button>
				   	</div>	
				   </div>
	  		</div>
		</modal>




		<modal name="edit_email" width="230" height="130">
		  <br>
	  		<div class="container">
	  			Editar Email
				  <div class="row">
					  	<div class="col-md-12">
					  		<input id="edit_contacto" type="text" v-model="email" class="form-control" >
					    </div>
				  </div>
				  <div class="row justify-content-md-center" style="margin-top: 5px">
				   	<div class="col-md-12">
				   		<md-button @click="update_email" class="md-icon-button md-dense md-raised md-primary">
					        <md-icon><i class="far fa-save"></i></md-icon>

					     </md-button>

					      <md-button @click="hide('edit_email')" class="md-icon-button md-dense md-raised md-accent">
					        <md-icon><i class="fas fa-times"></i></md-icon>
					      </md-button>
				   	</div>	
				   </div>
	  		</div>
		</modal>
		<modal name="edit_password" width="230" height="230">
		  <br>
	  		<div class="container">
	  			Editar Password
				  <div class="row">
					  	<div class="col-md-12">
					  		<input id="edit_contacto" placeholder="Password actual" type="password" v-model="actual_pass" class="form-control" >
					    </div>
				  </div>
				  <div class="row">
					  	<div class="col-md-12">
					  		<input id="edit_contacto" placeholder="Nueva password" type="password" v-model="new_pass" class="form-control" >
					    </div>
				  </div>
				  <div class="row">
					  	<div class="col-md-12">
					  		<input id="edit_contacto" placeholder="Repita nueva password" type="password" v-model="repeat_pass" class="form-control" >
					    </div>
				  </div>
				  <div class="row justify-content-md-center" style="margin-top: 5px">
				   	<div class="col-md-12">
				   		<md-button @click="update_password" class="md-icon-button md-dense md-raised md-primary">
					        <md-icon><i class="far fa-save"></i></md-icon>

					     </md-button>

					      <md-button @click="hide('edit_password')" class="md-icon-button md-dense md-raised md-accent">
					        <md-icon><i class="fas fa-times"></i></md-icon>
					      </md-button>
				   	</div>	
				   </div>
	  		</div>
		</modal>
		
	</div>
</template>

<script>
	export default{
		data(){
			return{
				ob:{},
				contacto:'',
				establecimiento:'',
				direccion:'',
				email:'',
				actual_pass:'',
				new_pass:'',
				repeat_pass:''
			}
		},
		created(){
			this.obtener_perfil();
		},
		methods:{
			obtener_perfil(){
				axios.get('api/auth/admin/obtener_perfil').then((res)=>{
					this.ob = res.data

					this.contacto = res.data.contacto;
					this.establecimiento = res.data.establecimiento;
					this.direccion = res.data.direccion;

					this.email = res.data.email;

				});
			},
			show ($title) {

			    this.$modal.show(''+$title+'');

			},
			hide ($title) {
			 	this.obtener_perfil();
			    this.$modal.hide(''+$title+'');
			},

			update_establecimiento(){
				axios.post('api/auth/admin/actualizar_perfil',{
					nombre:'establecimiento',
				 	establecimiento: this.establecimiento 
				}).then((res)=>{
					if (res.data.tipo == "success") {
						this.$notify({
						  group: 'success',
						  title: 'Alerta',
						  text: ''+ res.data.mensaje +'',
						});

						this.obtener_perfil();
					}
					if (res.data.tipo == "error")  {
						this.$notify({
						  group: 'error',
						  title: 'Alerta',
						  text: ''+ res.data.mensaje +'',
						});
					}
				});
			},
			update_contacto(){
				axios.post('api/auth/admin/actualizar_perfil',{
					nombre:'contacto',
				 	contacto: this.contacto 
				}).then((res)=>{
					if (res.data.tipo == "success") {
						this.$notify({
						  group: 'success',
						  title: 'Alerta',
						  text: ''+ res.data.mensaje +'',
						});
						this.obtener_perfil();
					}
					if (res.data.tipo == "error")  {
						this.$notify({
						  group: 'error',
						  title: 'Alerta',
						  text: ''+ res.data.mensaje +'',
						});
					}
				});
			},
			update_direccion(){
				axios.post('api/auth/admin/actualizar_perfil',{
					nombre:'direccion',
				 	direccion: this.direccion 
				}).then((res)=>{
					if (res.data.tipo == "success") {
						this.$notify({
						  group: 'success',
						  title: 'Alerta',
						  text: ''+ res.data.mensaje +'',
						});
						this.obtener_perfil();
					}
					if (res.data.tipo == "error")  {
						this.$notify({
						  group: 'error',
						  title: 'Alerta',
						  text: ''+ res.data.mensaje +'',
						});
					}
				});
			},
			update_email(){
				axios.post('api/auth/admin/actualizar_perfil',{
					nombre:'email',
				 	email: this.email 
				}).then((res)=>{
					if (res.data.tipo == "success") {
						this.$notify({
						  group: 'success',
						  title: 'Alerta',
						  text: ''+ res.data.mensaje +'',
						});
						this.obtener_perfil();
					}
					if (res.data.tipo == "error")  {
						this.$notify({
						  group: 'error',
						  title: 'Alerta',
						  text: ''+ res.data.mensaje +'',
						});
					}
				});
			},
			update_password(){
				axios.post('api/auth/admin/actualizar_perfil',{
					nombre:'password',
				 	actual_pass: this.actual_pass,
				 	new_pass : this.new_pass,
				 	repeat_pass: this.repeat_pass 
				}).then((res)=>{
					if (res.data.tipo == "success") {
						this.$notify({
						  group: 'success',
						  title: 'Alerta',
						  text: ''+ res.data.mensaje +'',
						});
						this.obtener_perfil();
					}
					if (res.data.tipo == "error")  {
						this.$notify({
						  group: 'error',
						  title: 'Alerta',
						  text: ''+ res.data.mensaje +'',
						});
					}
				});
			}
		}
	}
</script>