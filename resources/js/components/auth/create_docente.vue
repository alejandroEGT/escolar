
<template>
  <div class="">

    <div class="row justify-content-md-center">
		    <form novalidate class="md-layout" >
		      

		      <md-card class="">
		        <md-card-header>
		          <div class="md-title"><!-- Formulario --></div>
		        </md-card-header>
				

		       

		         <md-card-content>
		         
		            <h5 class="card-title"><i class="fas fa-chalkboard-teacher fa-2x"></i>
		                 Docente</h5>

					<div class="md-layout md-gutter md-alignment-center">
					    <div class="md-layout-item md-size-25 md-medium-size-30 md-small-size-50 md-xsmall-size-80">
					    	<md-field>
		                 <label>Run</label>
		                 <md-input v-model="form.nombre"></md-input>
		             </md-field>
					    </div>
					    <div class="md-layout-item md-size-10 md-medium-size-10 md-small-size-10 md-xsmall-size-20">
					    	<md-field>
		                 <label>Dv</label>
		                 <md-input v-model="form.nombre"></md-input>
		             </md-field>
					    </div>
					    <div class="md-layout-item">
					    	
		                 <md-datepicker v-model="selectedDate">
					      <label>Fecha de nacimiento</label>
					    </md-datepicker>
		            
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


		           <md-button class="md-raised md-primary" @click="register">Crear Establecimiento</md-button>
		             

		             
		                                    


		            

		             

		             

		                                     
		                      
		                               
		        </md-card-content>
		      </md-card>
		    </form>
	</div>
  </div>
</template>

<script>
  

  export default {
	  	data(){
	  		return{
	  			form:{}
	  		}
	  	},
	  	methods:{
	  		register(){
	  			axios.post('api/auth/sa/crearcuenta', this.form).then((res)=>{
		            
		        })
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
</style>