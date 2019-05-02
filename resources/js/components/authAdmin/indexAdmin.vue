<template>
  <div class="animated fadeIn" v-zLoading:circle.fullscreen="isLoading">
    <div class="row">
      <div class="col-md-4 col-sm-5">
      	<md-card :style="img_section_style">
            <md-card-header>
              <md-card-header-text>
                <div class="md-title">Cursos</div>
                <div class="md-subhead">{{ curso }} cursos (2019)</div>
              </md-card-header-text>

              <md-card-media>
                <img src="/images/school-3.png" alt="People">
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
                <div class="md-subhead">{{ docente }} docentes (2019)</div>
              </md-card-header-text>

              <md-card-media>
                <img src="/images/user.png" alt="People">
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
              <div class="md-subhead">{{ alumno }} alumnos (2019)</div>
            </md-card-header-text>

            <md-card-media>
              <img src="/images/user-2.png" alt="People">
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
          <md-card :style="img_section_style">
            <md-card-header>
              <md-card-header-text>
                <div class="md-title">Permisos</div>
                <!-- <div class="md-subhead">23 cursos</div> -->
              </md-card-header-text>

              <md-card-media>
                <img src="/images/secure.png" alt="People">
              </md-card-media>
            </md-card-header>

            <md-card-actions>
              <md-button @click="show('password')"  class="md-raised md-primary">Entrar</md-button>
             
              
            </md-card-actions>
          </md-card>
      </div>
      <div class="col-md-4">
        <md-card :style="img_section_style">
            <md-card-header>
              <md-card-header-text>
                <div class="md-title">Conducta</div>
                <!-- <div class="md-subhead">23 cursos</div> -->
              </md-card-header-text>
  
              <md-card-media>
                <img src="/images/success.png" alt="People">
              </md-card-media>
            </md-card-header>

            <md-card-actions>
              <md-button @click="url_vercomport"  class="md-raised md-primary">Ver</md-button>
              <md-button @click="url_crearcomport"  class="md-raised md-primary">Crear</md-button>
            </md-card-actions>
          </md-card>
      </div>

      <div class="col-md-4">
        <md-card :style="img_section_style">
            <md-card-header>
              <md-card-header-text>
                <div class="md-title">Reportes</div>
                <!-- <div class="md-subhead">23 cursos</div> -->
              </md-card-header-text>
  
              <md-card-media>
                <img src="/images/data.png" alt="People">
              </md-card-media>
            </md-card-header>

            <md-card-actions>
              <md-button @click="show('password_repor')"   class="md-raised md-primary">Entrar</md-button>
             
            </md-card-actions>
          </md-card>
      </div>
    </div>

    <modal name="password" width="300" height="230">
      <br>
        <div class="container">
          Valide su password para acceder
          <div class="row">
              <div class="col-md-12">
                <input id="edit_contacto" placeholder="Ingrese su Password" type="password" v-model="pass" class="form-control" >
              </div>
          </div>
          
          
          <div class="row justify-content-md-center" style="margin-top: 5px">
            <div class="col-md-12">
              <md-button @click="url_permiso" class="md-icon-button md-dense md-raised md-primary">
                  <md-icon><i class="far fa-check-circle"></i></md-icon>

               </md-button>

                <md-button @click="hide('password')" class="md-icon-button md-dense md-raised md-accent">
                  <md-icon><i class="fas fa-times"></i></md-icon>
                </md-button>
            </div>  
           </div>
        </div>
    </modal>
    <modal name="password_repor" width="300" height="230">
      <br>
        <div class="container">
          Valide su password para acceder
          <div class="row">
              <div class="col-md-12">
                <input id="edit_contacto" placeholder="Ingrese su Password" type="password" v-model="pass" class="form-control" >
              </div>
          </div>
          
          
          <div class="row justify-content-md-center" style="margin-top: 5px">
            <div class="col-md-12">
              <md-button @click="url_permiso_repor" class="md-icon-button md-dense md-raised md-primary">
                  <md-icon><i class="far fa-check-circle"></i></md-icon>

               </md-button>

                <md-button @click="hide('password')" class="md-icon-button md-dense md-raised md-accent">
                  <md-icon><i class="fas fa-times"></i></md-icon>
                </md-button>
            </div>  
           </div>
        </div>
    </modal>
  </div>
</template>

<script>
  export default{
  	data(){
  		return{
  			isLoading:true,

  			curso:'',
  			docente:'',
  			alumno:'',
        pass:'',
  		}
  	},
  	created(){
  		this.contar_elementos()
  	},
     methods:{

       contar_elementos(){
        axios.get('api/auth/admin/contar_elementos').then((res)=>{
          	this.curso = res.data.curso;
          	this.docente = res.data.docente;
          	this.alumno = res.data.alumno;
        })
       },
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
  	   },
       url_crearcomport(){
            this.$router.push('creaconducta');
       },
       url_vercomport(){
           this.$router.push('verconducta');
       },
       url_permiso($redirect){
           
           axios.get('api/auth/admin/validar_pass/'+this.pass).then((res)=>{
              if (res.data == '1') {
                this.$router.push('adminpermiso');
              }
           });
                
       },
       url_permiso_repor(){
          axios.get('api/auth/admin/validar_pass/'+this.pass).then((res)=>{
              if (res.data == '1') {
                this.$router.push('adminreporte');
              }
           });
       },
       show ($title) {

          this.$modal.show(''+$title+'');

       },
       hide ($title) {
          this.obtener_perfil();
            this.$modal.hide(''+$title+'');
       },
     } 
     ,
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

