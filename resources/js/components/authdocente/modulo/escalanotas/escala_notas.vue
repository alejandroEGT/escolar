<template>
	<div class="animated fadeIn">
		<div class="card">
			<div class="card-header">
				Escala de notas
			</div>
			<div class="card-body">

			     <div class="row">
			     	<div class="col-md-1">
			     		<label>Nota minima</label>
			     		<input type="numeric" @keypress="soloNumeros" class="form-control form-control-sm" v-model="form.minima" value="10" name=""><br>
			     		
			     	</div>
			     	<div class="col-md-1">
			     		<label>Nota maxima</label>
			     		<input type="numeric" @keypress="soloNumeros" class="form-control form-control-sm" v-model="form.maxima" value="70" name=""><br>
			     	</div>
			     	<div class="col-md-1">
			     		<label>Nota aprovación</label>
			     		<input type="numeric" @keypress="soloNumeros" class="form-control form-control-sm" v-model="form.aprovacion" value="40"  name=""><br>
			     	</div>
			     	<div class="col-md-1">
			     		<label>Puntaje minimo</label>
			     		<input type="numeric" @keypress="soloNumeros" class="form-control form-control-sm" v-model="form.puntaje_minimo" value="0" name=""><br>
			     	</div>
			     	<div class="col-md-1">
			     		<label>Puntaje máximo</label>
			     		<input type="numeric" @keypress="soloNumeros" class="form-control form-control-sm" v-model="form.puntaje_maximo" value="100" name=""><br>
			     	</div>
			     	<div class="col-md-1">
			     		<label>Exigencia(% porcentaje)</label>
			     		<input type="numeric" @keypress="soloNumeros" class="form-control form-control-sm" v-model="form.exigencia" value="60" name=""><br>
			     	</div>
			     	<div class="col-md-1">
			     		<md-button @click="register" class="md-fab md-primary">
					        <md-icon>add</md-icon>
					     </md-button>
			     	</div>
			     </div>

			     <table class="table table-responsive">
			     	<tr>
			     		<td>Puntaje</td>
			     		<td>Nota</td>
			     	</tr>
			     	<tr v-for="t in tabla">
			     		<td>{{ t.puntaje }}</td>
			     		<td>{{ t.nota }}</td>
			     	</tr>
			     </table>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				form:{
					minima:10,
					maxima:70,
					aprovacion:40,
					puntaje_minimo:0,
					puntaje_maximo:100,
					incremento:1,
					exigencia:60
				},
				tabla:[]
			}
		},
		created(){
			
		},
		methods:{
			register(){
				axios.post('api/auth/registrar_escalanota', this.form).then((res)=>{
					this.tabla = res.data;
				});
			},
			show ($title) {
			    this.$modal.show(''+$title+'');
			},
		    hide ($title) {
			    this.$modal.hide(''+$title+'');
	    	},
	    	soloNumeros(e){
			    var key = window.event ? e.which : e.keyCode;
			    if (key < 48 || key > 57) {
			        //Usando la definición del DOM level 2, "return" NO funciona.
			        e.preventDefault();
			    }
			}
		}
	}
</script>