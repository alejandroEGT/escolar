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
							<a href=""><i class="far fa-edit"></i></a>
	  					</label>
	  				</div>
	  				<div class="col-md-3">
	  					<label><strong>Dirección:</strong> {{ ob.direccion }}
							<a href=""><i class="far fa-edit"></i></a>
	  					</label>
	  				</div>
	  				<div class="col-md-3">
	  					<label><strong>Contacto:</strong> {{ ob.contacto }}
							<a href=""><i class="far fa-edit"></i></a>
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
	  					<label><strong>Email:</strong> {{ ob.email }} <a href=""><i class="far fa-edit"></i></a></label>
	  				</div>
	  				<div class="col-md-3">
	  					<label><strong>Password:</strong> ******* <a href=""><i class="far fa-edit"></i></a></label>
	  				</div>
	  				<div class="col-md-3">
	  					<label><strong>Tipo de usuario:</strong> {{ ob.descripcion }}</label>
	  				</div>
	  			</div>
	  		</div>
	  	</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				ob:{}
			}
		},
		created(){
			this.obtener_perfil();
		},
		methods:{
			obtener_perfil(){
				axios.get('api/auth/admin/obtener_perfil').then((res)=>{
					this.ob = res.data
				});
			}
		}
	}
</script>