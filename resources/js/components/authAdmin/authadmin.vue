

   <template >

    <div>
      
       <header class="header">
        <div class="header-wrap u-flex u-flexCenter u-container">
          
          <!-- Logo -->
          <div class="header-left u-flex0">
            <a href="/" class="logo"><img width="40" :src="'/'+img_logo" alt="Avatar"></a>
            <label style="color:white"><small>
            {{ user.nombres+' '+user.apellido_paterno+' '+user.apellido_materno }}</small></label>
          </div>
          
          <!-- menu -->
          <nav class="header-center menu u-flex1">
            <ul class="u-flex u-flexCenter u-hide-before-md">
              <!-- <li><a  @click="url_perfil" style="color:white">Perfil</a></li>
              <li><a style="color:white">Inicio</a></li>
              <li><a style="color:white">Salir</a></li> -->
             <!--  <li><a href="#">menu3</a></li>
              <li><a href="#">menu4</a></li> -->
            </ul>
          </nav>
          
          <div class="header-right u-flex u-flexCenter u-flex0">
         
            <div class="follow u-hide-before-md">
      
              <button class="btn btn-link" @click="url_perfil" style="color:white"><small>Perfil</small></button>
              <button class="btn btn-link" @click="url_" style="color:white"><small>Inicio</small></button>
              <button class="btn btn-link" @click="logout" style="color:white"><small>Salir</small></button>
              <button class="btn btn-link" @click="url_addAsignatura" style="color:white">Agregar asignatura</button>
            </div>
            
            <!-- Menu Open Close -->
            <a @click="accion" class="button-nav--toggle u-hide-after-md">
              <span></span>
              <span></span>
              <span></span>
            </a>
          </div>
          
        </div>
        
        <!-- Sidenav  -->
        <div class="sidenav">
          <div class="sidenav-wrap">
            <ul>
              <li><a @click="url_perfil">Perfil </a></li>
              <li><a @click="url_">Inicio </a></li>
              <li><a @click="logout">Salir </a></li>
              <li><a @click="url_addAsignatura">Agregar asignatura</a></li>
            </ul>
          </div>
        </div>
      </header>
      <br>
      <div class="container-fluid" style="height:100%">
          <router-view :key="$route.path"></router-view>  
      </div>
  </div>












  <!-- <div  class="page-container" v-if="$auth.check()">

    <md-app md-mode="reveal">
      <md-app-toolbar class="md-primary">

        <md-button class="md-icon-button" @click="menuVisible = !menuVisible">
            <md-avatar>
          <img :src="'/'+img_logo" alt="Avatar">
        </md-avatar>
        
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

          <md-list-item>
            <md-icon><i class="fas fa-plus-square"></i></md-icon>
            <span class="md-list-item-text" @click="url_addAsignatura">Agregar Asignatura</span>
          </md-list-item>

          <md-list-item>
            <md-icon>delete</md-icon>
            <span class="md-list-item-text">Trash</span>
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
  </div> -->
</template>

<script>
export default {
  name: 'Reveal',
  data: () => ({
    menuVisible: false,
    user: [],
    establecimiento:'',
    img_logo:''
  }),
  created(){
    this.user = this.$auth.user();
    this.establecimiento = '';

    this.logo();
    console.log(this.user);
  },
  methods:{
     close_menu(){
        $('body').toggleClass('is-showNavMob');
     },
     accion(){
        //e.preventDefault();
        $('body').toggleClass('is-showNavMob');
     },
  	 logout: function () {
         this.$auth.logout({
                  makeRequest: true,
                  redirect: '/'
              });
      },
      logo(){
          axios.get('api/auth/sa/logo').then((res)=>{
                  this.img_logo = res.data.logo;
                  this.establecimiento = res.data.establecimiento;
          })
      },
      url_(){
        this.close_menu()
            this.$router.push({path:'/admin'}); 
      },
      url_perfil(){
        this.close_menu()
            this.$router.push({path:'/adminperfil'});
      },
      url_addAsignatura(){
        this.close_menu()
            this.$router.push({path:'/adminagregarasignatura'});
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


<style lang="scss" scoped>
  .md-app {
    max-height: 800px;
    border: 1px solid rgba(#000, .12);
  }

   // Demo purposes only
  .md-drawer {
    width: 230px;
    max-width: calc(100vw - 125px);
  }
  .back{
    background-image: url('https://designshack.net/wp-content/uploads/tips-for-using-background-textures-in-web-design.jpg');
    background-repeat: no-repeat;
    background-position: center; 
    position: relative;
  }
  // Variables
$header-color: white;

// Global
html { height: 100%}
a {
    color: inherit;
    text-decoration: none;
}

body {
  font-family: 'Source Sans Pro', sans-serif;
  height: 100%;
}

ul {
  list-style: none;
  list-style-image: none;
  margin: 0;
  padding: 0;
}

// Utilities
.u-flex { display: flex }
.u-flexCenter { align-items: center }
.u-flex1 { flex: 1 1 auto }
.u-flex0 { flex: 0 0 auto }
.u-container {
  margin-left: auto;
  margin-right: auto;
  padding-left: 20px;
  padding-right: 20px;
}

// Header
.header {
  background-color: #3F8DF7;
  
  a { color: $header-color; }
  
  &-wrap { 
    max-width: 1200px ;
    position: relative;
    height: 50px;
    z-index: 100;
  }
}

// Logo
.logo {
  font-size: 24px;
  font-weight: 600;
  color: #fff !important;
  margin-right: 20px;
}

// Menu
.menu {
  overflow: hidden;
  
  a {
    margin-right: 22px;
    text-transform: uppercase;
  }
}


/* Toggle BTN for Menu */
.button-nav--toggle {
  height: 48px;
  position: relative;
  transition: transform .4s;
  width: 48px;
  
  span {
    background-color: $header-color;
    display: block;
    height: 2px;
    left: 14px;
    margin-top: -1px;
    position: absolute;
    top: 50%;
    transition: .4s;
    width: 20px;
    
    &:first-child { transform: translateY(-6px) }
    &:last-child { transform: translateY(6px) }
  }
}



// Sidenav
.sidenav {
  color: rgba(0,0,0,.8);
  height: 100vh;
  padding: 50px 20px;
  position: fixed;
  left: 0;
  top: 0;
  right: 0;
  bottom: 0;
  transform: translateX(100%);
  transition: .4s;
  will-change: transform;
  z-index: 99;
  
  &-wrap {
    background: #eee;
    overflow: auto;
    padding: 20px 0;
    top: 50px;
    left: 0;
    right: 0;
    bottom: 0;
    position: absolute;
  }
  
  ul a {
    padding: 10px 20px;
    display: block;
    color: #222;
  }
}

// follow
.follow a {
  font-size: 20px;
  margin-right: 8px;
}


// main
.main {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
  transition: transform .5s ease;
}

.demo {
  background: #00a034;
  color: #fff;
  padding:10px 20px;
  border-radius: 2px;
  text-decoration: none;
  font-size: 20px;
  letter-spacing: 2px;
}


// Media Query
@media only screen and (max-width: 766px) {
  // show sidenav   
  body.is-showNavMob { 
    overflow: hidden;
    
    .sidenav { transform: translateX(0) }
    .main { transform: translateX(-25%) }
   
     /* Active BTN Sidenav */
    .button-nav--toggle span {
      &:first-child { transform: rotate(45deg) translate(0) }
      &:nth-child(2) { transform: scaleX(0) }
      &:last-child { transform: rotate(-45deg) translate(0) }
    }
  }

  
 // hide
  .u-hide-before-md { display: none !important }
}

@media only screen and (min-width: 766px) {
  .u-hide-after-md { display: none !important }
}
</style>