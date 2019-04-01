
<template>
  <div class="">

    <div class="row justify-content-md-center">
		    <form novalidate class="md-layout" >
		      

		      <md-card class="">
		        <md-card-header>
		          <div class="md-title"></div>
		        </md-card-header>
				

		       

		         <md-card-content>
		         
		            <h5 class="card-title"><i class="fas fa-chalkboard-teacher fa-2x"></i>
		                 Docente</h5>

					<div class="md-layout md-gutter ">
					    <div class="md-layout-item md-size-25  md-xsmall-size-50">
					    	<md-field>
				                 <label>Run</label>
				                 <md-input v-model="form.run"></md-input>
				             </md-field>
					    </div>
					    <div class="md-layout-item md-size-10 md-xsmall-size-20">
					    	<md-field>
		                 <label>Dv</label>
		                 <md-input v-model="form.dv"></md-input>
		             </md-field>
					    </div>
					    

					    <div class="md-layout-item">
					    	<md-field>
				                 <label for="movie">Sexo</label>
				                 <md-select v-model="form.sexo" name="sexo" >
				                        <md-option value="F">Femenino</md-option>
				                        <md-option value="M">Masculino</md-option>
				                 </md-select>
				             </md-field>
					    </div>

					    <div class="md-layout-item">
					    	
		                 <md-field>
				                 <label for="movie">Fecha nacimiento</label>
				                 <!-- <md-input placeholder="Fecha nacimiento" v-model="form.nacimiento" type="date"></md-input> -->
				                 <datepicker 
				                 v-model="form.nacimiento"
				                 :language="es" 
				                 input-class="sinbordefondo" 
				                 placeholder="Fecha nacimiento"
								 format='dd/MM/yyyy'
				                 ></datepicker>
				             </md-field>
							
				             <!-- <input type="date" placeholder="My Placeholder"> -->
		            		
					    </div>
					</div>

					<div class="md-layout md-gutter">
					    <div class="md-layout-item">
					    	 <md-field>
				                 <label>Nombres</label>
				                 <md-input v-model="form.nombre"></md-input>
				             </md-field>
					    </div>
					    <div class="md-layout-item">
					    	<md-field>
				                 <label>Apellido Paterno</label>
				                    <md-input v-model="form.apellido_p" ></md-input>
				             </md-field>
					    </div>
					    <div class="md-layout-item">
					    	 <md-field>
		                 <label>Apellido Materno</label>
			                 <md-input v-model="form.apellido_m"></md-input>
			             </md-field>
					    </div>
					 </div>

					 <div class="md-layout md-gutter">
					 	 <div class="md-layout-item">
					    	 <md-field>
				                 <label>Contacto</label>
				                 <md-input v-model="form.contacto" type="text"></md-input>
				             </md-field>
					    </div>
					    <div class="md-layout-item">
					    	<md-field>
				                   <label>Email</label>
				                   <md-input v-model="form.email"></md-input>
				             </md-field>
					    </div>
					    <div class="md-layout-item">
					    	 <md-field>
				                 <label>Password</label>
				                 <md-input v-model="form.password" type="password"></md-input>
				             </md-field>
					    </div>
					   
					  </div>


		           <md-button class="md-raised md-primary" :style="'float:left'" @click="register">Crear Docente</md-button>
		           <md-button class="md-raised " @click="url_listardocente">Lista Docente</md-button>
		                          
		                               
		        </md-card-content>
		      </md-card>
		    </form>

		    
		    <br><br><br><br>Los Docentes ingresados se ven en la parte superior de su pantalla
	</div>
  </div>
</template>

<script>
 import Datepicker from 'vuejs-datepicker';
 import {en, es} from 'vuejs-datepicker/dist/locale'
  export default {
  		components: {
    		Datepicker
  		},
	  	data(){
	  		return{
	  			form:{},
	  			en: en,
      			es: es
	  		}
	  	},
	  	
	  	created(){

	  	},
	  	methods:{
	  		register(){
	  			axios.post('api/auth/sa/creardocente', this.form).then((res)=>{
		            
		        })
	  		},
	  		url_listardocente(){
	         this.$router.push('listardocente'); 
	       }
	  	}
    }
</script>

<style lang="scss" scoped>
  .md-progress-bar {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
  }

  input[type="date"]:before {
   content: attr(placeholder) !important;
   color: rgba(0,0,0,.4);
   margin-right: 0.5em;
   display:block;
 }

/* Your cool style */
body{
  background-color:rgba(0,0,0,.1);
}
input[type="date"]{
  padding:10px 5px 10px 5px;
  border:0px;
  border-bottom:1px solid rgba(0,0,0,.1);
  margin:auto;
  display:block;
  background-color:transparent;
  outline:0;
}

.sinbordefondo {
  background-color: #eee;
  border: 0;
}
</style>