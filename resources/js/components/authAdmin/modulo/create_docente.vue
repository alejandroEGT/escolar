<template>
	<div class="animated fadeIn">
		<div class="">

		    <div class="card">
				<div class="card-header">
	  				<h5><i class="fas fa-chalkboard-teacher"></i> Crear Docente</h5>
	  			</div>
			  <div class="card-body">
			  	<div class="row ">
			  		<div class="col-md-2" >
			  			<input v-model="form.run" placeholder="Run" type="text"  class="form-control" style="width:102px; float: left; margin-right:5px">
			  			<input v-model="form.dv" placeholder="D" type="" name="" class="form-control" style="width:40px">
			  		</div>
			  		<div class="col-md-2">
			  			<select v-model="form.sexo"  class="form-control form-control-md" id="inlineFormCustomSelect">
						        <option value="">Seleccione sexo..</option>
						        <option value="M">Masculino</option>
						        <option value="F">Femenino</option>
						        <!-- <option value="3">Three</option> -->
						</select>
			  		</div>
			  		<div class="col-md-2">
			  			<datepicker 
					        v-model="form.nacimiento"
					        :language="es" 
					        :bootstrap-styling="true"
					        placeholder="Fecha nacimiento"
							format='dd/MM/yyyy'
					    ></datepicker>
			  		</div>
			  	</div>
				<br>
			  	<div class="row">
			  		<div class="col-md-2">
			  			<input v-model="form.nombre" type="text" placeholder="Nombres"class="form-control"  name="">
			  		</div>
			  		<div class="col-md-2">
			  			<input v-model="form.apellido_p" type="text" placeholder="Apellido paterno"class="form-control"  name="">
			  		</div>
			  		<div class="col-md-2">
			  			<input v-model="form.apellido_m" type="text" placeholder="Apellido materno" class="form-control" name="">
			  		</div>
			  	</div>
				<br>
			  	<div class="row">
			  		<div class="col-md-2">
			  			<input v-model="form.contacto" type="text" placeholder="Contacto"class="form-control"  name="">
			  		</div>
			  		<div class="col-md-2">
			  			<input v-model="form.email" type="text" placeholder="Email" class="form-control"  name="">
			  		</div>
			  		<div class="col-md-2">
			  			<input v-model="form.password"  type="password" placeholder="Password" class="form-control" name="">
			  		</div>
			  	</div>
			  	<br>
			  	 <md-button class="md-raised md-primary" :style="'float:left'" @click="register">Crear</md-button>
			           <md-button class="md-raised " @click="url_listardocente">Listar</md-button>
			  </div>
			</div>
		</div>
	</div>
</template>

<script>
import Datepicker from 'vuejs-datepicker';
 import {en, es} from 'vuejs-datepicker/dist/locale'
	export default{
		components: {
    		Datepicker
  		},
  		data(){
	  		return{
	  			form:{ sexo:''},
	  			en: en,
      			es: es
	  		}
	  	},
	  	methods:{
	  		register(){
	  			axios.post('api/auth/admin/creardocente', this.form).then((res)=>{
		            if (res.data == 'success') {
		            	this.form = {};

		            	this.$notify({
						  group: 'success',
						  title: 'Alerta',
						  text: 'Docente Registrado!',
						});
		            }
		        })
	  		},
	  		url_listardocente(){
	          this.$router.push('adminlistardocente'); 
	        }
	  	}
	}
</script>