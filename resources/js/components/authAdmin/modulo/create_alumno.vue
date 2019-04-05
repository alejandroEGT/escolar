<template>
	<div class="animated fadeIn">
	<div class="container">

	    <div class="card">
			<div class="card-header">
  				<h5><i class="fas fa-user-graduate"></i>Crear Alumno</h5>
  			</div>
		  <div class="card-body">
		  	<div class="row ">
		  		<!-- <div class="col-md-2" >
		  			<input v-model="form.run" placeholder="Run" type="text"  class="form-control" style="width:102px; float: left; margin-right:5px">
		  			<input v-model="form.dv" placeholder="D" type="" name="" class="form-control" style="width:40px">
		  		</div> -->
		  		
		  		<!-- <div class="col-md-2">
		  			<datepicker 
				        v-model="form.nacimiento"
				        :language="es" 
				        :bootstrap-styling="true"
				        placeholder="Fecha nacimiento"
						format='dd/MM/yyyy'
				    ></datepicker>
		  		</div> -->
		  	</div>
		  	<h6>(Obligatorio)</h6>
			<hr>

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
		  		<div class="col-md-2">
		  			<select v-model="form.sexo"  class="form-control form-control-md" id="inlineFormCustomSelect">
					       <option value="">Sexo</option>
					        <option value="M">Masculino</option>
					        <option value="F">Femenino</option>
					        <!-- <option value="3">Three</option> -->
					</select>
		  		</div>
		  		<div class="col-md-2">
		  			<select v-model="form.curso"  class="form-control form-control-md" id="inlineFormCustomSelect">
					       <option value="">Curso...</option>
					        <option v-for="c in cursos" :value="c.id">{{ c.descripcion }}</option>
					        
					        
					</select>
		  		</div>
		  	</div>
			<br>
			<h6>(Opcional)</h6>
			<hr>
		  	<div class="row">
		  		<div class="col-md-2" >
		  			<input v-model="form.run" placeholder="Run" type="text"  class="form-control" >
		  			
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
		  		<div class="col-md-2">
		  			<input v-model="form.direccion" type="text" placeholder="Dirección"class="form-control"  name="">
		  		</div>
		  		<div class="col-md-2">
		  			<!-- <select v-model="form.curso"  class="form-control form-control-md" id="inlineFormCustomSelect">
					       <option value="">Curso...</option>
					        <option v-for="c in cursos" :value="c.id">{{ c.descripcion }}</option>
					        
					        
					</select> -->
		  		</div>
		  		
		  	</div>
		  	<br>
		  	 <md-button class="md-raised md-primary" :style="'float:left'" @click="register">Crear</md-button>
		           <md-button class="md-raised " @click="url_listaralumno">Listar</md-button>
		           <br><br><br>  <br><br><br> 
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
	  			form:{
	  				nombre:'', apellido_p:'', apellido_m:'',
	  				sexo:'', curso:'', direccion:'', nacimiento:'', run:''},
	  			en: en,
      			es: es,
      			cursos:{}
	  		}
	  	},
	  	created(){
	  		this.obtener_cursos()
	  		
	  	},
	  	methods:{
	  		register(){
	  			axios.post('api/auth/admin/crearalumno', this.form).then((res)=>{
		            if (res.data == 'success') {
		            	this.form = {
		            		nombre:'', apellido_p:'', apellido_m:'',
	  						sexo:'', curso:'', direccion:'', nacimiento:'', run:''};
		           		}

		           		this.$notify({
						  group: 'success',
						  title: 'Alerta',
						  text: 'Alumno Registrado!',
						});

		        })
	  		},
	  		url_listaralumno(){
			    this.$router.push('adminlistaralumno'); 
		    },
	        obtener_cursos(){
	  			axios.get('api/auth/admin/obtener_curso').then((res)=>{
		            
		            	this.cursos = res.data;
		            
		        })
	  		},
	  	}
	}
</script>