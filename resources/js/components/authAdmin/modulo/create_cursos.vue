<template>
	<div class="container">
		<div class="card">
  <div class="card-body">
		<div class="row">
		            <div class="col-md-2">
		              <input type="text" class="form-control form-control-md" v-model="form.descripcion" placeholder="Descripcion" name="">
		            </div>

		            <div class="col-md-2">
		            	<select class="form-control form-control-md" id="inlineFormCustomSelect">
					        <option selected>Año de promoción</option>
					        <option value="2019">2019</option>
					        <option value="2020">2020</option>
					        <!-- <option value="3">Three</option> -->
					      </select>
		            </div>
		             <div class="col-md-3">
		     		
		            	<multiselect v-model="value" :options="options" :custom-label="nameWithLang" placeholder="Asignar Docente (Opcional)" label="name" track-by="name"></multiselect>
		            
		            </div>
		            <div class="col-md-2">
		            	<center><md-button class="md-raised md-primary" @click="register">Crear Curso/grado</md-button></center>
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
				form:{},
				value: null,
				selectedCountry:null,
				value: '',
			    options: [
			        { name: 'Vue.js', language: 'JavaScript' },
			        { name: 'Rails', language: 'Ruby' },
			        { name: 'Sinatra', language: 'Ruby' },
			        { name: 'Laravel', language: 'PHP' },
			        { name: 'Phoenix', language: 'Elixir' }
			    ]
				 
			}
		},
		created(){

		},
		methods:{

			nameWithLang ({ name, language }) {
		      return `${name} — [${language}]`
		    },
			
			register(){

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