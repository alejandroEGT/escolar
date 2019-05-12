<template>
	<div class="animated fadeIn" v-zLoading:circle.fullscreen="isLoading">
		<br>
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
	       <div class="col-md-4 col-sm-5">

	      		<md-card :style="img_section_style">
		            <md-card-header>
		              <md-card-header-text>
		                <div class="md-title">Chat <i style="color:green" :class="''+icon+''"></i> </div>
		                <div class="md-subhead">(2019)</div>
		              </md-card-header-text>

		              <md-card-media>
		                <img src="/images/chat.png" alt="People">
		              </md-card-media>
		            </md-card-header>

		            <md-card-actions>
		              <md-button @click="url_chat" class="md-raised md-primary">Ver</md-button>
		              
		            </md-card-actions>
		          </md-card>
	      </div>
	      <div class="col-md-4 col-sm-5">

	      		<md-card :style="img_section_style">
		            <md-card-header>
		              <md-card-header-text>
		                <div class="md-title">Actividades</div>
		                <div class="md-subhead">(2019)</div>
		              </md-card-header-text>

		              <md-card-media>
		                <img src="/images/school-3.png" alt="People">
		              </md-card-media>
		            </md-card-header>

		            <md-card-actions>
		              <md-button @click="url_historial" class="md-raised md-primary">Ver</md-button>
		              
		            </md-card-actions>
		          </md-card>
	      </div>
	      
	  	</div>
	  	<div class="row">
	      	<div class="col-md-4 col-sm-5">
	      		<md-card :style="img_section_style">
		            <md-card-header>
		              <md-card-header-text>
		                <div class="md-title">Escala de notas</div>
		                <div class="md-subhead">(2019)</div>
		              </md-card-header-text>

		              <md-card-media>
		                <img src="/images/school-3.png" alt="People">
		              </md-card-media>
		            </md-card-header>

		            <md-card-actions>
		              <md-button @click="url_escalanotas" class="md-raised md-primary">Ver</md-button>
		              
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
				icon:''
			}
		},
		created(){
			this.isLoading = false;

			Echo.private('chat.'+this.$auth.user().id).listen('MessageSentEvent', (e) => {
            if(e.message.id_user_recibe == this.$auth.user().id){

                      var audio = new Audio('http://soundbible.com/mp3/Elevator Ding-SoundBible.com-685385892.mp3');
                      audio.play();
                      this.icon='fas fa-comment'
                        
                  }
                                    
          }); 

		},
	    methods:{
	    	url_curso(){
	    		this.$router.push({path:'/docentecurso'}); 
	    	},
	    	url_chat(){
	    		this.$router.push({path:'/docentechat'}); 
	    	},
	    	url_historial(){
	    		this.$router.push({path:'/docenteactividades'}); 
	    	},
	    	url_escalanotas(){
	    		this.$router.push({path:'/escalanotas'}); 
	    	},

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