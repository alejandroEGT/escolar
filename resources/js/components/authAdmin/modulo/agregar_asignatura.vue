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
			  </div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				form:{}
			}
		},
		created(){

		},
		methods:{
			register(){
				axios.post('api/auth/admin/crear_asignatura', this.form).then((res)=>{
					this.$notify({
						  group: ''+res.data.tipo+'',
						  title: 'Alerta',
						  text: ''+res.data.mensaje+'',
						});
				});
				if (res.data.tipo == "success") {
					this.form = {};
				}
			}
		}
	}
</script>