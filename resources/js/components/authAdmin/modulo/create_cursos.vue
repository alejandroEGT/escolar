<template>
	<div class="animated fadeIn">
		<div class="container">
			<div class="card">
				<div class="card-header">
	  				<h5><i class="fas fa-graduation-cap"></i> Crear Curso / Grado</h5>
	  			</div>
			  <div class="card-body">
					<div class="row">
			            <div class="col-md-2">
			              <input type="text" class="form-control form-control-md" v-model="form.descripcion" placeholder="Descripcion" name="">
			            </div>
						<div class="col-md-2">
			            	<select v-model="form.nivel" class="form-control form-control-md" id="inlineFormCustomSelect">
						        <option value="">Seleccione nivel..</option>
						        <option value="E. BÁSICA">E. BÁSICA</option>
						        <option value="E. MEDIA">E. MEDIA</option>
						        <hr>
						        <option value="PRIMARIA">Primaria</option>
						        <option value="SECUNDARIA">Secundaria</option>
						        <!-- <option value="3">Three</option> -->
						      </select>
			            </div>
			            <div class="col-md-2">
			            	{{form.promocion}}
			            </div>
			            <!--  <div class="col-md-3">
			     		
			            	<multiselect v-model="form.docente" :options="options" :custom-label="nameWithLang" placeholder="Asignar Docente (Opcional)" label="name" track-by="name"></multiselect>
			            
			            </div> -->
			            <div class="col-md-3">
			            	 <md-radio v-model="form.formato" :value="1"><small>Semestre</small></md-radio>
	    					 <md-radio v-model="form.formato" :value="2"><small>Trimestre</small></md-radio>
			            </div>
			            <div class="col-md-2">
			            	<md-button class="md-raised md-primary" @click="register">Crear</md-button>
			            </div>

			             
			          </div>
			                                    
			                                  
			     </div>
			 </div>


			 <div class="card">
				<div class="card-header">
	  				<h5><i class="fas fa-clipboard-list"></i> Lista Curso / Grado</h5>
	  			</div>
			  <div class="card-body">

			  		<div class="table-responsive">

					      	
						  <table class="table">
						    <thead>
						    	<tr style="background:#3F8DF7; color:white">
						    		<td>Descripción</td>
						    		<td>Nivel Educativo</td>
						    		<td>Promoción</td>
						    		<td>Formato</td>
						    		<td></td>
						    		<!-- <td>Email</td>
						    		<td>Contacto</td>
						    		<td>Activo</td> -->
						    	</tr>
						    </thead>
						    <tbody>
						    	<tr v-for="listado in listar_cursos">
						    		<td>
						    			<md-chip class="md-primary" md-clickable @click="url_curso(listado.id)">
						    				{{listado.descripcion}}
						    			</md-chip>
						    		</td>
						    		<td>{{ listado.nivel_educativo }}</td>
						    		<td>{{listado.promocion}}</td>
						    		<td v-if="listado.formato_id  == 1">Semestral</td>
						    		<td v-if="listado.formato_id  == 2">Trimestral</td>
						    		<td>
						    			<md-button @click="eliminar_curso(listado.id)" class="md-icon-button md-dense md-raised md-accent">
									        <md-icon><i class="fas fa-times"></i></md-icon>
									      </md-button>
						    		</td>
						    		<!-- <td>{{ listado.email }}</td>
						    		<td>{{ listado.contacto }}</td>
						    		<td>{{ listado.activo }}</td> -->
						    	</tr>
						    </tbody>
						  </table>
						</div>
			  </div>
			</div>
		</div>
	</div>
</template>

<script type="text/javascript">
import Multiselect from 'vue-multiselect'
	export default{
		components: {
		    Multiselect
		},
		data(){
			return{
				form:{
					promocion:'', nivel:''
					
				},
				radio: false,
				value: null,
				selectedCountry:null,
				value: '',
			    options: [
			        { name: 'Vue.js', language: 'JavaScript' },
			        { name: 'Rails', language: 'Ruby' },
			        { name: 'Sinatra', language: 'Ruby' },
			        { name: 'Laravel', language: 'PHP' },
			        { name: 'Phoenix', language: 'Elixir' }
			    ],
			    listar_cursos:{}
			    }
		},
		created(){
			this.listar();
			this.get_anio_actual();
		},
		methods:{

			nameWithLang ({ name, language }) {
		      return `${name} — [${language}]`
		    },
		    get_anio_actual(){
		    	axios.get('api/anio_actual').then((res)=>{
		    		this.form.promocion = res.data;
		    	});
		    },
			
			register(){
				axios.post('api/auth/admin/creacurso', this.form).then((res)=>{
					if (res.data == 'success') {
						this.form = {};
						this.form.promocion = '2019';

						this.listar();
					}
				});
			},
			listar(){
				axios.get('api/auth/admin/listarcurso').then((res)=>{
					this.listar_cursos = res.data;
				});
			},
			url_curso($curso){
				this.$router.push({ name: 'curso', params: { id: $curso }})
			},
			eliminar_curso($curso){
				var conf = confirm('¿Quieres Desactivar este curso?, no podras ver este curso en otros lados');

				if (conf == true) {
					axios.get('api/auth/admin/delete_curso/'+$curso).then((res)=>{
						this.listar();
					});
				}else{
					alert("Nada paso")
				}
			}
		}
	}
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style >
	.multiselect__tags {
    height: 10px;
	}
	/*span.multiselect__option.multiselect__option--highlight {
    background: white;
    color:black;
	}
	.multiselect__option{ display: show; background: red}.multiselect__option--highlight{display: show; background: white}*/
</style>