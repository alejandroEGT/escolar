

   <!-- <template >
  <div  class="page-container" v-if="$auth.check()">

    <header class="header">
  <a href="" class="logo">CSS Nav</a>
  <input class="menu-btn" type="checkbox" id="menu-btn" />
  <label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
  <ul class="menu">
    <li><a href="#work">Our Work</a></li>
    <li><a href="#about">About</a></li>
    <li><a href="#careers">Careers</a></li>
    <li><a href="#contact">Contact</a></li>
  </ul>
</header>
        <div style="height:100%">
                 <router-view :key="$route.path"></router-view>  
              </div>
      
  </div>
</template> -->

<template>
	<md-app md-mode="reveal">
      <md-app-toolbar class="md-primary">

        <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
            <md-avatar>
          <img :src="'/'+user.avatar" alt="Avatar">
        </md-avatar>
          <!-- <md-icon>menu</md-icon> -->
        </md-button>
       
        <span class="md-title">{{establecimiento}} (<small>{{ user.nombres+' '+user.apellido_paterno+' '+user.apellido_materno }}</small>)</span>
      </md-app-toolbar>

      <md-app-drawer :md-active.sync="menuVisible">
        <md-toolbar class="md-transparent" md-elevation="0">Menu</md-toolbar>

        <md-list>
         <md-list-item>
            <md-icon><i class="fas fa-user"></i></md-icon>
            <span class="md-list-item-text" @click="url_perfil">Perfil</span>
         </md-list-item>
          <md-list-item>
            <md-icon><i class="fas fa-home"></i></md-icon>
            <span class="md-list-item-text" @click="url_">Inicio</span>
          </md-list-item>
          <md-list-item>
            <md-icon>move_to_inbox</md-icon>
            <span class="md-list-item-text" @click="logout">Salir</span>
          </md-list-item>

         <!--  <md-list-item>
            <md-icon><i class="fas fa-plus-square"></i></md-icon>
            <span class="md-list-item-text" @click="url_addAsignatura">Agregar Asignatura</span>
          </md-list-item> -->

          <md-list-item v-if="coun_curs_jefe > 0">
	            <md-tabs>
			      <md-tab id="tab-home" md-label="Jefe de cursos">
			      	
			      	<div v-for="c in j_curso">
			      		<button @click="url_jcurso(c.curso_id, c.descripcion)" class="btn btn-link">{{ c.descripcion }}</button>
			      	</div>

			      </md-tab>
			      
			    </md-tabs>
          </md-list-item>

          <md-list-item>
            <md-icon>error</md-icon>
            <span class="md-list-item-text">Spam</span>
          </md-list-item>
        </md-list>
      </md-app-drawer>

      <md-app-content>
        <div style="height:100%">
                 <router-view :key="$route.path"></router-view>  
              </div>
      </md-app-content>
    </md-app>
</template>

<style>
 .header {
  background-color: #fff;
  box-shadow: 1px 1px 4px 0 rgba(0,0,0,.1);
  position: fixed;
  width: 100%;
  z-index: 3;
}

.header ul {
  margin: 0;
  padding: 0;
  list-style: none;
  overflow: hidden;
  background-color: #fff;
}

.header li a {
  display: block;
  padding: 20px 20px;
  border-right: 1px solid #f4f4f4;
  text-decoration: none;
}

.header li a:hover,
.header .menu-btn:hover {
  background-color: #f4f4f4;
}

.header .logo {
  display: block;
  float: left;
  font-size: 2em;
  padding: 10px 20px;
  text-decoration: none;
}

/* menu */

.header .menu {
  clear: both;
  max-height: 0;
  transition: max-height .2s ease-out;
}

/* menu icon */

.header .menu-icon {
  cursor: pointer;
  display: inline-block;
  float: right;
  padding: 28px 20px;
  position: relative;
  user-select: none;
}

.header .menu-icon .navicon {
  background: #333;
  display: block;
  height: 2px;
  position: relative;
  transition: background .2s ease-out;
  width: 18px;
}

.header .menu-icon .navicon:before,
.header .menu-icon .navicon:after {
  background: #333;
  content: '';
  display: block;
  height: 100%;
  position: absolute;
  transition: all .2s ease-out;
  width: 100%;
}

.header .menu-icon .navicon:before {
  top: 5px;
}

.header .menu-icon .navicon:after {
  top: -5px;
}

/* menu btn */

.header .menu-btn {
  display: none;
}

.header .menu-btn:checked ~ .menu {
  max-height: 240px;
}

.header .menu-btn:checked ~ .menu-icon .navicon {
  background: transparent;
}

.header .menu-btn:checked ~ .menu-icon .navicon:before {
  transform: rotate(-45deg);
}

.header .menu-btn:checked ~ .menu-icon .navicon:after {
  transform: rotate(45deg);
}

.header .menu-btn:checked ~ .menu-icon:not(.steps) .navicon:before,
.header .menu-btn:checked ~ .menu-icon:not(.steps) .navicon:after {
  top: 0;
}

/* 48em = 768px */

@media (min-width: 48em) {
  .header li {
    float: left;
  }
  .header li a {
    padding: 20px 30px;
  }
  .header .menu {
    clear: none;
    float: right;
    max-height: none;
  }
  .header .menu-icon {
    display: none;
  }
}

</style>

<script>
export default {
  name: 'Reveal',
  data: () => ({
    menuVisible: false,
    user: [],
     establecimiento:'',
    // img_logo:'',
    coun_curs_jefe:0,
    j_curso:{}
  }),
  created(){
    this.user = this.$auth.user();
   
    this.jefe_curso();

   
    console.log(this.user);
  },
  methods:{
  	 logout: function () {
         this.$auth.logout({
                  makeRequest: true,
                  redirect: '/'
              });
      },
      
      url_(){
            this.$router.push({path:'/docente'}); 
      },
      url_perfil(){
            this.$router.push({path:'/adminperfil'});
      },
      url_addAsignatura(){
            this.$router.push({path:'/adminagregarasignatura'});
      },
      jefe_curso(){
      	axios.get('api/auth/docente/profesor_jefe').then((res)=>{
      		if (res.data.tipo == 'success') {
      			this.coun_curs_jefe = res.data.cantidad;
      			this.j_curso = res.data.cursos;
      		}
      	});
      },
      url_jcurso($curso, $txt){
      	this.$router.push({name:'jcurso', params:{ curso: $curso, texto: $txt }});
      }
  } ,
   computed: {
            img_section_style: function(){
                var bgImg= "https://designshack.net/wp-content/uploads/tips-for-using-background-textures-in-web-design.jpg"
                return {
                    // "color": "red",
                    // "border" : "5px solid ",
                    "background": 'url('+bgImg+')'
                }
            },
}
  
}
</script>