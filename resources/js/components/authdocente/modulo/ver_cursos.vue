<template>
	<div class="animated fadeIn">
		<div class="">
			<h3>Mis Cursos</h3>
			<hr>
			<div id="card_lol" class="card " style="width:100%; margin-left: 4px; 
			margin-top:4px; border:none; box-shadow: 5px 5px 25px #222 inset;box-shadow: 2px 2px 10px #666;        /* Sombra normal */
  box-shadow: 5px -5px 0 2px #444;" v-for="listado in listar_cursos" :style="img_section_style">
				<div class="card-body">
					    <h5 class="card-title">{{listado.asignatura}} <small>{{listado.promocion}}</small></h5>
					    <h6 class="card-subtitle mb-2 text-muted">{{listado.descripcion}}</h6>
					    
					    <md-button @click="url_libro(listado.curso_id, listado.asignatura_id)" class="md-icon-button md-raised">
					        <md-icon><i class="fas fa-book"></i></md-icon>
					    </md-button>

					      <md-button @click="url_alumnos(listado.curso_id, listado.asignatura_id)" class="md-icon-button md-raised md-primary">
					        <md-icon><i class="fas fa-users"></i></md-icon>
					      </md-button>

					      <md-button @click="url_historia(listado.curso_id, listado.asignatura_id)" class="md-icon-button md-raised md-accent">
					        <md-icon><i class="fas fa-thumbtack"></i></md-icon>
					      </md-button>

					      <md-button class="md-icon-button md-raised" >
					        <md-icon><i class="fas fa-chart-area"></i></md-icon>
					      </md-button>


					      <md-button @click="url_mensaje(listado.curso_id, listado.asignatura_id)" class="md-icon-button md-raised" >
					        <md-icon><i class="fas fa-envelope"></i></md-icon>
					      </md-button>

					      
			    </div>
			</div>
					      	
		</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				listar_cursos:{}
			}
		},
		created(){
			this.cursos()
		},
		methods:{
			cursos(){
				axios.get('api/auth/docente/mis_cursos').then((res)=>{
					this.listar_cursos = res.data;
				});
			},
			url_libro($curso, $asignatura){
				
				this.$router.push({ name: 'docentelibro', params: { curso: $curso, asignatura:$asignatura }})
			},
			url_alumnos($curso, $asignatura){
				
				this.$router.push({ name: 'alumnos', params: { curso: $curso, asignatura:$asignatura }})
			},
			url_historia($curso, $asignatura){
				
				this.$router.push({ name: 'docentehistoria', params: { curso: $curso, asignatura:$asignatura }})
			},
			url_mensaje($curso, $asignatura){
				this.$router.push({ name: 'docentemensaje', params:{ curso: $curso, asignatura:$asignatura } });
			}
		},
		computed: {
            img_section_style: function(){
            	var bgImg="https://static.rfstat.com/renderforest/images/v2/logo-homepage/bg-bottom-right.svg"
                // var bgImg= "https://media.istockphoto.com/videos/soft-background-blue-loopable-video-id656234942?s=640x640"/*"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQLScrhnHLqmeyJOawurq_DxtYyCOmJzsi3OPuwFBWSQnORPWuJA"/*"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeVz1N3HAKFw2bJtxZSnGDHUZZ5M4CHGdJOFckagmT3m-TS_5S"/*"https://rlv.zcache.com/wavy_teal_aqua_blue_spripes_label-r68f3d96569964f51ac304e6859e334e5_v11mb_8byvr_307.jpg?rvtype=content"*/

                //this.isLoading = false;
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