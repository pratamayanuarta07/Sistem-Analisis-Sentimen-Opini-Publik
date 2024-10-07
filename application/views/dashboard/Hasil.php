
		<div class="container-fluid my-5">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="card">
							<div class="card-body">
								<div class="card-header bg-primary text-center text-white">
									<h5>DATA TRAINING</h5>
								</div>
								<br />
								<div style=" height: 400px; overflow: scroll;">
									<table id="chen"  class="table table-bordered table-striped table-hover text-center">
										<thead class="table-dark">
											<tr>
												<th>Data</th>
												<th>Label</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											for ($i=0; $i < count($data_train) ; $i++) {
												if ($i == 0) {
													echo '
													<tr>
													<td>'.$data_train[$i].'</td>
                        							<td>'.$label_train[$i][0].'</td>
                        							</tr>';
												}
												else {
													echo '
													<tr>
                        							<td>'.$data_train[$i].'</td>
                        							<td>'.$label_train[$i][0].'</td>
                       								</tr>';
												} 
											}
											?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							
						</div>
						
						<div class="col-lg-6">
							<div class="card">
								<div class="card-body">
									<div class="card-header bg-primary text-center text-white">
										<h5 class="card-title">DATA TESTING</h5>
									</div>
									
									<br />
									
									<div style=" height: 400px; overflow: scroll;">
									<table id="chen_pso" class="table table-bordered table-striped table-hover text-center">
										<thead class="table-dark">
											<tr>
												<th>Data</th>
												<th>Label</th>
											</tr>
										</thead>
										
										<tbody>
											<?php 
											for ($i=0; $i < count($data_testing) ; $i++) {
												if ($i == 0) {
													echo '
													<tr>
													<td>'.$data_testing[$i].'</td>
                        							<td>'.$label_testing[$i].'</td>
                        							</tr>';
												}
												else {
													echo '
													<tr>
                        							<td>'.$data_testing[$i].'</td>
                        							<td>'.$label_testing[$i].'</td>
                       								</tr>';
												} 
											}
											?>
										</tbody>
									</table> 
									</div>
								</div>
							</div>
						</div>
					</div>
					<br />
					
					<div class="d-grid">
						<a class="btn btn-warning btn-block text-black" style="text-decoration: none;" href="<?= base_url('predict') ?>"><strong>  MULAI KLASIFIKASI  </strong></a>
					</div>
				</div>
			</div>

		<!-- <footer class="main-footer bg-dark p-3 text-white text-center">
			<strong>
				Copyright @
				<a style="text-decoration: none" href="#" class="text-white"
					>Hafizh Shafwan Rafa</a>
			</strong>
		</footer>

		<!-- Optional JavaScript; choose one of the two! -->

		<!-- Option 1: Bootstrap Bundle with Popper -->
		<script
			src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
			integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
			crossorigin="anonymous"
		></script>

		<!-- Option 2: Separate Popper and Bootstrap JS -->
		<!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
	</body>
</html> 
