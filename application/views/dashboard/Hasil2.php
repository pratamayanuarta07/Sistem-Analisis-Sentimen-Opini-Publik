 			<div class="container-fluid my-5">
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<div class="card" style="width: 1300px;">
							<div class="card-body">
								<div class="card-header bg-primary text-center text-white">
									<h5>HASIL KLASIFIKASI</h5>
								</div>
								<br />
								<div style=" height: 400px; overflow: scroll;">
									<table id="chen"  class="table table-bordered table-striped table-hover text-center">
										<thead class="table-dark">
											<tr>
												<th>No.</th>
												<th>Data</th>
												<th>Label Aktual</th>
												<th>Label Prediksi Tanpa Chi</th>
												<th>Label Prediksi Dengan Chi</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											for ($i=0; $i < count($data) ; $i++) {
												if ($i == 0) {
													$temp = $i+1;
													echo '
													<tr>
													<td>'.($i+1).'</td>
													<td>'.$data[$i].'</td>
                        							<td>'.$label_aktual[$i].'</td>
                        							<td>'.$label_prediksi_tanpa[$i].'</td>
                        							<td>'.$label_prediksi[$i].'</td>
                        							</tr>';
												}
												else {
													echo '
													<tr>
													<td>'.($i+1).'</td>
                        							<td>'.$data[$i].'</td>
                        							<td>'.$label_aktual[$i].'</td>
                        							<td>'.$label_prediksi_tanpa[$i].'</td>
                        							<td>'.$label_prediksi[$i].'</td>
                       								</tr>';
												} 
											}
											?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<br>
							<div class="card" style="width: 1300px;">
							<div class="card-body">
								<div class="card-header bg-primary text-center text-white">
									<h5>CONFUSION MATRIX DENGAN CHI</h5>
								</div>
								<br />
								<div style=" height: 190px; overflow: scroll;">
									<table id="chen"  class="table table-bordered table-striped table-hover text-center">
										<thead class="table-dark">
											<tr>
												<td></td>
												<td>Netral</td>
												<td>Positif</td>
												<td>Negatif</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Netral</td>
												<td><?php echo $cf_dengan[0][0]; ?></td>
												<td><?php echo $cf_dengan[0][1]; ?></td>
												<td><?php echo $cf_dengan[0][2]; ?></td>
											</tr>
											<tr>
												<td>Positif</td>
												<td><?php echo $cf_dengan[1][0]; ?></td>
												<td><?php echo $cf_dengan[1][1]; ?></td>
												<td><?php echo $cf_dengan[1][2]; ?></td>
											</tr>
											<tr>
												<td>Negatif</td>
												<td><?php echo $cf_dengan[2][0]; ?></td>
												<td><?php echo $cf_dengan[2][1]; ?></td>
												<td><?php echo $cf_dengan[2][2]; ?></td>
											</tr>
											
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<br>
							<div class="card" style="width: 1300px;">
							<div class="card-body">
								<div class="card-header bg-primary text-center text-white">
									<h5>CONFUSION MATRIX TANPA CHI</h5>
								</div>
								<br />
								<div style=" height: 190px; overflow: scroll;">
									<table id="chen"  class="table table-bordered table-striped table-hover text-center">
										<thead class="table-dark">
											<tr>
												<td></td>
												<td>Netral</td>
												<td>Positif</td>
												<td>Negatif</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Netral</td>
												<td><?php echo $cf_tanpa[0][0]; ?></td>
												<td><?php echo $cf_tanpa[0][1]; ?></td>
												<td><?php echo $cf_tanpa[0][2]; ?></td>
											</tr>
											<tr>
												<td>Positif</td>
												<td><?php echo $cf_tanpa[1][0]; ?></td>
												<td><?php echo $cf_tanpa[1][1]; ?></td>
												<td><?php echo $cf_tanpa[1][2]; ?></td>
											</tr>
											<tr>
												<td>Negatif</td>
												<td><?php echo $cf_tanpa[2][0]; ?></td>
												<td><?php echo $cf_tanpa[2][1]; ?></td>
												<td><?php echo $cf_tanpa[2][2]; ?></td>
											</tr>
											
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<br>
							<ul class="list-group" style="width: 1300px;">
								<li class="list-group-item"><strong> Akurasi : <?php  echo $akurasi?>% Dan Akurasi Tanpa Chi : <?php  echo $akurasi_tanpa?>%</strong></li>
							</ul>	
						</div>
					</div>
					<br />
					
					<div class="d-grid">
						<a class="btn btn-warning btn-block text-black" style="text-decoration: none;" href="<?= base_url() ?>"><strong>  BACK  </strong></a>
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
