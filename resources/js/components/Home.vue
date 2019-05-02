<template>
  <div class="banner_content">
        <div class="row justify-content-center">
          
            <div class="col-md-8" style="margin-top: 110px">
                <div class="card card-default">
                    <div class="card-header">Log in</div>

                    <div class="card-body home_banner_area">
                        <div class="row justify-content-md-center">
                              <div class="col col-lg-5">
                                   <div class="">
                                       <div class="card-body">
                                          <!-- <h5 class="card-title">Log in</h5> -->
                                          <md-field>
                                                <label>Email</label>
                                                <md-input v-model="email"></md-input>
                                           </md-field>

                                            <md-field>
                                              <label>Password</label>
                                              <md-input v-model="password" type="password"></md-input>
                                            </md-field>

                                            <!-- <md-field>
                                              <label for="movie">Tipo de usuario</label>
                                              <md-select v-model="rol" >
                                                <md-option value="1">Super Administrador</md-option>
                                                <md-option value="2">Administrador</md-option>
                                                <md-option value="3">Docente</md-option>
                                                
                                              </md-select>
                                            </md-field> -->

                                            <md-button class="md-raised md-primary" @click="login">Ingresar</md-button>

                                            <!-- <md-button type="submit" class="md-primary" @click="redirect_create_user">Create user</md-button> -->
                            
                                            <!-- <a href="">Crear una cuenta</a> -->
                                        </div>


                                  </div>
                              </div>
                         <!--  <div class="col-md-auto">
                            Variable width content
                          </div> -->
                          
                      </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</template>

<style lang="scss" scoped>
  .md-card {
    width: 320px;
    margin: 4px;
    display: inline-block;
    vertical-align: top;
  }
</style>

<script>
export default {
  name: 'Media',
  data(){
    return{
      email:'',
      password:'',
      error:false,
      rol:'',
    }
  },

  methods:{
     redirect_create_user(){
      this.$router.push('create') 
    },
    login(){

      axios.get('api/auth/valida_rol/'+this.email.toLowerCase()).then((res)=>{
              
           var app = this
           if (1 == res.data) {
               this.$auth.login({
                params: {
                  email: app.email.toLowerCase(),
                  password: app.password
                }, 
                success: function () {},
                error: function () {},
                rememberMe: true,
                redirect: '/index',
                fetchUser: true,
            });
           }
           if (2 == res.data) {
             this.$auth.login({
                params: {
                  email: app.email.toLowerCase(),
                  password: app.password
                }, 
                success: function () {},
                error: function () {},
                rememberMe: true,
                redirect: '/admin',
                fetchUser: true,
            });
           } 

           if (3 == res.data) {
             this.$auth.login({
                params: {
                  email: app.email.toLowerCase(),
                  password: app.password
                }, 
                success: function () {},
                error: function () {},
                rememberMe: true,
                redirect: '/docente',
                fetchUser: true,
            });
           } 
       })      
    },
  }
}
</script>