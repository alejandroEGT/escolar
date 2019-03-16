
<template>
  <div class="container">
    <form novalidate class="md-layout" >
      

      <md-card class="">
        <md-card-header>
          <div class="md-title">Users</div>
        </md-card-header>

       

         <md-card-content>
          <div class="md-layout md-gutter">
            <div class="md-layout-item md-small-size-100">
              <md-field >
                <label for="first-name">First Name</label>
                <md-input name="first-name" id="first-name" autocomplete="given-name" v-model="form.firstName" />
                <span class="md-error" >The first name is required</span>
                <span class="md-error" >Invalid first name</span>
              </md-field>
            </div>

            <div class="md-layout-item md-small-size-100">
              <md-field >
                <label for="last-name">Last Name</label>
                <md-input name="last-name" id="last-name" autocomplete="family-name" v-model="form.lastName"  />
                <span class="md-error" >The last name is required</span>
                <span class="md-error" >Invalid last name</span>
              </md-field>
            </div>
          </div>

          <div class="md-layout md-gutter">
            <div class="md-layout-item md-small-size-100">
              <md-field >
                <label for="gender">Gender</label>
                <md-select name="gender" id="gender" v-model="form.gender" md-dense >
                  <md-option></md-option>
                  <md-option value="M">M</md-option>
                  <md-option value="F">F</md-option>
                </md-select>
                <span class="md-error">The gender is required</span>
              </md-field>
            </div>

            <div class="md-layout-item md-small-size-100">
              <md-field >
                <label for="age">Age</label>
                <md-input type="number" id="age" name="age" autocomplete="age" v-model="form.age"  />
                <span class="md-error" >The age is required</span>
                <span class="md-error" >Invalid age</span>
              </md-field>
            </div>
          </div>

          <md-field >
            <label for="email">Email</label>
            <md-input type="email" name="email" id="email" autocomplete="email" v-model="form.email" />
            <span class="md-error" >The email is required</span>
            <span class="md-error" >Invalid email</span>
          </md-field>
        </md-card-content>
      </md-card>
    </form>
  </div>
</template>

<script>
  

  export default {
	  	data(){
	  		return{
	  			form:{}
	  		}
	  	},
	  	methods:{
	  		userSaved(){

	  		}
	  	}
    }
</script>

<style lang="scss" scoped>
  .md-progress-bar {
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
  }
</style>