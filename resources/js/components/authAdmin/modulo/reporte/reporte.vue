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
					    <h5 class="card-title">Alumnos</h5>
					    <!-- <h6 class="card-subtitle mb-2 text-muted">kkck</h6> -->
					    
					     <select class="form-control">
					     	<option value="">Seleccione año</option>
					     	<option value="2018" >2018</option>
					     	<option value="2019" >2019</option>
					     </select>

					     <select class="form-control">
					     	<option value="">Seleccione Curso</option>
					     	<option v-for="c in cursos" :value="c.id" >{{ c.descripcion+' - '+c.nivel_educativo}}</option>
					     	
					     </select>


					      <md-button @click="url_mensaje(listado.curso_id, listado.asignatura_id)" class="md-icon-button md-raised" >
					        <md-icon><i class="fas fa-envelope"></i></md-icon>
					      </md-button>

					      
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
				cursos:{}
			}
		},
		created(){
			this.listar_cursos()
		},	
		methods:{
			listar_cursos(){
				axios.get('api/auth/admin/listarcurso').then((res)=>{
					this.cursos = res.data
				})
			}
		},
		computed: {
            img_section_style: function(){
            	var bgImg="https://static.rfstat.com/renderforest/images/v2/logo-homepage/bg-bottom-right.svg"
                // var bgImg= "https://media.istockphoto.com/videos/soft-background-blue-loopable-video-id656234942?s=640x640"/*"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQLScrhnHLqmeyJOawurq_DxtYyCOmJzsi3OPuwFBWSQnORPWuJA"/*"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeVz1N3HAKFw2bJtxZSnGDHUZZ5M4CHGdJOFckagmT3m-TS_5S"/*"https://rlv.zcache.com/wavy_teal_aqua_blue_spripes_label-r68f3d96569964f51ac304e6859e334e5_v11mb_8byvr_307.jpg?rvtype=content"*/

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