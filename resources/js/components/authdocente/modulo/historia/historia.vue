<template>
	<div class="animated fadeIn">
		<div class="card">
			<div class="card-header">Notas</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-4">
						<small><strong>Docente:</strong> {{ user.nombres+' '+user.apellido_paterno+' '+user.apellido_materno }}</small>
					</div>
					<div class="col-md-3">
						<small><strong>Curso:</strong> {{ cur.descripcion }}</small>
					</div>
					<div class="col-md-3">
						<small><strong>Asignatura:</strong> {{ asig.descripcion }}</small>
					</div>
				</div>
				
			</div>
		</div>
		<div class="card">
			<div class="card-header">Agregar Actividad</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3">
						<input maxlength="250" v-model="form.titulo" class="form-control" type="text" name="" placeholder="Titulo">	
					</div>		
					<div class="col-md-3">
						<datepicker 
					        v-model="form.fecha"
					        :language="es" 
					        :bootstrap-styling="true"
					        placeholder="Fecha de actividad"
							format='dd/MM/yyyy'
					    ></datepicker>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-3">
						<textarea maxlength="250" v-model="form.descripcion" class="form-control form-control-sm"  placeholder="Descripción de la actividad"></textarea>
					</div>
					<div class="col-md-1">
						<center><md-button @click="register" class="md-icon-button md-raised md-primary">
					        <md-icon><i class="fas fa-book"></i></md-icon>
					    </md-button></center>
					</div>
				</div>
				<hr>
				
    			
    			<div class="table-responsive">
    				<table class="table">
    					<tr>
    						<td style="width:20%;"><i class="far fa-calendar-alt"></i> Fecha</td>
    						<td><i class="fas fa-thumbtack"></i> Actividad</td>
    					</tr>

    					<tr v-for="l in listar_act">
    						<td>
    							<h5>{{ l.cabeza.fecha }}</h5>
    						</td>
    						<td style="border-left: 1px solid #3498DB">
    							<div v-for="x in l.cuerpo" >
    								<h6>{{x.titulo}} <small style="color:#616A6B">({{ x.cuando }})</small></h6>
						        <p>{{ x.descripcion }}</p><hr>
    							</div>
    						</td>
    					</tr>
    				</table>
    			</div>
				<!-- <div v-for="l in listar_act">
					<h5>{{ l.cabeza.fecha }}</h5>
					
						<ul class="posit">
						    <li v-for="x in l.cuerpo">
						      <a href="#">
						        <h2>{{x.titulo}}</h2>
						        <p>{{ x.descripcion }}</p>
						      </a>
						    </li>
						</ul>
					<hr>
				</div> -->
			
			</div>
		</div>
	</div>
</template>

<script>
	import Datepicker from 'vuejs-datepicker';
    import {en, es} from 'vuejs-datepicker/dist/locale'

    export default{
    	components:{ Datepicker },
    	data(){
    		return{
    			user:{},
    			cur:{},
				asig:{},
    			curso: this.$route.params.curso,
				asignatura: this.$route.params.asignatura,
    			form:{
    				curso: this.$route.params.curso,
					asignatura: this.$route.params.asignatura,
    			},
	  			en: en,
      			es: es,
      			listar_act:{}
    		}
    	},
    	created(){
    		this.user = this.$auth.user();
    		this.listar();
    		this.datos_basicos();
    	},

    	methods:{
    		register(){
    			if ($.trim(this.form.fecha) == "" || $.trim(this.form.descripcion) == "" || $.trim(this.form.titulo) == "") {
    				this.$notify({
						  group: 'error',
						  title: 'Alerta',
						  text: 'Faltan campos por llenar',
						});
    				return false;
    			}
    			axios.post('api/auth/docente/registrar_actividad', this.form).then((res)=>{
    				this.$notify({
						  group: ''+res.data.tipo+'',
						  title: 'Alerta',
						  text: ''+res.data.mensaje+'',
						});

    				this.listar()
    			});
    			
    		},
    		datos_basicos(){
				axios.get('api/auth/docente/datos_basicos/'+this.curso+'/'+this.asignatura).then((res)=>{
					this.cur = res.data.curso;
					this.asig = res.data.asignatura;
				});
			},
    		listar(){
    			axios.get('api/auth/docente/listar_actividad/'+this.curso+'/'+this.asignatura).then((res)=>{
    				this.listar_act = res.data;
    				//this.listar_cuerpo = res.data.cuerpo;

    			});
    		}
    	}
    }
</script>



<style type="text/css">
	/**/
</style>