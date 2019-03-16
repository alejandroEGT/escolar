<template>
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card card-default">
              <div class="card-header">Crear usuario</div>

              <div class="card-body">
                  <div class="row justify-content-md-center">
                        <div class="col col-lg-5">
                             <div class="">
                                 <div class="card-body">
                                    <h5 class="card-title">Log in</h5>
                                    <md-field>
                                          <label>Nombres</label>
                                          <md-input v-model="nombre"></md-input>
                                     </md-field>
                                     <md-field>
                                          <label>Apellido Paterno</label>
                                          <md-input v-model="apellido_p" ></md-input>
                                     </md-field>
                                     <md-field>
                                          <label>Apellido Materno</label>
                                          <md-input v-model="apellido_m"></md-input>
                                     </md-field>
                                     <md-field>
                                          <label for="movie">Sexo</label>
                                          <md-select v-model="sexo" name="sexo" id="sexo">
                                            <md-option value="F">Femenino</md-option>
                                            <md-option value="M">Masculino</md-option>
                                          </md-select>
                                    </md-field>
                                    <md-field>
                                          <label for="movie">Tipo de usuario</label>
                                          <md-select v-model="rol" name="rol" id="rol">
                                            <md-option value="1">Super Administrador</md-option>
                                            <md-option value="2">Administrador</md-option>
                                          </md-select>
                                    </md-field>
                                    <md-field>
                                          <label>Email</label>
                                          <md-input v-model="email"></md-input>
                                     </md-field>

                                      <md-field>
                                        <label>Password</label>
                                        <md-input v-model="password" type="password"></md-input>
                                      </md-field>

                                      <md-button class="md-raised md-primary" @click="register">Crear</md-button>

                                      <md-button type="submit" class="md-primary" >Create user</md-button>
                      
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
</template>

<script> 
    export default {
        data(){
            return {
                nombre: '',
                apellido_p:'',
                apellido_m:'',
                email: '',
                password: '',
                error: false,
                errors: {},
                success: false,
                rol:'',
                sexo:'',
            };
        },
        methods: {
            register(){
                var app = this
                this.$auth.register({
                    data: {
                        nombre: app.nombre,
                        apellido_p: app.apellido_p,
                        apellido_m: app.apellido_m,
                        rol:app.rol,
                        sexo:app.sexo,
                        email: app.email,
                        password: app.password
                    }, 
                    success: function () {
                        app.success = true
                    },
                    error: function (resp) {
                        app.error = true;
                        app.errors = resp.response.data.errors;
                    },
                    redirect: null
                });                
            }
        }
    }
</script>