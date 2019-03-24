<template>
	
	<div>
		<section class="home_banner_area">
        <div class="banner_inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-sm-4 col-md-4 col-sx-4">
                        <div class="banner_content">
                            <h3 class="text-uppercase">Hola!!</h3>
                            <h1 class="text-uppercase">ESTAMOS en desarrollo</h1>
                            <h5 class="text-uppercase">YA VOLVEMOS</h5>
                            <div class="d-flex align-items-center">
                                <a class="primary_btn" @click="url_login"><span style="color:black">Log in</span></a>
                                <a class="primary_btn tr-bg" @click="url_create"><span>Crear cuenta</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="home_right_img">
                            <img class="" src="img/banner/home-right.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--================ Start About Us Area =================-->
	<section class="about_area section_gap">
		<div class="container">
			<div class="row justify-content-start align-items-center">
				<div class="col-lg-5">
					<div class="about_img">
						<img class="" src="img/about-us.png" alt="">
					</div>
				</div>

				<div class="offset-lg-1 col-lg-5">
					<div class="main_title text-left">
						<h2>Trabajo digital y <br>
							Organizado <br>
							para ti</h2>
						<p>
							Llevamos lo digital a tu entorno de trabajo, somos un sistema web dedicado a gestionar la informacion para ti y tu escuela.
						</p>
						<p>
							Te contamos mas! se paciente...
						</p>
						<a class="primary_btn" href="#"><span>Esperar para mas detalles..</span></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	</div>
</template>

<script>
	export default{
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