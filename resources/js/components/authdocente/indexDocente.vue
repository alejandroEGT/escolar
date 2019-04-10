<template>
	<div class="animated fadeIn" v-zLoading:circle.fullscreen="isLoading">
	    <div class="row">
	      <div class="col-md-4 col-sm-5">

	      		<md-card :style="img_section_style">
		            <md-card-header>
		              <md-card-header-text>
		                <div class="md-title">Mis Cursos</div>
		                <div class="md-subhead">(2019)</div>
		              </md-card-header-text>

		              <md-card-media>
		                <img src="/images/school-3.png" alt="People">
		              </md-card-media>
		            </md-card-header>

		            <md-card-actions>
		              <md-button @click="url_curso" class="md-raised md-primary">Ver</md-button>
		              
		            </md-card-actions>
		          </md-card>
	      </div>
	  	</div>
	</div>
</template>

<script>
	export default{
		data(){
			return{
				isLoading:true,
			}
		},
		created(){
			this.isLoading = false;
		},
	    methods:{
	    	url_curso(){
	    		this.$router.push({path:'/docentecurso'}); 
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