
<template>
  <div class="container">
    <form novalidate class="md-layout" >
      

      <md-card class="">
        <md-card-header>
          <div class="md-title"><i class="fas fa-chalkboard-teacher"></i> Crear Docente</div>
        </md-card-header>

       

         <md-card-content>
          <div>
          	<div class="container">
				  <div class="row">
				    <div class="col-sm-2">
				      <md-field>
					      <label>Run</label>
					      <md-input v-model="form.run"></md-input>
					    </md-field>
				    </div>
				    <div class="col-sm-1">
				      <md-field>
					      <label>Dv</label>
					      <md-input v-model="form.dv"></md-input>
					    </md-field>
				    </div>
				    <div class="col-sm-3">
				     	<md-field>
					      <label>Nombre</label>
					      <md-input v-model="form.nombre"></md-input>
					    </md-field>
				    </div>
				    <div class="col-sm-3">
				     	<md-field>
					      <label>Apellido 1</label>
					      <md-input v-model="form.apellido_p"></md-input>
					    </md-field>
				    </div>
				    <div class="col-sm-3">
				     	<md-field>
					      <label>Apellido 2</label>
					      <md-input v-model="form.apellido_m"></md-input>
					    </md-field>
				    </div>
				  </div>

				  <div class="row">
				  	<div class="col-md-3">
				  		 <div>
						    <md-datepicker v-model="selectedDate" />
						    <md-field>
						      <label for="movie">First day of a week</label>
						      <md-select v-model="firstDayOfAWeek">
						        <md-option value="0">Sunday</md-option>
						        <md-option value="1">Monday</md-option>
						      </md-select>
						      <span class="md-helper-text">This config is global.</span>
						    </md-field>
						  </div>
				  	</div>
				  </div>
			</div>
          <!-- 	<input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
          	<input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
          	<input class="form-control form-control-sm" type="text" placeholder=".form-control-sm">
          	<input class="form-control form-control-sm" type="text" placeholder=".form-control-sm"> -->
          </div>

          
        </md-card-content>
      </md-card>
    </form>
  </div>
</template>

<script>
  

  export default {
	  	data(){
	  		return{
	  			form:{},
	  			selectedDate: null
	  		}
	  	},
	  	methods:{
	  		userSaved(){

	  		}
	  	},
	  	computed:{
	  		firstDayOfAWeek: {
        get () {
          return this.$material.locale.firstDayOfAWeek
        },
        set (val) {
          this.$material.locale.firstDayOfAWeek = val
        }
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