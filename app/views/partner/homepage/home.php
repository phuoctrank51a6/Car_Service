<?php
require_once './app/views/partner/master/master.php';
require_once './app/views/partner/master/header.php';
require_once './app/views/partner/master/sidebar.php';
?>
<!-- body -->
		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
							</div>

						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row row-card-no-pd mt--2">
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i class="fas fa-motorcycle text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category"><a class="text-warning" href="">Xe</a></p>
												<h4 class="card-title"></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i class="fas fa-map-marker-alt text-success"></i>			
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category"><a class="text-warning" href="n' ?>">Địa điểm</a></p>
												<h4 class="card-title"></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
											<i class="fas fa-user-friends text-danger"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category"><a class="text-warning" href="' ?>">Tài khoản</a></p>
												<h4 class="card-title"></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-shopping-cart text-primary"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category"><a class="text-warning" href="?>">Đơn hàng</a></p>
												<h4 class="card-title"></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="page-inner">


					
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Đánh giá, bình luận mới nhất</div>
									<a href="">Xem danh sách</a>
								</div>
								<div class="card-body">
								<table class="table table-head-bg-primary mt-4">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Tên</th>
												<th scope="col">Ngày</th>
												<th scope="col">Tiêu đề</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>Mark</td>
												<td>2019-10-31</td>
												<td>@mdo</td>
											</tr>
											<tr>
												<td>2</td>
												<td>Jacob</td>
												<td>2019-10-31</td>
												<td>@fat</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>

		</div>

	<!--   Core JS Files   -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Tháng', 'Doanh thu theo tháng'],
          <?php
                foreach ($chartOrder as $chart) {
                    echo "['$chart->month_date', $chart->total_price],";
                }
                ?>
        ]);

        var options = {
          title: 'Biểu đồ doanh thu năm 2019',
          curveType: 'function',
          legend: { position: 'bottom' }
          
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
	<?php
	require_once './app/views/partner/master/footer.php';
	?>