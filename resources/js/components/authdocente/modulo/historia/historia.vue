<template>
	<div>
		<div class="card">
			<div class="card-header">Agregar Actividad</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-3">
						<input maxlength="50" v-model="form.titulo" class="form-control" type="text" name="" placeholder="Titulo">	
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
						<textarea maxlength="50" v-model="form.descripcion" class="form-control form-control-sm"  placeholder="Descripción de la actividad"></textarea>
					</div>
					<div class="col-md-1">
						<center><md-button @click="register" class="md-icon-button md-raised md-primary">
					        <md-icon><i class="fas fa-book"></i></md-icon>
					    </md-button></center>
					</div>
				</div>
				<hr>
				<ul>
    
				<div v-for="l in listar_act">
					<h4>{{ l.cabeza.fecha }}</h4>
					
						<ul class="posit">
						    <li v-for="x in l.cuerpo">
						      <a href="#">
						        <h2>{{x.titulo}}</h2>
						        <p>{{ x.descripcion }}</p>
						      </a>
						    </li>
						</ul>
					<hr>
				</div>
			</ul>
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
    		this.listar()
    	},

    	methods:{
    		register(){
    			axios.post('api/auth/docente/registrar_actividad', this.form).then((res)=>{
    				this.$notify({
						  group: ''+res.data.tipo+'',
						  title: 'Alerta',
						  text: ''+res.data.mensaje+'',
						});
    			});
    			this.listar()
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
	.posit,li{
  list-style:none;
}
.posit{
  overflow:hidden;
  /*padding:3em;*/
}
.posit li a{
	/*margin-left: 10%*/
  text-decoration:none;
  color:#000;
  background:#ffc;
  display:block;
  height:80%;
  width:80%/*12em*/;
  padding:1em;
  -moz-box-shadow:5px 5px 7px rgba(33,33,33,1);
  -webkit-box-shadow: 5px 5px 7px rgba(33,33,33,.7);
  box-shadow: 5px 5px 7px rgba(33,33,33,.7);
  -moz-transition:-moz-transform .15s linear;
  -o-transition:-o-transform .15s linear;
  -webkit-transition:-webkit-transform .15s linear;
}
.posit li{
  margin:1em;
  float:left;
}
.posit li h2{
  font-size:110%;
  font-weight:bold;
  padding-bottom:10px;
}
.posit  li p{
	color:black;
  font-family:"Reenie Beanie",arial,sans-serif;
  font-size:100%;
}
.posit  li a{
  -webkit-transform: rotate(-6deg);
  -o-transform: rotate(-6deg);
  -moz-transform:rotate(-6deg);
}
.posit  li:nth-child(even) a{
  -o-transform:rotate(4deg);
  -webkit-transform:rotate(4deg);
  -moz-transform:rotate(4deg);
  position:relative;
  top:5px;
  background:#cfc;
}
.posit  li:nth-child(3n) a{
  -o-transform:rotate(-3deg);
  -webkit-transform:rotate(-3deg);
  -moz-transform:rotate(-3deg);
  position:relative;
  top:-5px;
  background:#ccf;
}
.posit  li:nth-child(5n) a{
  -o-transform:rotate(5deg);
  -webkit-transform:rotate(5deg);
  -moz-transform:rotate(5deg);
  position:relative;
  top:-10px;
}
.posit  li a:hover,ul li a:focus{
  box-shadow:10px 10px 7px rgba(0,0,0,.7);
  -moz-box-shadow:10px 10px 7px rgba(0,0,0,.7);
  -webkit-box-shadow: 10px 10px 7px rgba(0,0,0,.7);
  -webkit-transform: scale(1.25);
  -moz-transform: scale(1.25);
  -o-transform: scale(1.25);
  position:relative;
  z-index:5;
}
ol{text-align:center;}
ol li{display:inline;padding-right:1em;}
ol li a{color:#fff;}
</style>