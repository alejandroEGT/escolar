<template>
	<div>
		<div class="card">
			<div class="card-header">
				<h5>Permisos</h5>
			</div>
			
			<div class="card-body">
				<div class="row">
					<div class="col-md-5">
						<div class="card" style="">
						  <div class="card-header">
						    Accesos
						  </div>
						  <ul class="list-group list-group-flush" v-for="(l,i) in listar_permisos">
						    <li class="list-group-item">
						    

									<div class="custom-control custom-checkbox">
									  <input name="chk" :id="'check'+i" type="checkbox" class="custom-control-input" :value="l.id">
									  <label class="custom-control-label" :for="'check'+i">
									  {{ l.descripcion }} - <small>({{ l.observacion }})</small></label>
									</div>
							</li>
						    
						  </ul>
						</div>
					</div>

					<div class="col-md-4">
							
							    <md-tabs>
							      <md-tab id="tab-home" md-label="Usuarios">
							      	<select v-model="usuario" class="form-control">
							      		<option value="">Seleccione usuario</option>
							      		<option v-for="d in listar_docentes"  :value="d.user_id">
											{{ d.nombres+' '+d.apellido_paterno+' '+d.apellido_materno }}
							      		</option>
							      	</select>
							      </md-tab>
							      <md-tab id="tab-pages" md-label="Otros"></md-tab>
							   
								    </md-tabs>

								    <md-button @click="register" class="md-raised md-primary">Agregar permiso</md-button>
							</select>
					</div>

				</div>
				<br>


				 <div class="table-responsive">

				      	<!-- <md-button class="md-raised md-primary" @click="url_creardocente">Crear Docente</md-button> -->
					  <table class="table">
					    <thead>
					    	<tr style="background:#3F8DF7; color:white">
					    		<td>Permiso</td>
					    		<td>Nombre</td>
					    		<td>Email</td>
					    		<td>Activo</td>
					    	</tr>
					    </thead>
					    <tbody>
					    	<tr v-for="tb in tb_list">
					    		<td>{{ tb.descripcion }}</td>
					    		<td>{{ tb.nombres+' '+tb.apellido_paterno+''+tb.apellido_materno }}</td>
					    		<td>{{ tb.email }}</td>
					    		<td>{{ tb.activo }}</td>
					    	</tr>
					    </tbody>
					  </table>
					</div>

			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				permiso_id:[],
				listar_permisos:{},
				listar_docentes:{},
				usuario:'',
				tb_list:{}
			}
		},
		created(){
			this.listar();
			this.obtener_docentes();
			this.listar_tabla();
		},
		methods:{
			listar(){
				axios.get('api/auth/admin/listar_permisos').then((res)=>{
					this.listar_permisos = res.data;
				});
			},
			obtener_docentes(){
				axios.get('api/auth/admin/obtener_docentes').then((res)=>{
					this.listar_docentes = res.data;
				});
			},
			register(){
				var yourArray = new Array();
				$("input:checkbox[name=chk]:checked").each(function(){
					    yourArray.push($(this).val());
				});
				const data = {
				  usuario: this.usuario,
				  permiso: yourArray
				};
				
				console.log(data);

				axios.post('api/auth/admin/agregar_permiso', data).then((res)=>{
					
					this.$notify({
						  group: ''+res.data.tipo+'',
						  title: 'Alerta',
						  text: ''+res.data.mensaje+'',
						});
					this.listar_tabla();
					
				});
			},
			listar_tabla(){
				axios.get('api/auth/admin/listar_permisos_user').then((res)=>{
					this.tb_list = res.data;
				});
			}
		}
	}
</script>