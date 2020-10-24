<div id="content" class="container-fluid py-4">
	<section class="">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-3 col-md-6 card-paddin">
					<div class="card">
						<div class="card-body shadow-sm">
							<div class="stat-widget-five d-flex">
								<div class="stat-icon dib flat-color-1">
									<i class="fas fa-chart-bar icon-primario " style="color:#218838;"></i></i>
								</div>
								<div class="stat-content pl-4">
									<div class="text-left dib">
										<div class="stat-text"><span class="count">23569</span></div>
										<div class="stat-heading">Visitas</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 card-paddin">
					<div class="card">
						<div class="card-body shadow-sm">
							<div class="stat-widget-five d-flex">
								<div class="stat-icon dib flat-color-2">
									<i class="fas fa-shopping-cart icon-primario" style="color:#0070C0;"></i>
								</div>
								<div class="stat-content pl-4">
									<div class="text-left dib">
										<div class="stat-text"><span class="count">3435</span></div>
										<div class="stat-heading">Compras</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 card-paddin">
					<div class="card">
						<div class="card-body shadow-sm">
							<div class="stat-widget-five d-flex">
								<div class="stat-icon dib flat-color-3">
									<i class="fas fa-user-tie icon-primario" style="color:#E67D35;"></i>
								</div>
								<div class="stat-content pl-4">
									<div class="text-left dib">
										<div class="stat-text"><span class="count">349</span></div>
										<div class="stat-heading">Proveedores</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6 card-paddin">
					<div class="card">
						<div class="card-body shadow-sm">
							<div class="stat-widget-five d-flex">
								<div class="stat-icon dib flat-color-4">
									<i class="fas fa-users icon-primario" style="color:#797a7ac4;"></i>
								</div>
								<div class="stat-content pl-4">
									<div class="text-left dib">
										<div class="stat-text"><span class="count">2986</span></div>
										<div class="stat-heading">Clientes</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- graficas estaticas -->
			<div class="container-fluid">
				<div class="row pt-3">
					<div class="col-lg-12 py-3 shadow-sm div-grafica">
						<h6 class="font-weight-bold">Ventas por mes</h6>
						<canvas id="myChart" width="1271" height="536" style="display: block; width: 1271px; height: 536px;"></canvas>
						<script>
							var ctx = document.getElementById("myChart").getContext("2d");
							var myChart = new Chart(ctx,{
								type: "bar",
								data:{
									labels:['col1','col2','col3','col4','col5','col6','col7'],
									datasets:[{
										label:'VENTAS',
										data:[10,9,15,12,10,9,9],
										backgroundColor:[
											'rgb(255,224,230)',
											'rgb(255,236,217)',
											'rgb(255,245,221)',
											'rgb(219,242,242)',
											'rgb(255,224,230)',
											'rgb(235,224,255)',
											'rgb(244,245,245)',
										]
									}]
								},
								options:{
									scales:{
										yAxes:[{
											ticks:{
												beginAtZero:true
											}
										}]

									}
								}

							});

						</script>

					</div>
				</div>
			</div>

			<!-- tablas proveedores y clientes -->
			<div class="container">
				<div class="row pt-3">
					<div class="col-lg-4">
						<div class="col-12 col-md-12 form-color p-4 shadow-sm">
							<h6 class="pb-1">Proveedores registrados</h6>
							<div class="row mb-3">
								<div class="col-xl-12 col-lg-12">
									<table class="table">
										<thead>
											<tr>
												<th scope="col"><small class="font-weight-bold">ID<small></th>
												<th scope="col"><small class="font-weight-bold">Nombre<small></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="align-middle"><span class="font-weight-bold">1</span></td>
												<td class="align-middle"><span class="status-span badge-primary badge-active">Nombre</span></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 t-responsive">
						<div class="col-12 col-md-12 form-color p-4 shadow-sm">
							<h6 class="pb-1">Clientes registrados</h6>
							<div class="row mb-3">
								<div class="col-xl-12 col-lg-12">
									<table class="table">
										<thead>
											<tr>
												<th scope="col"><small class="font-weight-bold">ID<small></th>
												<th scope="col"><small class="font-weight-bold">Nombre<small></th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="aling-middle"><span class="font-weigth-bold">1</span></td>
												<td class="align-middle"><span class="status-span badge-primary badge-active">Nombre</span></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

					<div class="col-lg-4 t-responsive">
						<div class="col-12 col-md-12 form-color p-4 shadow-sm">
							<h6 class="notifiaciones-mensajes"> Mensajes <span class="badge badge-light">19</span></h6>
							<!-- SOLO VAS A MOSTRAR DE 4 MENSAJES -->
							<div class="container">
								<a class="link-mensajeria" href="#"><small class="punto" style="color: red;"><i class="fas fa-circle"></i></small> Juan alberto</a>
								<p>El servicio es excelente...</p>
								<a class="link-mensajeria" href="#"><small class="punto" style="color: red;"><i class="fas fa-circle"></i></small> Juan alberto</a>
								<p>El servicio es excelente...</p>
								<a class="link-mensajeria" href="#"><small class="punto" style="color: red;"><i class="fas fa-circle"></i></small> Juan alberto</a>
								<p>El servicio es excelente...</p>
								<a class="link-mensajeria" href="#"><small class="punto" style="color: red;"><i class="fas fa-circle"></i></small> Juan alberto</a>
								<p>El servicio es excelente...</p>
							</div>
						</div>
					</div>
				</div>
			</div>
	</section>
</div>