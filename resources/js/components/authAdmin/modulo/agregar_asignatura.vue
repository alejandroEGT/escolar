<template>
	<div class="animated fadeIn">
		<div class="container">

		    <div class="card">
				<div class="card-header">
	  				<h5><i class="fas fa-plus-square"></i> Agregar asignatura</h5>
	  			</div>
			  <div class="card-body">
					
					<div class="row">
				  		<div class="col-md-2">
				  			<input v-model="form.asignatura" type="text" placeholder="Asignatura"class="form-control"  name="">
				  		</div>
				  		<div class="col-md-2">
				  			<input v-model="form.observacion" type="text" placeholder="Observacion"class="form-control"  name="">
				  		</div>
				  		<div class="col-md-2">
				  			 <md-button class="md-raised md-primary" :style="'float:left'" @click="register">Crear</md-button>
				  		</div>
					</div>
					<br>
					<div class="table-responsive">
						 <table class="table">
						    <thead>
						    	<tr style="background:#3F8DF7; color:white">
						    		<td>ID</td>
						    		<td>Nombre</td>
						    		<td>Descripción</td>
						    		<td>Activo</td>
						    		<!-- <td>Direccion</td>
						    		<td>Activo</td> -->
						    	</tr>
						    </thead>
						    <tbody>
						    	<tr v-for="listado in listar_asignaturas">
						    		<td>{{ listado.id}}</td>
									
									<td>{{ listado.descripcion }}</td>
						    		<td>{{ listado.observacion }}</td>
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
	export default{
		data(){
			return{
				form:{},
				listar_asignaturas:{}
			}
		},
		created(){
			this.listar()
		},
		methods:{
			register(){
				axios.post('api/auth/admin/crear_asignatura', this.form).then((res)=>{
					this.listar()
					this.$notify({
						  group: ''+res.data.tipo+'',
						  title: 'Alerta',
						  text: ''+res.data.mensaje+'',
						});
				});
				if (res.data.tipo == "success") {
					this.form = {};
				}
			},
			listar(){
				axios.get('api/auth/admin/obtener_asignaturas').then((res)=>{
					this.listar_asignaturas = res.data;
				});
			}
		}
	}
</script>