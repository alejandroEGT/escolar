
<template>
  <div>
         <!--================ Start Header Area =================-->
    <header class="header_area">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light" >
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.html"><img src="img/bogi2.png" width="100" height="100" alt=""></a> By <a class="navbar-brand logo_h" href="index.html"><img src="img/droban.png" width="70" height="100" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                     aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav justify-content-end">
                            <li class="nav-item active"><a class="nav-link" @click="url_">Home</a></li>
                            <li class="nav-item"><a class="nav-link" @click="url_create">Crear cuenta</a></li>
                            <li class="nav-item"><a class="nav-link" @click="url_login">Log in</a></li>

                           <!--  <li class="nav-item"><a class="nav-link">Services</a></li>
                            <li class="nav-item"><a class="nav-link">Portfolio</a></li> -->
                           <!--  <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                 aria-expanded="false">Pages</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="elements.html">Elements</a></li>
                                    <li class="nav-item"><a class="nav-link" href="portfolio-details.html">Portfolio Details</a></li>
                                </ul>
                            </li> -->
                            <!-- <li class="nav-item submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                                 aria-expanded="false">Blog</a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                                    <li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li> -->
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--================ End Header Area =================-->
       
         <div>
          <transition>
            <router-view></router-view>
          </transition>
         </div> 
  </div>


</template>

<style lang="scss" scoped>
  .md-app {
   
    border: 1px solid rgba(#000, .12);
  }

   // Demo purposes only
  .md-drawer {
    background: red !important; // makes the drawer partially blue
  }
  
</style>

<script>

export default {
  name: 'LastRowFixed',
  data: () => ({
    menuVisible: false
  }),
  methods:{
    url_(){
      this.$router.push('/');
    },
    url_login(){
      this.$router.push('login') 
    },
    url_create(){
      this.$router.push('create') 
    }
  }
}
</script>