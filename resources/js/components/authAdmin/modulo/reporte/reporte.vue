<template>
	<div>
		<div class="card">
			<div class="card-header">
				Reportes
			</div>
			<div class="card-body">
				<div id="card_lol" class="card " style="width:100%; margin-left: 4px; 
			margin-top:4px; border:none; box-shadow: 5px 5px 25px #222 inset;box-shadow: 2px 2px 10px #666; /* Sombra normal */
  			box-shadow: 5px -5px 0 2px #444;" :style="img_section_style">
				<div class="card-body">
					    <h5 class="card-title">Curso</h5>
					    <!-- <h6 class="card-subtitle mb-2 text-muted">kkck</h6> -->
					    
					     <select v-model="anio" @change="listar_cursos" class="form-control">
					     	<option value="">Seleccione año</option>
					     	<option v-for="a in anios" :value="a.anio" >{{a.anio}}</option>
					     </select>

					     <select v-model="cur" class="form-control">
					     	<option value="">Seleccione Curso</option>
					     	<option v-for="c in cursos" :value="c.id" >{{ c.descripcion+' - '+c.nivel_educativo+' '+c.promocion}}</option>
					     	
					     </select>


					      <md-button class="md-raised md-primary" @click="url_repocurso">Buscar</md-button>

					      
			    </div>
			</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				anio:'',
				cur:'',
				cursos:{},
				anios:{},
				token: this.$route.params.token,
			}
		},
		created(){
			this.traer_anios();
			this.validar_token();
			//this.listar_cursos();
		},	
		methods:{
			validar_token(){
				if(localStorage.getItem("token") === null){ 
					this.$router.push({path:'/admin'}); 
				}
				if(localStorage.getItem("token") != this.token){ 
					this.$router.push({path:'/admin'}); 
				}

			},
			listar_cursos(){
				axios.get('api/auth/admin/listarcurso_promo/'+this.anio).then((res)=>{
					this.cursos = res.data
				})
			},
			url_repocurso(){
				this.$router.push({name:'reportecurso', params:{ 
					anio: encodeURI(this.anio), 
					curso: encodeURI(this.cur)
				}});
			},
			traer_anios(){
				axios.get('api/auth/anios').then((res)=>{
					this.anios = res.data;
				});
			}
		},
		computed: {
            img_section_style: function(){
            	var bgImg="https://static.rfstat.com/renderforest/images/v2/logo-homepage/bg-bottom-right.svg"
           

	                this.isLoading = false;
	                return {
	                    // "color": "red",
	                    // "border" : "5px solid ",
	                    "background": 'url('+bgImg+')',
	                    "background-size": "100%"
	                }
	            },
	    }
	}
</script>