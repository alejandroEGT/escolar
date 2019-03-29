
<template>
  <div class="">
  	<div class="card" style="width: 100%;">
		  <div class="card-body">
		    <h5 class="card-title">Crear Docente</h5>
		    <h6 class="card-subtitle mb-2 text-muted"><br></h6>
		    <div class="row">
		   		<div class="col-md-2">
		   			
		   			<input class="form-control form-control-sm"  type="text" placeholder="Run (Sin puntos ni guion)">
		   			<br>
		   		</div>
		   		<div class="col-md-2">
		   			<input class="form-control form-control-sm" type="date" placeholder="fecha">
		   		</div>
		   		
		   </div>
		   <div class="row">
		   		<div class="col-md-2">
		   			<input class="form-control form-control-sm" type="text" placeholder="Nombres"><br>
		   		</div>
		   		<div class="col-md-2">
		   			<input class="form-control form-control-sm" type="text" placeholder="Apellidos paterno">
		   		</div>
		   		<div class="col-md-2">
		   			<input class="form-control form-control-sm" type="text" placeholder="Apellido materno">
		   		</div>
		   </div>
		    <div class="row">
		   		<div class="col-md-2">
		   			<input class="form-control form-control-sm" type="text" placeholder="Contacto">
		   		</div>
		   		<div class="col-md-2">
		   			<input class="form-control form-control-sm" type="text" placeholder="Email">
		   		</div>
		   		<div class="col-md-2">
		   			<input class="form-control form-control-sm" type="text" placeholder="Password">
		   		</div>
		   </div>
			<br>
		    <button class="btn btn-primary btn-block">Guardar</button>
		    <!-- <a href="#" class="btn btn-primary">Another link</a> -->
		  </div>
	</div>
   
  </div>
</template>

<script>
  	
  export default {
  		components: {
        	
    	},
	  	data(){
	  		return{
	  			form:{},
	  			selectedDate: null,
	  			date:'',

	  		}
	  	},
	  	created(){
	  		 
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