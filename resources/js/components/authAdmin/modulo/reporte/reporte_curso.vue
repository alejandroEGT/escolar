<template>
	<div>
		<div class="card">
			<div class="card-header">
				Reporte por curso
			</div>
			<div class="card-body">
				{{ anio }}

				    <chartjs-bar 
						:datalabel="'GENERO'"
				    	:labels="labels" 
				    	:data="data" 
				    	:bind="true" 
						:width="700" :height="400"
				    	></chartjs-bar>
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
				

				labels: [],
                data:[],
			}
		},
		created(){
			this.chart();
		},
		
		methods:{
			chart(){
				axios.get('api/auth/admin/grafico_genero/'+this.anio+'/'+this.curso).then((res)=>{
					this.labels = res.data.categories;
					this.data = res.data.data;
					console.log(this.chartOptions);
					console.log(this.series);
			});
			}
		}
	}
</script>