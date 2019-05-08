<template>
	<div>
		<div class="card">
			<div class="card-header">
				Reporte por curso
			</div>
			<div class="card-body">
				{{ anio }}

				    <div class="row">
				    	<div class="col-md-6">
				    		<md-card>
				    			<bar-chart :data="data_g"></bar-chart>
						    </md-card>
				    	</div>
				    	<div class="col-md-6">
				    		<pie-chart :data="data_a"></pie-chart>
				    	</div>
				    </div>
			</div>
		</div>
	</div>
</template>

<script>
	// import { GChart } from 'vue-google-charts'
	// :bind="true"

	export default{
		components: {
		    
		},
		data(){
			return{
				anio: this.$route.params.anio,
				curso: this.$route.params.curso,
				data_g:[],
				data_a:[]

				
			}
		},
		created(){
			this.chart();
		},
		
		methods:{
			chart(){
				axios.get('api/auth/admin/grafico_genero/'+this.anio+'/'+this.curso).then((res)=>{
					this.data_g = res.data[0];
					this.data_a = res.data[1][0];
			});
			}
		}
	}
</script>