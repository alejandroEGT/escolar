<template>
	<div>
		<div class="card">
			<div class="card-header">Agregar Actividad</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3">
						<input class="form-control form-control-sm" type="text" name="" placeholder="Titulo">	
					</div>		
					<div class="col-md-3">
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
					<div class="col-md-3">
						<textarea class="form-control form-control-sm"  placeholder="Descripción de la actividad"></textarea>
					</div>
					<div class="col-md-1">
						<center><md-button class="md-icon-button md-raised md-primary">
					        <md-icon><i class="fas fa-book"></i></md-icon>
					    </md-button></center>
					</div>
				</div>
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
    			form:{},
	  			en: en,
      			es: es
    		}
    	},
    	created(){

    	},

    	methods:{

    	}
    }
</script>