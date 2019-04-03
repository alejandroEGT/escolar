<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-5">
      	<md-card :style="img_section_style">
            <md-card-header>
              <md-card-header-text>
                <div class="md-title">Cursos</div>
                <div class="md-subhead">23 cursos</div>
              </md-card-header-text>

              <md-card-media>
                <img src="/img/5c9fa6a68a4fd97597dbd45301ae7ae2.jpg" alt="People">
              </md-card-media>
            </md-card-header>

            <md-card-actions>
              <md-button @click="url_crearcurso" class="md-raised md-primary">Crear</md-button>
              
            </md-card-actions>
          </md-card>
        <!-- <md-card :style="img_section_style">
      <md-card-header>
        <md-card-header-text>
          <div  class="md-title">Calendario</div>
          <div class="md-subhead">3 actividades</div>
        </md-card-header-text>

        <md-card-media>
          <img src="https://banner2.kisspng.com/20171207/18c/creative-calendar-5a28e1b3507c76.7509526315126286593297.jpg" alt="People">
        </md-card-media>
      </md-card-header>

      <md-card-actions>
        <md-button class="md-raised md-primary">Ver</md-button>
        
      </md-card-actions>
    </md-card> -->
      </div>
      <div class="col-md-4">
          <md-card :style="img_section_style">
            <md-card-header>
              <md-card-header-text>
                <div class="md-title">Docentes</div>
                <div class="md-subhead">12 docentes</div>
              </md-card-header-text>

              <md-card-media>
                <img src="https://vignette.wikia.nocookie.net/central/images/6/64/Docentes.png/revision/latest?cb=20180523012406" alt="People">
              </md-card-media>
            </md-card-header>

            <md-card-actions>
              <md-button @click="url_listardocente" class="md-raised md-primary">Ver</md-button>
              <md-button @click="url_creardocente" class="md-raised md-primary">Crear</md-button>
              
            </md-card-actions>
          </md-card>
      </div>
      <div class="col-md-4">
        <md-card :style="img_section_style">
          <md-card-header>
            <md-card-header-text>
              <div class="md-title">Alumnos</div>
              <div class="md-subhead">120 alumnos</div>
            </md-card-header-text>

            <md-card-media>
              <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqk2WM9qtSs1phshNVV_GSWMTHAegEUSDlvI7woYVM9Jpf-aIo" alt="People">
            </md-card-media>
          </md-card-header>

          <md-card-actions>
          	<md-button class="md-raised md-primary" @click="url_listaralumno">Ver</md-button>
            <md-button class="md-raised md-primary" @click="url_crearalumno">Crear</md-button>
            
          </md-card-actions>
        </md-card>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
         <!-- <md-card :style="img_section_style">
            <md-card-header>
              <md-card-header-text>
                <div class="md-title">Cursos</div>
                <div class="md-subhead">23 cursos</div>
              </md-card-header-text>

              <md-card-media>
                <img src="/img/5c9fa6a68a4fd97597dbd45301ae7ae2.jpg" alt="People">
              </md-card-media>
            </md-card-header>

            <md-card-actions>
              <md-button @click="url_crearcurso" class="md-raised md-primary">Crear</md-button>
              
            </md-card-actions>
          </md-card> -->
      </div>
      <div class="col-md-4">
          <!-- <md-card :style="img_section_style">
            <md-card-header>
              <md-card-header-text>
                <div class="md-title">Cuentas</div>
                <div class="md-subhead">23 cursos</div>
              </md-card-header-text>

              <md-card-media>
                <img src="https://hyipsoftware.com/wp-content/uploads/2016/02/admin.png" alt="People">
              </md-card-media>
            </md-card-header>

            <md-card-actions>
              <md-button @click="url_listarcuenta" class="md-raised md-primary">Ver</md-button>
              <md-button @click="url_crearcuenta" class="md-raised md-primary">Crear</md-button>
              
            </md-card-actions>
          </md-card> -->
      </div>
      <div class="col-4">
        
      </div>
    </div>
  </div>
</template>

<script>
  export default{

     methods:{
       url_creardocente(){
         this.$router.push('admincreardocente'); 
       },
       url_crearcurso(){
        this.$router.push('admincrearcurso');
       },
       url_listardocente(){
         this.$router.push('listardocente'); 
       },
       url_listarcuenta(){
         this.$router.push('listarcuenta'); 
       },
       url_listardocente(){
	         this.$router.push('adminlistardocente'); 
	   },
	   url_crearalumno(){
	         this.$router.push('admincrearalumno'); 
	   },
	   url_listaralumno(){
	         this.$router.push('adminlistaralumno'); 
	   }
     } 
     ,
     computed: {
            img_section_style: function(){
                var bgImg= "https://media.istockphoto.com/videos/soft-background-blue-loopable-video-id656234942?s=640x640"/*"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQLScrhnHLqmeyJOawurq_DxtYyCOmJzsi3OPuwFBWSQnORPWuJA"/*"https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTeVz1N3HAKFw2bJtxZSnGDHUZZ5M4CHGdJOFckagmT3m-TS_5S"/*"https://rlv.zcache.com/wavy_teal_aqua_blue_spripes_label-r68f3d96569964f51ac304e6859e334e5_v11mb_8byvr_307.jpg?rvtype=content"*/
                return {
                    // "color": "red",
                    // "border" : "5px solid ",
                    "background": 'url('+bgImg+')'
                }
            },
}
  }
</script>

