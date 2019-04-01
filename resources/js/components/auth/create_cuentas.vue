
<template>
  <div class="">

    <div class="row justify-content-md-center">
		    <form novalidate class="md-layout" >
		      

		      <md-card class="">
		        <md-card-header>
		          <div class="md-title">Crear Establecimiento</div>
		        </md-card-header>
				

		       

		         <md-card-content>
		          <div class="md-layout md-gutter">
		            <div class="md-layout-item md-small-size-100">
		              <md-field >
		                <label for="first-name">Establecimiento</label>
		                <md-input name="first-name" id="first-name"  v-model="form.establecimiento" />
		                
		              </md-field>
		            </div>

		            <div class="md-layout-item md-small-size-100">
		              <md-field >
		                <label for="last-name">Dirección</label>
		                <md-input name="last-name" id="last-name"  v-model="form.direccion"  />
		               
		              </md-field>
		            </div>
		             <div class="md-layout-item md-small-size-100">
		              <md-field >
		                <label for="last-name">Contacto</label>
		                <md-input name="last-name" id="last-name"  v-model="form.contacto"  />
		               
		              </md-field>
		            </div>
		          </div>

		          
		         
		                                    <h5 class="card-title"><i class="fas fa-user-shield fa-2x"></i>
		                                          Administrador</h5>
		                                    <md-field>
		                                          <label>Nombres</label>
		                                          <md-input v-model="form.nombre"></md-input>
		                                     </md-field>
		                                     <md-field>
		                                          <label>Apellido Paterno</label>
		                                          <md-input v-model="form.apellido_p" ></md-input>
		                                     </md-field>
		                                     <md-field>
		                                          <label>Apellido Materno</label>
		                                          <md-input v-model="form.apellido_m"></md-input>
		                                     </md-field>
		                                     <md-field>
		                                          <label for="movie">Sexo</label>
		                                          <md-select v-model="form.sexo" name="sexo" >
		                                            <md-option value="F">Femenino</md-option>
		                                            <md-option value="M">Masculino</md-option>
		                                          </md-select>
		                                    </md-field>
		                                    
		                                    <md-field>
		                                          <label>Email</label>
		                                          <md-input v-model="form.email"></md-input>
		                                     </md-field>

		                                      <md-field>
		                                        <label>Password</label>
		                                        <md-input v-model="form.password" type="password"></md-input>
		                                      </md-field>

		                                      <md-field>
		                                        <label>Fecha nacimiento</label>
		                                        <md-datepicker v-model="selectedDate" />
		                                      </md-field>

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